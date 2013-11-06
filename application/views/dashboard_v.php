<div id="dashboard-wrapper" class="container">
	<div id="groups-in">
		<h2>Groups that <?=$this->session->userdata('name')?> is in</h2>
		<div class="groups-box">
<?php foreach ($groupsIn as $gin): ?>
			<div class="group">
				<div class="group-box">
					<span>Group name: <?=$gin['gname']?></span>				
					<span>Group owner: <?=$gin['gowner']?></span>
					<span class="horizontal-bar"></span>
	<?php if ($gin['apps_exist']):?>
					<a class="button" href="<?=site_url(array('application', 'show', $this->session->userdata('num'), $gin['gid']))?>">Open my application</a>
	<?php else:?>
					<a class="button" href="<?=site_url(array('application', 'make_new', $this->session->userdata('num'), $gin['gid']))?>">Make a new application</a>
	<?php endif;?>
				</div>
			</div>
<?php endforeach;?>
			<a class="btn" href="<?=site_url(array('group', 'join', $this->session->userdata('num')))?>">Join a new group</a>			
		</div>
	</div>
	<div id="groups-own">
		<h2>Groups that <?=$this->session->userdata('name')?> owns</h2>
		<table class="table table-condensed">
			<thead>
				<tr>
					<th>#</th>
					<th>Group name</th>
					<th>Information</th>
				</tr>
			</thead>
			<tbody>
<?php $group_index = 1;?>
<?php foreach ($groupsOwn as $gown): ?>
				<tr>
					<td><?=$group_index++?></td>
					<td><a href="<?=site_url('/group/configure/'.$gown['gid'])?>"><?=$gown['gname']?></a></td>
					<td>
	<?php if ($gown['all_mem_applied']):?>
						<span class="label">All members applied</span>
	<?php else:?>
						<span class="label label-warning">Some members are not applied yet</span>
	<?php endif;?>
					</td>				
				</tr>
<?php endforeach;?>
				<tr>
					<td><?=$group_index++?></td>
					<td class="muted">An empty group</td>
					<td>
						<a class="btn btn-small btn-info" href="<?=site_url(array('group', 'create', $this->session->userdata('num')))?>">Create a new group</a>
					</td>
				</tr>
			</tbody>					
		</table>
	</div>
</div>