<?php
namespace app\controllers;
use yii\web\Controller;
use app\models\User;
use yii;

class AccountController extends Controller
{	
	public $enableCsrfValidation = false;

	public function actionIndex(){
		$request=yii::$app->request;
		$session=yii::$app->session;
		if(!isset($session['user'])){
			//得到登陆信息
			$phonenumber=$request->post('phonenumber');
			$password=$request->post('password');
			//得到数据库信息
			$user=User::findUserByPhone($phonenumber);
			if ($user==null) {
				return $this->render('login',['isError'=> 1]);
			}//用户名错误
			else{
				if(strcmp($user->getPassword(),$password)==0){
					$session->open();//打开session
					$session['user']=$user;//设置session中的用户编号,之前用户尚未登陆
					return $this->render("index",['user'=>$user]);
				}//密码正确
				else{
					return $this->render('login',['isError'=> 1]);
				}//密码错误
			}
		}else{
			return $this->render('index',['user' => $session['user']]);//渲染模板
		}
	}//展示个人主页

	public function actionSignUp(){
		return $this->render("signUp");
	}//注册

	public function actionLogin(){
		return $this->render("login");
	}//跳转到登陆界面

	public function actionFindPassword(){
		return $this->render("findPassword");
	}//找回密码

	public function actionLogOut(){
		$session = yii::$app->session;
		unset($session['user']);
		return $this->render('login',['isError' => 0]);
	}//登出

	public function actionResetAccount(){

	}//账户设置

	public function actionDeleteAccount(){

	}//注销账户
}
?>