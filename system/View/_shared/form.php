<?php 
$base_url = lamp()->config->item('base_url') . 'index.php/';

$method = (isset($method) && in_array($method, ['post_get'])) ? $method : 'post';
$form_action = "${base_url}${action}";

?>
<form <?php if(isset($form_id) && !empty($form_id)) echo "id='${$form_id}' "; ?><?php if(isset($form_name) && !empty($form_name)) echo "name='${$form_name}' "; ?>method="<?=$method?>" action="<?=$form_action?>">

<?php if(isset($errors) && !empty($errors)):?>

<div class="alert alert-danger mb-0" role="alert">
<ul>
<?php foreach($errors as $error):?>
	<li><?=$error?></li>
<?php endforeach; ?>

</ul>
</div>
<?php endif; ?>
<?php

foreach($sections as $section_name => $section) {
    
    $sec_vars = [
        'name' => $section_name,
        'settings' => $section
    ];
    
    echo lamp('View', '_shared/form/section')->render($sec_vars);
}
?>
<?php if(isset($buttons) && !empty($buttons)):?>
<?php foreach($buttons as $btn): 
$btn_type = (isset($btn['type'])) ? $btn['type'] : 'submit';
$btn_style = (isset($btn['style'])) ? $btn['style'] : 'primary';
$btn_class = "btn btn-${btn_style}";
$btn_text = (isset($btn['text'])) ? $btn['text'] : 'Submit';
?>
<button type="<?=$btn_type?>" class="<?=$btn_class?>"><?=$btn_text?></button>
<?php endforeach; ?>
<?php else: ?>
<button type="submit" class="btn btn-primary">Submit</button>
<?php endif; ?>
</form>
