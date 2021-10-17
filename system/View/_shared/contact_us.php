<div class="card">
	<div class="card-body">
		<?php 
		  
		if(REQ == 'POST'):
		?>
		
		<div class="alert alert-primary" role="alert">
		
		Thank you for contacting us
		</div>
		
		<?php endif; ?>
	
		<form method="post" action="<?php echo lamp()->config->item('base_url') . 'index.php/contact'; ?>">
			<div class="mb-3">
				<label class="form-label">Name</label>
				<input type="text" class="form-control" name="name">
			</div>
			<div class="mb-3">
				<label class="form-label">Email</label>
				<input type="text" class="form-control" name="email">
			</div>
			<div class="mb-3">
				<label class="form-label">Message</label>
				<textarea rows="5" name="message" class="form-control"></textarea>
			</div>
			<button type="submit" class="btn btn-primary">Send</button>
		</form>
	</div>
</div>