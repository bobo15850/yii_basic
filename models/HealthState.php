<?php
namespace app\models;

class HealthState extends \yii\base\Object implements \yii\web\IdentityInterface
{
	public $uid;//用户id
	public $date;//日期
	public $height;//身高
	public $weight;//体重
	public $sleep;//睡眠时间
}
