<?php
namespace app\controllers;

use yii;
use yii\web\Controller;
use app\models\Activity;
use app\models\User;

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

	public function actionAddActivity(){

	}//添加活动

	public function actionDeleteActivity(){

	}//删除活动

	public function actionSelectActivity(){

	}//筛选活动

	public function actionJoinActivity(){

	}//参加活动

	public function actionQuitActivity(){

	}//退出活动
}
?>