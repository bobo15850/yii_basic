<?php
namespace app\models;

class WordsThumb extends \yii\base\Object implements \yii\web\IdentityInterface
{
    public $wtid;//点赞的id
    public $time;//点赞的时间
    public $uid//点赞人的id
    public $wid//被点赞的动态的id
}
