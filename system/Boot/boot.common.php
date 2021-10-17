<?php
if (! defined('SYSPATH')) {
    exit('No direct script access allowed');
}

spl_autoload_register(function ($name) {

    // echo "Want to load $name.\n".BR;

    $name_arr = explode("\\", $name);
    $class_sys_name_arr = array_splice($name_arr, 1);
    $class_sys_name_str = implode("/", $class_sys_name_arr);
    $class_filename = SYSPATH . $class_sys_name_str . ".php";

    if (! file_exists($class_filename)) {
        echo "Unable to load $name.";
        die();
        // throw new Exception();
    }

    require_once $class_filename;
});

/**
 * Remove Invisible Characters
 *
 * This prevents sandwiching null characters
 * between ascii characters, like Java\0script.
 *
 * @access public
 * @param
 *            string
 * @return string
 */
function remove_invisible_characters($str, $url_encoded = true)
{
    $non_displayables = array();

    // every control character except newline (dec 10)
    // carriage return (dec 13), and horizontal tab (dec 09)
    // and strip all RTL / LTR type markers

    if ($url_encoded) {
        $non_displayables[] = '/%0[0-8bcef]/i'; // url encoded 00-08, 11, 12, 14, 15
        $non_displayables[] = '/%1[0-9a-f]/i'; // url encoded 16-31
        $non_displayables[] = '/%e2%80%(?:a[de]|8[ef])/i'; // url encoded RTLO, LTRO, RTL, and LTR
    }

    $non_displayables[] = '/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]+/S'; // 00-08, 11, 12, 14-31, 127
    $non_displayables[] = '/[\x{202e}\x{202d}\x{200f}\x{200e}]/uS'; // RTLO 202e, LTRO 202d, RTL 200f, LTR 200e
    $non_displayables[] = '/&#(?:823[78]|820[67]);/'; // HTML entity versions of RTL/LTR markers

    do {
        $str = preg_replace($non_displayables, '', $str, - 1, $count);
    } while ($count);

    return $str;
}

