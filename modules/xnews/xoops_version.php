<?php
// $Id: xoops_version.php,v 1.34 2004/09/01 17:48:07 hthouzard Exp $
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
if (!defined('XOOPS_ROOT_PATH')) {
    die('XOOPS root path not defined');
}

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

$modversion['version']       = 1.72;
$modversion['module_status'] = 'Beta 1';
$modversion['release_date']  = '2020/11/09';
$modversion['name']          = 'xNews';
$modversion['description']   = _MI_NW_DESC;
$modversion['credits']       = 'The XOOPS Project, Christian, Pilou, Marco, ALL the members of the Newbb Team, GIJOE, Zoullou, Mithrandir, Setec Astronomy, Marcan, 5vision, Anne, Wishcraft, DNPROSSI';
$modversion['author']        = 'The XOOPS Project Module Dev Team & Instant Zero';
$modversion['help']          = '';
$modversion['license']       = 'GPL see LICENSE';
$modversion['official']      = 0;
$modversion['image']         = 'images/' . NW_MODULE_DIR_NAME . '_logo.png';
$modversion['dirname']       = NW_MODULE_DIR_NAME;
$modversion['onInstall']     = 'include/install.php';
$modversion['onUpdate']      = 'include/update.php';
$modversion['onUninstall']   = 'include/uninstall.php';
$modversion['original']      = 1;
$modversion['min_php']       = '7.2';
$modversion['min_xoops']     = '2.5.10';
$modversion['min_admin']     = '1.2';
$modversion['min_db']        = ['mysql' => '5.5'];

$modversion['sqlfile']['mysql'] = 'sql/mysql.sql';

// Tables created by sql file (without prefix!)
$modversion['tables'][0] = 'nw_stories';
$modversion['tables'][1] = 'nw_topics';
$modversion['tables'][2] = 'nw_stories_files';
$modversion['tables'][3] = 'nw_stories_votedata';

// Admin things
$modversion['hasAdmin']   = 1;
$modversion['adminindex'] = 'admin/index.php';
$modversion['adminmenu']  = 'admin/menu.php';

// Templates
$modversion['templates'][1]['file']         = 'nw_news_item.html';
$modversion['templates'][1]['description']  = '';
$modversion['templates'][2]['file']         = 'nw_news_archive.html';
$modversion['templates'][2]['description']  = '';
$modversion['templates'][3]['file']         = 'nw_news_article.html';
$modversion['templates'][3]['description']  = '';
$modversion['templates'][4]['file']         = 'nw_news_index.html';
$modversion['templates'][4]['description']  = '';
$modversion['templates'][5]['file']         = 'nw_news_by_topic.html';
$modversion['templates'][5]['description']  = '';
$modversion['templates'][6]['file']         = 'nw_news_by_this_author.html';
$modversion['templates'][6]['description']  = 'Shows a page resuming all the articles of the same author (according to the perms)';
$modversion['templates'][7]['file']         = 'nw_news_ratenews.html';
$modversion['templates'][7]['description']  = 'Template used to rate a news';
$modversion['templates'][8]['file']         = 'nw_news_rss.html';
$modversion['templates'][8]['description']  = 'Used for RSS per topics';
$modversion['templates'][9]['file']         = 'nw_news_whos_who.html';
$modversion['templates'][9]['description']  = "Who's who";
$modversion['templates'][10]['file']        = 'nw_news_topics_directory.html';
$modversion['templates'][10]['description'] = 'Topics Directory';
//WISHCRAFT
$modversion['templates'][11]['file']        = 'nw_news_article_pdf.html';
$modversion['templates'][11]['description'] = 'PDF Article Layout';
$modversion['templates'][12]['file']        = 'nw_news_item_pdf.html';
$modversion['templates'][12]['description'] = 'PDF Item Layout';

$i = 0;

$i++;
// Blocks
$modversion['blocks'][$i]['file']        = 'news_topics.php';
$modversion['blocks'][$i]['name']        = _MI_NW_BNAME1;
$modversion['blocks'][$i]['description'] = 'Shows news topics';
$modversion['blocks'][$i]['show_func']   = 'nw_b_news_topics_show';
$modversion['blocks'][$i]['template']    = 'nw_news_block_topics.html';

$i++;
$modversion['blocks'][$i]['file']        = 'news_bigstory.php';
$modversion['blocks'][$i]['name']        = _MI_NW_BNAME3;
$modversion['blocks'][$i]['description'] = 'Shows most read story of the day';
$modversion['blocks'][$i]['show_func']   = 'nw_b_news_bigstory_show';
$modversion['blocks'][$i]['template']    = 'nw_news_block_bigstory.html';

$i++;
$modversion['blocks'][$i]['file']        = 'news_top.php';
$modversion['blocks'][$i]['name']        = _MI_NW_BNAME4;
$modversion['blocks'][$i]['description'] = 'Shows top read news articles';
$modversion['blocks'][$i]['show_func']   = 'nw_b_news_top_show';
$modversion['blocks'][$i]['edit_func']   = 'nw_b_news_top_edit';
$modversion['blocks'][$i]['options']     = 'counter|10|25|0|0|0|0||1||||||';
$modversion['blocks'][$i]['template']    = 'nw_news_block_top.html';

