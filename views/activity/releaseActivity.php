<?php
$this->registerCssFile('@web/css/activity/oneActivity.css');
?>
<h1>发布活动</h1>
<form action="index.php?r=activity/release-activity" method="post" onsubmit="return check_release()">
	<input type="textarea" name="startdate" class="form-control" placeholder="开始日期yyyy-mm-dd格式" autofocus required>
	<input type="textarea" name="finishdate" class="form-control" placeholder="结束日期yyyy-mm-dd格式" required>
	<input type="textarea" name="peoplenum" class="form-control" placeholder="活动人数" required>
	<button class="btn btn-lg btn-primary btn-block" type="submit">发布</button>
</form>
<?php
$this->registerJsFile('@web/js/activity/oneActivity.js');
?>