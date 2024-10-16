<?php

namespace app\models;

use yii\db\ActiveRecord;

class Item extends ActiveRecord
{
   public $item_type_name;

   public static function tableName()
   {
      return 'item';
   }

   //Связь с таблицей item_type
   public function getItemType(){
      return $this->hasOne(Item_type::className(), ['id' => 'item_type_id']);
  }

   //Метод преобразования значения in_stock в текст и обратно для вывода и поиска
   public function convertInStock($to_text=false,$text="") {

      if($to_text) return $this->in_stock ? "Есть" : "Нет";
      else
      {
         switch(trim(mb_strtolower($text))){
            case "есть": return 1;
            case "нет": return 0;
         }
      }
   }
}