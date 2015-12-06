<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "adviceRequest".
 *
 * @property integer $id
 * @property integer $userId
 * @property integer $advicerId
 * @property string $createdAt
 * @property integer $isRead
 */
class AdviceRequest extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'adviceRequest';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userId', 'advicerId', 'createdAt', 'isRead'], 'required'],
            [['userId', 'advicerId', 'isRead'], 'integer'],
            [['createdAt'], 'string']
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
            'advicerId' => 'Advicer ID',
            'createdAt' => 'Created At',
            'isRead' => 'Is Read',
        ];
    }

    public static function getUnHandledRequest($advicerId){
        $sql = "select * from adviceRequest where advicerId = ".$advicerId." and isRead = 0 order by createdAt";
        $request = self::findBySql($sql)->all();
        return $request;
    }//得到某人未处理的请求

    public function setRead(){
        $this->isRead = 1;
        $this->update();
    }
}
