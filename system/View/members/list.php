<div class="card">
	<ul class="list-group list-group-flush friends-list">
		<?php foreach($members as $member):
		
		$username = $member['username'];
		$member_id = $member['member_id'];
		$name = trim($member['first_name'] . ' ' . $member['last_name']);
		$num_friends = $member['num_friends'];
		
		$profile_url = $base_url . 'index.php/members/view/' . $username;
		
		$profile_pic = '<i class="fas fa-user-circle fa-4x"></i>';
		if (isset($username) && file_exists(lamp()->config->item('base_path') . "userpics/${username}.jpg")) {
		    $user_pic = lamp()->config->item('base_url') . "userpics/${username}.jpg";
		    $profile_pic = "<img class='rounded-circle align-self-start' style='object-fit: cover;' src='$user_pic' alt='${username} profile picture' width='64' height='64'>";
		}
		
		
		if(!isset($parent_member_id)) {
		    $parent_member_id = lamp()->config->item('member_id');
		}
		
		$follow_status = false;
		
		$follow_result = lamp()->db->query("SELECT * FROM friends WHERE member_id=$parent_member_id AND friend_id=$member_id");
		if($follow_result->num_rows > 0) {
		    $follow_status = true;
		}
		
		$hide_follow_option = false;
		
		if($parent_member_id == $member_id) {
		    $hide_follow_option = true;
		}
		
		?>
		
		<li class="list-group-item list-group-item-action d-flex justify-content-between" data-link-href="<?=$profile_url?>">
			<div class="d-flex flex-column flex-lg-row justify-content-start">
				<div class="me-lg-3 align-self-lg-center align-self-start">
				<?=$profile_pic?>				
				</div>
				<div class="d-flex flex-column mt-lg-3">
					<h4><?=$name?></h4>
					<span class="font-monospace text-muted">@<?=$username?></span>
					<span class="text-muted"><?=$num_friends?> friends</span>
				</div>
			</div>
			<?php if(!$hide_follow_option): ?>
			<div class="follow-members-btns">
				<a class="btn btn-primary shadow-sm<?php if($follow_status) echo " visually-hidden"; ?> follow-member-link follow" href="<?php echo $base_url . 'index.php/members/follow/' . $username; ?>">Follow</a>
				<a class="btn btn-secondary shadow-sm<?php if(!$follow_status) echo " visually-hidden"; ?> follow-member-link un-follow" href="<?php echo $base_url . 'index.php/members/un_follow/' . $username; ?>">Un-Follow</a>
			</div>
			<?php endif; ?>
		</li>
		
		<?php endforeach; ?>
		
	</ul>
</div>