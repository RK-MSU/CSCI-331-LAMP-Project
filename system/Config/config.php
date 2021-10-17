<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$username = (isset($_SESSION['username'])) ? $_SESSION['username'] : null;
$member_id = (isset($_SESSION['member_id'])) ? $_SESSION['member_id'] : null;
$logged_in = (!is_null($username)) ? true : false;

$config['database'] = [
    'host'      => 'localhost',
    'database'  => 'db36',
    'username'  => 'user36',
    'password'  => '36oxon'
];

$protocol           = (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") ? "https://" : "http://";
$base_url           = $protocol . $_SERVER['HTTP_HOST'];
$base_path          = $_SERVER['DOCUMENT_ROOT'];

$config['base_path']    = "/home/b62v473/public_html/"; //;$base_path . '/';
$config['base_url']     = $base_url . '/~b62v473/';
$config['tmpl_path']    =  $config['base_path'] . "templates/";

$config['site_name']    = 'CS-Social';
$config['logged_in']    = $logged_in;
$config['username']     = $username;
$config['member_id']    = $member_id;
