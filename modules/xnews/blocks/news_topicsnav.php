<?php
// $Id: news_topicsnav.php,v 1.5 2004/09/01 17:48:07 hthouzard Exp $
//  ------------------------------------------------------------------------ //
//                XOOPS - PHP Content Management System                      //
//                    Copyright (c) 2000 XOOPS.org                           //
//                       <https://www.xoops.org>                             //
// ------------------------------------------------------------------------- //
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
if (!defined('XOOPS_ROOT_PATH')) {
    die('XOOPS root path not defined');
}

/**
 * Solves issue when upgrading xoops version
 * Paths not set and block would not work
 */
if (!defined('NW_MODULE_PATH')) {
    define('NW_SUBPREFIX', 'nw');
    define('NW_MODULE_DIR_NAME', 'xnews');
    define('NW_MODULE_PATH', XOOPS_ROOT_PATH . '/modules/' . NW_MODULE_DIR_NAME);
    define('NW_MODULE_URL', XOOPS_URL . '/modules/' . NW_MODULE_DIR_NAME);
    define('NW_UPLOADS_NEWS_PATH', XOOPS_ROOT_PATH . '/uploads/' . NW_MODULE_DIR_NAME);
    define('NW_TOPICS_FILES_PATH', XOOPS_ROOT_PATH . '/uploads/' . NW_MODULE_DIR_NAME . '/topics');
    define('NW_ATTACHED_FILES_PATH', XOOPS_ROOT_PATH . '/uploads/' . NW_MODULE_DIR_NAME . '/attached');
    define('NW_TOPICS_FILES_URL', XOOPS_URL . '/uploads/' . NW_MODULE_DIR_NAME . '/topics');
    define('NW_ATTACHED_FILES_URL', XOOPS_URL . '/uploads/' . NW_MODULE_DIR_NAME . '/attached');
}

function nw_b_news_topicsnav_show($options)
{
    require_once NW_MODULE_PATH . '/include/functions.php';
    require_once NW_MODULE_PATH . '/class/class.newstopic.php';
    $myts             = MyTextSanitizer::getInstance();
    $block            = [];
    $newscountbytopic = [];
    $perms            = '';
    $xt               = new nw_NewsTopic();
    $restricted       = nw_getmoduleoption('restrictindex', NW_MODULE_DIR_NAME);
    if ($restricted) {
        global $xoopsUser;
        $moduleHandler = xoops_getHandler('module');
        $newsModule    = $moduleHandler->getByDirname(NW_MODULE_DIR_NAME);
        $groups        = is_object($xoopsUser) ? $xoopsUser->getGroups() : XOOPS_GROUP_ANONYMOUS;
        $gpermHandler  = xoops_getHandler('groupperm');
        $topics        = $gpermHandler->getItemIds('nw_view', $groups, $newsModule->getVar('mid'));
        if (count($topics) > 0) {
            $topics = implode(',', $topics);
            $perms  = ' AND topic_id IN (' . $topics . ') ';
        } else {
            return '';
        }
    }
    $topics_arr = $xt->getChildTreeArray(0, 'topic_title', $perms);
    if (1 == $options[0]) {
        $newscountbytopic = $xt->getnwCountByTopic();
    }
    if (is_array($topics_arr) && count($topics_arr)) {
        foreach ($topics_arr as $onetopic) {
            if (1 == $options[0]) {
                $count = 0;
                if (array_key_exists($onetopic['topic_id'], $newscountbytopic)) {
                    $count = $newscountbytopic[$onetopic['topic_id']];
                }
            } else {
                $count = '';
            }
            $block['topics'][] = ['id' => $onetopic['topic_id'], 'nw_count' => $count, 'topic_color' => '#' . $onetopic['topic_color'], 'title' => $myts->displayTarea($onetopic['topic_title'])];
        }
    }
    //DNPROSSI ADDED
    $block['newsmodule_url'] = NW_MODULE_URL;

    // DNPROSSI SEO
    $seo_enabled = nw_getmoduleoption('seo_enable', NW_MODULE_DIR_NAME);
    if (0 != $seo_enabled) {
        $block['urlrewrite'] = 'true';
    } else {
        $block['urlrewrite'] = 'false';
    }

    return $block;
}

function nw_b_news_topicsnav_edit($options)
{
    $form = _MB_NW_SHOW_NEWS_COUNT . " <input type='radio' name='options[]' value='1'";
    if (1 == $options[0]) {
        $form .= ' checked';
    }
    $form .= '>' . _YES;
    $form .= "<input type='radio' name='options[]' value='0'";
    if (0 == $options[0]) {
        $form .= ' checked';
    }
    $form .= '>' . _NO;
    return $form;
}

function nw_b_news_topicsnav_onthefly($options)
{
    $options = explode('|', $options);
    $block   = nw_b_news_topicsnav_show($options);

    $tpl = new XoopsTpl();
    $tpl->assign('block', $block);
    $tpl->display('db:nw_news_block_topicnav.html');
}
