			</div>
			</div>	
			</div>			
		</div>
		<script src="http://code.jquery.com/jquery.js"></script>
		<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
		<script src="http://code.jquery.com/jquery-migrate-1.2.1.js"></script>		
		<script src="<?=base_url('includes/js/bootstrap.min.js')?>"></script>		
		<script src="<?=base_url('includes/js/jquery.autogrow.js')?>"></script>
		<script src="<?=base_url('includes/js/general.js')?>"></script>	
<?php if (strpos(uri_string(), 'room/add/') !== FALSE): ?>
		<script src="<?=base_url('includes/js/room_create.js')?>"></script>
<?php endif;?>
<?php if (strpos(uri_string(), 'room/modify/') !== FALSE): ?>
		<script src="<?=base_url('includes/js/room_create.js')?>"></script>
<?php endif;?>
<?php if (strpos(uri_string(), 'application/show/') !== FALSE): ?>
		<script src="<?=base_url('includes/js/room_select.js')?>"></script>
<?php endif;?>
	</body>
</html>