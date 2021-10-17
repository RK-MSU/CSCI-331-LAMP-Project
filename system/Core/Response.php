<?php

namespace Lamp\Core;

class Response
{
    
    private $wrapper = 'layout/_html-wrapper';
    
    public function send()
    {
        $output = lamp()->output;
        $config = lamp()->config;
        
        $base_url = $config->item('base_url');
        $logged_in = $config->item('logged_in');
        $username = $config->item('username');
        
        $output->addBreadcrumb('home', $config->item('site_name') . ': Home');
        
        
        $seg_1 = lamp()->req->path_segment(1);
        $seg_2 = lamp()->req->path_segment(2);
        $seg_3 = lamp()->req->path_segment(3);
        
        
        $vars = [
            'base_url' => $base_url,
            'logged_in' => $logged_in,
            'username' => $username
        ];
        
        $header_navbar = [
            'id' => 'headerNavbar',
            'brand_text' => $config->item('site_name'),
            'brand_img' => $base_url . 'favicon.png',
            'class' => 'navbar-expand-lg navbar-dark bg-primary shadow mb-2'
        ];
        
        
        if($logged_in) {
            
            $nav_items = [
                'feed' => [
                    'url' => 'feed',
                    'text' => 'Feed'
                ],
                'members' => [
                    'url' => 'members',
                    'text' => 'Members'
                ],
                'profile' => [
                    'url' => 'members/view/' . $username,
                    'text' => 'Profile'
                ],
                'friends' => [
                    'url' => 'members/friends/' . $username,
                    'text' => 'Friends',
                ],
                'messages' => [
                    'url' => 'messages',
                    'text' => 'Messages',
                ],
                'contact' => [
                    'url' => 'contact',
                    'text' => 'Contact Us',
                ],
            ];
            
            if($seg_1 == 'members') {
                if(empty($seg_2)) {
                    $nav_items['members']['active'] = true;
                } elseif ($seg_2 == 'view' && $seg_3 == $username) {
                    $nav_items['profile']['active'] = true;
                } elseif ($seg_2 == 'friends') {
                    if(empty($seg_3) || $seg_3 == $username) {
                        $nav_items['friends']['active'] = true;
                    }
                }
            } elseif ($seg_1 == 'messages') {
                $nav_items['messages']['active'] = true;
            } elseif ($seg_1 == 'contact') {
                $nav_items['contact']['active'] = true;
            }
            
            $header_navbar['navs'] = [
                [
                    'class' => 'me-auto mb-2 mb-lg-0',
                    'items' => $nav_items
                ],
                [
                    'class' => 'ms-auto mb-2 mb-lg-0',
                    'items' => [
                        'user-logged-in' => [
                            'dropdown' => true,
                            'text' => 'Logged in as: ' . $username,
                            'children' => [
                                [
                                    'url' => 'members/edit/' . $username,
                                    'text' => 'Edit Profile',
                                ],
                                'divider',
                                [
                                    'url' => 'home/logout',
                                    'text' => 'Logout',
                                ],
                            ]
                        ]
                    ]
                ]
            ];
            
        } else {
            
            $nav_items = [
                'login' => [
                    'url' => 'home/login',
                    'text' => 'Login',
                ]
            ];
            
            if ($seg_1 == 'home' && $seg_2 == 'login') {
                $nav_items['login']['active'] = true;
            }
            
            $header_navbar['navs'] = [
                [
                    'class' => 'ms-auto mb-2 mb-lg-0',
                    'items' => $nav_items
                ]
            ];
        }
        
        $vars += [
            'site_name' => $config->item('site_name'),
            'base_url' => $base_url,
            'page_title' => $output->getPageTitle(),
            'favicon' => $base_url . 'favicon.png',
            'header_navbar' => $header_navbar,
            'head_end' => $output->getHeadEnd(),
            'page_header' => $output->getPageHeader(),
            'breadcrumbs' => $output->getBreadcrumbs(),
            'html_content' => $output->getBody(),
            'footer_end' => $output->getFooterEnd(),
        ];
        
        $view = lamp('View', $this->wrapper);
        
        $output = $view->render($vars);
        
        echo $output;
    }
}

// EOF
