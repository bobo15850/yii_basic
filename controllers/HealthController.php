<?php
namespace app\controllers;
use yii\web\Controller;
use app\models\HealthState;
use yii;

class HealthController extends Controller
{

	public function actionGetHealthStateByTime(){

	}//通过时间长度得到健康情况

	public function actionSetIdealHealth(){
		$request = yii::$app->request;
		$session = yii::$app->session;
		$oldIdeal = HealthState::getUserIdealHealth($session['user']->id);
		$hasSet = 1;
		if(empty($oldIdeal)){
			$hasSet=0;
			$oldIdeal = new HealthState();
			$oldIdeal['date'] = "goal";
			$oldIdeal['userId'] = $session['user']->id;
		}
		$oldIdeal['height'] = floatval($request->post('idealHeight'));
		$oldIdeal['weight'] = floatval($request->post('idealWeight'));
		$oldIdeal['sleep'] = floatval($request->post('idealSleep'));
		$oldIdeal['highblood'] = intval($request->post('idealHighblood'));
		$oldIdeal['lowblood'] = intval($request->post('idealLowblood'));
		$oldIdeal['heartbeat'] = intval($request->post('idealHeartbeat'));
		$oldIdeal['step'] = intval($request->post('idealStep'));
		if($hasSet){
			$oldIdeal->update();			
		}
		else{
			$oldIdeal->save();
		}
		return true;
	}//设置目标健康状况

	public function actionGetIdealHealth(){
		Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$session = yii::$app->session;
		$thisUserId = $session['user']->id;
		$healthState = HealthState::getUserIdealHealth($thisUserId);
		return $healthState;
	}//得到理想健康状态

	public function actionGetMonthStep(){
		Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$session = yii::$app->session;
		$healthStates = HealthState::getMonthHealth($session['user']->id);
		$steps = array();
		for($i=0;$i<count($healthStates);$i++){
			$steps[$i] = $healthStates[$i]->step;
		}
		return $steps;
	}//得到最近一个月的运动情况
}
?>