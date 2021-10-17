<?php

namespace Lamp\Controller;

class Messages
{
    
    public function __construct()
    {
        lamp()->output->setPageTitle('Messages');
    }
    
    
    public function index()
    {
        $vars = [
            'base_url' => lamp()->config->item('base_url')
        ];
        
        
        
        global $config;
        
        $username = $config['username'];
        
        lamp()->output->setBreadcrumbs([
            'home' => lamp()->config->item('site_name') . ': Home',
            'members' => 'Members',
            'members/view/' . $username => 'Profile: ' . $username,
            'messages' => 'Messages'
        ]);
        
        $vars['recipients'] = lamp()->db->query("SELECT username,first_name,last_name FROM members JOIN profiles ON members.member_id=profiles.member_id WHERE members.username!='$username' ORDER BY profiles.first_name")->fetch_all(MYSQLI_ASSOC);
        $vars['messages'] = lamp()->db->query("SELECT * FROM messages WHERE recip='$username' OR auth='$username'")->fetch_all(MYSQLI_ASSOC);
        
        return lamp('View', '_shared/messages')->render($vars);
    }
    
    
    public function send()
    {
        
        $recip = lamp()->input->post('recip', true);
        $pm = lamp()->input->post('pm', true);
        $message = lamp()->input->post('message', true);
        $auth = lamp()->config->item('username');
        $time = time();
        
        if($pm != 'y') {
            $pm = 'n';
        }
        
        lamp()->db->query("INSERT INTO messages (auth,recip,pm,message,time) VALUES ('$auth','$recip','$pm','$message',$time)");
        
        lamp()->functions->redirect("index.php/messages");
        
    }
}