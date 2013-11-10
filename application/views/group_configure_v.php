<div id="group-configure-wrapper" class="container">
	<div id="group-configure-header">
		<h2>Group <span class="group-name"><?=$gname?></span>- created by <span class="user-name"><?=$this->session->userdata('name')?></span></h2>
		<a href="<?=site_url('/')?>" class="btn btn-info">Go back to the dashboard</a>
	</div>
	<div id="group-room-list">
		<table class="table table-condensed">
			<thead>
				<tr>
					<th>#</th>
					<th>Room name</th>
					<th>Functions</th>
				</tr>
			</thead>
			<tbody>
<?php $room_index = 1;?>
<?php foreach ($rooms as $room): ?>
				<tr>
					<td><?=$room_index++?></td>
					<td><?=$room['room_name']?></td>
					<td>
						<a class="btn btn-small" href="<?=site_url(array('room', 'modify', $room['room_id'], $gid))?>">Modify</a>
						<a class="btn btn-small btn-danger" href="<?=site_url(array('room', 'delete', $room['room_id'], $gid))?>">Delete</a>
					</td>
				</tr>
<?php endforeach;?>
				<tr>
					<td><?=$room_index?></td>
					<td class="muted">An empty room</td>
					<td>
						<a class="btn btn-small" href="<?=site_url(array('room', 'add', $gid))?>">Add a new room</a>
					</td>
				</tr>			
			</tbody>
		</table>	
	</div>
</div>