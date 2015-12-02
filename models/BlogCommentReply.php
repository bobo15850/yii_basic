<?php
namespace app\models;

class BlogCommentReply extends \yii\base\Object implements \yii\web\IdentityInterface
{
    public $bcrid;//回复id
    public $content;//回复的内容
    public $time;//回复的时间
    public $bid//回复的评论的id
}
