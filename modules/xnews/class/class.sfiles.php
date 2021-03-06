<?php
// $Id: class.sfiles.php,v 1.10 2004/09/02 17:04:08 hthouzard Exp $
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

require_once NW_MODULE_PATH . '/class/class.mimetype.php';

class nw_sFiles
{
    public $db;
    public $table;
    public $fileid;
    public $filerealname;
    public $storyid;
    public $date;
    public $mimetype;
    public $downloadname;
    public $counter;

    public function __construct($fileid = -1)
    {
        $this->db           = XoopsDatabaseFactory::getDatabaseConnection();
        $this->table        = $this->db->prefix('nw_stories_files');
        $this->storyid      = 0;
        $this->filerealname = '';
        $this->date         = 0;
        $this->mimetype     = '';
        $this->downloadname = 'downloadfile';
        $this->counter      = 0;
        if (is_array($fileid)) {
            $this->makeFile($fileid);
        } elseif (-1 != $fileid) {
            $this->getFile((int)$fileid);
        }
    }

    public function createUploadName($folder, $filename, $trimname = false)
    {
        $workingfolder = $folder;
        if ('/' <> xoops_substr($workingfolder, strlen($workingfolder) - 1, 1)) {
            $workingfolder .= '/';
        }
        $ext  = basename($filename);
        $ext  = explode('.', $ext);
        $ext  = '.' . $ext[count($ext) - 1];
        $true = true;
        while ($true) {
            $ipbits = explode('.', $_SERVER['REMOTE_ADDR']);

            [$usec, $sec] = explode(' ', microtime());

            $usec *= 65536;
            $sec  = ((integer)$sec) & 0xFFFF;

            if ($trimname) {
                $uid = sprintf('%06x%04x%04x', ($ipbits[0] << 24) | ($ipbits[1] << 16) | ($ipbits[2] << 8) | $ipbits[3], $sec, $usec);
            } else {
                $uid = sprintf('%08x-%04x-%04x', ($ipbits[0] << 24) | ($ipbits[1] << 16) | ($ipbits[2] << 8) | $ipbits[3], $sec, $usec);
            }
            if (!file_exists($workingfolder . $uid . $ext)) {
                $true = false;
            }
        }
        return $uid . $ext;
    }

    public function giveMimetype($filename = '')
    {
        $nw_cmimetype = new nw_cmimetype();
        $workingfile  = $this->downloadname;
        if ('' != xoops_trim($filename)) {
            $workingfile = $filename;
            return $nw_cmimetype->getType($workingfile);
        } else {
            return '';
        }
    }

    public function getAllbyStory($storyid)
    {
        $ret    = [];
        $sql    = 'SELECT * FROM ' . $this->table . ' WHERE storyid=' . (int)$storyid;
        $result = $this->db->query($sql);
        while (false !== ($myrow = $this->db->fetchArray($result))) {
            $ret[] = new nw_sFiles($myrow);
        }
        return $ret;
    }

    public function getFile($id)
    {
        $sql   = 'SELECT * FROM ' . $this->table . ' WHERE fileid=' . (int)$id;
        $array = $this->db->fetchArray($this->db->query($sql));
        $this->makeFile($array);
    }

    public function makeFile($array)
    {
        foreach ($array as $key => $value) {
            $this->$key = $value;
        }
    }

    public function store()
    {
        $myts         = MyTextSanitizer::getInstance();
        $fileRealName = $myts->addSlashes($this->filerealname);
        $downloadname = $myts->addSlashes($this->downloadname);
        $date         = time();
        $mimetype     = $myts->addSlashes($this->mimetype);
        $counter      = (int)$this->counter;
        $storyid      = (int)$this->storyid;

        if (!isset($this->fileid)) {
            $newid        = (int)$this->db->genId($this->table . '_fileid_seq');
            $sql          = 'INSERT INTO ' . $this->table . ' (fileid, storyid, filerealname, date, mimetype, downloadname, counter) ' . 'VALUES (' . $newid . ',' . $storyid . ",'" . $fileRealName . "','" . $date . "','" . $mimetype . "','" . $downloadname . "'," . $counter . ')';
            $this->fileid = $newid;
        } else {
            $sql = 'UPDATE ' . $this->table . ' SET storyid=' . $storyid . ",filerealname='" . $fileRealName . "',date=" . $date . ",mimetype='" . $mimetype . "',downloadname='" . $downloadname . "',counter=" . $counter . ' WHERE fileid=' . $this->getFileid();
        }
        if (!$result = $this->db->query($sql)) {
            return false;
        }
        return true;
    }

