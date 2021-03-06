<?php
// $Id: groupperms.php,v 1.7 2004/07/26 17:51:25 hthouzard Exp $
// ------------------------------------------------------------------------ //
// XOOPS - PHP Content Management System            				        //
// Copyright (c) 2000 XOOPS.org                           					//
// <https://www.xoops.org>                             						//
// ------------------------------------------------------------------------ //
// This program is free software; you can redistribute it and/or modify     //
// it under the terms of the GNU General Public License as published by     //
// the Free Software Foundation; either version 2 of the License, or        //
// (at your option) any later version.                                      //
// 																			//
// You may not change or alter any portion of this comment or credits       //
// of supporting developers from this source code or any supporting         //
// source code which is considered copyrighted (c) material of the          //
// original comment or credit authors.                                      //
// 																			//
// This program is distributed in the hope that it will be useful,          //
// but WITHOUT ANY WARRANTY; without even the implied warranty of           //
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            //
// GNU General Public License for more details.                             //
// 																			//
// You should have received a copy of the GNU General Public License        //
// along with this program; if not, write to the Free Software              //
// Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA //
// ------------------------------------------------------------------------ //
require_once __DIR__ . '/header.php';
require_once dirname(__DIR__, 3) . '/include/cp_header.php';
require_once XOOPS_ROOT_PATH . '/class/xoopstopic.php';
require_once XOOPS_ROOT_PATH . '/class/xoopslists.php';
require_once XOOPS_ROOT_PATH . '/class/xoopsform/grouppermform.php';
require_once NW_MODULE_PATH . '/admin/functions.php';

xoops_cp_header();

adminmenu(2, _AM_NW_GROUPPERM);
echo '<h2>' . _AM_NW_GROUPPERM . '</h2>';
$permtoset                = isset($_POST['permtoset']) ? (int)$_POST['permtoset'] : 1;
$selected                 = ['', '', ''];
$selected[$permtoset - 1] = ' selected';
echo "<form method='post' name='fselperm' action='groupperms.php'><select name='permtoset' onChange='javascript: document.fselperm.submit()'><option value='1'"
     . $selected[0]
     . '>'
     . _AM_NW_APPROVEFORM
     . "</option><option value='2'"
     . $selected[1]
     . '>'
     . _AM_NW_SUBMITFORM
     . "</option><option value='3'"
     . $selected[2]
     . '>'
     . _AM_NW_VIEWFORM
     . "</option></select> <input type='submit' name='go'></form>";
$module_id = $xoopsModule->getVar('mid');

switch ($permtoset) {
    case 1:
        $title_of_form = _AM_NW_APPROVEFORM;
        $perm_name     = 'nw_approve';
        $perm_desc     = _AM_NW_APPROVEFORM_DESC;
        break;
    case 2:
        $title_of_form = _AM_NW_SUBMITFORM;
        $perm_name     = 'nw_submit';
        $perm_desc     = _AM_NW_SUBMITFORM_DESC;
        break;
    case 3:
        $title_of_form = _AM_NW_VIEWFORM;
        $perm_name     = 'nw_view';
        $perm_desc     = _AM_NW_VIEWFORM_DESC;
        break;
}

$permform  = new XoopsGroupPermForm($title_of_form, $module_id, $perm_name, $perm_desc);
$xt        = new XoopsTopic($xoopsDB->prefix('nw_topics'));
$alltopics = $xt->getTopicsList();
foreach ($alltopics as $topic_id => $topic) {
    $permform->addItem($topic_id, $topic['title'], $topic['pid']);
}
echo $permform->render();
echo "<br><br><br><br>\n";
unset($permform);

xoops_cp_footer();
