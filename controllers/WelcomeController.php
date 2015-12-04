<?php
namespace app\controllers;
use yii\web\Controller;

class WelcomeController extends Controller
{
	public function actionIndex(){
		return $this->render('index');
	}//跳转到活动主页
}
?>