$i++;
$modversion['blocks'][$i]['file']        = 'news_top.php';
$modversion['blocks'][$i]['name']        = _MI_NW_BNAME5;
$modversion['blocks'][$i]['description'] = 'Shows recent articles';
$modversion['blocks'][$i]['show_func']   = 'nw_b_news_top_show';
$modversion['blocks'][$i]['edit_func']   = 'nw_b_news_top_edit';
$modversion['blocks'][$i]['options']     = 'published|10|25|0|0|0|0||1||||||';
$modversion['blocks'][$i]['template']    = 'nw_news_block_top.html';

$i++;
$modversion['blocks'][$i]['file']        = 'news_moderate.php';
$modversion['blocks'][$i]['name']        = _MI_NW_BNAME6;
$modversion['blocks'][$i]['description'] = 'Shows a block to moderate articles';
$modversion['blocks'][$i]['show_func']   = 'nw_b_news_topics_moderate';
$modversion['blocks'][$i]['template']    = 'nw_news_block_moderate.html';

$i++;
$modversion['blocks'][$i]['file']        = 'news_topicsnav.php';
$modversion['blocks'][$i]['name']        = _MI_NW_BNAME7;
$modversion['blocks'][$i]['description'] = 'Shows a block to navigate topics';
$modversion['blocks'][$i]['show_func']   = 'nw_b_news_topicsnav_show';
$modversion['blocks'][$i]['template']    = 'nw_news_block_topicnav.html';
$modversion['blocks'][$i]['options']     = '0';
$modversion['blocks'][$i]['edit_func']   = 'nw_b_news_topicsnav_edit';

$i++;
$modversion['blocks'][$i]['file']        = 'news_randomnews.php';
$modversion['blocks'][$i]['name']        = _MI_NW_BNAME8;
$modversion['blocks'][$i]['description'] = 'Shows a block where news appears randomly';
$modversion['blocks'][$i]['show_func']   = 'nw_b_news_randomnews_show';
$modversion['blocks'][$i]['template']    = 'nw_news_block_randomnews.html';
$modversion['blocks'][$i]['options']     = 'published|10|25|0|0';
$modversion['blocks'][$i]['edit_func']   = 'nw_b_news_randomnews_edit';

$i++;
$modversion['blocks'][$i]['file']        = 'news_ratenews.php';
$modversion['blocks'][$i]['name']        = _MI_NW_BNAME9;
$modversion['blocks'][$i]['description'] = 'Shows a block where you can see archives';
$modversion['blocks'][$i]['show_func']   = 'nw_b_news_archives_show';
$modversion['blocks'][$i]['template']    = 'nw_news_block_archives.html';
$modversion['blocks'][$i]['options']     = '0|0|0|0|1|1';    // Starting date (year, month), ending date (year, month), until today, sort order
$modversion['blocks'][$i]['edit_func']   = 'nw_b_news_archives_edit';

$i++;
// Added in v2.00
$modversion['blocks'][$i]['file']        = 'news_latestnews.php';
$modversion['blocks'][$i]['name']        = _MI_NW_LATESTNEWS_BLOCK;
$modversion['blocks'][$i]['description'] = 'Show latest news';
$modversion['blocks'][$i]['show_func']   = 'nw_b_news_latestnews_show';
$modversion['blocks'][$i]['edit_func']   = 'nw_b_news_latestnews_edit';
$modversion['blocks'][$i]['template']    = 'nw_news_block_latestnews.html';
$modversion['blocks'][$i]['options']     = '6|2|200|100|100|2|dcdcdc|0|0|1|1|1|1|1|1|1|1|1|1|1|1|1|0|100|30|published|';

$i++;
// Added in v1.63
$modversion['blocks'][$i]['file']        = 'news_block_tag.php';
$modversion['blocks'][$i]['name']        = _MI_NW_BNAME11;
$modversion['blocks'][$i]['description'] = 'Show top tags';
$modversion['blocks'][$i]['show_func']   = 'nw_news_tag_block_top_show';
$modversion['blocks'][$i]['edit_func']   = 'nw_news_tag_block_top_edit';
$modversion['blocks'][$i]['options']     = '50|30|c';
$modversion['blocks'][$i]['template']    = 'nw_news_tag_block_top.html';

$i++;
$modversion['blocks'][$i]['file']        = 'news_block_tag.php';
$modversion['blocks'][$i]['name']        = _MI_NW_BNAME10;
$modversion['blocks'][$i]['description'] = 'Show tag cloud';
$modversion['blocks'][$i]['show_func']   = 'nw_news_tag_block_cloud_show';
$modversion['blocks'][$i]['edit_func']   = 'nw_news_tag_block_cloud_edit';
$modversion['blocks'][$i]['options']     = '100|0|150|80';
$modversion['blocks'][$i]['template']    = 'nw_news_tag_block_cloud.html';

// Menu
$modversion['hasMain'] = 1;

$cansubmit = 0;

/**
 * This part inserts the selected topics as sub items in the Xoops main menu
 */
$moduleHandler = xoops_getHandler('module');
$module        = $moduleHandler->getByDirname($modversion['dirname']);
if ($module) {
    global $xoopsUser;
    if (is_object($xoopsUser)) {
        $groups = $xoopsUser->getGroups();
    } else {
        $groups = XOOPS_GROUP_ANONYMOUS;
    }
    $gpermHandler = xoops_getHandler('groupperm');
    if ($gpermHandler->checkRight('nw_submit', 0, $groups, $module->getVar('mid'))) {
        $cansubmit = 1;
    }
}

