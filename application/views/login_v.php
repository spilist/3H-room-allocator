		<?php if ($this->session->flashdata('message')) :?>
		<div class="flash-messages container">
			<div class="flash flash-error"><?=$this->session->flashdata('message')?></div>
		</div>
		<?php endif; ?>
		<div class="auth-form" id="login">
			<form accept-charset="UTF-8" action="<?=site_url('/auth/login')?>" method="post">				
				<div class="auth-form-header">
					<h1>드림노트에 로그인</h1>
				</div>
				<div class="auth-form-body">
					<label for="login_field"> 이메일 주소 </label>
					<input autocapitalize="off" autofocus="autofocus" class="input-block" id="login_field" name="email" tabindex="1" type="text" value="<?=set_value('email')?>">

					<label for="password">암호 <a href="<?=site_url('/auth/forgotPassword')?>">(암호를 잊으셨나요?)</a> </label>
					<input class="input-block" id="password" name="password" tabindex="2" type="password" value="<?=set_value('password')?>">
					<input class="button" name="commit" tabindex="3" type="submit" value="로그인">					
					<a target="" class="auth-up" href="<?=site_url('/auth/fakeLogin')?>">
						<span class="button">김연아로 로그인</span>
					</a>
				</div>
			</form>
		</div>