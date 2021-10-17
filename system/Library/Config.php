<?php

namespace Lamp\Library;

class Config
{
    protected $items;
    
    public function __construct()
    {
        global $config;
        $this->items = $config;
    }
    
    public function item($name)
    {
        if(isset($this->items[$name])) {
            return $this->items[$name];
        }
        
        return null;
        die("Invalid Config Item: " . $name);
    }
    
    public function items() {
        return $this->items;
    }
    
    public function update_item($name, $value)
    {
        $this->items[$name] = $value;
    }
    
}