<div class="mb-3">
	<?php if(isset($settings['title']) && !empty($settings['title'])):?>
	<label class="form-label"><?=$settings['title']?></label>
	<?php endif; ?>
	<?php
	foreach($settings['fields'] as $field_name =>  $field_data) {
	    $field_vars = array_merge($field_data, ['name' => $field_name]);
	    echo lamp('View', '_shared/form/field')->render($field_vars);
	}
	?>
</div>
