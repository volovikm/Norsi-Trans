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
         [['name'], 'required'],
      ];
   }

    //Связь с таблицей assembly_item
    public function getAssemblyItem() {
        return $this->hasMany(Assembly_item::className(), ['assembly_id' => 'id']);
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