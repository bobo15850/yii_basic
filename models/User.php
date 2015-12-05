<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
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
            [['username', 'password', 'icon', 'phonenumber', 'identity'], 'required'],
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
            'id' => 'ID',
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

    public static function getNewId(){
        $sql="select * from user order by id desc limit 1";
        $user=self::findBySql($sql)->one();
        return $user['id']+1;
    }//返回新注册用户的id

    public static function findActivityAttendUsers($activityId){
        $sql = "select * from user where user.id in (select attendActivity.userId from attendActivity where activityId = ".$activityId.")";
        $users=self::findBySql($sql)->all();
        return $users;
    }//查询参加了某个活动的用户

    public function isAttendActivity($activityId){
        $sql="select * from attendActivity where activityId = ".$activityId." and userId = ".$this->id;
        $counter=self::findBySql($sql)->count();
        return $counter==1;
    }//判断某用户是否参加了某个活动
}
