<?php
use app\models\HealthState;
use app\models\Activity;
use app\models\User;
	$this->registerCssFile('@web/css/account/mypage.css');
	$this->registerCssFile('@web/css/activity/activity.css');


	$session = yii::$app->session;
	$thisuser = $session['user'];//用户
	$nowHealth = HealthState::getUserLatestHealth($thisuser['id']);//当前健康状态
	$attendActivities = Activity::getUserActivities($thisuser['id']);
	$releaseActivities = Activity::getUserReleaseActivity($thisuser['id']);
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
				<button type="button" id="attend_activity_bar" class="list-group-item" onclick="clickBar(this)">
					我参加的活动
				</button>
				<button type="button" id="release_activity_bar" class="list-group-item" onclick="clickBar(this)">
					我发布的活动
				</button>
				<button type="button" id="my_friends_bar" class="list-group-item" onclick="clickBar(this)">
					我的好友
				</button>
				<button type="button" id="account_setting_bar" class="list-group-item" onclick="clickBar(this)">
					账户设置 
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
							<a href="#">过去一月运动折线图</a>
						</li>
						<li role="presentation" id="my_ideal_health_bar" class="health_state_bar" onclick="changeHealthBar(this)">
							<a href="#">我的目标</a>
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
							<button class="btn btn-lg btn-primary btn-block" type="submit">重置当前健康状态</button>
						</form>
					</div>
					<div id="past_month_health" class="health_state_content hide">
						<h3>一月内步数分布图</h3>
						<div id="container">
						</div>
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
							<label id="ideal_set_label" class="hide">目标设置成功</label>
							<button class="btn btn-lg btn-primary btn-block" type="submit">设置目标</button>
						</form>
					</div>
				</div>
				<div id="attend_activity" class="content hide">
					<?php
					if(empty($attendActivities)){
						echo "<h1>暂时没有参加的活动</h1>";
					}
					else{
						for($i=0;$i<count($attendActivities);$i++){
							$temp=$attendActivities[$i];
							echo "<li class='one_activity'>";
							echo "<a href='index.php?r=activity/view-activity&activityId=".$temp['id']."'>";
							echo "<img alt='walkinging' src='image/activity/walking.png'>";
							echo "</a>";
							echo "<div>";
							echo "<span>周期：</span> <label>".$temp->getTimeLong()."天</label><br/>";
							echo "<span>开始：</span> <label>".$temp['startdate']."</label><br/>";
							echo "<span>人数：</span> <label>".$temp->getAttendNum()."/".$temp['peoplenum']."人</label><br/>";
							$beginer = User::findUserById($temp['beginerId']);//得到创建者
							echo "<span>发起：</span> <label>".$beginer['username']."</label><br/>";
							echo "</div>";
							echo "</li>";
						}
					}
					?>
				</div>
				<div id="release_activity" class="content hide">
					<?php
					if(empty($releaseActivities)){
						echo "<h1>暂时没有发布的活动</h1>";
					}
					else{
						for($i=0;$i<count($releaseActivities);$i++){
							$temp=$releaseActivities[$i];
							echo "<li class='one_activity'>";
							echo "<a href='index.php?r=activity/view-activity&activityId=".$temp['id']."'>";
							echo "<img alt='walkinging' src='image/activity/walking.png'>";
							echo "</a>";
							echo "<div>";
							echo "<span>周期：</span> <label>".$temp->getTimeLong()."天</label><br/>";
							echo "<span>开始：</span> <label>".$temp['startdate']."</label><br/>";
							echo "<span>人数：</span> <label>".$temp->getAttendNum()."/".$temp['peoplenum']."人</label><br/>";
							$beginer = User::findUserById($temp['beginerId']);//得到创建者
							echo "<span>发起：</span> <label>".$beginer['username']."</label><br/>";
							echo "</div>";
							echo "</li>";
						}
					}
					?>
				</div>
				<div id="my_friends" class="content hide">
					<h1>我的好友</h1>
				</div>
				<div id="account_setting" class="content hide">
					<form onSubmit=false>
						<label>用户名：</label>
						<input type="textarea" class="form-control" id="usernameInput" value=<?=$thisuser['username']?>>
						<br>
						<button class="btn btn-lg btn-primary btn-block" type="button" onClick="set_username()">重置用户名</button>
					</form>
					<hr>
					<form onSubmit=false>
						<label>旧密码：</label>
						<input type="password" class="form-control" id="oldPasswordInput" placeholder="请输入旧密码">
						<label>新密码：</label>
						<input type="password" class="form-control" id="newPasswordInput" placeholder="请输入新密码">
						<label>确认新密码：</label>
						<input type="password" class="form-control" id="newPasswordComfirm" placeholder="确认新密码">
						<br>
						<label id="set_password_label" class="hide"></label>
						<button class="btn btn-lg btn-primary btn-block" type="button" onClick="set_password()">重置密码</button>			
					</form>			
				</div>
		</div>
	</div>
</div>
<?php
	$this->registerJsFile("@web/js/account/mypage.js");//添加js文件
	$this->registerJsFile("@web/js/account/d3.js");//添加js文件
?>
