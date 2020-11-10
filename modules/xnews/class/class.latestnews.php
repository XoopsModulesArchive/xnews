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

class nw_Latestnewsstory extends nw_NewsStory
{
    public function __construct($id = -1)
    {
        parent::__construct($id);
    }

    /**
     * Returns published stories according to some options
     * @param int    $limit
     * @param bool   $selected_stories
     * @param int    $start
     * @param bool   $checkRight
     * @param int    $topic
     * @param int    $ihome
     * @param bool   $asobject
     * @param string $order
     * @param bool   $topic_frontpage
     * @return array|null
     */
    public static function getAllPublished($limit = 0, $selected_stories = true, $start = 0, $checkRight = false, $topic = 0, $ihome = 0, $asobject = true, $order = 'published', $topic_frontpage = false)
    {
        $db   = XoopsDatabaseFactory::getDatabaseConnection();
        $myts = MyTextSanitizer::getInstance();

        $ret = [];
        $sql = 'SELECT s.*, t.* FROM ' . $db->prefix('nw_stories') . ' s, ' . $db->prefix('nw_topics') . ' t WHERE (s.published > 0 AND s.published <= ' . time() . ') AND (s.expired = 0 OR s.expired > ' . time() . ') AND (s.topicid=t.topic_id) ';
        if (0 != $topic) {
            if ($selected_stories) {
                $sql .= ' AND s.storyid IN (' . $selected_stories . ')';
            }

            if (!is_array($topic)) {
                if ($checkRight) {
                    $topics = nw_MygetItemIds('nw_view');
                    if (!in_array($topic, $topics)) {
                        return null;
                    } else {
                        $sql .= ' AND s.topicid=' . (int)$topic . ' AND (s.ihome=1 OR s.ihome=0)';
                    }
                } else {
                    $sql .= ' AND s.topicid=' . (int)$topic . ' AND (s.ihome=1 OR s.ihome=0)';
                }
            } else {
                if ($checkRight) {
                    $topics = nw_MygetItemIds('nw_view');
                    $topic  = array_intersect($topic, $topics);
                }
                if (count($topic) > 0) {
                    $sql .= ' AND s.topicid IN (' . implode(',', $topic) . ')';
                } else {
                    return null;
                }
            }
        } else {
            if ($checkRight) {
                $topics = nw_MygetItemIds('nw_view');
                if (count($topics) > 0) {
                    $topics = implode(',', $topics);
                    $sql    .= ' AND s.topicid IN (' . $topics . ')';
                } else {
                    return null;
                }
            }
            if (0 == (int)$ihome) {
                $sql .= ' AND s.ihome=0';
            }
        }
        if ($topic_frontpage) {
            $sql .= ' AND t.topic_frontpage=1';
        }
        $sql    .= " ORDER BY s.$order DESC";
        $result = $db->query($sql, (int)$limit, (int)$start);

        while (false !== ($myrow = $db->fetchArray($result))) {
            if ($asobject) {
                $ret[] = new nw_Latestnewsstory($myrow);
            } else {
                $ret[$myrow['storyid']] = htmlspecialchars($myrow['title'], ENT_QUOTES | ENT_HTML5);
            }
        }
        return $ret;
    }
}
