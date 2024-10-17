<?php

namespace app\models;

use yii\db\ActiveRecord;

class Assembly_item extends ActiveRecord
{
    public $item_name;
    public $item_type_name;

    public static function tableName()
    {
       return 'assembly_item';
    }

    //Необходимые поля модели
    public function rules()
    {
        return [
            [['count','item_id','assembly_id'], 'required'],
            [['item_id','assembly_id'], 'integer']
        ];
    }

    //Связь с таблицей assembly
    public function getAssembly() {
        return $this->hasOne(Assembly::className(), ['id' => 'assembly_id']);
    }

    //Связь с таблицей item
    public function getItem() {
        return $this->hasOne(Item::className(), ['id' => 'item_id']);
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
            'item_id'=>'Комплектующие',
            'item_name' => 'Название',
            'item_type_name' => 'Тип',
            'count'=>'Количество',
       ];
  }
}