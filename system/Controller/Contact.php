<?php
namespace Lamp\Controller;

class Contact
{

    public function index()
    {
        lamp()->output->setPageTitle('Contact Us');
        lamp()->output->setBreadcrumbs([
            'home' => lamp()->config->item('site_name') . ': Home',
            'feed' => 'Contact Us',
        ]);
        $vars = [];
        return lamp('View', '_shared/contact_us')->render($vars);
    }
}