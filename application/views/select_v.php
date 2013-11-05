<div id="#select-room-wrapper">
	<div id="roomCanvas" class="ui-widget-content" style="position: relative;">
  		<h3 class="ui-widget-header">Room</h3>
  		<?php foreach ($seats as $seat): ?>
  			<div class="seat ui-widget-content" style="position: absolute; top:<?=$seat->seat_location_y?>px; left:<?=$seat->seat_location_x?>px;"><span>seat</span></div>
  		<?php endforeach;?>
	</div>
	<button>Select</button>
</div>
