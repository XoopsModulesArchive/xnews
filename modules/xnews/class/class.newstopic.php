<?php
// $Id: class.newstopic.php,v 1.9 2004/09/02 17:04:08 hthouzard Exp $
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

require_once XOOPS_ROOT_PATH . '/class/xoopsstory.php';
require_once XOOPS_ROOT_PATH . '/class/xoopstree.php';
require_once NW_MODULE_PATH . '/include/functions.php';

class nw_NewsTopic extends XoopsTopic
{
    public $menu;
    public $topic_description;
    public $topic_frontpage;
    public $topic_rssurl;
    public $topic_color;

    public function __construct($topicid = 0)
    {
        $this->db    = XoopsDatabaseFactory::getDatabaseConnection();
        $this->table = $this->db->prefix('nw_topics');
        if (is_array($topicid)) {
            $this->makeTopic($topicid);
        } elseif (0 != $topicid) {
            $this->getTopic((int)$topicid);
        } else {
            $this->topic_id = $topicid;
        }
    }

    public function MakeMyTopicSelBox($none = 0, $seltopic = -1, $selname = '', $onchange = '', $checkRight = false, $perm_type = 'nw_view')
    {
        $perms = '';
        if ($checkRight) {
            global $xoopsUser;
            $moduleHandler = xoops_getHandler('module');
            $newsModule    = $moduleHandler->getByDirname(NW_MODULE_DIR_NAME);
            $groups        = is_object($xoopsUser) ? $xoopsUser->getGroups() : XOOPS_GROUP_ANONYMOUS;
            $gpermHandler  = xoops_getHandler('groupperm');
            $topics        = $gpermHandler->getItemIds($perm_type, $groups, $newsModule->getVar('mid'));
            if (count($topics) > 0) {
                $topics = implode(',', $topics);
                $perms  = ' AND topic_id IN (' . $topics . ') ';
            } else {
                return null;
            }
        }

        if (-1 != $seltopic) {
            return $this->makeMySelBox('topic_title', 'topic_title', $seltopic, $none, $selname, $onchange, $perms);
        } elseif (!empty($this->topic_id)) {
            return $this->makeMySelBox('topic_title', 'topic_title', $this->topic_id, $none, $selname, $onchange, $perms);
        } else {
            return $this->makeMySelBox('topic_title', 'topic_title', 0, $none, $selname, $onchange, $perms);
        }
    }

    /**
     * makes a nicely ordered selection box
     *
     * @param        $title
     * @param string $order
     * @param int    $preset_id is used to specify a preselected item
     * @param int    $none      set $none to 1 to add a option with value 0
     * @param string $sel_name
     * @param string $onchange
     * @param        $perms
     * @return string
     */
    public function makeMySelBox($title, $order = '', $preset_id = 0, $none = 0, $sel_name = 'topic_id', $onchange = '', $perms)
    {
        $myts      = MyTextSanitizer::getInstance();
        $outbuffer = '';
        $outbuffer = "<select name='" . $sel_name . "'";
        if ('' != $onchange) {
            $outbuffer .= " onchange='" . $onchange . "'";
        }
        $outbuffer .= ">\n";
        $sql       = 'SELECT topic_id, ' . $title . ' FROM ' . $this->table . ' WHERE (topic_pid=0)' . $perms;
        if ('' != $order) {
            $sql .= " ORDER BY $order";
        }
        $result = $this->db->query($sql);
        if ($none) {
            $outbuffer .= "<option value='0'>----</option>\n";
        }
        while (list($catid, $name) = $this->db->fetchRow($result)) {
            $sel = '';
            if ($catid == $preset_id) {
                $sel = " selected='selected'";
            }
            $name      = $myts->displayTarea($name);
            $outbuffer .= "<option value='$catid'$sel>$name</option>\n";
            $sel       = '';
            $arr       = $this->getChildTreeArray($catid, $order, $perms);
            foreach ($arr as $option) {
                $option['prefix'] = str_replace('.', '--', $option['prefix']);
                $catpath          = $option['prefix'] . '&nbsp;' . $myts->displayTarea($option[$title]);

                if ($option['topic_id'] == $preset_id) {
                    $sel = " selected='selected'";
                }
                $outbuffer .= "<option value='" . $option['topic_id'] . "'$sel>$catpath</option>\n";
                $sel       = '';
            }
        }
        $outbuffer .= "</select>\n";
        return $outbuffer;
    }

