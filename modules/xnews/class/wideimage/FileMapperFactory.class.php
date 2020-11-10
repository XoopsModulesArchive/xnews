<?php
/**
 * This file is part of WideImage.
 *
 * WideImage is free software; you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation; either version 2.1 of the License, or
 * (at your option) any later version.
 *
 * WideImage is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with WideImage; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 **/

class wiUnsupportedFormatException extends wiException
{
}

abstract class wiFileMapperFactory
{
    protected static $mappers   = [];
    protected static $mimeTable = [
        'image/jpg'   => 'jpeg',
        'image/jpeg'  => 'jpeg',
        'image/pjpeg' => 'jpeg',
        'image/gif'   => 'gif',
        'image/png'   => 'png',
    ];

    public static function selectMapper($uri, $format = null)
    {
        $format = self::determineFormat($uri, $format);

        if (array_key_exists($format, self::$mappers)) {
            return self::$mappers[$format];
        }

        $mapperClassName = 'wi' . 'ImageFileMapper_' . $format;
        if (!class_exists($mapperClassName)) {
            $mapperFileName = WI_LIB_PATH . 'mappers/' . 'ImageFileMapper_' . $format . '.class.php';
            if (file_exists($mapperFileName)) {
                require_once $mapperFileName;
            }
        }

        if (class_exists($mapperClassName)) {
            self::$mappers[$format] = new $mapperClassName();
            return self::$mappers[$format];
        }

        throw new wiUnsupportedFormatException("Format '{$format}' is not supported.");
    }

    public static function determineFormat($uri, $format = null)
    {
        if (null === $format) {
            $format = self::extractExtension($uri);
        }

        // mime-type match
        if (preg_match('~[a-z]*/[a-z-]*~i', $format)) {
            if (isset(self::$mimeTable[strtolower($format)])) {
                return self::$mimeTable[strtolower($format)];
            }
        }

        // clean the string
        $format = strtoupper(preg_replace('/[^a-z0-9_-]/i', '', $format));
        if ('JPG' == $format) {
            $format = 'JPEG';
        }

        return $format;
    }

    public static function extractExtension($uri)
    {
        $p = strrpos($uri, '.');
        if (false === $p) {
            return '';
        } else {
            return substr($uri, $p + 1);
        }
    }
}
