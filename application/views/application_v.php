<div id="#select-room-wrapper">
	<div>
		<div><h2>Select seats from below</h2></div>
		<button id="applyBtn" class="button" onClick="doApply()" 
			action_url="<?=site_url('/application/make_newHandler/'.$mid.'/'.$gid)?>"
			redirect_url="<?=site_url('/')?>">Apply</button>
	</div>
		
	<?php foreach ($roomArray as $room): ?>
		<div class="room ui-widget-content" style="position: relative;">
  			<h3 class="ui-widget-header"><?=$room['room_name']?></h3>
  			<?php foreach ($room['seats'] as $seat): ?>
  				<div class="seat ui-widget-content" style="position: absolute; top:<?=$seat->seat_location_y?>px; left:<?=$seat->seat_location_x?>px;" sid=<?=$seat->id?>><span>seat</span></div>
  			<?php endforeach;?>
		</div>
	<?php endforeach;?>
	
</div>
