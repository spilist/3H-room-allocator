<div id="room-creater-wrapper" class="container">
	<div id="group-configure-header">
		<h2>Add a new room for <span class="group-name"><?=$group_name?></span>- created by <span class="user-name"><?=$this->session->userdata('name')?></span>			
		</h2>
		<a href="<?=site_url('/')?>" class="btn btn-info">Go back to the dashboard</a>
	</div>
	
	<?php $errored='' ?>
	<dl class="form <?=$errored?>">
		<dt><label for="room_name" name="room_name">Room name</label></dt>
		<dd><input id="room_name" name="room_name" size="30" type="text" value="Room"/></dd>
		<?=form_error('room_name') ?>
	</dl>
	
	<div id="roomCanvas" class="ui-widget-content">
		<!--<h3 class="ui-widget-header">Room</h3>-->
			
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
		<input name="test" type="hidden" value="1212" />
		<input id="submitBtn" type="submit" value="create" class="button" onclick="roomSubmit()" 
			create_url="<?=site_url('/room/create/'.$gid)?>"
			redirect_url="<?=site_url('/group/configure/'.$gid)?>"/>
	</div>
</div>
