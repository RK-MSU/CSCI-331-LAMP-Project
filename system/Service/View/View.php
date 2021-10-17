<?php

namespace Lamp\Service\View;

class View
{
    
    public function __construct($path)
    {
        $this->path = $path;
    }
    
    
    public function render(array $vars = array())
    {
        $path = $this->getPath();
        // parse the current view
        $output = $this->parse($path, $vars);
        
        return $output;
    }
    
    protected function parse($path, $vars)
    {
        extract($vars);
        
        ob_start();
        
        include($path);
        
        $buffer = ob_get_contents();
        
        ob_end_clean();
        
        return $buffer;
    }
    
    
    protected function getPath()
    {
        $path = SYSPATH . 'View';
        return $path . '/' . $this->path . '.php';
    }
    
}