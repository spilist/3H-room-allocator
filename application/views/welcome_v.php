		<div class="marketing-section marketing-section-signup">
			<div class="container">
				<form accept-charset="UTF-8" action="<?=site_url('/auth/register')?>" autocomplete="off" class="form-signup-home js-form-signup-home" method="post">					
					<dl class="form">
						<dd>
							<input type="text" name="name" class="textfield" placeholder="Write your name" autofocus="">
						</dd>
					</dl>
					<dl class="form">
						<dd>
							<input type="text" name="id" class="textfield" placeholder="Write your ID">
						</dd>
					</dl>
					<dl class="form">
						<dd>
							<input type="password" name="password" class="textfield" placeholder="Write your password" >
						</dd>
						<p class="text-muted">
							Use at least six characters.
						</p>
					</dl>					
					<button class="button primary button-block" type="submit">
						Sign up for RAFA
					</button>					
				</form>
				<h1 class="heading">Allocate. Simpler.</h1>
				<p class="subheading">
					CS562, KAIST, 2013 Fall Project Page<br>
					Made by 3H - Hwidong, Hyunjun, Hyosu
				</p>
			</div><!-- /.container -->			
		</div><!-- /.jumbotron -->