// ************
$i = 1;
global $xoopsDB, $xoopsUser, $xoopsConfig, $xoopsModule, $xoopsModuleConfig;
// We try to "win" some time
// 1)  Check to see if the module is the current module
if (is_object($xoopsModule) && $xoopsModule->getVar('dirname') == $modversion['dirname'] && $xoopsModule->getVar('isactive')) {
    // 2) If there's no topics to display as sub menus we can go on
    if (!isset($_SESSION['items_count']) || -1 == $_SESSION['items_count']) {
        $sql    = 'SELECT COUNT(*) as cpt FROM ' . $xoopsDB->prefix('nw_topics') . ' WHERE menu=1';
        $result = $xoopsDB->query($sql);
        [$count] = $xoopsDB->fetchRow($result);
        $_SESSION['items_count'] = $count;
    } else {
        $count = $_SESSION['items_count'];
    }
    if ($count > 0) {
        require_once XOOPS_ROOT_PATH . '/class/tree.php';
        require_once NW_MODULE_PATH . '/class/class.newstopic.php';
        require_once NW_MODULE_PATH . '/include/functions.php';
        $xt         = new nw_NewsTopic();
        $allTopics  = $xt->getAllTopics(nw_getmoduleoption('restrictindex', NW_MODULE_DIR_NAME));
        $topic_tree = new XoopsObjectTree($allTopics, 'topic_id', 'topic_pid');
        $topics_arr = $topic_tree->getAllChild(0);
        if ($module) {
            foreach ($topics_arr as $onetopic) {
                if ($gpermHandler->checkRight('nw_view', $onetopic->topic_id(), $groups, $xoopsModule->getVar('mid')) && $onetopic->menu()) {
                    $modversion['sub'][$i]['name'] = $onetopic->topic_title();
                    $modversion['sub'][$i]['url']  = 'index.php?topic_id=' . $onetopic->topic_id();
                }
                $i++;
            }
        }
        unset($xt);
    }
}

$modversion['sub'][$i]['name'] = _MI_NW_SMNAME2;
$modversion['sub'][$i]['url']  = 'archive.php';
if ($cansubmit) {
    $i++;
    $modversion['sub'][$i]['name'] = _MI_NW_SMNAME1;
    $modversion['sub'][$i]['url']  = 'submit.php';
}
unset($cansubmit);

require_once NW_MODULE_PATH . '/include/functions.php';
if (nw_getmoduleoption('newsbythisauthor', NW_MODULE_DIR_NAME)) {
    $i++;
    $modversion['sub'][$i]['name'] = _MI_NW_WHOS_WHO;
    $modversion['sub'][$i]['url']  = 'whoswho.php';
}

$i++;
$modversion['sub'][$i]['name'] = _MI_NW_TOPICS_DIRECTORY;
$modversion['sub'][$i]['url']  = 'topics_directory.php';

// Search
$modversion['hasSearch']      = 1;
$modversion['search']['file'] = 'include/search.inc.php';
$modversion['search']['func'] = 'nw_search';

// Comments
$modversion['hasComments']          = 1;
$modversion['comments']['pageName'] = 'article.php';
$modversion['comments']['itemName'] = 'storyid';
// Comment callback functions
$modversion['comments']['callbackFile']        = 'include/comment_functions.php';
$modversion['comments']['callback']['approve'] = 'nw_com_approve';
$modversion['comments']['callback']['update']  = 'nw_com_update';

$i = 0;

/**
 * Select the number of news items to display on top page
 */
$i++;
$modversion['config'][$i]['name']        = 'storyhome';
$modversion['config'][$i]['title']       = '_MI_NW_STORYHOME';
$modversion['config'][$i]['description'] = '_MI_NW_STORYHOMEDSC';
$modversion['config'][$i]['formtype']    = 'select';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = 5;
$modversion['config'][$i]['options']     = ['5' => 5, '10' => 10, '15' => 15, '20' => 20, '25' => 25, '30' => 30];

/**
 * Format of the date to use in the module, if you don't specify anything then the default date's format will be used
 */
$i++;
$modversion['config'][$i]['name']        = 'dateformat';
$modversion['config'][$i]['title']       = '_MI_NW_DATEFORMAT';
$modversion['config'][$i]['description'] = '_MI_NW_DATEFORMAT_DESC';
$modversion['config'][$i]['formtype']    = 'textbox';
$modversion['config'][$i]['valuetype']   = 'text';
$modversion['config'][$i]['default']     = '';

/**
 * Display a navigation's box on the pages ?
 * This navigation's box enable you to jump from one topic to another
 */
$i++;
$modversion['config'][$i]['name']        = 'displaynav';
$modversion['config'][$i]['title']       = '_MI_NW_DISPLAYNAV';
$modversion['config'][$i]['description'] = '_MI_NW_DISPLAYNAVDSC';
$modversion['config'][$i]['formtype']    = 'yesno';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = 1;

/*
$i++;
$modversion['config'][$i]['name'] = 'anonpost';
$modversion['config'][$i]['title'] = '_MI_NW_ANONPOST';
$modversion['config'][$i]['description'] = '';
$modversion['config'][$i]['formtype'] = 'yesno';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = 0;
*/

/**
 * Auto approuve submited stories
 */
$i++;
$modversion['config'][$i]['name']        = 'autoapprove';
$modversion['config'][$i]['title']       = '_MI_NW_AUTOAPPROVE';
$modversion['config'][$i]['description'] = '_MI_NW_AUTOAPPROVEDSC';
$modversion['config'][$i]['formtype']    = 'yesno';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = 0;

