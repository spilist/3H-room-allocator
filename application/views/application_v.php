<div id="#select-room-wrapper" class="container">
	<div>
		<div><h2>Select seats from below</h2></div>
		<button disabled id="applyBtn" class="btn btn-primary" onClick="doApply()" 
			action_url="<?=site_url('/application/make_newHandler/'.$mid.'/'.$gid)?>"
			redirect_url="<?=site_url('/')?>">Apply</button>
		<a href="<?=site_url(array('application','cancel',$mid,$gid))?>" class="btn btn-danger">Cancel this request</a>
		<a href="<?=site_url('/')?>" class="btn btn-info">Go back to the dashboard</a>
	</div>
		
	<?php foreach ($roomArray as $room): ?>
		<div class="room ui-widget-content" style="position: relative;">
  			<h3 class="ui-widget-header"><?=$room['room_name']?></h3>
  			<?php foreach ($room['seats'] as $seat): ?>
  				<div class="seat ui-widget-content" style="position: absolute; top:<?=$seat['loc_y']?>px; left:<?=$seat['loc_x']?>px;" sid=<?=$seat['sid']?> prio=<?=$seat['priority']?>>
  					<span>seat</span>
  				</div>
  			<?php endforeach;?>
		</div>
	<?php endforeach;?>		
</div>