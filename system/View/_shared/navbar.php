<nav <?php if(isset($id) && !empty($id)) echo "id='$id' "?>class="navbar<?php echo " " . $navbar['class']; ?>">
	<div class="container">
    	<?php if(isset($navbar['brand_text']) || isset($navbar['brand_img'])): ?>
    	<a class="navbar-brand" href="<?php echo $base_url . 'index.php'?>">
    		<?php 
    		if(isset($navbar['brand_img']) && !empty($navbar['brand_img'])) echo "<img src='${navbar['brand_img']}' class='pe-1' alt='' height='24'>";
    		if(isset($navbar['brand_text'])) echo $navbar['brand_text'];
    		?>
    	</a>
    	<?php
    	if (isset($navbar['navs']) && !empty($navbar['navs'])) {
    	    foreach($navbar['navs'] as $i => $nav) {
    	        $nav_vars = array_merge(['base_url' => $base_url], $nav);
    	        if(isset($id) && !empty($id)) {
    	            $nav_vars['navbar_id'] = $id;
    	        }
    	        echo lamp('View', '_shared/navbar/nav')->render($nav_vars);
    	    }
    	}
    	?>
    	<?php endif; ?>
	</div>
</nav>