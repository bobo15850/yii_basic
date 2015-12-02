<?php
namespace app\controllers;
use yii\web\Controller;
use yii\web\cookie;

class HelloController extends Controller{
	public $layout="common";
	public function actionIndex(){
		// echo "hello";
		$res=\yii::$app->response;
		// $res->headers->add('pragma','no-cache');
		// $res->headers->set('pragma','max-age =5');
		// $res->headers->remove('pragma');
		$request =\yii::$app->request;
		//跳转
		// $res->headers->add('location','http://www.baidu.com');
		// $this->redirect("http://www.baidu.com",302);

		//文件下载
		// $res->headers->add('content-disposition','attachment;filename="a.jpg"');
		// $this->sendFile('./b.jpg');
		$session=\yii::$app->session;
		// $session->open();
		// if($session->isActive){
		// 	echo "session isActive";
		// }
		// $session->set("user","zhangsan");\
		// echo $session->get("user");
		// $session->remove("user");

		// $session["user"]="zhangsan";
		// echo $session["user"];
		// unset($session["user"]);

		$cookies=\yii::$app->response->cookies;
		// $cookie_data=array("name" => "user", "value"=> "zhangsan");
		// $cookies->add(new Cookie($cookie_data));//cookies都被加密过
		// $cookies->remove("user");
		$cookies_get=\yii::$app->request->cookies;
		// echo $cookies_get->getValue("user","没有找到");


		//创建一个数组
		// $data = array();
		// $hello_str="hello god <script>alert(123);</script>";
		// $arr=array(1,2,3);
		//把需要传递的数据放在数组中
		// $data["view_hello_str"]=$hello_str;
		// $data["view_hello_arr"]=$arr;
		// return $this->renderPartial("index",$data);

		
		// return $this->render("about");

		// return $this->renderPartial("help");

		return $this->render("about");
	}
} 