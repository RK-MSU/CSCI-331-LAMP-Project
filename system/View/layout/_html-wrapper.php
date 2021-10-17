<?php 

$title = $site_name;

if(isset($page_title) && !empty($page_title)) {
    $title = $page_title . ' - ' . $site_name;
}

?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <title><?=$title?></title>
        <link rel="icon" type="image/png" href="<?=$favicon?>">
        <!-- CSS -->
        <!-- bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Arsenal|Lora|Muli|Source+Sans+Pro|Playfair+Display&display=swap" rel="stylesheet">
        <link rel='stylesheet' href='<?php echo $base_url . 'assets/fontawesome/css/all.min.css'?>'>
        <link rel='stylesheet' href='<?php echo $base_url . 'assets/style/main.css'?>'>
        <?=$head_end?>
    </head>
	<body class="bg-light">
		<header>
			<?php echo lamp('View', '_shared/navbar')->render([
			    'base_url' => $base_url,
			    'site_name' => $site_name,
			    'navbar' => $header_navbar
			]);?>
		</header>
        <div id="content" class="container">
        
        	<section class="d-flex flex-column">
        		<?php if(isset($page_header) && !empty($page_header)):?>
        		<div>
                	<h1 id="pageHeader"><?=$page_header?></h1>
        		</div>
        		<?php endif; ?>
        		<?php if(isset($breadcrumbs) && !empty($breadcrumbs) && sizeof($breadcrumbs) > 1):?>
        		<div class="flex-fill">
                	<nav aria-label="breadcrumb">
                		<ol class="breadcrumb py-2 ps-4 bg-white shadow-sm rounded-pill border border-light">
                		<?php foreach($breadcrumbs as $crumb_url_path => $crumb_text):
                		$crumb_url = $base_url.'index.php/' . $crumb_url_path;
                		$is_active_crumb = (array_key_last($breadcrumbs) == $crumb_url_path) ? true : false;
                		$crumb_data = ($is_active_crumb) ? $crumb_text : "<a class=\"text-decoration-none\" href=\"$crumb_url\">$crumb_text</a>";
                		
                		?>
                        <li class="breadcrumb-item<?php if($is_active_crumb) echo ' active';?>"<?php if($is_active_crumb) echo ' aria-current="page"';?>>
                        	<?=$crumb_data?>
                        </li>
                        <?php endforeach; ?>
                      </ol>
                    </nav>
        		</div>
        		<?php endif; ?>
        	</section>
        	<section>
        	<?=$html_content?>
        	</section>
        </div>
        <?php 
        echo lamp('View', '_shared/toast')->render();
        ?>
        <script type="text/javascript">
        const BASE_URL = "<?=$base_url?>";
        const FAVICON_URL = "<?=$favicon?>";
        const SITE_NAME = "<?=$site_name?>";
        </script>
        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <!-- Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
        <!-- AngularJS -->
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
        <script src="<?php echo $base_url . 'assets/fontawesome/js/all.min.js'?>"></script>
        <script src="<?php echo $base_url . 'assets/js/main.js'?>"></script>
		<?=$footer_end?>
	</body>
</html>