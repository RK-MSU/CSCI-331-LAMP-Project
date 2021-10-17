<?php

namespace Lamp\Core;

class App extends Core
{
       
    public function boot()
    {
        $this->set('config', new \Lamp\Library\Config());
        $this->set('di', new \Lamp\Core\Autoloader());
        $this->set('db', new \Lamp\Library\Database());
        $this->set('functions', new \Lamp\Library\Functions());
        $this->set('input', new \Lamp\Core\Input());
        $this->set('xss', new \Lamp\Library\Security\XSS());
        $this->set('output', new \Lamp\Library\Output());
        $this->set('TMPL', new \Lamp\Library\Template());
    }
    
    public function run(Request $request)
    {

        lamp()->set('req', $request);

        $mcp = $request->path_segment(1);
        $mcp = (is_null($mcp)) ? 'home' : $mcp;
        $mcp = ($mcp == 'home') ? 'lamp' : $mcp;
        $mcp = ucfirst(strtolower($mcp));
        $mcp = "Lamp\Controller\\$mcp";

        $mcp_method = $request->path_segment(2);
        $mcp_method = (is_null($mcp_method)) ? 'index' : $mcp_method;
        $mcp_method = strtolower($mcp_method);
        $mcp_method = str_replace('-', '_', $mcp_method);
        
        
        
        $param_arr = $request->path_segments();
        $param_arr_len = sizeof($param_arr);
        if($param_arr_len > 1) {
            $mcp_param = array_splice($param_arr, 2);
        } else {
            $mcp_param = [];
        }
        
        $mcp_class = new $mcp;
        
        if(method_exists($mcp_class, $mcp_method)) {
            $mcp_callback = [$mcp_class, $mcp_method];
        } else {
            die("Invalid Controller Request: " . $mcp . "::" . $mcp_method . "()");
        }
        
        $output = call_user_func_array($mcp_callback, $mcp_param);
        
        lamp()->output->setBodyHTML($output);
        
        lamp()->output->appendToHead('');
        
        $response = new Response();
        
        return $response;
    }
    
}

// EOF
