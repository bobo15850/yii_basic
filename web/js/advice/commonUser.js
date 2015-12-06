function getAdvice(obj,userId,isRead,advicerIndentity){
	oldActive = document.getElementsByClassName("active");
	oldActive[0].className="";
	obj.parentNode.className="active";
	$.post("index.php?r=advice/get-advice",{'userId':userId,'isRead':isRead,'advicerIndentity':advicerIndentity},function(advices){
		var advice_list = document.getElementById("advice_list");
		if(advices==null||advices.length==0){
			advice_list.innerHTML="<h1>暂时没有该类建议</h1>";
		}
		else{
			var html="";
			for(i=0;i<advices.length;i++){
				html+="<h3>";
				html+=(i+1);
				html+="、";
				html+=advices[i].content;
				html+="------创建于";
				html+=advices[i].createdAt;
				html+="</h3>";
			}
			advice_list.innerHTML=html;
		}
	});
}//根据用户编号，是否读过，建议者身份得到建议

function requestAdvice(obj,userId,advicerIndentity){
	$.post("index.php?r=advice/request-advice",{'userId':userId,'advicerIndentity':advicerIndentity},function(data){
		if(data){
			obj.className = "btn btn-default btn-lg";
			if(obj.id=="trainer"){
				obj.innerHTML = "已向教练请求建议";
			}
			else if(obj.id=="doctor"){
				obj.innerHTML = "已向医生请求建议"
			}
		}
	});
}//请求建议根据用户编号，建议者身份
