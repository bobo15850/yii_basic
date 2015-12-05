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
}

function changeExerciseBar(newBar) {
	lis = document.getElementsByClassName("exercise_bar");
	for (i = 0; i < lis.length; i++) {
		lis[i].className = "exercise_bar";
	}
	newBar.className = "exercise_bar active";
	pages = document.getElementsByClassName("exercise_content");
	for (i = 0; i < pages.length; i++) {
		pages[i].className = "exercise_content hide";
	}
	newBarId = newBar.id;
	newPageId = newBarId.substring(0, newBarId.length - 4);// 得到新的选项页面的id
	newPage = document.getElementById(newPageId);
	newPage.className = "exercise_content show";
}

function check_healthState(){
	return true;
}