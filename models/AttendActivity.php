<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "attendActivity".
 *
 * @property integer $id
 * @property integer $userId
 * @property integer $activityId
 * @property string $attendAt
 */
class AttendActivity extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'attendActivity';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userId', 'activityId', 'attendAt'], 'required'],
            [['userId', 'activityId'], 'integer'],
            [['attendAt'], 'string', 'max' => 32]
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
            'activityId' => 'Activity ID',
            'attendAt' => 'Attend At',
        ];
    }

    public function deleteThis(){
        $attendActivity = self::findOne(['userId' => $this->userId,'activityId'=>$this->activityId]);
        $attendActivity->delete();
    }//删除当前的参加记录
}
