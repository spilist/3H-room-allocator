<div class="pagehead">
  <div class="container">
      <h1>Sign up for RAFA</h1>
  </div>
</div>

<div class="container">
	<div class="columns equacols bordered">
		<div class="column main">
			<form accept-charset="UTF-8" action="<?=site_url('/auth/register')?>" autocomplete="off" class="js-braintree-encrypt signup-form js-form-signup-detail" id="signup_form" method="post">
				<div class="fieldgroup">
					<div class="fields">
						<dl class="form <?=$errored?>">
							<dt><label autocapitalize="off" for="name" name="name">Name</label></dt>
							<dd><input autocapitalize="off" id="name" name="name" size="30" type="text" value="<?=set_value('name')?>"></dd>
							<?=form_error('name')?>
						</dl>

						<dl class="form <?=$errored?>">
							<dt><label autocapitalize="off" for="id"  name="id">ID</label>	</dt>
							<dd><input autocapitalize="off" id="id" name="id" size="30" type="text" value="<?=set_value('id')?>"></dd>
							<?=form_error('id')?>
						</dl>
						
						<dl class="form <?=$errored?>">
							<dt><label for="password" name="password">Password</label></dt>
							<dd><input id="password" name="password" size="30" type="password" value="<?=set_value('password')?>">								
							</dd>
							<?=form_error('password')?>
						</dl>				
					</div>
				</div>
				<div class="form-actions">
					<button type="submit" class="button primary" id="signup_button" data-disable-with="Creating Account…">
						Make a RAFA account
					</button>
				</div>

			</form>

		</div><!-- /.column.main -->
		<div class="column secondary">

			<p class="lead">
				Welcome!
			</p>

			<p class="lead">
				
			</p>

		</div><!-- /.column.sidebar -->
	</div>
</div>