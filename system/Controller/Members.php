<?php

namespace Lamp\Controller;

class Members
{
    
    public function __construct()
    {
        lamp()->output->setPageTitle('Members');
    }
    
    
    public function index()
    {
        $username = lamp()->config->item('username');
        lamp()->output->setBreadcrumbs([
            'home' => lamp()->config->item('site_name') . ': Home',
            'members' => 'Members',
        ]);
        
        $vars = [
            'base_url' => lamp()->config->item('base_url')
        ];
        
        $query_str = "SELECT m.member_id, m.username, p.first_name, p.last_name, p.bio, (select count(*) from friends f where f.member_id=m.member_id) as num_friends FROM members m JOIN profiles p ON p.member_id=m.member_id ORDER BY p.first_name, m.username ASC";
        $result = lamp()->db->query($query_str);
        
        if($result->num_rows > 0) {
            $vars['members'] = $result->fetch_all(MYSQLI_ASSOC);
        }
        
        return lamp('View', 'members/list')->render($vars);
    }
    
    
    public function view($username = null)
    {
        if(is_null($username)) {
            lamp()->functions->redirect('index.php/members');
        }
        
        lamp()->output->setBreadcrumbs([
            'home' => lamp()->config->item('site_name') . ': Home',
            'members' => 'Members',
            'members/view/' . $username => 'Profile: ' . $username
        ]);
        
        lamp()->output->setPageTitle('Profile: ' . $username);
        
        $vars = [
            'base_url' => lamp()->config->item('base_url'),
        ];
        
        
        if($username == lamp()->config->item('username')) {
            lamp()->output->setPageHeader('Your Profile');
            $vars['edit_profile'] = true;
        } else {
            lamp()->output->setPageHeader($username .' Profile');
            $vars['follow_options'] = true;
            
            $active_member_id = lamp()->config->item('member_id');
            $query_str = "SELECT m.username FROM members m JOIN friends f ON f.friend_id=m.member_id WHERE f.member_id=${active_member_id} AND m.username='$username'";
            $result = lamp()->db->query($query_str);
            $vars['follow_status'] = ($result->num_rows > 0) ? true : false;
            
        }
        
        
        
        $query_str = "SELECT m.member_id, m.username, p.first_name, p.last_name, p.bio FROM members m JOIN profiles p ON p.member_id=m.member_id WHERE m.username='${username}'";
        $result = lamp()->db->query($query_str);
        
        if($result->num_rows > 0) {
            $row = $result->fetch_all(MYSQLI_ASSOC)[0];
            $vars = array_merge($vars, $row);
        }
        
        $profile_pic = '<i class="fas fa-user-circle fa-7x"></i>';
        if (isset($vars['username']) && file_exists(lamp()->config->item('base_path') . "userpics/${vars['username']}.jpg")) {
            $user_pic = lamp()->config->item('base_url') . "userpics/${vars['username']}.jpg";
            $profile_pic = "<img class='rounded-circle align-self-start' src='$user_pic' alt='${vars['username']} profile picture'>";
        }
        
        $vars['profile_pic'] = $profile_pic;
        
        
        // friends 
        $query_str = "SELECT m.username, p.first_name, p.last_name FROM friends f JOIN members m ON f.friend_id=m.member_id JOIN profiles p ON p.member_id=m.member_id WHERE f.member_id=${vars['member_id']} LIMIT 5";
        $result = lamp()->db->query($query_str);
        $vars['friends'] = [];
        
        if($result->num_rows > 0) {
            $vars['friends'] = $result->fetch_all(MYSQLI_ASSOC);
        }
        
        
        
        // messages
        
        
        
        return lamp('View', 'members/profile')->render($vars);
    }

