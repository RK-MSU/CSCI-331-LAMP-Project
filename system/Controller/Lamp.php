<?php
namespace Lamp\Controller;

class Lamp
{

    public function index()
    {
        lamp()->output->setPageTitle('Home');
        lamp()->output->setPageHeader('CS-Socail: Home');
        $vars = [];
        return lamp('View', 'home/home')->render($vars);
    }

    public function login()
    {
        lamp()->output->setPageTitle('Login');
        lamp()->output->addBreadcrumb('home/login', 'Login');
        
        $username = null;
        $password = null;
        
        $vars = [
            'action' => 'home/login',
            'buttons' => [
                [
                    'text' => 'Login'
                ]
            ],
            'errors' => []
        ];
        

        if (REQ == 'POST') {

            $username = lamp()->input->post('username', true);
            $password = lamp()->input->post('password', true);

            if (empty($username) || empty($password)) {
                array_push($vars['errors'], "Not all fields were entered");
            } else {
                $query_str = "SELECT member_id, username FROM members WHERE username='$username' AND password='$password'";
                $result = lamp()->db->query($query_str);
                if ($result->num_rows == 0) {
                    array_push($vars['errors'], "Invalid login attempt");
                } else {
                    
                    $db_data = $result->fetch_all(MYSQLI_ASSOC)[0];
                    
                    $_SESSION['username'] = $db_data['username'];
                    $_SESSION['member_id'] = $db_data['member_id'];
                    
                    lamp()->functions->redirect("index.php/members/view/" . $username);
                }
            }
        }
        
        
        $vars['sections'] = [
            [
                [
                    'title' => 'Username',
                    'fields' => [
                        'username' => [
                            'type' => 'text',
                            'value' => $username,
                            'required' => true,
                        ]
                    ]
                ],
                [
                    'title' => 'Password',
                    'fields' => [
                        'password' => [
                            'type' => 'password',
                            'value' => $password,
                            'required' => true
                        ]
                    ]
                ]
            ]
        ];

        $login_form = lamp('View', '_shared/form')->render($vars);

        return lamp('View', 'home/login')->render([
            'login_form' => $login_form,
            'signup_url' => lamp()->config->item('base_url').'index.php/home/signup',
        ]);
    }

    public function signup()
    {
        
        lamp()->output->setPageTitle('SignUp');
        lamp()->output->addBreadcrumb('home/signup', 'SignUp');
        
        $username = null;
        $password = null;
        $first_name = null;
        $last_name = null;
        
        $errors = [];
        
        $form_vars = [
            'action' => 'home/signup',
            'errors' => $errors,
            'buttons' => [
                [
                    'text' => 'Register'
                ]
            ]
        ];
        
        
        
        if(REQ == 'POST') {
            
            $username   = trim(lamp()->input->post('username', true));
            $password   = trim(lamp()->input->post('password', true));
            $first_name = trim(lamp()->input->post('first_name', true));
            $last_name  = trim(lamp()->input->post('last_name', true));
            
            
            // errors: check for empty values
            if(empty($username) || empty($password) || empty($first_name) || empty($last_name)) {
                $errors[] = "You must complete all fields.";
            }
            
            // errors: check for unique username
            $existing_id = lamp()->functions->getMemberId($username);
            if(! is_null($existing_id)) {
                $errors[] = "Username is already taken.";
            }
            
            
            // no error?
            if(empty($errors)) { // create new member and profile data
                
                lamp()->db->query("INSERT INTO members (username, password) VALUES ('$username', '$password')");
                
                $last_id = lamp()->db->getLastInsertId();
                lamp()->db->query("INSERT INTO profiles (member_id,first_name,last_name) VALUES ('$last_id','$first_name','$last_name')");
                
                $_SESSION['username']   = $username;
                $_SESSION['member_id']  = $last_id;
                
                lamp()->functions->redirect("index.php/members/view/" . $username);
            }
        }
        
        
        
        $form_vars['sections'] = [
            [
                [
                    'title' => 'Username',
                    'fields' => [
                        'username' => [
                            'type' => 'text',
                            'required' => true,
                            'value' => $username,
                            'attrs' => [
                                'autocomplete' => 'off'
                            ]
                        ]
                    ]
                ],
                [
                    'title' => 'Password',
                    'fields' => [
                        'password' => [
                            'type' => 'password',
                            'required' => true,
                            'value' => $password,
                            'attrs' => [
                                'autocomplete' => 'new-password'
                            ]
                        ]
                    ]
                ],
                [
                    'title' => 'First Name',
                    'fields' => [
                        'first_name' => [
                            'type' => 'text',
                            'required' => true,
                            'value' => $first_name,
                            'attrs' => [
                                'autocomplete' => 'new-password'
                            ]
                        ]
                    ]
                ],
                [
                    'title' => 'Last Name',
                    'fields' => [
                        'last_name' => [
                            'type' => 'text',
                            'value' => $last_name,
                            'required' => true,
                            'attrs' => [
                                'autocomplete' => 'new-password'
                            ]
                        ]
                    ]
                ]
            ]
        ];
        
        
        $signup_form = lamp('View', '_shared/form')->render($form_vars);
        
        return lamp('View', 'home/signup')->render([
            'signup_form' => $signup_form,
            'login_url' => lamp()->config->item('base_url').'index.php/home/login',
        ]);
    }
    
    public function logout()
    {
        lamp()->functions->destroySession();
        lamp()->functions->redirect("index.php/home");
    }
}