<?php

namespace backend\models\admin;

use Yii;

/**
 * This is the model class for table "admin".
 *
 * @property integer $admin_id
 * @property integer $userid
 * @property integer $role_id
 * @property string $position
 * @property string $department
 *
 * @property AdminRole $role
 * @property User $user
 */
class Admin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'adminuser';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid'], 'required'],
            [['userid', 'role_id'], 'integer'],
            [['position'], 'string', 'max' => 45]

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'admin_id' => 'Admin ID',
            'userid' => 'Userid',
            'role_id' => 'Role ID',
            'position' => 'Position',
            'fname' => 'First Name',
            'lname' => 'Last Name',
            'mname' => 'Middle Name',
            'email' => 'Email',
            'username' => 'Username',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(AdminRole::className(), ['role_id' => 'role_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(AdminUser::className(), ['id' => 'userid']);
    }

    public static  function  getRoles(){
          $roles = AdminRole::find()->all();
          $roles_out = ArrayHelper::map($roles, 'role_id', 'role_title');
          return $roles_out;
    }

}
