<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $userid
 * @property string $username
 * @property string $password
 * @property string $icon
 * @property string $phonenumber
 * @property string $identity
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'username', 'password', 'icon', 'phonenumber', 'identity'], 'required'],
            [['userid'], 'integer'],
            [['username'], 'string', 'max' => 32],
            [['password', 'icon'], 'string', 'max' => 128],
            [['phonenumber'], 'string', 'max' => 16],
            [['identity'], 'string', 'max' => 1]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'userid' => 'Userid',
            'username' => 'Username',
            'password' => 'Password',
            'icon' => 'Icon',
            'phonenumber' => 'Phonenumber',
            'identity' => 'Identity',
        ];
    }

    public static function findUserById($uid){
        if(!is_numeric($uid)){
            return array();
        }else{
            $user=self::findOne($uid);
            return $user;
        }
    }//通过编号查找用户

    public static function findUserByPhone($phonenumber){
        $user=self::findOne(['phonenumber' => $phonenumber]);
        return $user;
    }//通过电话查找用户

    public static function getNewUserId(){
        $sql="select * from user order by userid desc limit 1";
        $user=self::findBySql($sql)->one();
        return $user['userid']+1;
    }//返回新注册用户的id
}
