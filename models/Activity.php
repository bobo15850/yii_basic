<?php
namespace app\models;

class Activity extends \yii\base\Object implements \yii\web\IdentityInterface
{
    public $aid;
    public $kind;//活动类型
    public $time;//活动周期
    public $people;//活动人数
    public $start;//活动开始时间
    public $beginerId;//发起者id
}
