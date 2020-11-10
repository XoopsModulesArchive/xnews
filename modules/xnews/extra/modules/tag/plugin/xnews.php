<?php
//  ------------------------------------------------------------------------ //
//                XOOPS - PHP Content Management System                      //
//                    Copyright (c) 2000 XOOPS.org                           //
//                       <https://www.xoops.org>                             //
//  ------------------------------------------------------------------------ //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
//                                                                           //
//  You may not change or alter any portion of this comment or credits       //
//  of supporting developers from this source code or any supporting         //
//  source code which is considered copyrighted (c) material of the          //
//  original comment or credit authors.                                      //
//                                                                           //
//  This program is distributed in the hope that it will be useful,          //
//  but WITHOUT ANY WARRANTY; without even the implied warranty of           //
//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            //
//  GNU General Public License for more details.                             //
//                                                                           //
//  You should have received a copy of the GNU General Public License        //
//  along with this program; if not, write to the Free Software              //
//  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA //
//  ------------------------------------------------------------------------ //
// Author: Hervé Thouzard, Instant Zero                                      //
// URL: http://xoops.instant-zero.com                                        //
// ------------------------------------------------------------------------- //

function xnews_tag_iteminfo(&$items)
{
    if (empty($items) || !is_array($items)) {
        return false;
    }

    $items_id = [];
    foreach (array_keys($items) as $cat_id) {
        foreach (array_keys($items[$cat_id]) as $item_id) {
            $items_id[] = (int)$item_id;
        }
    }
    require_once NW_MODULE_PATH . '/class/class.newsstory.php';
    $tempnw    = new nw_NewsStory();
    $items_obj = $tempnw->getStoriesByIds($items_id);

    foreach (array_keys($items) as $cat_id) {
        foreach (array_keys($items[$cat_id]) as $item_id) {
            if (isset($items_obj[$item_id])) {
                $item_obj                 =& $items_obj[$item_id];
                $items[$cat_id][$item_id] = [
                    'title'   => $item_obj->title(),
                    'uid'     => $item_obj->uid(),
                    'link'    => "article.php?storyid={$item_id}",
                    'time'    => $item_obj->published(),
                    'tags'    => tag_parse_tag($item_obj->tags()), // optional
                    'content' => $item_obj->hometext(),
                ];
            }
        }
    }
    unset($items_obj);
}

function xnews_tag_synchronization($mid)
{
    global $xoopsDB;
    $itemHandler_keyName = 'storyid';
    $itemHandler_table   = $xoopsDB->prefix('nw_stories');
    $linkHandler         = xoops_getModuleHandler('link', 'tag');
    $where               = "($itemHandler_table.published > 0 AND $itemHandler_table.published <= " . time() . ") AND ($itemHandler_table.expired = 0 OR $itemHandler_table.expired > " . time() . ')';

    /* clear tag-item links */
    if ($linkHandler->mysql_major_version() >= 4):
        $sql = "	DELETE FROM {$linkHandler->table}"
               . '	WHERE '
               . "		tag_modid = {$mid}"
               . '		AND '
               . '		( tag_itemid NOT IN '
               . "			( SELECT DISTINCT {$itemHandler_keyName} "
               . "				FROM {$itemHandler_table} "
               . "				WHERE $where"
               . '			) '
               . '		)';
    else:
        $sql = "	DELETE {$linkHandler->table} FROM {$linkHandler->table}"
               . "	LEFT JOIN {$itemHandler_table} AS aa ON {$linkHandler->table}.tag_itemid = aa.{$itemHandler_keyName} "
               . '	WHERE '
               . "		tag_modid = {$mid}"
               . '		AND '
               . "		( aa.{$itemHandler_keyName} IS NULL"
               . "			OR $where"
               . '		)';
    endif;
    if (!$result = $linkHandler->db->queryF($sql)) {
        //xoops_error($linkHandler->db->error());
    }
}
