<?php

if (! defined('SYSPATH')) {
    exit('No direct script access allowed');
}

if (session_id() == '' || ! isset($_SESSION) || session_status() === PHP_SESSION_NONE) {
    // session isn't started
    session_start();
}

require_once SYSPATH . 'Config/constants.php';
require_once SYSPATH . 'Config/config.php';
require_once __DIR__ . '/boot.common.php';

use Lamp\Core;

$core = new Core\App();

/*
 * ------------------------------------------------------
 *  Boot the core
 * ------------------------------------------------------
 */

$core->boot();

$CI = $core;

function get_instance()
{
    global $CI;
    
    return $CI;
}

function lamp($dep = null)
{
    $app = get_instance();
    
    if (isset($dep) && isset($app->di)) {
        $args = func_get_args();
        return call_user_func_array(array($app->di, 'make'), $args);
    }
    
    return $app;
}

/*
 * ------------------------------------------------------
 *  Parse the request
 * ------------------------------------------------------
 */
$request = Core\Request::fromGlobals();

/*
 * ------------------------------------------------------
 *  Run the request and get a response
 * ------------------------------------------------------
 */

try {
    $response = $core->run($request);
} catch (Exception $ex) {
    show_exception($ex);
} // catch (Error $ex) {
//     show_exception($ex);
// }


/*
 * ------------------------------------------------------
 *  Send the response
 * ------------------------------------------------------
 */
if ($response) {
    $response->send();
}

// EOF
