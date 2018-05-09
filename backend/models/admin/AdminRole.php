<?php

namespace backend\models\admin;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "admin_role".
 *
 * @property integer $role_id
 * @property string $role_title
 * @property string $page_permissions
 *
 * @property Admin[] $admins
 */
class AdminRole extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'adminrole';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [                             
            [['role_title'], 'required'],    
            [['page_permissions'], 'string'],     
            [['role_title'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'role_id' => 'Role ID',
            'roletitle' => 'Role Title',  
            'page_permissions' => 'Page Permissions',          
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdmins()
    {
        return $this->hasMany(Admin::className(), ['role_id' => 'role_id']);
    }


    public static  function  getRoles(){
          $roles = AdminRole::find()->all();
          $roles_out = ArrayHelper::map($roles, 'role_id', 'role_title');
          return $roles_out;
    }


}
