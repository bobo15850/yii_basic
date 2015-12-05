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
			$password=$request->post('password');
			//得到数据库信息
			$user=User::findUserByPhone($phonenumber);//返回一维数组
			if (empty($user)) {
				return $this->render('login',['isError'=> 1]);
			}//用户名错误
			else{
				if(strcmp($user['password'],$password)==0){
					$session->open();//打开session
					$session['user']=$user;//设置session中的用户编号,之前用户尚未登陆
					$nowHealth = HealthState::getUserLatestState($user->id);
					return $this->render("index",['nowHealth'=>$nowHealth]);
				}//密码正确
				else{
					return $this->render('login',['isError'=> 1]);
				}//密码错误
			}
		}else{
			$nowHealth = HealthState::getUserLatestState($session['user']->id);
			return $this->render("index",['nowHealth'=>$nowHealth]);//渲染模板
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
		$userId = User::getNewUserId();//得到新的用户编号
		//设置数据库里的每一位，验证放在前端js中
		$user['id'] = $userId;
		$user['phonenumber'] = $request->post('phonenumber');
		$user['username'] = $request->post('username');
		$user['password'] = $request->post('password');
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
		$nowHealth = new HealthState();
		$nowHealth['userId'] = $session['user']->id;
		$nowHealth['date'] = date("Y-m-d");
		$nowHealth['height'] = floatval($request->post('heightInput'));
		$nowHealth['weight'] = floatval($request->post('weightInput'));
		$nowHealth['sleep'] = floatval($request->post('sleepInput'));
		$nowHealth['step'] = intval($request->post('stepInput'));
		$beforeHealth = HealthState::getUserLatestState($session['user']->id);
		if($beforeHealth['date']==$nowHealth['date']){//判断是否为当天更新
			$beforeHealth['step'] = $nowHealth['step'];
			$beforeHealth['height'] = $nowHealth['height'];
			$beforeHealth['weight'] = $nowHealth['weight'];
			$beforeHealth['sleep'] = $nowHealth['sleep'];
			$beforeHealth->update();
		}//是当天更新
		else{
			$nowHealth->save();
		}//不是当天更新
		$nowHealth = HealthState::getUserLatestState($session['user']->id);
		return $this->render("index",['nowHealth'=>$nowHealth]);//渲染模板
	}//设置当前健康状态

	public function actionFindPassword(){
		return $this->render("findPassword");
	}//找回密码

	public function actionResetAccount(){

	}//账户设置

	public function actionDeleteAccount(){

	}//注销账户
}
?>