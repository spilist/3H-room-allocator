<div class="pagehead">
  <div class="container">
      <h1>드림노트 회원으로 가입하기</h1>
  </div>
</div>

<div class="container">
	<div class="columns equacols bordered">
		<div class="column main">
			<form accept-charset="UTF-8" action="<?=site_url('/auth/register')?>" autocomplete="off" class="js-braintree-encrypt signup-form js-form-signup-detail" id="signup_form" method="post">
				<div class="fieldgroup">
					<div class="fields">
						<dl class="form <?=$errored?>">
							<dt><label autocapitalize="off" for="name" name="name">이름</label></dt>
							<dd><input autocapitalize="off" id="name" name="name" size="30" type="text" value="<?=set_value('name')?>"></dd>
							<?=form_error('name')?>
						</dl>

						<dl class="form <?=$errored?>">
							<dt><label autocapitalize="off" for="email"  name="email">이메일 주소</label>	</dt>
							<dd><input autocapitalize="off" id="email" name="email" size="30" type="text" value="<?=set_value('email')?>"></dd>
							<?=form_error('email')?>
						</dl>
						
						<dl class="form <?=$errored?>">
							<dt><label for="password" name="user[password]">암호</label></dt>
							<dd><input id="password" name="password" size="30" type="password" value="<?=set_value('password')?>">								
							</dd>
							<?=form_error('password')?>
						</dl>				
					</div>
				</div>

				<div class="form-warning">
					<p>
						아래의 "드림노트 계정 만들기" 버튼을 누르면, 당신은 에버멘토의 
						<a href="https://help.github.com/terms" target="_blank">이용 약관</a>과 <a href="https://help.github.com/privacy" target="_blank">프라이버시 정책</a>에 동의하게 됩니다.
					</p>
				</div>
				<div class="form-actions">
					<button type="submit" class="button primary" id="signup_button" data-disable-with="Creating Account…">
						드림노트 계정 만들기
					</button>
				</div>

			</form>

		</div><!-- /.column.main -->
		<div class="column secondary">

			<img alt="Collabocats" src="https://github.global.ssl.fastly.net/images/modules/octocats/collabocats.jpg" width="100%">

			<p class="lead">
				광고 문구 광고 문구 광고 문구
			</p>

			<p class="lead">
				광고 문구 광고 문구 광고 문구
			</p>

		</div><!-- /.column.sidebar -->
	</div>
</div>