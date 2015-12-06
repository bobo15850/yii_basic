function showAdviceInput(requestId,userId,advicerId){
	var content=prompt("请输入建议的内容");
	if(content==null||content.length==0){
		alert("建议能容不能为空，请重新处理该请求");
	}else{
		$.post("index.php?r=advice/give-advice",{'userId':userId,'advicerId':advicerId,'content':content,'requestId':requestId},function(data){
			if(data){
				window.location.href="index.php?r=advice/index";
			}
		});
	}
}//给出建议