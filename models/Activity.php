<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "activity".
 *
 * @property integer $id
 * @property string $startdate
 * @property integer $peoplenum
 * @property string $finishdate
 * @property integer $beginerId
 */
class Activity extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'activity';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['startdate', 'peoplenum', 'finishdate', 'beginerId'], 'required'],
            [['peoplenum', 'beginerId'], 'integer'],
            [['startdate', 'finishdate'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'startdate' => 'Startdate',
            'peoplenum' => 'Peoplenum',
            'finishdate' => 'Finishdate',
            'beginerId' => 'Beginer ID',
        ];
    }

    public static function getInitActivities(){
    	$today=date('Y-m-d');//当前时间
    	$sql="select * from activity where startdate > ".$today." order by startdate limit 20";
    	$activities=self::findBySql($sql)->all();
    	return $activities;
    }//得到初始化活动管理界面所需要的活动，返回最近开始的20个活动

    public function getTimeLong(){
    	$sd = strtotime($this->startdate);//开始时间戳
    	$fd = strtotime($this->finishdate);//结束时间戳
    	return ceil(($fd-$sd)/86400);//86400表示一天的秒数
    }//得到活动周期

    public function getAttendNum(){
    	$sql="select * from attendActivity where activityId = ".$this->id;
    	$num=self::findBySql($sql)->count();
    	return $num;
    }//得到当前参加人数

    public static function findActivityById($id){
    	if(!is_numeric($id)){
            return array();
        }else{
            $activity=self::findOne($id);
            return $activity;
        }
    }//根据编号得到活动
}
