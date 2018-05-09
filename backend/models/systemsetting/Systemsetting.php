<?php

namespace backend\models\systemsetting;

use Yii;

/**
 * This is the model class for table "systemsetting".
 *
 * @property integer $system_setting
 */
class Systemsetting extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'systemsetting';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['system_setting'], 'required'],
            [['default_time_allowance'], 'integer'],
            [['default_time_zone'], 'string', 'max' => 250]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'system_setting' => 'System Setting',
            'default_time_allowance' => 'Default Time Allowance',
            'default_time_zone' => 'Default Timezone',
        ];
    }
}
