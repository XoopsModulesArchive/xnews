<?php
// ######################################################################
// #                                                                    #
// # Latest News block by Mowaffak ( www.arabxoops.com )                #
// # based on Last Articles Block by Pete Glanz (www.glanz.ru)          #
// # Thanks to:                                                         #
// # Trabis ( www.xuups.com ) and Bandit-x ( www.bandit-x.net )         #
// #                                                                    #
// ######################################################################
// # Use of this program is goverened by the terms of the GNU General   #
// # Public License (GPL - version 1 or 2) as published by the          #
// # Free Software Foundation (http://www.gnu.org/)                     #
// ######################################################################
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

function nw_b_news_latestnews_show($options)
{
    global $xoopsTpl, $xoopsUser, $xoopsConfig;
    require_once NW_MODULE_PATH . '/include/functions.php';

    $block = [];

    require_once NW_MODULE_PATH . '/class/class.newsstory.php';
    require_once NW_MODULE_PATH . '/class/class.sfiles.php';
    require_once NW_MODULE_PATH . '/class/class.newstopic.php';
    require_once NW_MODULE_PATH . '/class/class.latestnews.php'; //Bandit-X
    require_once XOOPS_ROOT_PATH . '/class/tree.php';

    if (file_exists(NW_MODULE_PATH . '/language/' . $xoopsConfig['language'] . '/main.php')) {
        require_once NW_MODULE_PATH . '/language/' . $xoopsConfig['language'] . '/main.php';
    } else {
        require_once NW_MODULE_PATH . '/language/english/main.php';
    }

    //DNPROSSI Added - xlanguage installed and active
    $moduleHandler = xoops_getHandler('module');
    $xlanguage     = $moduleHandler->getByDirname('xlanguage');
    if (is_object($xlanguage) && true === $xlanguage->getVar('isactive')) {
        $xlang = true;
    } else {
        $xlang = false;
    }

    $myts   = MyTextSanitizer::getInstance();
    $sfiles = new nw_sFiles();

    $dateformat = nw_getmoduleoption('dateformat', NW_MODULE_PATH);
    if ('' == $dateformat) {
        $dateformat = 's';
    }

    $limit            = $options[0];
    $column_count     = $options[1];
    $letters          = $options[2];
    $imgwidth         = $options[3];
    $imgheight        = $options[4];
    $border           = $options[5];
    $bordercolor      = $options[6];
    $selected_stories = $options[7];

    $block['spec']['columnwidth'] = (int)(1 / $column_count * 100);
    if (1 == $options[8]) {
        $imgposition = 'right';
    } else {
        $imgposition = 'left';
    }

    $xoopsTpl->assign(
        'xoops_module_header',
        '<style type="text/css">
	.itemText {text-align: left;} 
	.latestnews { border-bottom: 1px solid #cccccc; } 
	</style>' . $xoopsTpl->get_template_vars('xoops_module_header')
    );

    if (!isset($options[26])) {
        $sarray = nw_Latestnewsstory::getAllPublished($limit, $selected_stories, 0, true, 0, 0, true, $options[25], false);
    } else {
        $topics = array_slice($options, 26);
        $sarray = nw_Latestnewsstory::getAllPublished($limit, $selected_stories, 0, true, $topics, 0, true, $options[25], false);
    }

    $scount  = count($sarray);
    $k       = 0;
    $columns = [];
    if ($scount > 0) {
        $storieslist = [];
        foreach ($sarray as $storyid => $thisstory) {
            $storieslist[] = $thisstory->storyid();
        }
        $filesperstory = $sfiles->getCountbyStories($storieslist);

        foreach ($sarray as $key => $thisstory) {
            $storyid    = $thisstory->storyid();
            $filescount = array_key_exists($thisstory->storyid(), $filesperstory) ? $filesperstory[$thisstory->storyid()] : 0;
            $published  = formatTimestamp($thisstory->published(), $dateformat);
            $bodytext   = $thisstory->bodytext;
            $news       = $thisstory->prepare2show($filescount);

            $len = strlen($thisstory->hometext());
            if ($letters < $len && $letters > 0) {
                $patterns     = [];
                $replacements = [];

                if (0 != $options[4]) {
                    $height = 'height="' . $imgheight . '"';
                } // set height = 0 in block option for auto height

                $startdiv = '<div style="float:' . $imgposition . '"><a href="' . NW_MODULE_URL . '/article.php?storyid=' . $storyid . '">';
                $style    = 'style="border: ' . $border . 'px solid #' . $bordercolor . '"';
                $enddiv   = 'alt="' . $thisstory->title . '" width="' . $imgwidth . '" ' . $height . '></a></div>';

                $patterns[] = "/\[img align=(['\"]?)(left|center|right)\\1 width=(['\"]?)([0-9]*)\\3]([^\"\(\)\?\&'<>]*)\[\/img\]/sU";
                $patterns[] = "/\[img align=(['\"]?)(left|center|right)\\1]([^\"\(\)\?\&'<>]*)\[\/img\]/sU";
                $patterns[] = "/\[img]([^\"\(\)\?\&'<>]*)\[\/img\]/sU";
                $patterns[] = "/<img src=\"(.*)\" \>/sU";
                $patterns[] = "/<img src=(.*) \>/sU";

                $replacements[] = $startdiv . '<img ' . $style . ' src="\\3" ' . $enddiv;
                $replacements[] = $startdiv . '<img ' . $style . ' src="\\3" ' . $enddiv;
                $replacements[] = $startdiv . '<img ' . $style . ' src="\\1" ' . $enddiv;
                $replacements[] = $startdiv . '<img ' . $style . ' src="\\1" ' . $enddiv;
                $replacements[] = $startdiv . '<img ' . $style . ' src="\\1" ' . $enddiv;

                //DNPROSSI Added - xlanguage installed and active
                $story = '';
                $story = $thisstory->hometext;

                if (true === $xlang) {
                    require_once XOOPS_ROOT_PATH . '/modules/xlanguage/include/functions.php';
                    $story = xlanguage_ml($story);
                }
                //DNPROSSI New truncate function - now works correctly with html and utf-8
                $html         = 1 == $thisstory->nohtml() ? 0 : 1;
                $dobr         = 1 == $thisstory->dobr() ? 1 : 0;
                $smiley       = 1 == $thisstory->nosmiley() ? 0 : 1;
                $news['text'] = nw_truncate($myts->displayTarea($story, $html, $smiley, 1, 1, $dobr), $letters + 3, '...', false, $html);
            }

            if (is_object($xoopsUser) && $xoopsUser->isAdmin(-1)) {
                $news['admin'] = '<a href="'
                                 . NW_MODULE_URL
                                 . '/submit.php?op=edit&amp;storyid='
                                 . $storyid
                                 . '"><img src="'
                                 . NW_MODULE_URL
                                 . '/images/edit_block.png" alt="'
                                 . _EDIT
                                 . '" width="18"></a> <a href="'
                                 . NW_MODULE_URL
                                 . '/admin/index.php?op=delete&amp;storyid='
                                 . $storyid
                                 . '"><img src="'
                                 . NW_MODULE_URL
                                 . '/images/delete_block.png" alt="'
                                 . _DELETE
                                 . '" width="20"></a>';
            } else {
                $news['admin'] = '';
            }
            if (1 == $options[9]) {
                $block['topiclink'] = '| <a href="' . NW_MODULE_URL . '/topics_directory.php">' . _AM_NW_TOPICS_DIRECTORY . '</a> ';
            }
            if (1 == $options[10]) {
                $block['archivelink'] = '| <a href="' . NW_MODULE_URL . '/archive.php">' . _MA_NW_NEWSARCHIVES . '</a> ';
            }
            if (1 == $options[11]) {
                if (empty($xoopsUser)) {
                    $block['submitlink'] = '';
                } else {
                    $block['submitlink'] = '| <a href="' . NW_MODULE_URL . '/submit.php">' . _MA_NW_SUBMITNEWS . '</a> ';
                }
            }

            $news['poster'] = '';
            if (1 == $options[12]) {
                if ('' != $thisstory->uname()) {
                    $news['poster'] = '' . _MB_NW_LATESTNEWS_POSTER . ' ' . $thisstory->uname() . '';
                }
            }
            $news['posttime'] = '';
            if (1 == $options[13]) {
                if ('' != $thisstory->uname()) {
                    $news['posttime'] = '' . _ON . ' ' . $published . '';
                } else {
                    $news['posttime'] = '' . _MB_NW_POSTED . ' ' . _ON . ' ' . $published . '';
                }
            }
            $news['topic_image']          = '';
            $news['topic_articlepicture'] = '';
            if (1 == $options[14]) {
                $news['topic_image'] = '' . $thisstory->imglink() . '';
            }
            $news['topic_title'] = '';
            if (1 == $options[15]) {
                $news['topic_title']     = '' . $thisstory->textlink() . '';
                $news['topic_separator'] = ('' != $thisstory->textlink()) ? _MB_NW_SP : '';
            }

            $news['read'] = '';
            if (1 == $options[16]) {
                $news['read'] = '&nbsp;(' . $thisstory->counter . ' ' . _READS . ')';
            }

            $comments = $thisstory->comments();
            if (!empty($bodytext) || $comments > 0) {
                $news['more'] = '<a href="' . NW_MODULE_URL . '/article.php?storyid=' . $storyid . '">' . _MA_NW_READMORE . '</a>';
            } else {
                $news['more'] = '';
            }

            if (1 == $options[17]) {
                if ($comments > 0) {
                    //shows 1 comment instead of 1 comm. if comments ==1
                    //langugage file modified accordingly
                    if (1 == $comments) {
                        $news['comment'] = '&nbsp;' . _MA_NW_ONECOMMENT . '</a>&nbsp;';
                    } else {
                        $news['comment'] = '&nbsp;' . $comments . '&nbsp;' . _MB_NW_LATESTNEWS_COMMENT . '</a>&nbsp;';
                    }
                } else {
                    $news['comment'] = '&nbsp;' . _MB_NW_NO_COMMENT . '</a>&nbsp;';
                }
            }

            $news['print'] = '';
            if (1 == $options[18]) {
                $news['print'] = '<a href="' . NW_MODULE_URL . '/print.php?storyid=' . $storyid . '" rel="nofollow"><img src="' . NW_MODULE_URL . '/images/print.png" width="22" alt="' . _MA_NW_PRINTERFRIENDLY . '"></a>';
            }

            $news['pdf'] = '';
            if (1 == $options[19]) {
                $news['pdf'] = '&nbsp;<a href="' . NW_MODULE_URL . '/makepdf.php?storyid=' . $storyid . '" rel="nofollow"><img src="' . NW_MODULE_URL . '/images/acrobat.png" width="22" alt="' . _MA_NW_MAKEPDF . '"></a>&nbsp;';
            }

            $news['email'] = '';
            if (1 == $options[20]) {
                $news['email'] = '<a href="mailto:?subject='
                                 . sprintf(_MA_NW_INTARTICLE, $xoopsConfig['sitename'])
                                 . '&amp;body='
                                 . sprintf(_MA_NW_INTARTFOUND, $xoopsConfig['sitename'])
                                 . ':  '
                                 . NW_MODULE_URL
                                 . '/article.php?storyid='
                                 . $storyid
                                 . '" rel="nofollow"><img src="'
                                 . NW_MODULE_URL
                                 . '/images/friend.png" width="20" alt="'
                                 . _MA_NW_SENDSTORY
                                 . '"></a>&nbsp;';
            }

            if (1 == $options[21]) {
                $block['morelink'] = '&nbsp;<a href="' . NW_MODULE_URL . '/index.php ">' . _MB_NW_MORE_STORIES . '</A> ';
            }

            if (1 == $options[22]) {
                $block['latestnews_scroll'] = true;
            } else {
                $block['latestnews_scroll'] = false;
            }

            $block['scrollheight'] = $options[23];
            $block['scrollspeed']  = $options[24];

            $columns[$k][] = $news;
            $k++;
            if ($k == $column_count) {
                $k = 0;
            }
        }
    }
    unset($news);
    $block['columns'] = $columns;
    return $block;
}

function nw_b_news_latestnews_edit($options)
{
    global $xoopsDB;
    require_once NW_MODULE_PATH . '/include/functions.php';
    require_once NW_MODULE_PATH . '/class/class.newstopic.php';

    $tabletag1 = '<tr><td>';
    $tabletag2 = '</td><td>';

    $form = "<table border='0'>";
    $form .= $tabletag1 . _MB_NW_LATESTNEWS_DISPLAY . $tabletag2;
    $form .= "<input type='text' name='options[]' value='" . $options[0] . "' size='4'>&nbsp;" . _MB_NW_LATESTNEWS . '</td></tr>';
    $form .= $tabletag1 . _MB_NW_LATESTNEWS_COLUMNS . $tabletag2;
    $form .= "<input type='text' name='options[]' value='" . $options[1] . "' size='4'>&nbsp;" . _MB_NW_LATESTNEWS_COLUMN . '</td></tr>';
    $form .= $tabletag1 . _MB_NW_LATESTNEWS_TEXTLENGTH . $tabletag2;
    $form .= "<input type='text' name='options[]' value='" . $options[2] . "' size='4'>&nbsp;" . _MB_NW_LATESTNEWS_LETTER . '</td></tr>';
    $form .= $tabletag1 . _MB_NW_LATESTNEWS_IMGWIDTH . $tabletag2;
    $form .= "<input type='text' name='options[]' value='" . $options[3] . "' size='4'>&nbsp;" . _MB_NW_LATESTNEWS_PIXEL . '</td></tr>';
    $form .= $tabletag1 . _MB_NW_LATESTNEWS_IMGHEIGHT . $tabletag2;
    $form .= "<input type='text' name='options[]' value='" . $options[4] . "' size='4'>&nbsp;" . _MB_NW_LATESTNEWS_PIXEL . '</td></tr>';
    $form .= $tabletag1 . _MB_NW_LATESTNEWS_BORDER . $tabletag2;
    $form .= "<input type='text' name='options[]' value='" . $options[5] . "' size='4'>&nbsp;" . _MB_NW_LATESTNEWS_PIXEL . '</td></tr>';
    $form .= $tabletag1 . _MB_NW_LATESTNEWS_BORDERCOLOR . $tabletag2;
    $form .= "<input type='text' name='options[]' value='" . $options[6] . "' size='8'></td></tr>";
    $form .= $tabletag1 . _MB_NW_LATESTNEWS_SELECTEDSTORIES . $tabletag2;
    $form .= "<input type='text' name='options[]' value='" . $options[7] . "' size='16'></td></tr>";
    $form .= $tabletag1 . _MB_NW_LATESTNEWS_IMGPOSITION . $tabletag2;
    $form .= nw_latestnews_mk_select($options, 8);
    $form .= $tabletag1 . _MB_NW_LATESTNEWS_TOPICLINK . $tabletag2;
    $form .= nw_latestnews_mk_chkbox($options, 9);
    $form .= $tabletag1 . _MB_NW_LATESTNEWS_ARCHIVELINK . $tabletag2;
    $form .= nw_latestnews_mk_chkbox($options, 10);
    $form .= $tabletag1 . _MB_NW_LATESTNEWS_SUBMITLINK . $tabletag2;
    $form .= nw_latestnews_mk_chkbox($options, 11);
    $form .= $tabletag1 . _MB_NW_LATESTNEWS_POSTEDBY . $tabletag2;
    $form .= nw_latestnews_mk_chkbox($options, 12);
    $form .= $tabletag1 . _MB_NW_LATESTNEWS_POSTTIME . $tabletag2;
    $form .= nw_latestnews_mk_chkbox($options, 13);
    $form .= $tabletag1 . _MB_NW_LATESTNEWS_TOPICIMAGE . $tabletag2;
    $form .= nw_latestnews_mk_chkbox($options, 14);
    $form .= $tabletag1 . _MB_NW_LATESTNEWS_TOPICTITLE . $tabletag2;
    $form .= nw_latestnews_mk_chkbox($options, 15);
    $form .= $tabletag1 . _MB_NW_LATESTNEWS_READ . $tabletag2;
    $form .= nw_latestnews_mk_chkbox($options, 16);
    $form .= $tabletag1 . _MB_NW_LATESTNEWS_COMMENT . $tabletag2;
    $form .= nw_latestnews_mk_chkbox($options, 17);
    $form .= $tabletag1 . _MB_NW_LATESTNEWS_PRINT . $tabletag2;
    $form .= nw_latestnews_mk_chkbox($options, 18);
    $form .= $tabletag1 . _MB_NW_LATESTNEWS_PDF . $tabletag2;
    $form .= nw_latestnews_mk_chkbox($options, 19);
    $form .= $tabletag1 . _MB_NW_LATESTNEWS_EMAIL . $tabletag2;
    $form .= nw_latestnews_mk_chkbox($options, 20);
    $form .= $tabletag1 . _MB_NW_LATESTNEWS_MORELINK . $tabletag2;
    $form .= nw_latestnews_mk_chkbox($options, 21);
    $form .= $tabletag1 . _MB_NW_LATESTNEWS_SCROLL . $tabletag2;
    $form .= nw_latestnews_mk_chkbox($options, 22);
    $form .= $tabletag1 . _MB_NW_LATESTNEWS_SCROLLHEIGHT . $tabletag2;
    $form .= "<input type='text' name='options[]' value='" . $options[23] . "' size='4'></td></tr>";
    $form .= $tabletag1 . _MB_NW_LATESTNEWS_SCROLLSPEED . $tabletag2;
    $form .= "<input type='text' name='options[]' value='" . $options[24] . "' size='4'></td></tr>";

    //order
    $form .= $tabletag1 . _MB_NW_LATESTNEWS_ORDERBY . $tabletag2;
    $form .= "<select name='options[]'>";
    $form .= "<option value='published'";
    if ('published' == $options[25]) {
        $form .= " selected='selected'";
    }
    $form .= '>' . _MB_NW_LATESTNEWS_DATE . "</option>\n";

    $form .= "<option value='counter'";
    if ('counter' == $options[25]) {
        $form .= " selected='selected'";
    }
    $form .= '>' . _MB_NW_LATESTNEWS_HITS . '</option>';
    $form .= "<option value='rating'";
    if ('rating' == $options[25]) {
        $form .= " selected='selected'";
    }
    $form .= '>' . _MB_NW_LATESTNEWS_RATE . '</option>';
    $form .= '</select></td></tr>';
    //topics
    $form       .= $tabletag1 . _MB_NW_LATESTNEWS_TOPICSDISPLAY . $tabletag2;
    $form       .= "<select name='options[]' multiple='multiple'>";
    $topics_arr = [];
    $xt         = new XoopsTree($xoopsDB->prefix('nw_topics'), 'topic_id', 'topic_pid');
    $topics_arr = $xt->getChildTreeArray(0, 'topic_title');
    $size       = count($options);
    foreach ($topics_arr as $onetopic) {
        $sel = '';
        if (0 != $onetopic['topic_pid']) {
            $onetopic['prefix'] = str_replace('.', '-', $onetopic['prefix']) . '&nbsp;';
        } else {
            $onetopic['prefix'] = str_replace('.', '', $onetopic['prefix']);
        }
        for ($i = 26; $i < $size; ++$i) {
            if ($options[$i] == $onetopic['topic_id']) {
                $sel = " selected='selected'";
            }
        }
        $form .= "<option value='" . $onetopic['topic_id'] . "'$sel>" . $onetopic['prefix'] . $onetopic['topic_title'] . '</option>';
    }
    $form .= '</select></td></tr>';

    $form .= '</table>';
    return $form;
}
