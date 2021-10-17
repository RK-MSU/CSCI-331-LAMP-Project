<?php

/**
 * This source file is part of the open source project
 * ExpressionEngine (https://expressionengine.com)
 *
 * @link      https://expressionengine.com/
 * @copyright Copyright (c) 2003-2021, Packet Tide, LLC (https://www.packettide.com)
 * @license   https://expressionengine.com/license Licensed under Apache License, Version 2.0
 */

namespace Lamp\Core;

class Input
{
    /**
     * Fetch an item from the GET array
     *
     * @access	public
     * @param	string
     * @param	bool
     * @return	string
     */
    public function get($index = '', $xss_clean = false)
    {
        return $this->_fetch_from_array($_GET, $index, $xss_clean);
    }
    
    /**
     * Fetch an item from the POST array
     *
     * @access	public
     * @param	string
     * @param	bool
     * @return	string
     */
    public function post($index = '', $xss_clean = false)
    {
        return $this->_fetch_from_array($_POST, $index, $xss_clean);
    }
    
    /**
     * Fetch an item from either the GET array or the POST
     *
     * @access	public
     * @param	string	The index key
     * @param	bool	XSS cleaning
     * @return	string
     */
    public function get_post($index = '', $xss_clean = false)
    {
        if (! isset($_POST[$index])) {
            return $this->get($index, $xss_clean);
        } else {
            return $this->post($index, $xss_clean);
        }
    }
    
    
    /**
     * Fetch from array
     *
     * This is a helper function to retrieve values from global arrays
     *
     * @access	private
     * @param	array
     * @param	string
     * @param	bool
     * @return	string
     */
    public function _fetch_from_array(&$array, $index = '', $xss_clean = false)
    {
        if (! isset($array[$index])) {
            return false;
        }
        
        if ($xss_clean === true) {
            return lamp()->xss->clean($array[$index]);
        }
        
        return $array[$index];
    }
    
    
}