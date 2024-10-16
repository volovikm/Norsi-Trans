<?php

namespace app\models;

use yii\db\ActiveRecord;

class Assembly_item extends ActiveRecord
{
    public static function tableName()
    {
       return 'assembly_item';
    }

    //Связь с таблицей assembly
    public function getAssembly() {
        return $this->hasOne(Assembly::className(), ['id' => 'assembly_id']);
    }

    //Связь с таблицей item
    public function getItem() {
        return $this->hasOne(Item::className(), ['id' => 'item_id']);
    }
}