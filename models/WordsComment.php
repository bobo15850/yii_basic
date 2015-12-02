<?php
namespace app\models;

class WordsComment extends \yii\base\Object implements \yii\web\IdentityInterface
{
    public $wcid;//评论id
    public $content;//评论的内容
    public $time;//评论的时间
    public $uid//评论人的id
    public $wid//评论的动态的id
}
