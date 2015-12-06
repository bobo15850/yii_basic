function clickBar(newBar) {
	buttons = document.getElementsByClassName("list-group-item");
	for (i = 0; i < buttons.length; i++) {
		buttons[i].className = "list-group-item";
	}// 将原来的active状态擦除
	newBar.className = "list-group-item active";// 给新点击的元素加上active状态
	pages = document.getElementsByClassName("content");
	for (i = 0; i < pages.length; i++) {
		pages[i].className = "content hide";
	}// 隐藏所有的选项页面
	newBarId = newBar.id;
	newPageId = newBarId.substring(0, newBarId.length - 4);// 得到新的选项页面的id
	newPage = document.getElementById(newPageId);
	newPage.className = "content show";
	if(newBar.id=="account_setting_bar"){
		set_password_label = document.getElementById("set_password_label");
		set_password_label.className="hide";
		document.getElementById("usernameInput").value=document.getElementById("username").innerHTML;
		reset_password_set_form();
	}
}

function changeHealthBar(newBar) {
	lis = document.getElementsByClassName("health_state_bar");
	for (i = 0; i < lis.length; i++) {
		lis[i].className = "health_state_bar";
	}
	newBar.className = "health_state_bar active";
	pages = document.getElementsByClassName("health_state_content");
	for (i = 0; i < pages.length; i++) {
		pages[i].className = "health_state_content hide";
	}
	newBarId = newBar.id;
	newPageId = newBarId.substring(0, newBarId.length - 4);// 得到新的选项页面的id
	newPage = document.getElementById(newPageId);
	newPage.className = "health_state_content show";
	if(newBar.id=="past_month_health_bar"){
		$.post("index.php?r=health/get-month-step",{},function(data){
			getSvg(data);
		});
	}
	else if(newBar.id=="my_ideal_health_bar"){
		$.post("index.php?r=health/get-ideal-health",{},function(data){
			document.getElementById("idealHeight").value = data.height;
			document.getElementById("idealWeight").value = data.weight;
			document.getElementById("idealSleep").value = data.sleep;
			document.getElementById("idealHighblood").value = data.highblood;
			document.getElementById("idealLowblood").value = data.lowblood;
			document.getElementById("idealHeartbeat").value = data.heartbeat;
			document.getElementById("idealStep").value = data.step;
			document.getElementById("ideal_set_label").className="hide";
		});
	}
}

function getSvg(data){
	var width = 500,
	height = 350,
	margin = {left:50,top:30,right:20,bottom:20},
	g_width = width-margin.left-margin.right,
	g_height=height-margin.top-margin.bottom;

	d3.select("#container")
	.append("svg")

	.attr("width",width)
	.attr("height",height)


	var g = d3.select("svg")
	.append("g")
	.attr("transform","translate("+margin.left+","+margin.top+")")

	var scale_x = d3.scale.linear()
	.domain([0,data.length-1])
	.range([0,g_width])
	var scale_y = d3.scale.linear()
	.domain([0,d3.max(data)])
	.range([0,g_height])



	var line_generator = d3.svg.line()
	.x(function(d,i){return scale_x(i);})
	.y(function(d){return scale_y(d);})
	.interpolate("cardinal")

	d3.select("g")
	.append("path")
	.attr("d", line_generator(data))
}
function check_healthState(){
	return true;
}

function set_username(){
	var username = document.getElementById("usernameInput").value;
	$.post("index.php?r=account/set-username",{'username':username},function(data){
		if(data){
			var username_show = document.getElementById("username");
			username_show.innerHTML = username;
			var frame_show = document.getElementById("frame_user_bar");
			frame_show.innerHTML = username;
		}
	});
}//账户设置

function set_password(){
	set_password_label = document.getElementById("set_password_label");
	var oldPassword = document.getElementById("oldPasswordInput").value;
	var newPassword = document.getElementById("newPasswordInput").value;
	var newPasswordComfirm = document.getElementById("newPasswordComfirm").value;
	if(newPassword==null||newPassword.length<8||newPassword.length>16){
		set_password_label.className="show";
		set_password_label.innerHTML = "新密码长度不正确,应为8-16位字符"
	}
	else{
		if(newPassword==newPasswordComfirm){
			$.post("index.php?r=account/set-password",{'oldPassword':oldPassword,'newPassword':newPassword},function(data){
				if(data){
					set_password_label.className="show";
					set_password_label.innerHTML = "密码设置成功"
				}
				else{
					set_password_label.className="show";
					set_password_label.innerHTML = "旧密码输入错误"
				}
			});
		}
		else{
			set_password_label.className="show";
			set_password_label.innerHTML = "两次输入的新密码要相同"
		}
	}
	reset_password_set_form();
}//重置密码

function reset_password_set_form(){
	document.getElementById("oldPasswordInput").value="";
	document.getElementById("newPasswordInput").value="";
	document.getElementById("newPasswordComfirm").value="";
}//重置密码修改栏

function setIdealHealth(){
	var idealHeight = document.getElementById("idealHeight").value;
	var idealWeight = document.getElementById("idealWeight").value;
	var idealSleep = document.getElementById("idealSleep").value;
	var idealHighblood = document.getElementById("idealHighblood").value;
	var idealLowblood = document.getElementById("idealLowblood").value;
	var idealHeartbeat = document.getElementById("idealHeartbeat").value;
	var idealStep = document.getElementById("idealStep").value;
	$.post("index.php?r=health/set-ideal-health",{'idealHeight':idealHeight,'idealWeight':idealWeight,
		'idealSleep':idealSleep,'idealHighblood':idealHighblood,'idealLowblood':idealLowblood,
		'idealHeartbeat':idealHeartbeat,'idealStep':idealStep},function(data){
		document.getElementById("ideal_set_label").className="show";
	});
	return false;
}//设置理想健康状态