<?php
namespace app\controllers;
use yii\web\Controller;

class AccountController extends Controller
{
	public $layout="frame";	
	public function actionIndex(){
		return $this->render('index');
	}
	public function actionSignUp(){
		echo "signup";
	}//注册

	public function actionLogin(){

	}//登陆

	public function actionLogout(){

	}//登出

	public function actionResetAccount(){

	}//账户设置

	public function acctionFindPassword(){

	}//找回密码

	public function actionDeleteAccount(){

	}//注销账户
}
?>