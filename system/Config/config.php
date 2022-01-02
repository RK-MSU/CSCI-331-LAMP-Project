<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$username = (isset($_SESSION['username'])) ? $_SESSION['username'] : null;
$member_id = (isset($_SESSION['member_id'])) ? $_SESSION['member_id'] : null;
$logged_in = (!is_null($username)) ? true : false;

$config['database'] = [
    'host'      => 'localhost',
    'database'  => 'db_tablename',
    'username'  => 'db_username',
    'password'  => 'db_password'
];

$protocol           = (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") ? "https://" : "http://";
$base_url           = $protocol . $_SERVER['HTTP_HOST'];

switch ($_SERVER['HTTP_HOST']) {
    case 'msu.rk311y.com':
        $base_url   = $protocol . $http_host . '/csci331/lamp/';
        $base_path  = '/home2/highaech/msu.rk311y.com/csci331/lamp/';
        break;
    default:
        $base_path  = "/home/b62v473/public_html/LampStack/"; //$_SERVER['DOCUMENT_ROOT'];
        $base_url   = "https://csci331.cs.montana.edu/~b62v473/LampStack/";
        break;
}

$config['base_path']    = rtrim($base_path, '/') . '/';
$config['base_url']     = rtrim($base_url, '/') . '/';
$config['tmpl_path']    =  $config['base_path'] . 'templates/';

$config['site_name']    = 'CS-Social';
$config['logged_in']    = $logged_in;
$config['username']     = $username;
$config['member_id']    = $member_id;

/*
 * --------------------------------------------------------------------
 * Creating Dynamic Database Connections
 * --------------------------------------------------------------------
 */
switch ($_SERVER['HTTP_HOST']) {
    case 'msu.rk311y.com':
        $config['database'] = [
            'host'      => 'localhost',
            'database'  => 'db_table_name',
            'username'  => 'username',
            'password'  => 'password'
        ];
        break;
    default:
        $config['database'] = [
            'host'      => 'localhost',
            'database'  => 'db_table_name',
            'username'  => 'username',
            'password'  => 'password'
        ];
        break;
}

// END OF
