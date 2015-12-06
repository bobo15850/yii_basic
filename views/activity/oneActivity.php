<?php
use app\models\Activity;
use app\models\User;

$this->registerCssFile('@web/css/activity/oneActivity.css');
?>
<div class="container-fluid">
	<div class="row">
  		<div class="col-md-4">
  			<h1>活动详情：</h1>
  			<br/>
  			<h3>活动周期：<?=$activity->getTimeLong();?>天</h3>
  			<h3>参加人数：<?=$activity->getAttendNum();?>人</h3>
  			<h3>计划人数：<?=$activity['peoplenum']?>人</h3>
  			<h3>开始时间：<?=$activity['startdate']?></h3>
			<h3>结束时间：<?=$activity['finishdate']?></h3>
			<br/>
			<?php
			$session = yii::$app->session;
			if(isset($session['user'])){
				$thisuser = $session['user'];//登陆用户
				if($thisuser['id']==$activity['beginerId']){
					echo "<button class='btn btn-lg btn-primary btn-block' type='button' onClick='modifyActivity(".$activity['id'].")'>修改活动</button>";
					echo "<button class='btn btn-lg btn-danger btn-block' type='button' onClick='deleteActivity(".$activity['id'].")'>删除活动</button>";
				}//本人发起的活动，添加两个权限
				if($thisuser->isAttendActivity($activity['id'])){
					echo "<input class='btn btn-lg btn-default btn-block' id='join_quit' type='button' value='退出活动' onClick='joinOrQuitActivity(".$activity['id'].")'>";
				}//参加了活动
				else{
					echo "<input class='btn btn-lg btn-primary btn-block' id='join_quit' type='button' value='参加活动' onClick='joinOrQuitActivity(".$activity['id'].")'>";
				}//没有参加活动
			}//已登录
			else{
				echo "<h4>请先登录才能参加活动</h4>";
			}//未登录
			?>
  		</div>
  		<div class="col-md-8">
  			<h1>活动参与：</h1>
  			<?php
			if(!empty($attendUsers)){
			for($i=0;$i<count($attendUsers);$i++){
				$tempUser=$attendUsers[$i];
				echo "<h3><a href='index.php?r=account/view-user&userId=".$tempUser['id']."'>".$tempUser['username']."</a></h3>";
			}
			}else{
				echo "没有其他用户参加<br/>";
			}
			?>
  		</div>
	</div>
</div>
<?php
$this->registerJsFile('@web/js/activity/oneActivity.js');
?>