    public function edit($username = null)
    {
        if(is_null($username)) {
            return "Invalid request";
        }
        
        if(lamp()->config->item('username') != $username) {
            return "Cannot edit another members profile.";
        }
        
        lamp()->output->setPageTitle('Edit Profile: ' . $username);
        
        lamp()->output->setBreadcrumbs([
            'home' => lamp()->config->item('site_name') . ': Home',
            'members' => 'Members',
            'members/view/' . $username => $username,
            'home/members/edit/' . $username => 'Edit Profile',
        ]);
        
        $member_id = lamp()->config->item('member_id');
        
        if (REQ == 'POST') {
            
            
            $first_name = lamp()->input->post('first_name', true);
            $last_name  = lamp()->input->post('last_name', true);
            $bio        = lamp()->input->post('bio', true);
            
            
            
            $query_str = "SELECT p.first_name, p.last_name, p.bio FROM profiles p WHERE p.member_id=${member_id} LIMIT 1";
            $result = lamp()->db->query($query_str);
            if($result->num_rows == 0) {
                $query_str = "INSERT INTO profiles (member_id,first_name,last_name,bio) VALUES (${member_id}, '${first_name}', '${last_name}', '${bio}')";
                lamp()->db->query($query_str);
            } else {
                $query_str = "UPDATE profiles SET first_name='$first_name', last_name='$last_name', bio='$bio' WHERE member_id='$member_id'";
                lamp()->db->query($query_str);
            }
            
            
            if (isset($_FILES['image']['name'])) {
                $saveto = lamp()->config->item('base_path') . "userpics/$username.jpg";
                move_uploaded_file($_FILES['image']['tmp_name'], $saveto);
                $typeok = TRUE;
                
                switch($_FILES['image']['type']) {
                    case "image/gif":   $src = imagecreatefromgif($saveto); break;
                    case "image/jpeg":  // Both regular and progressive jpegs
                    case "image/pjpeg": $src = imagecreatefromjpeg($saveto); break;
                    case "image/png":   $src = imagecreatefrompng($saveto); break;
                    default:            $typeok = FALSE; break;
                }
                
                if ($typeok) {
                    list($w, $h) = getimagesize($saveto);
                    
                    $max = 100;
                    $tw  = $w;
                    $th  = $h;
                    
                    if ($w > $h && $max < $w) {
                        $th = $max / $w * $h;
                        $tw = $max;
                    }
                    elseif ($h > $w && $max < $h) {
                        $tw = $max / $h * $w;
                        $th = $max;
                    }
                    elseif ($max < $w) {
                        $tw = $th = $max;
                    }
                    
                    $tmp = imagecreatetruecolor($tw, $th);
                    imagecopyresampled($tmp, $src, 0, 0, 0, 0, $tw, $th, $w, $h);
                    imageconvolution($tmp, array(array(-1, -1, -1), array(-1, 16, -1), array(-1, -1, -1)), 8, 0);
                    imagejpeg($tmp, $saveto);
                    imagedestroy($tmp);
                    imagedestroy($src);
                }
            }
        }
        
        $query_str = "SELECT m.member_id, m.username, p.first_name, p.last_name, p.bio FROM members m JOIN profiles p ON p.member_id=m.member_id WHERE m.member_id='${member_id}'";
        $result = lamp()->db->query($query_str);
        
        $vars = [
            'form_action' => lamp()->config->item('base_url') . 'index.php/members/edit/' . $username,
        ];
        
        if($result->num_rows > 0) {
            $row = $result->fetch_all(MYSQLI_ASSOC)[0];
            $vars = array_merge($vars, $row);
        }
        
        return lamp('View', 'members/edit-profile')->render($vars);
    
    }
    
    

    public function friends($username = null)
    {
        if(is_null($username)) {
            lamp()->functions->redirect('index.php/members/friends/' . lamp()->config->item('username'));
        }
        
        lamp()->output->setBreadcrumbs([
            'home' => lamp()->config->item('site_name') . ': Home',
            'members' => 'Members',
            'members/view/' . $username => $username,
            'members/friends/' . $username => 'Friends',
        ]);
        
        lamp()->output->setPageTitle('Friends: ' . $username);
        
        $user_mbr_id = lamp()->functions->getMemberId($username);
        
        $vars = [
            'base_url' => lamp()->config->item('base_url'),
            'parent_member_id' => $user_mbr_id
        ];
        
        
        $query_str = "SELECT m.member_id, m.username, p.first_name, p.last_name, p.bio, (select count(*) from friends f where f.member_id=m.member_id) as num_friends FROM members m JOIN profiles p ON p.member_id=m.member_id JOIN friends fr ON fr.friend_id=m.member_id WHERE fr.member_id=$user_mbr_id ORDER BY p.first_name, m.username ASC";
        $result = lamp()->db->query($query_str);
        
        if($result->num_rows > 0) {
            $vars['members'] = $result->fetch_all(MYSQLI_ASSOC);
        }
        
        return lamp('View', 'members/list')->render($vars);
    }
    
    
    
    
    public function follow($username = null) {
        
        $output = [
            'status' => 'success',
            'message' => "You are now following: " . $username
        ];
        
        global $config;
        
        $member_id = $config['member_id'];
        $friend_id = lamp()->functions->getMemberId($username);
        
        $result = lamp()->db->query("SELECT * FROM friends WHERE member_id=$member_id AND friend_id=$friend_id");
        
        if($result->num_rows == 0) {
            lamp()->db->query("INSERT INTO friends (member_id,friend_id) VALUES ($member_id, $friend_id)");
        }
        
        return lamp()->output->send_ajax_response($output);
        
    }
    
    public function un_follow($username = null) {
        
        $output = [
            'status' => 'success',
            'message' => "You are not following: " . $username
        ];
        
        
        global $config;
        
        $member_id = $config['member_id'];
        $friend_id = lamp()->functions->getMemberId($username);
        
        lamp()->db->query("DELETE FROM friends WHERE member_id=$member_id AND friend_id=$friend_id");
        
        return lamp()->output->send_ajax_response($output);
        
    }
    
}