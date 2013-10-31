		<?php if ($this->session->flashdata('message')) :?>
		<div class="flash-messages container">
			<div class="flash flash-error"><?=$this->session->flashdata('message')?></div>
		</div>
		<?php endif; ?>
		<div class="auth-form" id="login">
			<form accept-charset="UTF-8" action="<?=site_url('/auth/login')?>" method="post">				
				<div class="auth-form-header">
					<h1>Sign in for RAFA</h1>
				</div>
				<div class="auth-form-body">
					<label for="login_field"> ID </label>
					<input autocapitalize="off" autofocus="autofocus" class="input-block" id="login_field" name="id" tabindex="1" type="text" value="<?=set_value('email')?>">

					<label for="password">Password </label>
					<input class="input-block" id="password" name="password" tabindex="2" type="password" value="<?=set_value('password')?>">
					<input class="button" name="commit" tabindex="3" type="submit" value="Sign In">					
					<a target="" class="auth-up" href="<?=site_url('/auth/fakeLogin')?>">
						<span class="button">Sign In for testing</span>
					</a>
				</div>
			</form>
		</div>