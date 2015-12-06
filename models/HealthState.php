<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "healthState".
 *
 * @property integer $id
 * @property integer $userId
 * @property string $date
 * @property integer $highblood
 * @property integer $lowblood
 * @property double $height
 * @property integer $heartbeat
 * @property double $weight
 * @property double $sleep
 * @property integer $step
 */
class HealthState extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'healthState';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userId', 'date', 'highblood', 'lowblood', 'height', 'heartbeat', 'weight', 'sleep', 'step'], 'required'],
            [['userId', 'highblood', 'lowblood', 'heartbeat', 'step'], 'integer'],
            [['date'], 'string'],
            [['height', 'weight', 'sleep'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'userId' => 'User ID',
            'date' => 'Date',
            'highblood' => 'Highblood',
            'lowblood' => 'Lowblood',
            'height' => 'Height',
            'heartbeat' => 'Heartbeat',
            'weight' => 'Weight',
            'sleep' => 'Sleep',
            'step' => 'Step',
        ];
    }

    public static function getUserLatestHealth($userId){
        $sql="select * from healthState where userId = '".$userId."' and date <> 'goal' order by date desc limit 1";
        $healthState = self::findBySql($sql)->one();
        return $healthState;
    }//得到某个用户最近的健康状况

    public static function getUserIdealHealth($userId){
        $sql="select * from healthState where userId = '".$userId."' and date = 'goal'";
        $healthState = self::findBySql($sql)->one();
        return $healthState;
    }//得到某个用户的理想健康状态

    public static function getMonthHealth($userId){
        $sql = "select * from healthState where userId = ".$userId." order by date desc limit 30";
        $healthStates = self::findBySql($sql)->all();
        return $healthStates;
    }
}