    public function delete($workdir = NW_ATTACHED_FILES_PATH)
    {
        $sql = 'DELETE FROM ' . $this->table . ' WHERE fileid=' . $this->getFileid();
        if (!$result = $this->db->query($sql)) {
            return false;
        }
        if (file_exists($workdir . '/' . $this->downloadname)) {
            unlink($workdir . '/' . $this->downloadname);
            //DNPROSSI - Added thumb deletion
            if (false !== strpos($this->getMimetype(), 'image')) {
                unlink($workdir . '/thumb_' . $this->downloadname);
            }
        }
        return true;
    }

    public function updateCounter()
    {
        $sql = 'UPDATE ' . $this->table . ' SET counter=counter+1 WHERE fileid=' . $this->getFileid();
        if (!$result = $this->db->queryF($sql)) {
            return false;
        }
        return true;
    }

    // ****************************************************************************************************************
    // All the Sets
    // ****************************************************************************************************************
    public function setFileRealName($filename)
    {
        $this->filerealname = $filename;
    }

    public function setStoryid($id)
    {
        $this->storyid = (int)$id;
    }

    public function setMimetype($value)
    {
        $this->mimetype = $value;
    }

    public function setDownloadname($value)
    {
        $this->downloadname = $value;
    }

    // ****************************************************************************************************************
    // All the Gets
    // ****************************************************************************************************************
    public function getFileid()
    {
        return (int)$this->fileid;
    }

    public function getStoryid()
    {
        return (int)$this->storyid;
    }

    public function getCounter()
    {
        return (int)$this->counter;
    }

    public function getDate()
    {
        return (int)$this->date;
    }

    public function getFileRealName($format = 'S')
    {
        $myts = MyTextSanitizer::getInstance();
        switch ($format) {
            case 'S':
            case 'Show':
                $filerealname = htmlspecialchars($this->filerealname, ENT_QUOTES | ENT_HTML5);
                break;
            case 'E':
            case 'Edit':
                $filerealname = htmlspecialchars($this->filerealname, ENT_QUOTES | ENT_HTML5);
                break;
            case 'P':
            case 'Preview':
                $filerealname = htmlspecialchars(($this->filerealname), ENT_QUOTES | ENT_HTML5);
                break;
            case 'F':
            case 'InForm':
                $filerealname = htmlspecialchars(($this->filerealname), ENT_QUOTES | ENT_HTML5);
                break;
        }
        return $filerealname;
    }

    public function getMimetype($format = 'S')
    {
        $myts = MyTextSanitizer::getInstance();
        switch ($format) {
            case 'S':
            case 'Show':
                $filemimetype = htmlspecialchars($this->mimetype, ENT_QUOTES | ENT_HTML5);
                break;
            case 'E':
            case 'Edit':
                $filemimetype = htmlspecialchars($this->mimetype, ENT_QUOTES | ENT_HTML5);
                break;
            case 'P':
            case 'Preview':
                $filemimetype = htmlspecialchars(($this->mimetype), ENT_QUOTES | ENT_HTML5);
                break;
            case 'F':
            case 'InForm':
                $filemimetype = htmlspecialchars(($this->mimetype), ENT_QUOTES | ENT_HTML5);
                break;
        }
        return $filemimetype;
    }

    public function getDownloadname($format = 'S')
    {
        $myts = MyTextSanitizer::getInstance();
        switch ($format) {
            case 'S':
            case 'Show':
                $filedownname = htmlspecialchars($this->downloadname, ENT_QUOTES | ENT_HTML5);
                break;
            case 'E':
            case 'Edit':
                $filedownname = htmlspecialchars($this->downloadname, ENT_QUOTES | ENT_HTML5);
                break;
            case 'P':
            case 'Preview':
                $filedownname = htmlspecialchars(($this->downloadname), ENT_QUOTES | ENT_HTML5);
                break;
            case 'F':
            case 'InForm':
                $filedownname = htmlspecialchars(($this->downloadname), ENT_QUOTES | ENT_HTML5);
                break;
        }
        return $filedownname;
    }

    // Deprecated
    public function getCountbyStory($storyid)
    {
        $sql    = 'SELECT count(fileid) as cnt FROM ' . $this->table . ' WHERE storyid=' . (int)$storyid . '';
        $result = $this->db->query($sql);
        $myrow  = $this->db->fetchArray($result);
        return $myrow['cnt'];
    }

    public function getCountbyStories($stories)
    {
        $ret = [];
        if (count($stories) > 0) {
            $sql    = 'SELECT storyid, count(fileid) as cnt FROM ' . $this->table . ' WHERE storyid IN (';
            $sql    .= implode(',', $stories) . ') GROUP BY storyid';
            $result = $this->db->query($sql);
            while (false !== ($myrow = $this->db->fetchArray($result))) {
                $ret[$myrow['storyid']] = $myrow['cnt'];
            }
        }
        return $ret;
    }
}
