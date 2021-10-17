<?php


namespace Lamp\Core;


class Autoloader
{
    
    private $class_dict = [
        'View' => 'Lamp\Service\View\View',
        'Security/XSS' => 'Lamp\Library\Security\XSS'
    ];
    
    
    public function make()
    {
        $class = $this->class_dict[func_get_arg(0)];
        $obj = new $class(func_get_arg(1));
        return $obj;
    }
}