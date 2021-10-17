<form method="post" action="<?=$form_action?>"  enctype='multipart/form-data'>
	<div class="card">
		<div class="card-body">
			<div class="d-flex flex-column">
				<div class="mb-3">
                  	<label for="profilePic" class="form-label">Profile Picture</label>
                  	<input class="form-control" type="file" id="profilePic" name="image" size='14'>
                </div>
				<div class="d-flex flex-column flex-lg-row">
					<div class="mb-3 flex-fill">
						<label for="firstName" class="form-label">First Name</label> <input
							type="text" class="form-control" id="firstName" name="first_name"
							value="<?=$first_name?>" autocomplete="off">
					</div>
					<div class="mb-3 ms-lg-3 flex-fill">
						<label for="lastName" class="form-label">Last Name</label> <input
							type="text" class="form-control" id="lastName" name="last_name"
							value="<?=$last_name?>" autocomplete="off">
					</div>
				</div>
				<div class="mb-3 flex-fill">
					<label for="profileBio" class="form-label">Bio</label>
					<textarea class="form-control" id="profileBio" name="bio" rows="10"><?=$bio?></textarea>
				</div>
			</div>
		</div>
		<div class="card-footer">
			<input type="submit" value="Save Profile" name="save" class="btn btn-primary">
		</div>
	</div>
</form>