<div class="container">
	<form class="form-login" action="index.php?r=account/index" method="post">
		<h2 class="form-login-heading">请登录</h2>
		<input type="textarea" name="phonenumber" class="form-control" placeholder="手机号" required autofocus>
		<input type="password" name="password" class="form-control" placeholder="密码8-16位数字或字母或下划线" required>
		<?php
		if(isset($isError)){
			if ($isError==1) {
				echo "<h4 class='login-error'>用户名或密码错误</h4>";
			}
		}//用来提示登陆情况
		?>
		<div class="checkbox">
			<label><input type="checkbox" value="remember-me">记住密码</label>
			<a class="forget-password" href="index.php?r=account/find-password">忘记密码</a>
		</div>
		<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
	</form>
	<div class="no-account">
		<label>没有账号<a href="index.php?r=account/sign-up">==>立即注册</a></label>
	</div>
</div>