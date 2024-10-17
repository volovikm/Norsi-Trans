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
            [['count','item_id','assembly_id'], 'integer']
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