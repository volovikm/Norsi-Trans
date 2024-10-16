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

      if($to_text) return ($this->inStockValuesArr()[$this->in_stock]);
      else
      {
         switch(trim(mb_strtolower($text))){
            case "есть": return 1;
            case "нет": return 0;
         }
      }
   }

   //Массив возможных значений in_stock
   public function inStockValuesArr()
   {
      return([
         0=>"Нет",
         1=>"Есть"
      ]);
   }

   //Метки атрибутов
   public function attributeLabels()
    {
        return [
            'name' => 'Название',
            'item_type_name' => 'Тип',
            'item_type_id' => 'Тип',
            'added_at' =>'Дата добавления',
            'updated_at' =>'Дата обновления',
            'in_stock' => 'В наличие'
        ];
      }
}