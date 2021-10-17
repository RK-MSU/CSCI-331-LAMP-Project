<?php 
$navbar_nav_class = "navbar-nav";

if(isset($class) && !empty($class)) {
    $class = trim($class);
    $navbar_nav_class .= " ${class}";
}

if(isset($id) && !empty($id)) {
    $navbar_nav_id = $id;
} else {
    if(isset($navbar_id) && !empty($navbar_id)) {
        $navbar_nav_id = $navbar_id;
    } else {
        $navbar_nav_id = 'navbar-nav';
    }
    $navbar_nav_id .= '-' . rand();
}

?>
<ul id="<?=$navbar_nav_id?>" class="<?=$navbar_nav_class?>">
<?php
foreach($items as $i => $item) {
    $item_vars = array_merge($item, [
        'base_url' => $base_url,
//         'nav_index' => $nav_index,
        'nav_id' => $navbar_nav_id,
        'item_index' => $i
    ]);
    
    echo lamp('View', '_shared/navbar/nav-item')->render($item_vars);
}
?>
</ul>