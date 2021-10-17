<?php

namespace Lamp\Library;

class Functions
{
    public function destroySession()
    {
        $_SESSION=array();
        
        if (session_id() != "" || isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time()-2592000, '/');
        }
            
        session_destroy();
    }
    
    
    public function redirect($path)
    {
        global $config;
        
        /* Redirect browser */
        header("Location: " . $config['base_url'] . $path);
        
        exit;
    }
    
    public function getMemberId($username)
    {
        $result = lamp()->db->query("SELECT member_id FROM members WHERE username='$username'");
        
        if($result->num_rows > 0) {
            return $result->fetch_row()[0];
        }
        
        return null;
    }

}
