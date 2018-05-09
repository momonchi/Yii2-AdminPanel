<?php

namespace backend\models\admin;

use Yii;

class Developer extends \yii\db\ActiveRecord
{    
    public $token = "d8ccb5bd3487e0a2ef4a8222372be6e9";
    public static function findToken()
    {
        return new static($token);
    }
          
}
?>