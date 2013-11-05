			</div>
			</div>	
			</div>			
		</div>
		<script src="http://code.jquery.com/jquery.js"></script>
		<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
		<script src="http://code.jquery.com/jquery-migrate-1.2.1.js"></script>		
		<script src="<?=base_url('includes/js/bootstrap.min.js')?>"></script>		
		<script src="<?=base_url('includes/js/jquery.autogrow.js')?>"></script>
<?php if (uri_string()=='create'): ?>
		<script src="<?=base_url('includes/js/create_room.js')?>"></script>
<?php endif;?>
<?php if (uri_string()=='select'): ?>
		<!--<script src="<?=base_url('includes/js/room_select.js')?>"></script>-->
<?php endif;?>
	</body>
</html>