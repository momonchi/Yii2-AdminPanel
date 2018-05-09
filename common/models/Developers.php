<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "developers".
 *
 * @property integer $devid
 * @property string $name
 * @property string $api_token
 */
class Developers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'developers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'api_token'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'devid' => 'Devid',
            'name' => 'Name',
            'api_token' => 'Api Token',
        ];
    }
}
