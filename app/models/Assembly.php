<?php

namespace app\models;

use yii\db\ActiveRecord;

class Assembly extends ActiveRecord
{
    public static function tableName()
    {
       return 'assembly';
    }

    //Необходимые поля модели
    public function rules()
   {
      return [
         [['id','name'], 'required'],
         //[['status'], 'string'],
      ];
    }

    //Связь с таблицей assembly_item
    public function getAssemblyItem() {
        return $this->hasMany(Assembly_item::className(), ['assembly_id' => 'id']);
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
            'id'=>'id',
            'name' => 'Название',
            'added_at' =>'Дата добавления',
            'updated_at' =>'Дата обновления',
            'status' => 'Статус'
        ];
    }
}