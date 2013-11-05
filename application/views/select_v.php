<div id="#select-room-wrapper">
	<div id="roomCanvas" class="ui-widget-content" style="position: relative;">
  		<h3 class="ui-widget-header">Room</h3>
  		
  		<?php
  		
  		foreach ($seats as $seat) {
  			echo "<div class=\"seat ui-widget-content\" style=\"position: absolute; top:";
			echo $seat->seat_location_y;
			echo "px; left:";
			echo $seat->seat_location_x;
			echo "px; \"><span>seat</span></div>";
		}
  		
  		?>
  		
	</div>
</div>
