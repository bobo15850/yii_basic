<?php
namespace app\models;

class Words extends \yii\base\Object implements \yii\web\IdentityInterface
{
    public $wid;//朋友圈动态编号 
    public $time;//发布时间
    public $uid;//发布者的id
    public $content;//发布的内容
    public $picture;//图片
}
