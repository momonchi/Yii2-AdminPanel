<?php

namespace common\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "admin_users".
 *
 * @property integer $id
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $create_date
 * @property string $update_at
 * @property string $name
 * @property string $role
 * @property string $mobile_no
 * @property integer $contact_no
 * @property integer $status
 */
class AdminUsers extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin_users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_date', 'update_at'], 'safe'],
            [['contact_no', 'status'], 'integer'],
            [['username'], 'string', 'max' => 150],
            [['email', 'role', 'auth_key'], 'string', 'max' => 255],
            [['password'], 'string', 'max' => 32],
            [['name'], 'string', 'max' => 50],
            [['mobile_no'], 'string', 'max' => 25]
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
            'email' => 'Email',
            'password' => 'Password',
            'create_date' => 'Create Date',
            'update_at' => 'Update At',
            'name' => 'Name',
            'role' => 'Role',
            'mobile_no' => 'Mobile No',
            'contact_no' => 'Contact No',
            'status' => 'Status',
            'auth_key' => 'Auth Key',
        ];
    }
    
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }
    
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    public function setPassword($password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }
    
    public function getAuthKey() {
        return $this->auth_key;
    }
    
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    public function getId() {
        return $this->getPrimaryKey();
    }

    public function validateAuthKey($authKey) {
        return $this->getAuthKey() === $authKey;
    }
    
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    public static function findIdentityByAccessToken($token, $type = null) {
        
    }

}