/**
 * Dispay layout, classic or by topics
 */
$i++;
$modversion['config'][$i]['name']        = 'newsdisplay';
$modversion['config'][$i]['title']       = '_MI_NW_NEWSDISPLAY';
$modversion['config'][$i]['description'] = '_MI_NW_NEWSDISPLAYDESC';
$modversion['config'][$i]['formtype']    = 'select';
$modversion['config'][$i]['valuetype']   = 'text';
$modversion['config'][$i]['default']     = 'Classic';
$modversion['config'][$i]['options']     = ['_MI_NW_NEWSCLASSIC' => 'Classic', '_MI_NW_NEWSBYTOPIC' => 'Bytopic'];

/**
 * How to display Author's name, username, full name or nothing ?
 */
$i++;
$modversion['config'][$i]['name']        = 'displayname';
$modversion['config'][$i]['title']       = '_MI_NW_NAMEDISPLAY';
$modversion['config'][$i]['description'] = '_MI_NW_ADISPLAYNAMEDSC';
$modversion['config'][$i]['formtype']    = 'select';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = 1;
$modversion['config'][$i]['options']     = ['_MI_NW_DISPLAYNAME1' => 1, '_MI_NW_DISPLAYNAME2' => 2, '_MI_NW_DISPLAYNAME3' => 3];

/**
 * Number of columns to use to display news
 */
$i++;
$modversion['config'][$i]['name']        = 'columnmode';
$modversion['config'][$i]['title']       = '_MI_NW_COLUMNMODE';
$modversion['config'][$i]['description'] = '_MI_NW_COLUMNMODE_DESC';
$modversion['config'][$i]['formtype']    = 'select';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = 1;
$modversion['config'][$i]['options']     = [1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5];

/**
 * Number of news and topics to display in the module's admin part
 */
$i++;
$modversion['config'][$i]['name']        = 'storycountadmin';
$modversion['config'][$i]['title']       = '_MI_NW_STORYCOUNTADMIN';
$modversion['config'][$i]['description'] = '_MI_NW_STORYCOUNTADMIN_DESC';
$modversion['config'][$i]['formtype']    = 'select';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = 10;
$modversion['config'][$i]['options']     = ['5' => 5, '10' => 10, '15' => 15, '20' => 20, '25' => 25, '30' => 30, '35' => 35, '40' => 40];

/**
 * Authorized groups to upload
 */
$i++;
$modversion['config'][$i]['name']        = 'uploadgroups';
$modversion['config'][$i]['title']       = '_MI_NW_UPLOADGROUPS';
$modversion['config'][$i]['description'] = '_MI_NW_UPLOADGROUPS_DESC';
$modversion['config'][$i]['formtype']    = 'select';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = 2;
$modversion['config'][$i]['options']     = ['_MI_NW_UPLOAD_GROUP1' => 1, '_MI_NW_UPLOAD_GROUP2' => 2, '_MI_NW_UPLOAD_GROUP3' => 3];

/**
 * MAX Filesize Upload in kilo bytes
 */
$i++;
$modversion['config'][$i]['name']        = 'maxuploadsize';
$modversion['config'][$i]['title']       = '_MI_NW_UPLOADFILESIZE';
$modversion['config'][$i]['description'] = '_MI_NW_UPLOADFILESIZE_DESC';
$modversion['config'][$i]['formtype']    = 'textbox';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = 1048576;

/**
 * Restrict Topics on Index Page
 *
 * This is one of the mot important option in the module.
 * If you set it to No, then the users can see the introduction's text of each
 * story even if they don't have the right to see the topic attached to the news.
 * If you set it to Yes then you can only see what you have the right to see.
 * Many of the permissions are based on this option.
 */
$i++;
$modversion['config'][$i]['name']        = 'restrictindex';
$modversion['config'][$i]['title']       = '_MI_NW_RESTRICTINDEX';
$modversion['config'][$i]['description'] = '_MI_NW_RESTRICTINDEXDSC';
$modversion['config'][$i]['formtype']    = 'yesno';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = 0;

/**
 * Do you want to enable your visitors to see all the other articles
 * created by the author they are currently reading ?
 */
$i++;
$modversion['config'][$i]['name']        = 'newsbythisauthor';
$modversion['config'][$i]['title']       = '_MI_NW_NEWSBYTHISAUTHOR';
$modversion['config'][$i]['description'] = '_MI_NW_NEWSBYTHISAUTHORDSC';
$modversion['config'][$i]['formtype']    = 'yesno';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = 0;

/**
 * If you set this option to yes then you will see two links at the bottom
 * of each article. The first link will enable you to go to the previous
 * article and the other link will bring you to the next article
 */
$i++;
$modversion['config'][$i]['name']        = 'showprevnextlink';
$modversion['config'][$i]['title']       = '_MI_NW_PREVNEX_LINK';
$modversion['config'][$i]['description'] = '_MI_NW_PREVNEX_LINK_DESC';
$modversion['config'][$i]['formtype']    = 'select';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['options']     = [
    _MI_NW_NONE       => 0,
    _MI_NW_TOPONLY    => 1,
    _MI_NW_BOTTOMONLY => 2,
    _MI_NW_BOTH       => 3,
];
$modversion['config'][$i]['default']     = 0;

/**
 * Dispay layout, view topics and link enabled
 */
$i++;
$modversion['config'][$i]['name']        = 'topicdisplay';
$modversion['config'][$i]['title']       = '_MI_NW_TOPICDISPLAY';
$modversion['config'][$i]['description'] = '_MI_NW_TOPICDISPLAYDESC';
$modversion['config'][$i]['formtype']    = 'yesno';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = 1;

