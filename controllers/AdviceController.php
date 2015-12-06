<?php
namespace app\controllers;
use yii\web\Controller;
use app\models\User;
use app\models\HealthState;
use app\models\Advice;
use app\models\AdviceRequest;
use yii;

class AdviceController extends Controller{
	public function actionIndex(){
		$session = yii::$app->session;
		if(!isset($session['user'])){
			return $this->render("notLogin");
		}
		$identity = $session['user']->identity;
		if($identity=='a'){
			return $this->render("commonUser");
		}//普通用户
		else if($identity=='b'){
			return $this->render("trainer");
		}//健身教练
		else if($identity=='c'){
			return $this->render("doctor");
		}//医生
	}//做到权限管理

	public function actionGetAdvice(){
		Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;//设置返回值为json格式
		$request = yii::$app->request;
		$userId = $request->post('userId');
		$isRead = $request->post('isRead');
		$advicerIdentity = $request->post('advicerIndentity');
		$advices = Advice::getAdvices($userId,$isRead,$advicerIdentity);
		return $advices;
	}//根据用户编号，是否读过，建议者身份得到建议

	public function actionRequestAdvice(){
		$request = yii::$app->request;
		$userId = $request->post('userId');
		$advicerIdentity = $request->post('advicerIndentity');
		$adviceRequest = new AdviceRequest();
		$adviceRequest['userId'] = $userId;
		if($advicerIdentity=='b'){
			$adviceRequest['advicerId'] = 3;	
		}
		else if($advicerIdentity=='c'){
			$adviceRequest['advicerId'] = 9;
		}
		$adviceRequest['isRead'] = 0;
		$adviceRequest['createdAt'] = date('Y-m-d H:i:s');
		$adviceRequest->save();
		return true;
	}//请求建议

	public function actionGiveAdvice(){
		$request = yii::$app->request;
		$advice = new Advice();
		$advice['userId'] = $request->post('userId');
		$advice['advicerId'] = $request->post('advicerId');
		$advice['content'] = $request->post('content');
		$advice['createdAt'] = date('Y-m-d H:i:s');
		$advice['isRead'] = 0;
		$advice->save();
		$adviceRequest = AdviceRequest::findOne($request->post('requestId'));
		$adviceRequest->setRead();
		return true;
	}
}
?>