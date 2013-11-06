<div id="dashboard-wrapper" class="container">
	<div id="groups-in">
		<h2>Groups that <?=$this->session->userdata('name')?> is in</h2>
		<div class="groups-box">
<?php foreach ($groupsIn as $gin): ?>
			<div class="group group-in">
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
			<a class="button" href="<?=site_url(array('group', 'join', $this->session->userdata('num')))?>">Join a new group</a>			
		</div>
	</div>
	<div id="groups-own">
		<h2>Groups that <?=$this->session->userdata('name')?> owns</h2>
		<div class="groups-box">
			<!-- TEST -->
			<a class="button" href="<?=site_url(array('group', 'create', $this->session->userdata('num')))?>">Create a new group</a>
			<!--<a class="button" href="<?=site_url(array('create', 'group', $this->session->userdata('num')))?>">Create a new group</a>-->
		</div>
	</div>
</div>