<?php
namespace Lamp\Controller;

class Feed
{

    public function index()
    {
        lamp()->output->setPageTitle('Feed');
        $vars = [];
        
        lamp()->output->setBreadcrumbs([
            'home' => lamp()->config->item('site_name') . ': Home',
            'feed' => 'Feed',
        ]);
        
        $vars['messages'] = lamp()->db->query("SELECT * FROM messages WHERE pm='n'")->fetch_all(MYSQLI_ASSOC);
        
        return lamp('View', '_shared/feed')->render($vars);
    }
}