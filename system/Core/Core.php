<?php

namespace Lamp\Core;


class Core {

    protected $loaded = array();
    
    public function __get($name)
    {
        return $this->get($name);
    }
    
    
    public function __isset($name)
    {
        return $this->has($name);
    }
    
    
    public function __set($name, $value)
    {
        // here only for the duration of the dev preview:
        $this->set($name, $value);
        // TODO throw this exception for release.
        // trigger_error("Setting values on ee()-> is no longer supported. Tried to set {$name}.", E_USER_DEPRECATED);
        //throw new RuntimeException("Cannot set variables on the super object. Tried to set {$name}.");
    }
    
    
//     public function __call($method, $args)
//     {
//         if ($this->in_scope && $this->has('load')) {
//             $callback = array($this->get('load'), $method);
            
//             if (is_callable($callback)) {
//                 return call_user_func_array($callback, $args);
//             }
//         } elseif ($this->has('__legacy_controller')) {
//             $obj = $this->get('__legacy_controller');
            
//             if ($this->has('_mcp_reference')) {
//                 $obj = $this->get('_mcp_reference');
//             }
            
//             return call_user_func_array(array($obj, $method), $args);
//         }
        
//         throw new \BadMethodCallException("Could not find {$method}.");
//     }
    
    
    public function has($name)
    {
        return array_key_exists($name, $this->loaded);
    }
    
    public function set($name, $object)
    {
        if ($this->has($name)) {
            // TODO: throw error
            die('ERROR');
            //throw new RuntimeException("Cannot overwrite {$name} on the loader.");
        }
        
        $this->loaded[$name] = $object;
    }
    
    
    public function get($name)
    {
        if ($this->has($name)) {
            return $this->loaded[$name];
        }
        
        // TODO: throw error
        // throw new InvalidArgumentException("No such property: '{$name}' on " . get_called_class());
    }
    
    
    public function remove($name)
    {
        unset($this->loaded[$name]);
    }
    
}

