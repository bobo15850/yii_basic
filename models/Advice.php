<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "advice".
 *
 * @property integer $id
 * @property integer $userId
 * @property integer $advicerId
 * @property string $content
 * @property string $createdAt
 * @property integer $isRead
 */
class Advice extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'advice';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userId', 'advicerId', 'content', 'createdAt', 'isRead'], 'required'],
            [['userId', 'advicerId', 'isRead'], 'integer'],
            [['content'], 'string', 'max' => 1024],
            [['createdAt'], 'string', 'max' => 32]
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
            'content' => 'Content',
            'createdAt' => 'Created At',
            'isRead' => 'Is Read',
        ];
    }

    public static function getAdvices($userId,$isRead,$AdvicerIdentity){
        $sql="select * from advice where userId = '".$userId."' and isRead = ".$isRead." and advicerId in 
                (select id from user where user.identity = '".$AdvicerIdentity."') order by createdAt desc";
        $advices = self::findBySql($sql)->all();
        if(!empty($advices)){
            for($i=0;$i<count($advices);$i++){
                $advices[$i]->setRead();
            }
        }
        return $advices;
    }//根据用户编号，是否读过，建议者身份得到建议

    private function setRead(){
        $this->isRead = 1;
        $this->update();
    }//设置为已读
}
