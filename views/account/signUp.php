<?php
	$this->registerCssFile("@web/css/account/signUp.css");//添加css文件
?>
<div class="container">
	<form class="form-signUp" action="index.php?r=account/sign-up" method="post" onSubmit="return check_form();">
		<h2 class="form-signUp-heading">请注册</h2>
		<input type="textarea" name="phonenumber" class="form-control" placeholder="请输入11位手机号" onBlur="check_phonenumber(this)" autofocus required>
		<input type="textarea" name="username" class="form-control" placeholder="请输入昵称，不超过16个字符" onBlur="check_username(this)" required>
		<input type="password" name="password" class="form-control" placeholder="请输入密码8-16位" onBlur="check_password(this)" required>
		<input type="password" name="password_repeat" class="form-control" placeholder="确认密码" required>
		<button class="btn btn-lg btn-primary btn-block" type="submit">注册</button>
	</form>
	<div class="has-account">
		<label>已有账号<a href="index.php?r=account/login">==>直接登陆</a></label>
	</div>
</div>

<?php
	$this->registerJsFile("@web/js/account/signUp.js");//添加js文件
?>