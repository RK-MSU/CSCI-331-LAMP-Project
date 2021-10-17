<?php

$item_id = null;

if(isset($id) && !empty($id)) {
    $item_id = $id;
} else {
    $item_id .= $nav_id . '-item-' . $item_index;
}

$nav_item_class = 'nav-item';
$nav_link_class = "nav-link";
$nav_link_href = '#';
$nav_link_attrs = '';

if(isset($dropdown) && $dropdown) {
    $nav_item_class .= ' dropdown';
    $nav_link_class .= ' dropdown-toggle';
    
    $nav_link_attrs = 'role="button" data-bs-toggle="dropdown" aria-expanded="false"';
    
} elseif (isset($url) && !empty($url)) {
    $nav_link_href = "${base_url}index.php/${url}";
}

if(isset($active) && $active) {
    $nav_link_class .= ' active';
}


?>
<li class="<?=$nav_item_class?>">
	<a id="<?=$item_id?>" class="<?=$nav_link_class?>" href="<?=$nav_link_href?>"<?php if(isset($active) && $active) echo ' aria-current="page"';?><?php if(isset($nav_link_attrs) && !empty($nav_link_attrs)) echo ' '.$nav_link_attrs;?>><?php echo $text?></a>
	<?php 
	if(isset($dropdown) && $dropdown && isset($children) && !empty($children)):
	?>
	<ul class="dropdown-menu" aria-labelledby="<?=$item_id?>">
		<?php foreach($children as $child_item): ?>
		<li>
			<?php if($child_item == 'divider'): ?>
			<hr class="dropdown-divider">
			<?php else: ?>
			<a class="dropdown-item" href="<?php echo $base_url.'index.php/' . $child_item['url']; ?>"><?php echo $child_item['text']; ?></a>
			<?php endif;?>
		</li>
		<?php endforeach;?>
	</ul>
	<?php endif; ?>
</li>
