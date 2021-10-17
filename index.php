<?php
/**
 * LAMP Project - CSCI-331: Web Development
 * 
 */


/*
 * --------------------------------------------------------------------
 *  System Path
 * --------------------------------------------------------------------
 *
 */

$system_path = './system';

/*
 * --------------------------------------------------------------------
 *  Resolve the system path for increased reliability
 * --------------------------------------------------------------------
 */

if (realpath($system_path) !== false) {
    $system_path = realpath($system_path);
}

$system_path = rtrim($system_path, '/') . '/';


/*
 * --------------------------------------------------------------------
 *  Now that we know the path, set the main constants
 * --------------------------------------------------------------------
 */
// The name of this file
define('SELF', basename(__FILE__));
define('EESELF', basename(__FILE__));

// // Path to this file
define('FCPATH', __DIR__ . '/');

// // Path to the "system" folder
define('SYSPATH', $system_path);

// // Name of the "system folder"
define('SYSDIR', basename($system_path));


/*
 *
 * And away we go...
 *
 */


if (! file_exists(SYSPATH . 'Boot/boot.php')) {
    header('HTTP/1.1 503 Service Unavailable.', true, '503');
    exit("Your system folder path does not appear to be set correctly. Please open the following file and correct this: " . pathinfo(__FILE__, PATHINFO_BASENAME));
}

require_once SYSPATH . 'Boot/boot.php';
