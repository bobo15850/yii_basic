<?php
namespace app\models;

class FriendRequest extends \yii\base\Object implements \yii\web\IdentityInterface
{
    public $frid;//请求的id
    public $suid;//请求发送者的id
    public $ruid;//请求接收者的id
    public $time;//请求发送时间
    public $state;//请求状态，分为-1,0,1三种状态分别为拒绝，接受，未处理
}