/**
 * Display attached PDF - 1.71
 */
$i++;
$modversion['config'][$i]['name']        = 'pdf_display';
$modversion['config'][$i]['title']       = '_MI_NW_PDF_DISPLAY';
$modversion['config'][$i]['description'] = '_MI_NW_PDF_DISPLAY_DESC';
$modversion['config'][$i]['formtype']    = 'yesno';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = 0;

/**
 * Display attached images - 1.71
 */
$i++;
$modversion['config'][$i]['name']        = 'images_display';
$modversion['config'][$i]['title']       = '_MI_NW_IMAGES_DISPLAY';
$modversion['config'][$i]['description'] = '_MI_NW_IMAGES_DISPLAY_DESC';
$modversion['config'][$i]['formtype']    = 'yesno';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = 0;

/**
 * Actvate PDF plugin detection - 1.71
 */
$i++;
$modversion['config'][$i]['name']        = 'pdf_detect';
$modversion['config'][$i]['title']       = '_MI_NW_PDF_DETECT';
$modversion['config'][$i]['description'] = '_MI_NW_PDF_DETECT_DESC';
$modversion['config'][$i]['formtype']    = 'yesno';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = 0;

/**
 * Display print, friend and pdf icons top-bottom-both-none
 */
$i++;
$modversion['config'][$i]['name']        = 'displaylinkicns';
$modversion['config'][$i]['title']       = '_MI_NW_DISPLAYLINKICNS';
$modversion['config'][$i]['description'] = '_MI_NW_DISPLAYLINKICNSDESC';
$modversion['config'][$i]['formtype']    = 'select';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['options']     = [
    _MI_NW_NONE       => 0,
    _MI_NW_TOPONLY    => 1,
    _MI_NW_BOTTOMONLY => 2,
    _MI_NW_BOTH       => 3,
];
$modversion['config'][$i]['default']     = 2;

/**
 * Seo enable
 */
$i++;
$modversion['config'][$i]['name']        = 'seo_enable';
$modversion['config'][$i]['title']       = '_MI_NW_SEOENABLE';
$modversion['config'][$i]['description'] = '_MI_NW_SEOENABLEDESC';
$modversion['config'][$i]['formtype']    = 'select';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['options']     = [
    _MI_NW_NONE => 0,
    'htaccess'  => 1,
    'path-info' => 2,
];
$modversion['config'][$i]['default']     = 0;

/**
 * Seo path
 */
$i++;
$modversion['config'][$i]['name']        = 'seo_path';
$modversion['config'][$i]['title']       = '_MI_NW_SEOPATH';
$modversion['config'][$i]['description'] = '_MI_NW_SEOPATHDESC';
$modversion['config'][$i]['formtype']    = 'textbox';
$modversion['config'][$i]['valuetype']   = 'text';
$modversion['config'][$i]['default']     = 'news';

//WISHCRAFT
/**
 * Seo end of URL for Standard
 */
$i++;
$modversion['config'][$i]['name']        = 'seo_endofurl';
$modversion['config'][$i]['title']       = '_MI_NW_SEOENDOFURL';
$modversion['config'][$i]['description'] = '_MI_NW_SEOENDOFURL_DESC';
$modversion['config'][$i]['formtype']    = 'text';
$modversion['config'][$i]['valuetype']   = 'text';
$modversion['config'][$i]['default']     = '.html';

/**
 * Seo end of URL for RSS
 */
$i++;
$modversion['config'][$i]['name']        = 'seo_endofurl_rss';
$modversion['config'][$i]['title']       = '_MI_NW_SEOENDOFURLRSS';
$modversion['config'][$i]['description'] = '_MI_NW_SEOENDOFURLRSS_DESC';
$modversion['config'][$i]['formtype']    = 'text';
$modversion['config'][$i]['valuetype']   = 'text';
$modversion['config'][$i]['default']     = '.rss';

/**
 * Seo end of URL for PDF
 */
$i++;
$modversion['config'][$i]['name']        = 'seo_endofurl_pdf';
$modversion['config'][$i]['title']       = '_MI_NW_SEOENDOFURLPDF';
$modversion['config'][$i]['description'] = '_MI_NW_SEOENDOFURLPDF_DESC';
$modversion['config'][$i]['formtype']    = 'text';
$modversion['config'][$i]['valuetype']   = 'text';
$modversion['config'][$i]['default']     = '.pdf';

/**
 * Seo level
 */
$i++;
$modversion['config'][$i]['name']        = 'seo_level';
$modversion['config'][$i]['title']       = '_MI_NW_SEOLEVEL';
$modversion['config'][$i]['description'] = '_MI_NW_SEOLEVELDESC';
$modversion['config'][$i]['formtype']    = 'select';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['options']     = [
    _MI_NW_ROOT_LEVEL   => 0,
    _MI_NW_MODULE_LEVEL => 1,
];
$modversion['config'][$i]['default']     = 0;

/**
 * Do you want to see a summary table at the bottom of each article ?
 */
$i++;
$modversion['config'][$i]['name']        = 'showsummarytable';
$modversion['config'][$i]['title']       = '_MI_NW_SUMMARY_SHOW';
$modversion['config'][$i]['description'] = '_MI_NW_SUMMARY_SHOW_DESC';
$modversion['config'][$i]['formtype']    = 'yesno';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = 0;

