<?php
namespace app\controllers;

use yii;
use yii\web\Controller;
use app\models\Activity;
use app\models\User;
use app\models\AttendActivity;

class ActivityController extends Controller
{
	public function actionIndex(){
		$activities=Activity::getInitActivities();
		return $this->render('index',['activities' => $activities]);
	}//跳转到活动主页

	public function actionViewActivity(){
		$request = yii::$app->request;
		$activityId = $request->get('activityId');
		$activity = Activity::findActivityById($activityId);
		$attendUsers = User::findActivityAttendUsers($activityId);
		return $this->render("oneActivity",['activity' => $activity,'attendUsers' => $attendUsers]);
	}//查看活动详情

	public function actionToRelease(){
		return $this->render('releaseActivity');
	}//到发布活动页面

	public function actionReleaseActivity(){
		$request = yii::$app->request;
		$session = yii::$app->session;
		$user = $session['user'];
		$activity = new Activity();
		$activity['id'] = Activity::getNewActivityId();
		$activity['startdate'] = $request->post('startdate');
		$activity['finishdate'] = $request->post('finishdate');
		$activity['peoplenum'] = intval($request->post('peoplenum'));
		$activity['beginerId'] = $user['id'];
		$activity->save();
		return $this->render("oneActivity",['activity' => $activity,'attendUsers' => array()]);
	}//确认发布活动

	public function actionJoinActivity(){
		$request = yii::$app->request;
		$session = yii::$app->session;
		$attendActivity = new AttendActivity();
		$attendActivity['activityId'] = $request->post('activityId');
		$attendActivity['userId'] = $session['user']->id;
		$attendActivity['attendAt'] = date('Y-m-d H:i:s');
		$attendActivity->save();//这里本该有是否执行成功的判断，之后补上
		return true;
	}//参加活动

	public function actionQuitActivity(){
		$request = yii::$app->request;
		$session = yii::$app->session;
		$attendActivity = new AttendActivity();
		$attendActivity['activityId'] = $request->post('activityId');
		$attendActivity['userId'] = $session['user']->id;
		$attendActivity->deleteThis();
		return true;
	}//退出活动

	public function actionDeleteActivity(){
		
	}//删除活动

	public function actionModifyActivity(){

	}//修改活动

	public function actionSelectActivity(){

	}//筛选活动
}
?>