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

   //Необходимые поля модели
   public function rules()
   {
      return [
         [['name', 'item_type_id','in_stock'], 'required'],
         [['status'], 'safe'],
      ];
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

   //Метод преобразования значения status в текст и обратно для вывода и поиска
   public function convertStatus($to_text=false,$text="") {

      if($to_text) return ($this->statusValuesArr()[$this->status]);
      else
      {
         switch(trim(mb_strtolower($text))){
            case "активна": return 1;
            case "удалена": return 2;
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

   //Массив возможных значений status
   public function statusValuesArr()
   {
      return([
         1=>"Активна",
         2=>"Удалена"
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
            'in_stock' => 'В наличие',
            'status' => 'Статус',
        ];
   }

   //Метод нахождения всех компонентов
    public function getItemsArray()
    {
        $items_arr=$this::find()->where(['status'=>'1'])->asArray()->all();

        $result_arr=[];
        foreach($items_arr as $item)
        {
            $result_arr+=[$item["id"]=>$item["name"]];
        }

        return($result_arr);
    }
}