/**
 * Do you enable author's to edit their posts ?
 */
$i++;
$modversion['config'][$i]['name']        = 'authoredit';
$modversion['config'][$i]['title']       = '_MI_NW_AUTHOR_EDIT';
$modversion['config'][$i]['description'] = '_MI_NW_AUTHOR_EDIT_DESC';
$modversion['config'][$i]['formtype']    = 'yesno';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = 1;

/**
 * Do you want to enable your visitors to rate news ?
 */
$i++;
$modversion['config'][$i]['name']        = 'ratenews';
$modversion['config'][$i]['title']       = '_MI_NW_RATE_NEWS';
$modversion['config'][$i]['description'] = '';
$modversion['config'][$i]['formtype']    = 'yesno';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = 0;

/**
 * You can set RSS feeds per topic
 */
$i++;
$modversion['config'][$i]['name']        = 'topicsrss';
$modversion['config'][$i]['title']       = '_MI_NW_TOPICS_RSS';
$modversion['config'][$i]['description'] = '_MI_NW_TOPICS_RSS_DESC';
$modversion['config'][$i]['formtype']    = 'yesno';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = 0;

/**
 * If you set this option to yes then the approvers can type the keyword
 * and description's meta datas
 */
$i++;
$modversion['config'][$i]['name']        = 'metadata';
$modversion['config'][$i]['title']       = '_MI_NW_META_DATA';
$modversion['config'][$i]['description'] = '_MI_NW_META_DATA_DESC';
$modversion['config'][$i]['formtype']    = 'yesno';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = 0;

/**
 * If you set this option to yes one line meta data textbox input will be
 * extended
 */
$i++;
$modversion['config'][$i]['name']        = 'extendmetadata';
$modversion['config'][$i]['title']       = '_MI_NW_EXTEND_META_DATA';
$modversion['config'][$i]['description'] = '_MI_NW_EXTEND_META_DATA_DESC';
$modversion['config'][$i]['formtype']    = 'yesno';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = 0;

/**
 * Editor to use
 */
$i++;
$modversion['config'][$i]['name']        = 'form_options';
$modversion['config'][$i]['title']       = '_MI_NW_FORM_OPTIONS';
$modversion['config'][$i]['description'] = '_MI_NW_FORM_OPTIONS_DESC';
$modversion['config'][$i]['formtype']    = 'select';
$modversion['config'][$i]['valuetype']   = 'text';
$modversion['config'][$i]['default']     = 'dhtml';
xoops_load('xoopseditorhandler');
$editorHandler                       = XoopsEditorHandler::getInstance();
$modversion['config'][$i]['options'] = array_flip($editorHandler->getList());

/**
 * If you set this option to Yes then the keywords entered in the
 * search will be highlighted in the articles.
 */
$i++;
$modversion['config'][$i]['name']        = 'keywordshighlight';
$modversion['config'][$i]['title']       = '_MI_NW_KEYWORDS_HIGH';
$modversion['config'][$i]['description'] = '_MI_NW_KEYWORDS_HIGH_DESC';
$modversion['config'][$i]['formtype']    = 'yesno';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = 0;

/**
 * If you have enabled the previous option then with this one
 * you can select the color to use to highlight words
 */
$i++;
$modversion['config'][$i]['name']        = 'highlightcolor';
$modversion['config'][$i]['title']       = '_MI_NW_HIGH_COLOR';
$modversion['config'][$i]['description'] = '_MI_NW_HIGH_COLOR_DES';
$modversion['config'][$i]['formtype']    = 'textbox';
$modversion['config'][$i]['valuetype']   = 'text';
$modversion['config'][$i]['default']     = '#FFFF80';

/**
 * Tooltips, or infotips are some small textes you can see when you
 * move your mouse over an article's title. This text contains the
 * first (x) characters of the story
 */
$i++;
$modversion['config'][$i]['name']        = 'infotips';
$modversion['config'][$i]['title']       = '_MI_NW_INFOTIPS';
$modversion['config'][$i]['description'] = '_MI_NW_INFOTIPS_DES';
$modversion['config'][$i]['formtype']    = 'textbox';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = '0';

/**
 * This option is specific to Mozilla/Firefox and Opera
 * Both of them can display a toolbar wich contains buttons to
 * go from article to article. It can show other information too
 */
$i++;
$modversion['config'][$i]['name']        = 'sitenavbar';
$modversion['config'][$i]['title']       = '_MI_NW_SITE_NAVBAR';
$modversion['config'][$i]['description'] = '_MI_NW_SITE_NAVBAR_DESC';
$modversion['config'][$i]['formtype']    = 'yesno';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = 0;

/**
 * With this option you can select the skin (apparence) to use for the blocks containing tabs
 */
$i++;
$modversion['config'][$i]['name']        = 'tabskin';
$modversion['config'][$i]['title']       = '_MI_NW_TABS_SKIN';
$modversion['config'][$i]['description'] = '_MI_NW_TABS_SKIN_DESC';
$modversion['config'][$i]['formtype']    = 'select';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['options']     = [
    _MI_NW_SKIN_1 => 1,
    _MI_NW_SKIN_2 => 2,
    _MI_NW_SKIN_3 => 3,
    _MI_NW_SKIN_4 => 4,
    _MI_NW_SKIN_5 => 5,
    _MI_NW_SKIN_6 => 6,
    _MI_NW_SKIN_7 => 7,
    _MI_NW_SKIN_8 => 8,
];
$modversion['config'][$i]['default']     = 6;

