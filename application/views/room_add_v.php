<div id="room-creater-wrapper">
	<div id="roomCanvas" class="ui-widget-content">
		<h3 class="ui-widget-header">Room</h3>		
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
		<input id="submitBtn" type="submit" value="create" onclick="asubmit()" site_url="<?=site_url('/room/create')?>"/>
	</div>
</div>
