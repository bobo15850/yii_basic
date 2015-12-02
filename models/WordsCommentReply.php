<?php
namespace app\models;

class WordsCommentReply extends \yii\base\Object implements \yii\web\IdentityInterface
{
    public $wcrid;//回复id
    public $content;//回复的内容
    public $time;//回复的时间
    public $wcid//回复的评论的id
}
