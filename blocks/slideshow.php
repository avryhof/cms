<?
	$slides = $db->query("SELECT * FROM `slides` ORDER BY `order`");
?>
<div class="slideshow cycle-slideshow" 
  data-cycle-fx="fade"
  data-cycle-timeout="5000"
  data-cycle-speed="200"
  data-cycle-pause-on-hover="true"
  data-cycle-center-horz=true
  data-cycle-center-vert=true
  >
  <? while($slide = $slides->fetch_assoc()) { ?>
    <img src="<?= $slide['src']; ?>" alt="<?= $slide['alt']; ?>" class="<?= ($slide['orientation'] == 0 ? 'portrait' : 'landscape'); ?>">
  <? } ?>
</div>