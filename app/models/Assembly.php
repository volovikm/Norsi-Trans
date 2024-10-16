<?php

namespace app\models;

use yii\db\ActiveRecord;

class Assembly extends ActiveRecord
{
    public static function tableName()
    {
       return 'assembly';
    }
}