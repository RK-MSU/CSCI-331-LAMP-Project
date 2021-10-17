<?php

$bio = (empty($bio)) ? "Nothing to see here..." : $bio;
$bio = nl2br($bio);

$name = $first_name . ' ' . $last_name;
$name = trim($name);

?>
<?php if(isset($edit_profile) && $edit_profile):?>
<div class="d-flex justify-content-end mb-2">
	<a class="btn btn-primary shadow-sm" href="<?php echo lamp()->config->item('base_url') . 'index.php/members/edit/' . $username; ?>">Edit Profile</a>
</div>
<?php endif; ?>
<?php if(isset($follow_options) && $follow_options):?>
<div class="d-flex justify-content-end mb-2 follow-members-btns">
	<a class="btn btn-primary shadow-sm<?php if($follow_status) echo " visually-hidden"; ?> follow-member-link follow" href="<?php echo lamp()->config->item('base_url') . 'index.php/members/follow/' . $username; ?>">Follow</a>
	<a class="btn btn-secondary shadow-sm<?php if(!$follow_status) echo " visually-hidden"; ?> follow-member-link un-follow" href="<?php echo lamp()->config->item('base_url') . 'index.php/members/un_follow/' . $username; ?>">Un-Follow</a>
</div>
<?php endif; ?>
<div class="card shadow-sm">
    <div class="card-body">
        <div class="d-flex flex-row">
            <?php echo $profile_pic; ?>
            <div class="ms-3 d-flex flex-column">
            	<h5><?=$name?></h5>
            	<span class="font-monospace text-muted mb-3">@<?=$username?></span>
            	<h5>Bio</h5>
            	<p><?=$bio?></p>
            </div>
        </div>
        <div class="d-flex flex-row">
        	<div class="align-self-start me-2">
    			<h5>Friends</h5>
    			<div class="list-group">
            	<?php
    
                foreach ($friends as $friend) :
                $fr_name = $friend['first_name'] . ' ' . $friend['last_name'];
                $fr_link = $base_url . 'index.php/members/view/' . $friend['username'];
                
                $fr_profile_pic = '<i class="fas fa-user-circle me-1"></i>';
                if (isset($friend['username']) && file_exists(lamp()->config->item('base_path') . "userpics/${friend['username']}.jpg")) {
                    $user_pic = lamp()->config->item('base_url') . "userpics/${friend['username']}.jpg";
                    $fr_profile_pic = "<img class='rounded-circle align-self-start me-1' src='$user_pic' alt='${friend['username']} profile picture' height=\"16\" width='16'>";
                }
                ?>
            	<a href="<?=$fr_link?>"
    					class="list-group-item list-group-item-action text-nowrap"
    					aria-current="true">
        			<?=$fr_profile_pic?><?=$fr_name?>
      			</a>
            	<?php endforeach; ?>
            	<li class="list-group-item text-nowrap">
            		<a href="<?php echo $base_url . 'index.php/members/friends/' . $username; ?>">View All Friends</a>
            	</li>
            	</div>
			</div>
			<div class="flex-fill ms-4">
				<h5>Messages</h5>
				<?php 
				$messages = lamp()->db->query("SELECT * FROM messages WHERE pm='y'")->fetch_all(MYSQLI_ASSOC);
				?>
				<div class="card">
  <ul class="list-group list-group-flush">
  	<?php
  	$empty_messages = true;
  	foreach($messages as $m):
  	
  	if($m['auth'] != $username && $m['recip'] != $username) {
  	    continue;
  	}
  	$empty_messages = false;
  	
  	?>
    <li class="list-group-item">
    	<h5><?=$m['auth']?> sent to <?=$m['recip']?></h5>
    	<span class="text-muted"><?php echo date("m/d/Y - h:i a", $m['time']);?></span>
    	<p><?=$m['message']?></p>
    </li>
    <?php endforeach; ?>
    <?php if($empty_messages): ?>
    <li class="list-group-item">
    	No Messages
    </li>
    <?php endif; ?>
  </ul>
</div>
			</div>
        
        </div>
    </div>
</div>