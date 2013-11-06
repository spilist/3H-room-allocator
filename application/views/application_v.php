<div id="#select-room-wrapper">
	<div>
		<div>Group Name : TEST</div>
		<div>Select seats from below</div>
		<button class="button">Apply</button>
	</div>
		
	<?php foreach ($roomArray as $seats): ?>
		<div class="room ui-widget-content" style="position: relative;">
  			<h3 class="ui-widget-header">Room</h3>
  			<?php foreach ($seats as $seat): ?>
  				<div class="seat ui-widget-content" style="position: absolute; top:<?=$seat->seat_location_y?>px; left:<?=$seat->seat_location_x?>px;"><span>seat</span></div>
  			<?php endforeach;?>
		</div>
	<?php endforeach;?>
	
</div>
