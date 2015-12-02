<?php
namespace app\models;

class BlogComment extends \yii\base\Object implements \yii\web\IdentityInterface
{
    public $bcid;//评论id
    public $content;//评论的内容
    public $time;//评论的时间
    public $uid//评论人的id
    public $bid//评论的博客的id
}
