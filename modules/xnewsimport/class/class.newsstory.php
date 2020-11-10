<?php

// $Id: class.newsstory.php,v 1.29 2004/09/02 17:04:08 hthouzard Exp $
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
// ------------------------------------------------------------------------- //
if (!defined('XOOPS_ROOT_PATH')) {
    die('XOOPS root path not defined');
}

require_once XOOPS_ROOT_PATH . '/class/xoopsstory.php';
require_once XOOPS_ROOT_PATH . '/include/comment_constants.php';
require_once XNI_MODULE_PATH . '/include/functions.php';

class xni_NewsStory extends XoopsStory
{
    // XoopsTopic object
    public $newstopic;
    // news rating
    public $rating;
    // Number of votes
    public $votes;
    // META, desciption
    public $description;
    // META, keywords
    public $keywords;
    public $picture;
    public $topic_imgurl;
    public $topic_title;

    /**
     * Constructor
     * @param int    $storyid
     * @param string $subprefix
     */
    public function __construct($storyid = -1, $subprefix = '')
    {
        $this->db          = XoopsDatabaseFactory::getDatabaseConnection();
        $this->table       = $this->db->prefix($subprefix . 'stories');
        $this->topicstable = $this->db->prefix($subprefix . 'topics');
        if (is_array($storyid)) {
            $this->makeStory($storyid);
        } elseif (-1 !== $storyid) {
            $this->getStory((int)$storyid, $subprefix);
        }
    }

    /**
     * Load the specified story from the database
     * @param $storyid
     * @param $subprefix
     */
    public function getStory($storyid, $subprefix = null): void
    {
        $sql   = 'SELECT s.*, t.* FROM ' . $this->table . ' s, ' . $this->db->prefix($subprefix . 'topics') . ' t WHERE (storyid=' . (int)$storyid . ') AND (s.topicid=t.topic_id)';
        $array = $this->db->fetchArray($this->db->query($sql));
        $this->makeStory($array);
    }

    /**
     * Create or update an article
     * @param bool $approved
     * @return false|int
     */
    public function store($approved = false)
    {
        $myts        = MyTextSanitizer::getInstance();
        $counter     = $this->counter ?? 0;
        $title       = $myts->censorString($this->title);
        $title       = $myts->addSlashes($title);
        $hostname    = $myts->addSlashes($this->hostname);
        $type        = $myts->addSlashes($this->type);
        $hometext    = $myts->addSlashes($myts->censorString($this->hometext));
        $bodytext    = $myts->addSlashes($myts->censorString($this->bodytext));
        $description = $myts->addSlashes($myts->censorString($this->description));
        $keywords    = $myts->addSlashes($myts->censorString($this->keywords));
        $picture     = $myts->addSlashes($this->picture);
        $votes       = (int)$this->votes;
        $rating      = (float)($this->rating);
        if (!isset($this->nohtml) || 1 !== $this->nohtml) {
            $this->nohtml = 0;
        }
        if (!isset($this->nosmiley) || 1 !== $this->nosmiley) {
            $this->nosmiley = 0;
        }
        if (!isset($this->notifypub) || 1 !== $this->notifypub) {
            $this->notifypub = 0;
        }
        if (!isset($this->topicdisplay) || 0 !== $this->topicdisplay) {
            $this->topicdisplay = 1;
        }
        $expired = !empty($this->expired) ? $this->expired : 0;
        if (!isset($this->storyid)) {
            //$newpost = 1;
            $newstoryid = $this->db->genId($this->table . '_storyid_seq');
            $created    = time();
            $published  = $this->approved ? (int)$this->published : 0;
            $sql        = sprintf(
                "INSERT INTO %s (storyid, uid, title, created, published, expired, hostname, nohtml, nosmiley, hometext, bodytext, counter, topicid, ihome, notifypub, story_type, topicdisplay, topicalign, comments, rating, votes, description, keywords, picture) VALUES (%u, %u, '%s', %u, %u, %u, '%s', %u, %u, '%s', '%s', %u, %u, %u, %u, '%s', %u, '%s', %u, %u, %u, '%s', '%s', '%s')",
                $this->table,
                $newstoryid,
                (int)$this->uid(),
                $title,
                $created,
                $published,
                $expired,
                $hostname,
                (int)$this->nohtml(),
                (int)$this->nosmiley(),
                $hometext,
                $bodytext,
                $counter,
                (int)$this->topicid(),
                (int)$this->ihome(),
                (int)$this->notifypub(),
                $type,
                (int)$this->topicdisplay(),
                $this->topicalign,
                (int)$this->comments(),
                $rating,
                $votes,
                $description,
                $keywords,
                $picture
            );
        } else {
            $sql        = sprintf(
                "UPDATE %s SET title='%s', published=%u, expired=%u, nohtml=%u, nosmiley=%u, hometext='%s', bodytext='%s', topicid=%u, ihome=%u, topicdisplay=%u, topicalign='%s', comments=%u, rating=%u, votes=%u, uid=%u, description='%s', keywords='%s', picture='%s' WHERE storyid = %u",
                $this->table,
                $title,
                (int)$this->published(),
                $expired,
                (int)$this->nohtml(),
                (int)$this->nosmiley(),
                $hometext,
                $bodytext,
                (int)$this->topicid(),
                (int)$this->ihome(),
                (int)$this->topicdisplay(),
                $this->topicalign,
                (int)$this->comments(),
                $rating,
                $votes,
                (int)$this->uid(),
                $description,
                $keywords,
                $picture,
                (int)$this->storyid()
            );
            $newstoryid = (int)$this->storyid();
        }
        if (!$this->db->queryF($sql)) {
            return false;
        }
        if (empty($newstoryid)) {
            $newstoryid    = $this->db->getInsertId();
            $this->storyid = $newstoryid;
        }

        return $newstoryid;
    }

    public function picture()
    {
        return $this->picture;
    }

    public function rating()
    {
        return $this->rating;
    }

    public function votes()
    {
        return $this->votes;
    }

    public function Setpicture($data): void
    {
        $this->picture = $data;
    }

    public function Setdescription($data): void
    {
        $this->description = $data;
    }

    public function Setkeywords($data): void
    {
        $this->keywords = $data;
    }

    public function description($format = 'S')
    {
        $myts = MyTextSanitizer::getInstance();
        switch (mb_strtoupper($format)) {
            case 'S':
                $description = htmlspecialchars($this->description, ENT_QUOTES | ENT_HTML5);
                break;
            case 'P':
            case 'F':
                $description = htmlspecialchars($this->description, ENT_QUOTES | ENT_HTML5);
                break;
            case 'E':
                $description = htmlspecialchars($this->description, ENT_QUOTES | ENT_HTML5);
                break;
        }

        return $description;
    }

    public function keywords($format = 'S')
    {
        $myts = MyTextSanitizer::getInstance();
        switch (mb_strtoupper($format)) {
            case 'S':
                $keywords = htmlspecialchars($this->keywords, ENT_QUOTES | ENT_HTML5);
                break;
            case 'P':
            case 'F':
                $keywords = htmlspecialchars($this->keywords, ENT_QUOTES | ENT_HTML5);
                break;
            case 'E':
                $keywords = htmlspecialchars($this->keywords, ENT_QUOTES | ENT_HTML5);
                break;
        }

        return $keywords;
    }
}
