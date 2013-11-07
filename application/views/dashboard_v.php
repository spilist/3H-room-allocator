<div id="dashboard-wrapper" class="container">
	<div id="groups-own">
<?php if (empty($groupsOwn)):?>
		<div class="ask-empty">
			<span class="user-name"><?=$this->session->userdata('name')?></span>, you don't have your own group! Want to <a class="tooltipped" data-toggle="tooltip" data-placement="bottom" title="Create a new group" href="<?=site_url(array('group', 'create', $this->session->userdata('num')))?>">create</a> one?			
		</div>
<?php else:?>
		<div class="groups-header clearfix">
			<h2>Groups <span class="user-name"><?=$this->session->userdata('name')?></span> owns</h2>
			<a class="btn btn-small btn-info" href="<?=site_url(array('group', 'create', $this->session->userdata('num')))?>">Create a new group</a>
		</div>
		<table class="table table-condensed">
			<thead>
				<tr>
					<th>#</th>
					<th>Group name</th>
					<th>Members in group</th>
					<th>Members applied</th>
					<th>Operation</th>
				</tr>
			</thead>
			<tbody>
	<?php $group_index = 1;?>
	<?php foreach ($groupsOwn as $gown): ?>
				<tr>
					<td><?=$group_index++?></td>
					<td>
						<a class="label label-important tooltipped" data-toggle="tooltip" href="<?=site_url('/group/configure/'.$gown['gid'])?>" title="Click to configure"><?=$gown['gname']?></a>
					</td>
					<td>
						<?=$gown['num_members']?> / <?=$gown['max_members']?>
					</td>
					<td>
						<?=$gown['mem_applied']?> / <?=$gown['num_members']?>
					</td>
					<td>
		<?php if ($gown['alloc_done']):?>
						<a class="btn btn-small btn-primary" href="<?=site_url('/group/alloc_result/')?>">See the result</a>
		<?php else:?>
						<a class="btn btn-small btn-warning" href="<?=site_url('/group/allocate/'.$gown['gid'])?>">Allocate Now</a>
		<?php endif;?>
						<a class="btn btn-small btn-danger" href="<?=site_url('/group/delete/'.$gown['gid'])?>">Delete this group</a>	
					</td>				
				</tr>
	<?php endforeach;?>				
			</tbody>					
		</table>		
<?php endif;?>		
	</div>
	<div id="join-modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="join-modal-label" aria-hidden="true" style="display: none;">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h2 id="join-modal-label" mid="<?=$this->session->userdata('num')?>">Join a new group in RAFA</h2>
		</div>
		<div class="modal-body">
			<form id="join-form" accept-charset="UTF-8" autocomplete="off" method="post">
				<p>
					<label autocapitalize="off" for="group_name" name="group_name">Group name</label>
					<input autocapitalize="off" id="group_name" name="group_name" size="30" type="text">
				</p>
				<p>
					<label for="group_pw" name="group_pw">Group join password</label>
					<input id="group_pw" name="group_pw" size="30" type="text">	
				</p>											
			</form>
		</div>
		<div class="modal-footer">
			<button class="btn btn-primary join-submit">Join</button>
			<button class="btn" data-dismiss="modal">Close</button>
		</div>
	</div>
	<div id="groups-in">
<?php if (empty($groupsIn)):?>
		<div class="ask-empty">
			<span class="user-name"><?=$this->session->userdata('name')?></span>, you have no joined group! Want to <a class="join-btn" data-toggle="modal" href="#join-modal">JOIN</a> one?
		</div>						
<?php else:?>
		<div class="groups-header clearfix">
			<h2>Groups <span class="user-name"><?=$this->session->userdata('name')?></span> is in</h2>
			<a data-toggle="modal" href="#join-modal" class="btn btn-small btn-danger">Join a new group</a>
		</div>
		<table class="table table-condensed">
			<thead>
				<tr>
					<th>#</th>
					<th>Group name</th>
					<th>Members in group</th>
					<th>Application</th>
					<th>Seat</th>
				</tr>
			</thead>
			<tbody>
	<?php $group_index = 1;?>
	<?php foreach ($groupsIn as $gin): ?>
				<tr>
					<td><?=$group_index++?></td>
					<td>
						<span class="label label-important"><?=$gin['gname']?></span> by <span class="user-name"><?=$gin['gowner']?></span> 
					</td>
					<td>
						<?=$gown['num_members']?> / <?=$gown['max_members']?>
					</td>
					<td>
		<?php if ($gin['apps_exist']):?>
						<a class="btn btn-small btn-primary" href="<?=site_url(array('application', 'show', $this->session->userdata('num'), $gin['gid']))?>">Open & modify</a>
		<?php else:?>
						<a class="btn btn-small btn-warning" href="<?=site_url(array('application', 'make_new', $this->session->userdata('num'), $gin['gid']))?>">Apply now</a>
		<?php endif;?>
					</td>
					<td>
		<?php if ($gin['seat_exist']):?>
						<a class="btn btn-small btn-primary" href="<?=site_url(array('seat', 'assigned', $this->session->userdata('num'), $gin['gid']))?>">See the result</a>
		<?php else:?>
						<span class="muted">Not allocated yet</span>
		<?php endif;?>
					</td>
				</tr>				
	<?php endforeach;?>
			</tbody>
		</table>
<?php endif;?>
	</div>
</div>