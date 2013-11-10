<div id="#select-room-wrapper" class="container">
	<div>
		<div>
			<h2>Select seats from below: for <span class="user-name"><?=$gowner?></span>'s <span class="group-name"><?=$gname?></span></h2>
			<p class="muted max-seats" max-seats="<?=$gseats?>">You can choose at most <b><?=$gseats?></b> seats.</p>
		</div>
		<button disabled id="applyBtn" class="btn btn-primary" onClick="doApply()" 
			action_url="<?=site_url(array('application','make_newHandler',$mid,$gid,$new))?>"
			redirect_url="<?=site_url('/')?>">
<?php if ($new == 'new'):?>
			Apply
<?php else:?>
			Modify
<?php endif;?>
		</button>
		<a href="<?=site_url(array('application','cancel',$mid,$gid,$new))?>" class="btn btn-danger">Cancel this request</a>
		<a href="<?=site_url('/')?>" class="btn btn-info">Go back to the dashboard</a>
	</div>
		
	<?php foreach ($roomArray as $room): ?>
		<div class="room ui-widget-content" style="position: relative; width: <?=$room['room_width']?>px; height: <?=$room['room_height']?>px">
  			<h3 class="ui-widget-header"><?=$room['room_name']?></h3>
  			<?php foreach ($room['seats'] as $seat): ?>
  				<div class="seat ui-widget-content" style="position: absolute; top:<?=$seat['loc_y']?>px; left:<?=$seat['loc_x']?>px;" sid=<?=$seat['sid']?> prio=<?=$seat['priority']?>>
  					<span>seat</span>
  				</div>
  			<?php endforeach;?>
  			<?php foreach ($room['objects'] as $obj): ?>
  				<div class="door ui-widget-content" style="position: absolute; top:<?=$obj->object_location_y?>px; left:<?=$obj->object_location_x?>px;"><span>door</span></div>
  			<?php endforeach;?>
		</div>
	<?php endforeach;?>		
</div>