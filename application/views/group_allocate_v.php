<div id="group-allocator-wrapper" class="container">
	<h2>Allocation result</span></h2>
	<a href="<?=site_url('/')?>" class="btn btn-info">Go back to the dashboard</a>
	<?php foreach ($roomArray as $room): ?>
		<div class="room ui-widget-content" style="position: relative;">
  			<h3 class="ui-widget-header"><?=$room['room_name']?></h3>
  			<?php foreach ($room['seats'] as $seat): ?>
  				<div class="seat ui-widget-content" style="position: absolute; top:<?=$seat->seat_location_y?>px; left:<?=$seat->seat_location_x?>px;" sid=<?=$seat->id?>><span><?=$seat->seat_owner_name?></span></div>
  			<?php endforeach;?>
		</div>
	<?php endforeach;?>	
</div>