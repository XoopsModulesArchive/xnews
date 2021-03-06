<?php

// $Id: header.php,v 1.2 2004/01/29 17:15:54 mithyt2 Exp $
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
require_once dirname(__DIR__, 2) . '/mainfile.php';

define('XNI_SUBPREFXNI', 'XNI');
define('XNI_MODULE_DIR_NAME', 'xnewsimport');
define('XNI_MODULE_PATH', XOOPS_ROOT_PATH . '/modules/' . XNI_MODULE_DIR_NAME);
define('XNI_MODULE_URL', XOOPS_URL . '/modules/' . XNI_MODULE_DIR_NAME);
define('XNI_UPLOADS_NEWS_PATH', XOOPS_ROOT_PATH . '/uploads/' . XNI_MODULE_DIR_NAME);
define('XNI_IMAGES_FILES_PATH', XOOPS_ROOT_PATH . '/uploads/' . XNI_MODULE_DIR_NAME . '/images');
