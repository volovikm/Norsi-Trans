<?php

namespace app\models;

use yii\db\ActiveRecord;

class Assembly extends ActiveRecord
{
    public static function tableName()
    {
       return 'assembly';
    }

    //Метки атрибутов
    public function attributeLabels()
    {
        return [
            'name' => 'Название',
            'added_at' =>'Дата добавления',
            'updated_at' =>'Дата обновления',
            'status' => 'Статус'
        ];
    }
}