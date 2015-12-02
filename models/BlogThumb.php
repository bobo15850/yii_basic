<?php
namespace app\models;

class BlogThumb extends \yii\base\Object implements \yii\web\IdentityInterface
{
    public $btid;//点赞的id
    public $time;//点赞的时间
    public $uid//点赞人的id
    public $bid//被点赞的博客的id
}
