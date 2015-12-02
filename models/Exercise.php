<?php
namespace app\models;

class Exercise extends \yii\base\Object implements \yii\web\IdentityInterface
{
    public $uid;//用户id
    public $date;//日期
    public $step;//步数
    public $distance;//距离
}
