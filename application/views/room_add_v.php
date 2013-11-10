<div id="room-creater-wrapper" class="container">
	<div id="group-configure-header">
		<h2>Add a new room for <span class="group-name"><?=$group_name?></span>- created by <span class="user-name"><?=$this->session->userdata('name')?></span>			
		</h2>
		<a href="<?=site_url('/')?>" class="btn btn-info">Go back to the dashboard</a>
	</div>
	
	<?php $errored='' ?>
	<dl class="form <?=$errored?>">
		<dt><label for="room_name" name="room_name">Room name</label></dt>
		<dd><input id="room_name" name="room_name" size="30" type="text" value="<?=$room_name?>"/></dd>
		<?=form_error('room_name') ?>
	</dl>
	
	<div id="roomCanvas" class="ui-widget-content" style="width:<?=$room_width?>px; height:<?=$room_height?>px">
		<?php foreach ($seats as $seat): ?>
			<div class="seat ui-widget-content" style="position: absolute; top:<?=$seat->seat_location_y?>px; left:<?=$seat->seat_location_x?>px;" sid=<?=$seat->id?>><span>seat</span></div>
		<?php endforeach;?>
		<?php foreach ($objects as $obj): ?>
			<div class="door ui-widget-content" style="position: absolute; top:<?=$obj->object_location_y?>px; left:<?=$obj->object_location_x?>px;"><span>door</span></div>
		<?php endforeach;?>
	</div>
	
	<div>
		<div id="seatBtn" class="ui-widget-content" style="float: left">
			<span>seat</span>
		</div>
		<div id="doorBtn" class="ui-widget-content" style="float: left">
			<span>door</span>
		</div>
		<div id="recycleBin" class="ui-widget-content" style="float: left">
			<span>delete</span>
		</div>
	</div>
	
	<div style="clear: both">
		<input id="seatArray" name="seats[]" type="hidden" />
		<input id="work" name="test" type="hidden" value="<?=$work?>" />
		<input id="submitBtn" type="submit" value="confirm" class="button" onclick="roomSubmit()" 
			create_url="<?=site_url('/room/create/'.$gid)?>"
			update_url="<?=site_url('/room/update/'.$gid.'/'.$rid)?>" 
			redirect_url="<?=site_url('/group/configure/'.$gid)?>"/>
	</div>
</div>
