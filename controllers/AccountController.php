<?php
namespace app\controllers;
use yii\web\Controller;
use app\models\User;
use app\models\HealthState;
use yii;

class AccountController extends Controller
{	
	public function actionIndex(){
		$request=yii::$app->request;
		$session=yii::$app->session;
		if(!isset($session['user'])){
			//得到登陆信息
			$phonenumber=$request->post('phonenumber');
			$password=md5($request->post('password'));
			//得到数据库信息
			$user=User::findUserByPhone($phonenumber);//返回一维数组
			if (empty($user)) {
				return $this->render('login',['isError'=> 1]);
			}//用户名错误
			else{
				if(strcmp($user['password'],$password)==0){
					$session->open();//打开session
					$session['user']=$user;//设置session中的用户编号,之前用户尚未登陆
					return $this->render("index");
				}//密码正确
				else{
					return $this->render('login',['isError'=> 1]);
				}//密码错误
			}
		}else{
			return $this->render("index");//渲染模板
		}
	}//展示个人主页,登陆或者点击个人主页

	public function actionLogOut(){
		$session = yii::$app->session;
		unset($session['user']);
		return $this->render('login',['isError' => 0]);
	}//登出，点击退出登录

	public function actionToSign(){
		return $this->render("signUp");
	}//跳转到注册界面

	public function actionSignUp(){
		$request=yii::$app->request;
		$user = new User();
		//设置数据库里的每一位，验证放在前端js中
		$user['phonenumber'] = $request->post('phonenumber');
		$user['username'] = $request->post('username');
		$user['password'] = md5($request->post('password'));
		$user['icon'] = "icon";//设置默认的头像，可以修改
		$user['identity'] = 'a';//设置默认的身份，可以升级
		$user->save();
		return $this->render("login",['isError' => 0]);
	}//注册,并跳转到登陆界面

	public function actionLogin(){
		return $this->render("login");
	}//跳转到登陆界面

	public function actionCheckPhone(){
		$request= yii::$app->request;
		$phonenumber = $request->post('phonenumber');
		$user = User::findUserByPhone($phonenumber);
		if(empty($user)){
			return false;
		}else {
			return true;
		}
	}//检测手机号是否被注册过

	public function actionSetNowHealth(){
		$request = yii::$app->request;
		$session = yii::$app->session;
		$oldHealth = HealthState::getUserLatestHealth($session['user']->id);
		$isNewDay = 0;
		if(!($oldHealth['date']==date("Y-m-d"))){
			$isNewDay = 1;
			$oldHealth = new HealthState();
			$oldHealth['date'] = date('Y-m-d');
			$oldHealth['userId'] = $session['user']->id;
		}//是新的一天
		$oldHealth['height'] = floatval($request->post('heightInput'));
		$oldHealth['weight'] = floatval($request->post('weightInput'));
		$oldHealth['sleep'] = floatval($request->post('sleepInput'));
		$oldHealth['highblood'] = intval($request->post('highbloodInput'));
		$oldHealth['lowblood'] = intval($request->post('lowbloodInput'));
		$oldHealth['heartbeat'] = intval($request->post('heartbeatInput'));
		$oldHealth['step'] = intval($request->post('stepInput'));
		if($isNewDay){
			$oldHealth->save();
		}
		else{
			$oldHealth->update();
		}
		return $this->render("index");//渲染模板
	}//设置当前健康状态

	public function actionFindPassword(){
		return $this->render("findPassword");
	}//找回密码

	public function actionSetUsername(){
		$request = yii::$app->request;
		$session = yii::$app->session;
		$username = $request->post('username');
		$user = User::findOne($session['user']->id);
		if(!empty($user)){
			$user['username'] = $username;
			$user->update();
			unset($session['user']);
			$session['user'] = $user;
		}
		return true;
	}//设置用户名

	public function actionSetPassword(){
		$request = yii::$app->request;
		$session = yii::$app->session;
		$user = User::findOne($session['user']->id);
		if($user['password']==md5($request->post('oldPassword'))){
			$user['password'] = md5($request->post('newPassword'));
			$user->update();
			unset($session['user']);
			$session['user'] = $user;
			return true;
		}
		else{
			return false;
		}
	}//设置密码

	public function actionViewUser(){
		$request = yii::$app->request;
		return $this->render("viewUser",['otherUserId'=>$request->get('userId')]);
	}
}
?>