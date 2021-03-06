<?php
use app\models\HealthState;
use app\models\User;
	$this->registerCssFile('@web/css/account/mypage.css');

	$session = yii::$app->session;
	$thisuser = User::findOne($otherUserId);//用户
	$nowHealth = HealthState::getUserLatestHealth($thisuser['id']);//当前健康状态
?>
<div class="container">
	<div class="row">
		<div class="col-sm-3">
			<div class="my_info">
					<div class="portrait">
						<img alt="头像" src="image/mypage/portrait.png">
					</div>
					<h3 id="username"><?=$thisuser['username']?></h3>
			</div>
			<div class="sidenav list-group">
				<button type="button" id="health_manage_bar" class="list-group-item active" onclick="clickBar(this)">
					健康管理
				</button>
				<button type="button" id="my_friends_bar" class="list-group-item" onclick="clickBar(this)">
					他的好友
				</button>
			</div>
		</div>
		<div class="col-sm-9">
				<div id="health_manage" class="content show">
					<ul class="nav nav-pills">
						<li role="presentation" id="now_health_bar" class="health_state_bar active" onclick="changeHealthBar(this)">
							<a href="#">当前状态</a>
						</li>
						<li role="presentation" id="past_month_health_bar" class="health_state_bar" onclick="changeHealthBar(this)">
							<a href="#">过去一月运动情况</a>
						</li>
						<li role="presentation" id="my_ideal_health_bar" class="health_state_bar" onclick="changeHealthBar(this)">
							<a href="#">他的目标</a>
						</li>
					</ul>
					<div id="now_health" class="health_state_content show">
						<form action="index.php?r=account/set-now-health" method="post" onSubmit="return check_healthState()">
							<label>身高(厘米)：</label>
							<input type="textarea" class="form-control" name="heightInput" value=<?=$nowHealth['height']?>>
							<label>体重(千克)：</label>
							<input type="textarea" class="form-control" name="weightInput" value=<?=$nowHealth['weight']?>>
							<label>睡眠(小时)：</label>
							<input type="textarea" class="form-control" name="sleepInput" value=<?=$nowHealth['sleep']?>>
							<label>血压(高压)：</label>
							<input type="textarea" class="form-control" name="highbloodInput" value=<?=$nowHealth['highblood']?>>
							<label>血压(低压)：</label>
							<input type="textarea" class="form-control" name="lowbloodInput" value=<?=$nowHealth['lowblood']?>>
							<label>心跳(分钟)：</label>
							<input type="textarea" class="form-control" name="heartbeatInput" value=<?=$nowHealth['heartbeat']?>>
							<label>步数(步)：</label>
							<input type="textarea" class="form-control" name="stepInput" value=<?=$nowHealth['step']?>>
							<h5>最后更新：<?=$nowHealth['date']?></h5>
						</form>
					</div>
					<div id="past_month_health" class="health_state_content hide">
						<div id="container"></div>
					</div>
					<div id="my_ideal_health" class="health_state_content hide">
						<form onSubmit="return setIdealHealth()">
							<label>理想身高(厘米)：</label>
							<input type="textarea" class="form-control" id="idealHeight">
							<label>目标体重(千克)：</label>
							<input type="textarea" class="form-control" id="idealWeight">
							<label>理想睡眠(小时)：</label>
							<input type="textarea" class="form-control" id="idealSleep">
							<label>目标血压(高压)：</label>
							<input type="textarea" class="form-control" id="idealHighblood">
							<label>目标血压(低压)：</label>
							<input type="textarea" class="form-control" id="idealLowblood">
							<label>目标心跳(分钟)：</label>
							<input type="textarea" class="form-control" id="idealHeartbeat">
							<label>目标步数(步)：</label>
							<input type="textarea" class="form-control" id="idealStep">
						</form>
					</div>
				</div>
				<div id="my_friends" class="content hide">
					<h1>他的好友</h1>
				</div>
		</div>
	</div>
</div>
<?php
	$this->registerJsFile("@web/js/account/mypage.js");//添加js文件
	$this->registerJsFile("@web/js/account/d3.js");//添加js文件
?>