    public function getChildTreeArray($sel_id = 0, $order = '', $perms = '', $parray = [], $r_prefix = '')
    {
        $sql = 'SELECT * FROM ' . $this->table . ' WHERE (topic_pid=' . $sel_id . ')' . $perms;
        if ('' != $order) {
            $sql .= " ORDER BY $order";
        }
        $result = $this->db->query($sql);
        $count  = $this->db->getRowsNum($result);
        if (0 == $count) {
            return $parray;
        }
        while (false !== ($row = $this->db->fetchArray($result))) {
            $row['prefix'] = $r_prefix . '.';
            array_push($parray, $row);
            $parray = $this->getChildTreeArray($row['topic_id'], $order, $perms, $parray, $row['prefix']);
        }
        return $parray;
    }

    public function getVar($var)
    {
        if (method_exists($this, $var)) {
            return call_user_func([$this, $var]);
        } else {
            return $this->$var;
        }
    }

    /**
     * Get the total number of topics in the base
     * @param bool $checkRight
     * @return mixed|null
     */
    public function getAllTopicsCount($checkRight = true)
    {
        $perms = '';
        if ($checkRight) {
            global $xoopsUser;
            $moduleHandler = xoops_getHandler('module');
            $newsModule    = $moduleHandler->getByDirname(NW_MODULE_DIR_NAME);
            $groups        = is_object($xoopsUser) ? $xoopsUser->getGroups() : XOOPS_GROUP_ANONYMOUS;
            $gpermHandler  = xoops_getHandler('groupperm');
            $topics        = $gpermHandler->getItemIds('nw_submit', $groups, $newsModule->getVar('mid'));
            if (count($topics) > 0) {
                $topics = implode(',', $topics);
                $perms  = ' WHERE topic_id IN (' . $topics . ') ';
            } else {
                return null;
            }
        }

        $sql   = 'SELECT count(topic_id) as cpt FROM ' . $this->table . $perms;
        $array = $this->db->fetchArray($this->db->query($sql));
        return ($array['cpt']);
    }

    public function getAllTopics($checkRight = true, $permission = 'nw_view')
    {
        $topics_arr = [];
        $db         = XoopsDatabaseFactory::getDatabaseConnection();
        $table      = $db->prefix('nw_topics');
        $sql        = 'SELECT * FROM ' . $table;
        if ($checkRight) {
            $topics = nw_MygetItemIds($permission);
            if (0 == count($topics)) {
                return [];
            }
            $topics = implode(',', $topics);
            $sql    .= ' WHERE topic_id IN (' . $topics . ')';
        }
        $sql    .= ' ORDER BY topic_title';
        $result = $db->query($sql);
        while (false !== ($array = $db->fetchArray($result))) {
            $topic = new nw_NewsTopic();
            $topic->makeTopic($array);
            $topics_arr[$array['topic_id']] = $topic;
            unset($topic);
        }
        return $topics_arr;
    }

    /**
     * Returns the number of published news per topic
     */
    public function getnwCountByTopic()
    {
        $ret    = [];
        $sql    = 'SELECT count(storyid) as cpt, topicid FROM ' . $this->db->prefix('nw_stories') . ' WHERE (published > 0 AND published <= ' . time() . ') AND (expired = 0 OR expired > ' . time() . ') GROUP BY topicid';
        $result = $this->db->query($sql);
        while (false !== ($row = $this->db->fetchArray($result))) {
            $ret[$row['topicid']] = $row['cpt'];
        }
        return $ret;
    }

    /**
     * Returns some stats about a topic
     * @param $topicid
     * @return array
     */
    public function getTopicMiniStats($topicid)
    {
        $ret          = [];
        $sql          = 'SELECT count(storyid) as cpt1, sum(counter) as cpt2 FROM ' . $this->db->prefix('nw_stories') . ' WHERE (topicid=' . $topicid . ') AND (published>0 AND published <= ' . time() . ') AND (expired = 0 OR expired > ' . time() . ')';
        $result       = $this->db->query($sql);
        $row          = $this->db->fetchArray($result);
        $ret['count'] = $row['cpt1'];
        $ret['reads'] = $row['cpt2'];
        return $ret;
    }

    public function setMenu($value)
    {
        $this->menu = $value;
    }

    public function setTopic_color($value)
    {
        $this->topic_color = $value;
    }

    public function getTopic($topicid)
    {
        $sql   = 'SELECT * FROM ' . $this->table . ' WHERE topic_id=' . $topicid . '';
        $array = $this->db->fetchArray($this->db->query($sql));
        $this->makeTopic($array);
    }

    public function makeTopic($array)
    {
        if (is_array($array)) {
            foreach ($array as $key => $value) {
                $this->$key = $value;
            }
        }
    }

