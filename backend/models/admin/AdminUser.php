<?php

namespace backend\models\admin;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $email
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $verify_code
 * @property integer $status
 * @property string $title_prefix
 * @property string $fname
 * @property string $mname
 * @property string $lname
 * @property integer $role
 * @property string $user_type
 * @property integer $accountid
 *
 * @property Admin[] $admins
 * @property Invoice[] $invoices
 * @property Messages[] $messages
 * @property Rating[] $ratings
 * @property Trucker $account
 */
class AdminUser extends \yii\db\ActiveRecord
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
            [['username', 'email','fname', 'lname'], 'required'],
            [['email','username'], 'unique'],
            [['created_at', 'updated_at', 'status'], 'integer'],
            [['username', 'verify_code'], 'string', 'max' => 50],
            [['email'], 'string', 'max' => 150],
            [['auth_key', 'title_prefix'], 'string', 'max' => 45],
            [['password_hash', 'password_reset_token'], 'string', 'max' => 255],
            [['fname', 'mname', 'lname'], 'string', 'max' => 100],
            [['user_type'], 'string', 'max' => 20]
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
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'date_verified' => 'Date Verified',
            'is_veriied' => 'Is Veriied',
            'verify_code' => 'Verify Code',
            'status' => 'Status',
            'title_prefix' => 'Title Prefix',
            'fname' => 'First Name',
            'mname' => 'Middle Name',
            'lname' => 'Last Name',
            'user_type' => 'User Type'
        ];
    }



    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdmins()
    {
        return $this->hasMany(Admin::className(), ['userid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoices()
    {
        return $this->hasMany(Invoice::className(), ['billto_userid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMessages()
    {
        return $this->hasMany(Messages::className(), ['to_userid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRatings()
    {
        return $this->hasMany(Rating::className(), ['to_userid' => 'id']);
    }


    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

}
