<?php
$this->registerCssFile('@web/css/activity/oneActivity.css');
?>
<h1>修改活动</h1>
<form action="index.php?r=activity/modify-activity" method="post" onsubmit="return check_modify()">
	<label>开始日期：<?=$activity['startdate']?></label><br>
	<label>开始日期：<?=$activity['finishdate']?></label><br>
	<label>人数：</label>
	<input class="hide" name="activityId" value=<?=$activity['id']?>>
	<input type="textarea" name="peoplenum" class="form-control" value=<?=$activity['peoplenum']?> placeholder="活动人数" required>
	<br>
	<button class="btn btn-lg btn-primary btn-block" type="submit">确定修改</button>
</form>
<?php
$this->registerJsFile('@web/js/activity/oneActivity.js');
?>