    public function store()
    {
        $myts              = MyTextSanitizer::getInstance();
        $title             = '';
        $imgurl            = '';
        $topic_description = $myts->censorString($this->topic_description);
        $topic_description = $myts->addSlashes($topic_description);
        $topic_rssurl      = $myts->addSlashes($this->topic_rssurl);
        $topic_color       = $myts->addSlashes($this->topic_color);

        if (isset($this->topic_title) && '' != $this->topic_title) {
            $title = $myts->addSlashes($this->topic_title);
        }
        if (isset($this->topic_imgurl) && '' != $this->topic_imgurl) {
            $imgurl = $myts->addSlashes($this->topic_imgurl);
        }
        if (!isset($this->topic_pid) || !is_numeric($this->topic_pid)) {
            $this->topic_pid = 0;
        }
        $topic_frontpage = (int)$this->topic_frontpage;
        $insert          = false;
        if (empty($this->topic_id)) {
            $insert         = true;
            $this->topic_id = $this->db->genId($this->table . '_topic_id_seq');
            $sql            = sprintf(
                "INSERT INTO %s (topic_id, topic_pid, topic_imgurl, topic_title, menu, topic_description, topic_frontpage, topic_rssurl, topic_color, topic_weight) VALUES (%u, %u, '%s', '%s', %u, '%s', %d, '%s', '%s', %u)",
                $this->table,
                (int)$this->topic_id,
                (int)$this->topic_pid,
                $imgurl,
                $title,
                (int)$this->menu,
                $topic_description,
                $topic_frontpage,
                $topic_rssurl,
                $topic_color,
                (int)$this->topic_weight
            );
        } else {
            $sql = sprintf(
                "UPDATE %s SET topic_pid = %u, topic_imgurl = '%s', topic_title = '%s', menu=%d, topic_description='%s', topic_frontpage=%d, topic_rssurl='%s', topic_color='%s', topic_weight='%u' WHERE topic_id = %u",
                $this->table,
                (int)$this->topic_pid,
                $imgurl,
                $title,
                (int)$this->menu,
                $topic_description,
                $topic_frontpage,
                $topic_rssurl,
                $topic_color,
                (int)$this->topic_weight,
                (int)$this->topic_id
            );
        }
        if (!$result = $this->db->query($sql)) {
            // TODO: Replace with something else
            ErrorHandler::show('0022');
        } else {
            if ($insert) {
                $this->topic_id = $this->db->getInsertId();
            }
        }

        if (true === $this->use_permission) {
            $xt            = new XoopsTree($this->table, 'topic_id', 'topic_pid');
            $parent_topics = $xt->getAllParentId($this->topic_id);
            if (!empty($this->m_groups) && is_array($this->m_groups)) {
                foreach ($this->m_groups as $m_g) {
                    $moderate_topics = XoopsPerms::getPermitted($this->mid, 'ModInTopic', $m_g);
                    $add             = true;
                    // only grant this permission when the group has this permission in all parent topics of the created topic
                    foreach ($parent_topics as $p_topic) {
                        if (!in_array($p_topic, $moderate_topics)) {
                            $add = false;
                            continue;
                        }
                    }
                    if (true === $add) {
                        $xp = new XoopsPerms();
                        $xp->setModuleId($this->mid);
                        $xp->setName('ModInTopic');
                        $xp->setItemId($this->topic_id);
                        $xp->store();
                        $xp->addGroup($m_g);
                    }
                }
            }
            if (!empty($this->s_groups) && is_array($this->s_groups)) {
                foreach ($this->s_groups as $s_g) {
                    $submit_topics = XoopsPerms::getPermitted($this->mid, 'SubmitInTopic', $s_g);
                    $add           = true;
                    foreach ($parent_topics as $p_topic) {
                        if (!in_array($p_topic, $submit_topics)) {
                            $add = false;
                            continue;
                        }
                    }
                    if (true === $add) {
                        $xp = new XoopsPerms();
                        $xp->setModuleId($this->mid);
                        $xp->setName('SubmitInTopic');
                        $xp->setItemId($this->topic_id);
                        $xp->store();
                        $xp->addGroup($s_g);
                    }
                }
            }
            if (!empty($this->r_groups) && is_array($this->r_groups)) {
                foreach ($this->s_groups as $r_g) {
                    $read_topics = XoopsPerms::getPermitted($this->mid, 'ReadInTopic', $r_g);
                    $add         = true;
                    foreach ($parent_topics as $p_topic) {
                        if (!in_array($p_topic, $read_topics)) {
                            $add = false;
                            continue;
                        }
                    }
                    if (true === $add) {
                        $xp = new XoopsPerms();
                        $xp->setModuleId($this->mid);
                        $xp->setName('ReadInTopic');
                        $xp->setItemId($this->topic_id);
                        $xp->store();
                        $xp->addGroup($r_g);
                    }
                }
            }
        }
        return true;
    }