/**
 * Display a navigation's box on the pages ?
 * This navigation's box enable you to jump from one topic to another
 */
$i++;
$modversion['config'][$i]['name']        = 'footNoteLinks';
$modversion['config'][$i]['title']       = '_MI_NW_FOOTNOTES';
$modversion['config'][$i]['description'] = '';
$modversion['config'][$i]['formtype']    = 'yesno';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = 1;

/**
 * Activate Dublin Core Metadata ?
 */
$i++;
$modversion['config'][$i]['name']        = 'dublincore';
$modversion['config'][$i]['title']       = '_MI_NW_DUBLINCORE';
$modversion['config'][$i]['description'] = '_MI_NW_DUBLINCORE_DSC';
$modversion['config'][$i]['formtype']    = 'yesno';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = 0;

/**
 * Display a "Bookmark this article at these sites" block ?
 */
$i++;
$modversion['config'][$i]['name']        = 'bookmarkme';
$modversion['config'][$i]['title']       = '_MI_NW_BOOKMARK_ME';
$modversion['config'][$i]['description'] = '_MI_NW_BOOKMARK_ME_DSC';
$modversion['config'][$i]['formtype']    = 'yesno';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = 0;

/**
 * Activate Firefox 2 microformats ?
 */
$i++;
$modversion['config'][$i]['name']        = 'firefox_microsummaries';
$modversion['config'][$i]['title']       = '_MI_NW_FF_MICROFORMAT';
$modversion['config'][$i]['description'] = '_MI_NW_FF_MICROFORMAT_DSC';
$modversion['config'][$i]['formtype']    = 'yesno';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = 0;

/**
 * Advertisement
 */
$i++;
$modversion['config'][$i]['name']        = 'advertisement';
$modversion['config'][$i]['title']       = '_MI_NW_ADVERTISEMENT';
$modversion['config'][$i]['description'] = '_MI_NW_ADV_DESCR';
$modversion['config'][$i]['formtype']    = 'textarea';
$modversion['config'][$i]['valuetype']   = 'text';
$modversion['config'][$i]['default']     = '';

/**
 * Mime Types
 *
 * Default values : Web pictures (png, gif, jpeg), zip, pdf, gtar, tar, pdf
 */
$i++;
$modversion['config'][$i]['name']        = 'mimetypes';
$modversion['config'][$i]['title']       = '_MI_NW_MIME_TYPES';
$modversion['config'][$i]['description'] = '';
$modversion['config'][$i]['formtype']    = 'textarea';
$modversion['config'][$i]['valuetype']   = 'text';
$modversion['config'][$i]['default']     = "image/gif\nimage/jpeg\nimage/pjpeg\nimage/x-png\nimage/png\napplication/x-zip-compressed\napplication/zip\napplication/pdf\napplication/x-gtar\napplication/x-tar";

/**
 * Use enhanced page separator ?
 */
$i++;
$modversion['config'][$i]['name']        = 'enhanced_pagenav';
$modversion['config'][$i]['title']       = '_MI_NW_ENHANCED_PAGENAV';
$modversion['config'][$i]['description'] = '_MI_NW_ENHANCED_PAGENAV_DSC';
$modversion['config'][$i]['formtype']    = 'yesno';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = 0;

/**
 * Use the TAGS system ?
 */
$i++;
$modversion['config'][$i]['name']        = 'tags';
$modversion['config'][$i]['title']       = '_MI_NW_TAGS';
$modversion['config'][$i]['description'] = '_MI_NW_TAGS_DSC';
$modversion['config'][$i]['formtype']    = 'yesno';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = 0;

/**
 * Introduction text to show on the submit page
 */
$i++;
$modversion['config'][$i]['name']        = 'submitintromsg';
$modversion['config'][$i]['title']       = '_MI_NW_INTRO_TEXT';
$modversion['config'][$i]['description'] = '';
$modversion['config'][$i]['formtype']    = 'textarea';
$modversion['config'][$i]['valuetype']   = 'text';
$modversion['config'][$i]['default']     = '';

/**
 * Image max width
 */
$i++;
$modversion['config'][$i]['name']        = 'maxwidth';
$modversion['config'][$i]['title']       = '_MI_NW_IMAGE_MAX_WIDTH';
$modversion['config'][$i]['description'] = '';
$modversion['config'][$i]['formtype']    = 'textbox';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = 640;

/**
 * Image max height
 */
$i++;
$modversion['config'][$i]['name']        = 'maxheight';
$modversion['config'][$i]['title']       = '_MI_NW_IMAGE_MAX_HEIGHT';
$modversion['config'][$i]['description'] = '';
$modversion['config'][$i]['formtype']    = 'textbox';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = 480;

/**
 * Thumb max width
 */
$i++;
$modversion['config'][$i]['name']        = 'thumb_maxwidth';
$modversion['config'][$i]['title']       = '_MI_NW_THUMB_MAX_WIDTH';
$modversion['config'][$i]['description'] = '';
$modversion['config'][$i]['formtype']    = 'textbox';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = 150;

/**
 * Thumb max max height
 */
$i++;
$modversion['config'][$i]['name']        = 'thumb_maxheight';
$modversion['config'][$i]['title']       = '_MI_NW_THUMB_MAX_HEIGHT';
$modversion['config'][$i]['description'] = '';
$modversion['config'][$i]['formtype']    = 'textbox';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = 150;

