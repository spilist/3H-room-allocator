<?php
	$uid = $this->session->userdata('num');
	$uname = $this->session->userdata('name');	
?>
<div id="dashboard-wrapper" class="container">
	<div id="groups-own">
<?php if (empty($groupsOwn)):?>
		<div class="ask-empty">
			<span class="user-name"><?=$uname?></span>, you don't have your own group! Want to <a class="tooltipped" data-toggle="tooltip" data-placement="bottom" title="Create a new group" href="<?=site_url(array('group', 'create', $uid))?>">create</a> one?			
		</div>
<?php else:?>
		<div class="groups-header clearfix">
			<h2>Groups <span class="user-name"><?=$uname?></span> owns</h2>
			<a class="btn btn-small btn-info" href="<?=site_url(array('group', 'create', $uid))?>">Create a new group</a>
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
						<abbr title="current # of members"><?=$gown['num_members']?></abbr>
						 / 
						<abbr title="member limit"><?=$gown['max_members']?></abbr>
					</td>
					<td>
						<abbr title="members applied so far"><?=$gown['mem_applied']?></abbr>
						 / 
						<abbr title="current # of members"><?=$gown['num_members']?></abbr>
					</td>
					<td>
		<?php if ($gown['alloc_done']):?>
						<a class="btn btn-small btn-primary" href="<?=site_url('/group/alloc_result/'.$gown['gid'])?>">See the result</a>
		<?php else:?>			
						<a class="btn btn-small btn-warning" <?=$gown['alloc_disable']?> href="<?=site_url('/group/allocate/'.$gown['gid'])?>">Allocate Now</a>
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
			<h2 id="join-modal-label">Join a new group in RAFA</h2>
		</div>
		<div class="modal-body">
			<div class="flash-messages hidden">
				<div class="flash flash-error join-msg"></div>
			</div>
			<form id="join-form" accept-charset="UTF-8" autocomplete="off" method="post" action="<?=site_url('/ajax/group_join/'.$uid)?>">
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
			<span class="user-name"><?=$uname?></span>, you have no joined group! Want to <a class="join-btn" data-toggle="modal" href="#join-modal">JOIN</a> one?
		</div>						
<?php else:?>
		<div class="groups-header clearfix">
			<h2>Groups <span class="user-name"><?=$uname?></span> is in</h2>
			<a data-toggle="modal" href="#join-modal" class="btn btn-small btn-info join-btn">Join a new group</a>
		</div>
		<table class="table table-condensed">
			<thead>
				<tr>
					<th>#</th>
					<th>Group name</th>
					<th>Group owner</th>
					<th>Members in group</th>
					<th>Operation</th>					
				</tr>
			</thead>
			<tbody>
	<?php $group_index = 1;?>
	<?php foreach ($groupsIn as $gin): ?>
				<tr>
					<td><?=$group_index++?></td>
					<td>
						<span class="label label-important"><?=$gin['gname']?></span> 
					</td>
					<td class="user-name"><?=$gin['gowner']?></td>
					<td>
						<abbr title="current # of members"><?=$gin['num_members']?></abbr>
						 / 
						<abbr title="member limit"><?=$gin['max_members']?></abbr>
					</td>
					<td>
		<?php if ($gin['apps_exist']):?>
						<a class="btn btn-small btn-primary" href="<?=site_url(array('application', 'show', $uid, $gin['gid'], 'open'))?>">Open my request</a>
		<?php else:?>
						<a class="btn btn-small btn-warning" href="<?=site_url(array('application', 'show', $uid, $gin['gid']))?>">Request for seat</a>
		<?php endif;?>
		<?php if ($gin['seat_exist']):?>
						<a class="btn btn-small btn-primary" href="<?=site_url(array('seat', 'assigned', $uid, $gin['gid']))?>">See my seat</a>
		<?php endif;?>
		<?php if ($gin['gowner_id']!=$uid):?>
						<a class="btn btn-small btn-danger" href="<?=site_url(array('group', 'leave', $uid, $gin['gid']))?>">Leave this group</a>
		<?php endif;?>
					</td>												
				</tr>
	<?php endforeach;?>
			</tbody>
		</table>
<?php endif;?>
	</div>
</div>