    public function Settopic_rssurl($value)
    {
        $this->topic_rssurl = $value;
    }

    public function topic_rssurl($format = 'S')
    {
        $myts = MyTextSanitizer::getInstance();
        switch ($format) {
            case 'S':
                $topic_rssurl = $myts->displayTarea($this->topic_rssurl);
                break;
            case 'P':
                $topic_rssurl = $myts->previewTarea($this->topic_rssurl);
                break;
            case 'F':
            case 'E':
                $topic_rssurl = htmlspecialchars($this->topic_rssurl, ENT_QUOTES | ENT_HTML5);
                break;
        }
        return $topic_rssurl;
    }

    public function topic_color($format = 'S')
    {
        $myts = MyTextSanitizer::getInstance();
        switch ($format) {
            case 'S':
                $topic_color = $myts->displayTarea($this->topic_color);
                break;
            case 'P':
                $topic_color = $myts->previewTarea($this->topic_color);
                break;
            case 'F':
            case 'E':
                $topic_color = htmlspecialchars($this->topic_color, ENT_QUOTES | ENT_HTML5);
                break;
        }
        return $topic_color;
    }

    public function menu()
    {
        return $this->menu;
    }

    public function topic_description($format = 'S')
    {
        $myts = MyTextSanitizer::getInstance();
        switch ($format) {
            case 'S':
                $topic_description = $myts->displayTarea($this->topic_description, 1);
                break;
            case 'P':
                $topic_description = $myts->previewTarea($this->topic_description);
                break;
            case 'F':
            case 'E':
                $topic_description = htmlspecialchars(($this->topic_description), ENT_QUOTES | ENT_HTML5);
                break;
        }
        return $topic_description;
    }

    public function topic_imgurl($format = 'S')
    {
        if ('' == trim($this->topic_imgurl)) {
            $this->topic_imgurl = 'blank.png';
        }
        $myts = MyTextSanitizer::getInstance();
        switch ($format) {
            case 'S':
                $imgurl = htmlspecialchars($this->topic_imgurl, ENT_QUOTES | ENT_HTML5);
                break;
            case 'E':
                $imgurl = htmlspecialchars($this->topic_imgurl, ENT_QUOTES | ENT_HTML5);
                break;
            case 'P':
                $imgurl = ($this->topic_imgurl);
                $imgurl = htmlspecialchars($imgurl, ENT_QUOTES | ENT_HTML5);
                break;
            case 'F':
                $imgurl = ($this->topic_imgurl);
                $imgurl = htmlspecialchars($imgurl, ENT_QUOTES | ENT_HTML5);
                break;
        }
        return $imgurl;
    }

    public function getTopicTitleFromId($topic, &$topicstitles)
    {
        $myts = MyTextSanitizer::getInstance();
        $sql  = 'SELECT topic_id, topic_title, topic_imgurl FROM ' . $this->table . ' WHERE ';
        if (!is_array($topic)) {
            $sql .= ' topic_id=' . (int)$topic;
        } else {
            if (count($topic) > 0) {
                $sql .= ' topic_id IN (' . implode(',', $topic) . ')';
            } else {
                return null;
            }
        }
        $result = $this->db->query($sql);
        while (false !== ($row = $this->db->fetchArray($result))) {
            $topicstitles[$row['topic_id']] = ['title' => $myts->displayTarea($row['topic_title']), 'picture' => NW_TOPICS_FILES_URL . '/' . $row['topic_imgurl']];
        }
        return $topicstitles;
    }

    public function getTopicsList($frontpage = false, $perms = false)
    {
        $sql = 'SELECT topic_id, topic_pid, topic_title, topic_color FROM ' . $this->table . ' WHERE 1 ';
        if ($frontpage) {
            $sql .= ' AND topic_frontpage=1';
        }
        if ($perms) {
            $topicsids = [];
            $topicsids = nw_MygetItemIds();
            if (0 == count($topicsids)) {
                return '';
            }
            $topics = implode(',', $topicsids);
            $sql    .= ' AND topic_id IN (' . $topics . ')';
        }
        $result = $this->db->query($sql);
        $ret    = [];
        $myts   = MyTextSanitizer::getInstance();
        while (false !== ($myrow = $this->db->fetchArray($result))) {
            $ret[$myrow['topic_id']] = ['title' => $myts->displayTarea($myrow['topic_title']), 'pid' => $myrow['topic_pid'], 'color' => $myrow['topic_color']];
        }
        return $ret;
    }

    public function setTopicDescription($value)
    {
        $this->topic_description = $value;
    }

    public function topic_frontpage()
    {
        return $this->topic_frontpage;
    }

    public function setTopicFrontpage($value)
    {
        $this->topic_frontpage = (int)$value;
    }
}
