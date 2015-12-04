<?php
use app\mdoels\Activity;
use app\models\User;

$this->registerCssFile('@web/css/activity/activity.css');
?>
<div id="main_body">
		<!-- 以下是活动的筛选栏 -->
		<div id="activity_selection">
			<div id="activity_time" class="selection_bar">
				<span class="option_name">活动周期：</span>
				<div class="btn-group">
					<button type="button" class="btn btn-primary" id="all_time">不限</button>
					<button type="button" class="btn btn-default" id="one_to_two_day">一到两天</button>
					<button type="button" class="btn btn-default" id="three_to_five_day">三到五天</button>
					<button type="button" class="btn btn-default" id="one_week">一周左右</button>
					<button type="button" class="btn btn-default" id="two_week">两周左右</button>
					<button type="button" class="btn btn-default" id="one_month">一月左右</button>
					<button type="button" class="btn btn-default" id="three_month">三个月左右</button>
					<button type="button" class="btn btn-default" id="more_three_month">三个月以上</button>
				</div>
			</div>
			<div id="activity_people" class="selection_bar">
				<span class="option_name">活动人数：</span>
				<div class="btn-group">
					<button type="button" class="btn btn-primary" id="all_people">不限</button>
					<button type="button" class="btn btn-default" id="two">两人PK</button>
					<button type="button" class="btn btn-default" id="three_to_five">3-5人</button>
					<button type="button" class="btn btn-default" id="five_to_ten">5-10人</button>
					<button type="button" class="btn btn-default" id="ten_to_twenty">10-20人</button>
					<button type="button" class="btn btn-default" id="twenty_to_fifty">20-50人</button>
					<button type="button" class="btn btn-default" id="fifty_to_hundred">50-100人</button>
					<button type="button" class="btn btn-default" id="one_to_two_hundred">100-200人</button>
					<button type="button" class="btn btn-default" id="two_to_five_hundred">200-500人</button>
					<button type="button" class="btn btn-default" id="more_five_hundred">500人以上</button>
				</div>
			</div>
			<div id="activity_start" class="selection_bar">
				<span class="option_name">开始时间：</span>
				<div class="btn-group">
					<button type="button" class="btn btn-primary" id="all_start">不限</button>
					<button type="button" class="btn btn-default" id="started">已开始</button>
					<button type="button" class="btn btn-default" id="less_two_day_start">两天以内</button>
					<button type="button" class="btn btn-default" id="two_to_five_day_start">2-5天</button>
					<button type="button" class="btn btn-default" id="five_to_eight_day_start">5-8天</button>
					<button type="button" class="btn btn-default" id="ten_to_thirty_day_start">10-30天</button>
					<button type="button" class="btn btn-default" id="more_thirty_day_start">30天以上</button>
				</div>
			</div>
		</div>

		<!-- 以下是依据以上的搜索条件查找到的活动列表 ，活动列表以块状形式展示，每行展示四个活动-->
		<div id="activities">
			<!-- 一个活动的细节展示包括活动类型，周期，人数（已参加人数/总人数），开始时间，活动详情，发起者等信息 -->
			<ul class="activity_list">
				<?php
				if((!isset($activities))||empty($activities)){
					echo "<h1>暂无活动可以参加</h1>";
				}else{
					for($i=0;$i<count($activities);$i++){
						$temp=$activities[$i];
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
					}//展示所有初始化的活动
				}
				?>
			</ul>
		</div>
	</div>