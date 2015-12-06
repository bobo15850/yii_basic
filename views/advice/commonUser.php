<?php
use app\models\Advice;

	$this->registerCssFile("@web/css/advice/commonUser.css");
	$session = \yii::$app->session;
	$unreadTrainer = Advice::getAdvices($session['user']->id,0,'b');
?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-9">
			<ul class="nav nav-pills">
			  	<li role="presentation" id="unread_trainer" class="active" ><a href="javascirpt:void(0)" onClick="getAdvice(this,<?=$session['user']->id?>,0,'b')">健身教练建议(未读)</a></li>
			  	<li role="presentation" id="unread_doctor"><a href="javascirpt:void(0)" onClick="getAdvice(this,<?=$session['user']->id?>,0,'c')">医生建议(未读)</a></li>
			  	<li role="presentation" id="read_trainer"><a href="javascirpt:void(0)" onClick="getAdvice(this,<?=$session['user']->id?>,1,'b')">健身教练建议(已读)</a></li>
			  	<li role="presentation" id="read_doctor"><a href="javascirpt:void(0)" onClick="getAdvice(this,<?=$session['user']->id?>,1,'c')">医生建议(已读)</a></li>
			</ul>
			<div id="advice_list">
				<?php
				if(empty($unreadTrainer)){
					echo "<h1>暂时没有未读的健身教练的建议</h1>";
				}
				else{
					for($i=0;$i<count($unreadTrainer);$i++){
						echo "<h3>".($i+1)."、".$unreadTrainer[$i]->content."--------创建于".$unreadTrainer[$i]->createdAt."</h3>";
					}
				}
				?>
			</div>
		</div>
		<div class="col-md-3">
			<button id="trainer" class="btn btn-primary btn-lg" onClick="requestAdvice(this,<?=$session['user']->id?>,'b')">向教练请求建议</button>
			<br><br><br>
			<button id="doctor" class="btn btn-primary btn-lg" onClick="requestAdvice(this,<?=$session['user']->id?>,'c')">向医生请求建议</button>
		</div>
	</div>
</div>
<?php
	$this->registerJsFile("@web/js/advice/commonUser.js");//添加js文件
?>
