<div id="group-allocator-wrapper" class="container">
	<h2>Allocation result</span></h2>
	
	<?php foreach ($roomArray as $seats): ?>
		<div class="room ui-widget-content" style="position: relative;">
  			<h3 class="ui-widget-header">Room</h3>
  			<?php foreach ($seats as $seat): ?>
  				<div class="seat ui-widget-content" style="position: absolute; top:<?=$seat->seat_location_y?>px; left:<?=$seat->seat_location_x?>px;" sid=<?=$seat->id?>><span>seat</span></div>
  			<?php endforeach;?>
		</div>
	<?php endforeach;?>
</div>
