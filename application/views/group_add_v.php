<div id="group-add-wrapper" class="container">
	<h2>Create a new group for <span><?=$this->session->userdata('name')?></span></h2>
	<div class="columns equacols bordered">
		<div class="column main">
			<form accept-charset="UTF-8" action="<?=site_url('/group/create')?>" autocomplete="off" method="post">
				<div class="fieldgroup">
					<div class="fields">
						<dl class="form <?=$errored?>">
							<dt><label autocapitalize="off" for="group_name" name="group_name">Group name</label></dt>
							<dd><input autocapitalize="off" id="group_name" name="group_name" size="30" type="text" value="<?=set_value('group_name')?>"></dd>
							<?=form_error('group_name')?>
						</dl>

						<dl class="form <?=$errored?>">
							<dt><label for="group_pw" name="group_pw">Group join password</label></dt>
							<dd><input id="group_pw" name="group_pw" size="30" type="text" value="<?=set_value('group_pw')?>">
							</dd>
							<?=form_error('group_pw') ?>
						</dl>
						
						<dl class="form <?=$errored?>">
							<dt><label autocapitalize="off" for="num_seats"  name="num_seats"># of selectable seats (Between 1 and 5)</label>	</dt>
							<dd>
								<input class="radio" name="num_seats" type="radio" value="1" checked="checked">1</input>
								<input class="radio" name="num_seats" type="radio" value="2">2</input>
								<input class="radio" name="num_seats" type="radio" value="3">3</input>
								<input class="radio" name="num_seats" type="radio" value="4">4</input>
								<input class="radio" name="num_seats" type="radio" value="5">5</input>
								</dd>
							<?=form_error('num_seats')?>
						</dl>				
					</div>
				</div>				
				<div class="form-actions">
					<button type="submit" class="button primary" id="group-create-button" data-disable-with="Creating Group…">
						Create a new group with this configuration
					</button>
				</div>
			</form>
		</div>
		<div class="column secondary">
			<p class="lead">
				Members who want to join to this group need to know the group's name and password. 
			</p>
			<p class="lead">
				Group members can select at most 5 seats with their priorities. 
			</p>
		</div><!-- /.column.sidebar -->
	</div>	
</div>