// Notification
$modversion['hasNotification']             = 1;
$modversion['notification']['lookup_file'] = 'include/notification.inc.php';
$modversion['notification']['lookup_func'] = 'nw_notify_iteminfo';

$modversion['notification']['category'][1]['name']           = 'global';
$modversion['notification']['category'][1]['title']          = _MI_NW_GLOBAL_NOTIFY;
$modversion['notification']['category'][1]['description']    = _MI_NW_GLOBAL_NOTIFYDSC;
$modversion['notification']['category'][1]['subscribe_from'] = ['index.php', 'article.php'];

$modversion['notification']['category'][2]['name']           = 'story';
$modversion['notification']['category'][2]['title']          = _MI_NW_STORY_NOTIFY;
$modversion['notification']['category'][2]['description']    = _MI_NW_STORY_NOTIFYDSC;
$modversion['notification']['category'][2]['subscribe_from'] = ['article.php'];
$modversion['notification']['category'][2]['item_name']      = 'storyid';
$modversion['notification']['category'][2]['allow_bookmark'] = 1;

// Added by Lankford on 2007/3/23
$modversion['notification']['category'][3]['name']           = 'category';
$modversion['notification']['category'][3]['title']          = _MI_NW_CATEGORY_NOTIFY;
$modversion['notification']['category'][3]['description']    = _MI_NW_CATEGORY_NOTIFYDSC;
$modversion['notification']['category'][3]['subscribe_from'] = ['index.php', 'article.php'];
$modversion['notification']['category'][3]['item_name']      = 'storytopic';
$modversion['notification']['category'][3]['allow_bookmark'] = 1;

$modversion['notification']['event'][1]['name']          = 'new_category';
$modversion['notification']['event'][1]['category']      = 'global';
$modversion['notification']['event'][1]['title']         = _MI_NW_GLOBAL_NEWCATEGORY_NOTIFY;
$modversion['notification']['event'][1]['caption']       = _MI_NW_GLOBAL_NEWCATEGORY_NOTIFYCAP;
$modversion['notification']['event'][1]['description']   = _MI_NW_GLOBAL_NEWCATEGORY_NOTIFYDSC;
$modversion['notification']['event'][1]['mail_template'] = 'global_newcategory_notify';
$modversion['notification']['event'][1]['mail_subject']  = _MI_NW_GLOBAL_NEWCATEGORY_NOTIFYSBJ;

$modversion['notification']['event'][2]['name']          = 'story_submit';
$modversion['notification']['event'][2]['category']      = 'global';
$modversion['notification']['event'][2]['admin_only']    = 1;
$modversion['notification']['event'][2]['title']         = _MI_NW_GLOBAL_STORYSUBMIT_NOTIFY;
$modversion['notification']['event'][2]['caption']       = _MI_NW_GLOBAL_STORYSUBMIT_NOTIFYCAP;
$modversion['notification']['event'][2]['description']   = _MI_NW_GLOBAL_STORYSUBMIT_NOTIFYDSC;
$modversion['notification']['event'][2]['mail_template'] = 'global_storysubmit_notify';
$modversion['notification']['event'][2]['mail_subject']  = _MI_NW_GLOBAL_STORYSUBMIT_NOTIFYSBJ;

$modversion['notification']['event'][3]['name']          = 'new_story';
$modversion['notification']['event'][3]['category']      = 'global';
$modversion['notification']['event'][3]['title']         = _MI_NW_GLOBAL_NEWSTORY_NOTIFY;
$modversion['notification']['event'][3]['caption']       = _MI_NW_GLOBAL_NEWSTORY_NOTIFYCAP;
$modversion['notification']['event'][3]['description']   = _MI_NW_GLOBAL_NEWSTORY_NOTIFYDSC;
$modversion['notification']['event'][3]['mail_template'] = 'global_newstory_notify';
$modversion['notification']['event'][3]['mail_subject']  = _MI_NW_GLOBAL_NEWSTORY_NOTIFYSBJ;

$modversion['notification']['event'][4]['name']          = 'approve';
$modversion['notification']['event'][4]['category']      = 'story';
$modversion['notification']['event'][4]['invisible']     = 1;
$modversion['notification']['event'][4]['title']         = _MI_NW_STORY_APPROVE_NOTIFY;
$modversion['notification']['event'][4]['caption']       = _MI_NW_STORY_APPROVE_NOTIFYCAP;
$modversion['notification']['event'][4]['description']   = _MI_NW_STORY_APPROVE_NOTIFYDSC;
$modversion['notification']['event'][4]['mail_template'] = 'story_approve_notify';
$modversion['notification']['event'][4]['mail_subject']  = _MI_NW_STORY_APPROVE_NOTIFYSBJ;

// Added by Lankford on 2007/3/23
$modversion['notification']['event'][5]['name']          = 'new_story';
$modversion['notification']['event'][5]['category']      = 'category';
$modversion['notification']['event'][5]['title']         = _MI_NW_CATEGORY_STORYPOSTED_NOTIFY;
$modversion['notification']['event'][5]['caption']       = _MI_NW_CATEGORY_STORYPOSTED_NOTIFYCAP;
$modversion['notification']['event'][5]['description']   = _MI_NW_CATEGORY_STORYPOSTED_NOTIFYDSC;
$modversion['notification']['event'][5]['mail_template'] = 'category_newstory_notify';
$modversion['notification']['event'][5]['mail_subject']  = _MI_NW_CATEGORY_STORYPOSTED_NOTIFYSBJ;
