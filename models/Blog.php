<?php
namespace app\models;

class Blog extends \yii\base\Object implements \yii\web\IdentityInterface
{
    public $bid;//博客的id
    public $kind;//博文所属分类
    public $title;//博文标题
    public $content;//博文内容
    public $time;//博文建立时间
    public $uid;//博文作者id
}
