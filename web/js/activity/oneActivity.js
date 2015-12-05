function joinOrQuitActivity(activityId){
	btn = document.getElementById('join_quit');
	if(btn.value=="参加活动"){
		$.post("index.php?r=activity/join-activity",{'activityId':activityId},function(data){
			if(data){
				btn.value="退出活动";
				btn.className="btn btn-lg btn-default btn-block";
			}
		});
	}
	else{
		$.post("index.php?r=activity/quit-activity",{'activityId':activityId},function(data){
			if(data){
				btn.value="参加活动";
				btn.className="btn btn-lg btn-primary btn-block";
			}
		});
	}
}//参加活动和退出活动，二者共用一个按钮

function modifyActivity(activityId){
	window.location.href="index.php?r=activity/to-modify&activityId="+activityId;
}//修改活动

function deleteActivity(activityId){
	var r=confirm("是否删除该活动，此操作不可恢复");
	if (r==true){
		$.post("index.php?r=activity/delete-activity",{'activityId':activityId},function(data){
			if(data){
				window.location.href="index.php?r=account/index";
			}
		});		
	}
}//删除活动

function check_release(){
	return true;
}//检验活动发布表单

function check_modify(){
	return true;
}//检验活动修改表单,只能修改人数，而且只能扩大人数