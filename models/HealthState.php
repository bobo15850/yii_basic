<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "healthState".
 *
 * @property integer $id
 * @property integer $userId
 * @property string $date
 * @property double $height
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
            [['userId', 'date', 'height', 'weight', 'sleep', 'step'], 'required'],
            [['userId', 'step'], 'integer'],
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
            'height' => 'Height',
            'weight' => 'Weight',
            'sleep' => 'Sleep',
            'step' => 'Step',
        ];
    }

    public static function getUserLatestState($userId){
        $sql="select * from healthState where userId = '".$userId."' and date <> 'goal' order by date desc limit 1";
        $healthState = self::findBySql($sql)->one();
        return $healthState;
    }//得到某个用户最近的健康状况
}
