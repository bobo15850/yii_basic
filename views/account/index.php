<?php
	$this->registerCssFile('@web/css/account/mypage.css');

	$session = yii::$app->session;
	$thisuser = $session['user'];
?>
<div class="container">
	<div class="row">
		<div class="col-sm-3">
			<div class="my_info">
					<div class="portrait">
						<img alt="头像" src="image/mypage/portrait.png">
					</div>
					<h3><?=$thisuser['username']?></h3>
			</div>
			<div class="sidenav list-group">
				<button type="button" id="health_manage_bar" class="list-group-item active" onclick="clickBar(this)">
					健康管理 <span class="badge">2</span>
				</button>
				<button type="button" id="my_friends_bar" class="list-group-item" onclick="clickBar(this)">
					我的好友 <span class="badge">4</span>
				</button>
				<button type="button" id="people_follow_bar" class="list-group-item" onclick="clickBar(this)">
					关注的人 <span class="badge">6</span>
				</button>
				<button type="button" id="my_activity_bar" class="list-group-item" onclick="clickBar(this)">
					我的活动 <span class="badge">1</span>
				</button>
				<button type="button" id="my_blog_bar" class="list-group-item" onclick="clickBar(this)">
					我的博文 <span class="badge">3</span>
				</button>
				<button type="button" id="my_interest_bar" class="list-group-item" onclick="clickBar(this)">
					我的兴趣 <span class="badge">5</span>
				</button>
				<button type="button" id="system_message_bar" class="list-group-item" onclick="clickBar(this)">
					系统消息 <span class="badge">6</span>
				</button>
			</div>
		</div>
		<div class="col-sm-9">
				<div id="health_manage" class="content show">
					<ul class="nav nav-pills">
						<li role="presentation" id="now_health_bar" class="health_state_bar active" onclick="changeHealthBar(this)">
							<a href="#">当前状态</a>
						</li>
						<li role="presentation" id="past_week_health_bar" class="health_state_bar" onclick="changeHealthBar(this)">
							<a href="#">过去一周</a>
						</li>
						<li role="presentation" id="past_month_health_bar" class="health_state_bar" onclick="changeHealthBar(this)">
							<a href="#">过去一月</a>
						</li>
						<li role="presentation" id="past_3month_health_bar" class="health_state_bar" onclick="changeHealthBar(this)">
							<a href="#">过去三月</a>
						</li>
						<li role="presentation" id="my_ideal_health_bar" class="health_state_bar" onclick="changeHealthBar(this)">
							<a href="#">我的目标</a>
						</li>
					</ul>
					<div id="now_health" class="health_state_content show">
						<form action="index.php?r=account/set-now-health" method="post" onSubmit="return check_healthState()">
							<label>身高(cm)：</label><input type="textarea" class="form-control" name="heightInput" value=<?=$nowHealth['height']?>>
							<label>体重(kg)：</label><input type="textarea" class="form-control" name="weightInput" value=<?=$nowHealth['weight']?>>
							<label>睡眠(h)：</label><input type="textarea" class="form-control" name="sleepInput" value=<?=$nowHealth['sleep']?>>
							<label>步数：</label><input type="textarea" class="form-control" name="stepInput" value=<?=$nowHealth['step']?>>
							<label>最后更新：<?=$nowHealth['date']?></label>
							<button class="btn btn-lg btn-primary btn-block" type="submit">重置当前健康状态</button>
						</form>
					</div>
					<div id="past_week_health" class="health_state_content hide">
						<h1>过去一周健康状态折线图</h1>
					</div>
					<div id="past_month_health" class="health_state_content hide">
						<h1>过去一个月健康状态折线图</h1>
					</div>
					<div id="past_3month_health" class="health_state_content hide">
						<h1>过去三个月健康状态折线图</h1>
					</div>
					<div id="my_ideal_health" class="health_state_content hide">
						<h1>我的理想健康状态</h1>
					</div>
				</div>
				<div id="my_friends" class="content hide">
					<h1>我的好友</h1>
				</div>
				<div id="people_follow" class="content hide">
					<h1>关注的人</h1>
				</div>
				<div id="my_activity" class="content hide">
					<h1>我的活动</h1>
				</div>
				<div id="my_blog" class="content hide">
					<h1>我的博文</h1>
				</div>
				<div id="my_interest" class="content hide">
					<h1>我的兴趣</h1>
				</div>
				<div id="system_message" class="content hide">
					<h1>系统消息</h1>
				</div>
		</div>
	</div>
</div>
<?php
	$this->registerJsFile("@web/js/account/mypage.js");//添加js文件
?>
