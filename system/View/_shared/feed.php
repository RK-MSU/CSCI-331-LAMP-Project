<div class="card">
  <ul class="list-group list-group-flush">
  	<?php foreach($messages as $m): ?>
    <li class="list-group-item">
    	<h5><?=$m['auth']?> sent to <?=$m['recip']?></h5>
    	<span class="text-muted"><?php echo date("m/d/Y - h:i a", $m['time']);?></span>
    	<p><?=$m['message']?></p>
    </li>
    <?php endforeach; ?>
  </ul>
</div>