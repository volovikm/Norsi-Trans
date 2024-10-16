<?php

namespace app\models;

use yii\db\ActiveRecord;

class Item_type extends ActiveRecord
{
    public static function tableName()
     {
        return 'item_type';
     }

     public function getItems(){
      return $this->hasMany(Item::className(), ['item_type_id' => 'id']);
  }
}