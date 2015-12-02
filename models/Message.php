<?php
namespace app\models;

class Message extends \yii\base\Object implements \yii\web\IdentityInterface
{
	public $mid;//消息的id
	public $suid;//消息发送者的id
	public $ruid;//消息接收者的id
	public $content;//消息内容
	public $state;//消息的状态，为已读和未读
}
