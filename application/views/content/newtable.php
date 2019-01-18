<div class="panel">
  <header class="panel-heading">
    <?php if($title!=""): ?>
    <div class="ribbon ribbon-clip ribbon-primary">
    	<span class="ribbon-inner"><?php echo $title; ?></span>
    </div>
    <div>&nbsp;</div>
    <div>&nbsp;</div>
    <?php endif; ?>
  </header>
  <div class="panel-body">
  	<?php echo $content; ?>
  </div>
</div>
    