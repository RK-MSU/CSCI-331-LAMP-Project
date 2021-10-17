<?php

$navbar_brand = <<<_TMPL
<a class="navbar-brand" href="${base_url}index.php">
    <img src="${base_url}favicon.png" alt="" height="24"> ${site_name}
</a>
_TMPL;

if (lamp()->config->item('logged_in')): 

    $username = lamp()->config->item('username');
    
    $nav_items = [
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
    ];

    $seg_1 = lamp()->req->path_segment(1);
    $seg_2 = lamp()->req->path_segment(2);
    $seg_3 = lamp()->req->path_segment(3);

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
    }

?>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow mb-2">
	<div class="container">
		<?=$navbar_brand?>
		<?php echo lamp('View', '_shared/navbar/navbar-nav')->render([
		    'class' => 'me-auto mb-2 mb-lg-0',
		    'nav_items' => $nav_items,
		]); ?>
		<ul class="navbar-nav ms-auto mb-2 mb-lg-0">
			<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle"
				href="#" id="navbarDropdown" role="button"
				data-bs-toggle="dropdown" aria-expanded="false"> Logged in as: <?=$user?></a>
				<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
					<li><a class="dropdown-item" href="<?php echo $base_url.'index.php/members/edit/' . $user; ?>">Edit Profile</a></li>
					<li>
						<hr class="dropdown-divider">
					</li>
					<li><a class="dropdown-item" href="<?php echo $base_url.'index.php/home/logout'; ?>">Logout</a></li>
				</ul></li>
		</ul>
	</div>
</nav>
<?php else: 
$nav_items = [
    'login' => [
        'url' => 'home/login',
        'text' => 'Login',
    ],
];

if(lamp()->req->path_segment(1) == 'home' && lamp()->req->path_segment(2) == 'login') {
    $nav_items['login']['active'] = true;
}

?>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow mb-2">
    <div class="container">
    	<?=$navbar_brand?>
    	<?php echo lamp('View', '_shared/navbar/navbar-nav')->render([
		    'class' => 'ms-auto mb-2 mb-lg-0',
		    'nav_items' => $nav_items,
		]); ?>
    </div>
</nav>
<?php endif; ?>