function check_form(){
	var password_repeat=document.getElementsByName("password_repeat");
	return check_password_repeat(password_repeat[0]);
}//验证整个表单，即为验证最后的密码重复是否正确，其他的都已经验证过了

function check_phonenumber(obj){
	var phonenumber=obj.value;
	if(phonenumber==null||phonenumber.length==0){
		obj.placeholder="手机号不能为空";
	}else{
		re = /^1\d{10}$/;//手机号的正则表达式
		if(!re.test(phonenumber)){
			obj.value="";
			obj.placeholder="请输入正确格式的手机号";
		}
		else{
			$.post("index.php?r=account/check-phone",{'phonenumber':phonenumber},function(isRegistered){
				if(isRegistered){
					obj.value="";
					obj.placeholder="该手机号已经被注册过了，请重新输入";
				}
			});
		}//验证是否被注册过
	}
}//检验电话

function check_username(obj){
	var username=obj.value;
	if(username==null||username.length==0){
		obj.placeholder="用户名不能为空"
	}else{
		if(username.length>16){
			obj.placeholder="昵称不能超过16个字符";
		}
	}
}//检验用户名

function check_password(obj){
	var password=obj.value;
	if(password==null||password.length==0){
		obj.placeholder="密码不能为空";
	}
	else{
		if(password.length<8){
			obj.value="";
			obj.placeholder="密码至少8位，请重新输入";
		}
		else if(password.length>16){
			obj.value="";
			obj.placeholder="密码最多16位，请重新输入"
		}
	}
}//检验密码

function check_password_repeat(obj){
	var passwordInput = document.getElementsByName("password");
	var password=passwordInput[0].value;
	var password_repeat=obj.value;
	if(password==password_repeat){
		return true;
	}
	else{
		obj.value="";
		obj.placeholder="两次输入的密码必须相同";
		return false;
	}
}//检验密码重复