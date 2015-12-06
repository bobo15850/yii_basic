<?php
use app\models\AdviceRequest;
use app\models\User;

$session = \yii::$app->session;
$thisUser = $session['user'];
$unHandledRequest = AdviceRequest::getUnHandledRequest($session['user']->id);
?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-1">
		</div>
		<div class="col-md-10">
			<h2>未处理建议请求如下</h2>
			<?php
			if(empty($unHandledRequest)){
				echo "<h1>没有要处理的建议请求</h1>";
			}
			else{
				for($i=0;$i<count($unHandledRequest);$i++){
					$user = User::findOne($unHandledRequest[$i]->userId);
					$temp = $unHandledRequest[$i];
					echo "<h3>".($i+1)."、"."<a target='_blank' href='index.php?r=account/view-user&
							userId=".$user['id']."'>".$user['username']."</a>在".$unHandledRequest[$i]->createdAt.
							"请求您的健康建议,请您及时<a href='javascript:void(0)' onClick='showAdviceInput($temp->id,$user->id,$thisUser->id)'>处理</a></h3>";
				}
			}
			?>
		</div>
		<div class="col-md-1">
		</div>
	</div>
</div>

<?php
	$this->registerJsFile("@web/js/advice/doctor.js");//添加js文件
?>