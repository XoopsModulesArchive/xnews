<?php
//  ------------------------------------------------------------------------ //
//                XOOPS - PHP Content Management System                      //
//                  Copyright (c) 2005-2006 Instant Zero                     //
//                     <http://xoops.instant-zero.com>                      //
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

/*
 * Created on 28 oct. 2006
 *
 * This page will display a list of the authors of the site
 *
 * @package News
 * @author Instant Zero
 * @copyright (c) Instant Zero - http://www.instant-zero.com
 */
require_once __DIR__ . '/header.php';
require_once NW_MODULE_PATH . '/class/class.newsstory.php';
require_once NW_MODULE_PATH . '/class/class.newstopic.php';
require_once NW_MODULE_PATH . '/class/class.sfiles.php';
require_once NW_MODULE_PATH . '/include/functions.php';

if (!nw_getmoduleoption('newsbythisauthor', NW_MODULE_DIR_NAME)) {
    redirect_header('index.php', 2, _ERRORS);
    exit();
}

$GLOBALS['xoopsOption']['template_main'] = 'nw_news_whos_who.html';
require_once XOOPS_ROOT_PATH . '/header.php';

$option  = nw_getmoduleoption('displayname', NW_MODULE_DIR_NAME);
$article = new nw_NewsStory();
$uid_ids = [];
$uid_ids = $article->getWhosWho(nw_getmoduleoption('restrictindex', NW_MODULE_DIR_NAME));
if (count($uid_ids) > 0) {
    $lst_uid       = implode(',', $uid_ids);
    $memberHandler = xoops_getHandler('member');
    $critere       = new Criteria('uid', '(' . $lst_uid . ')', 'IN');
    $tbl_users     = $memberHandler->getUsers($critere);
    foreach ($tbl_users as $one_user) {
        $uname = '';
        switch ($option) {
            case 1:        // Username
                $uname = $one_user->getVar('uname');
                break;

            case 2:        // Display full name (if it is not empty)
                if ('' != xoops_trim($one_user->getVar('name'))) {
                    $uname = $one_user->getVar('name');
                } else {
                    $uname = $one_user->getVar('uname');
                }
                break;
        }
        $xoopsTpl->append('whoswho', ['uid' => $one_user->getVar('uid'), 'name' => $uname, 'user_avatarurl' => XOOPS_URL . '/uploads/' . $one_user->getVar('user_avatar')]);
    }
}
//DNPROSSI - ADDED
$xoopsTpl->assign('newsmodule_url', NW_MODULE_URL);

$xoopsTpl->assign('advertisement', nw_getmoduleoption('advertisement', NW_MODULE_DIR_NAME));

/**
 * Manage all the meta datas
 */
nw_CreateMetaDatas($article);

$xoopsTpl->assign('xoops_pagetitle', _AM_NW_WHOS_WHO);
$myts             = MyTextSanitizer::getInstance();
$meta_description = _AM_NW_WHOS_WHO . ' - ' . htmlspecialchars($xoopsModule->name(), ENT_QUOTES | ENT_HTML5);
if (isset($xoTheme) && is_object($xoTheme)) {
    $xoTheme->addMeta('meta', 'description', $meta_description);
} else {    // Compatibility for old Xoops versions
    $xoopsTpl->assign('xoops_meta_description', $meta_description);
}

require_once XOOPS_ROOT_PATH . '/footer.php';
