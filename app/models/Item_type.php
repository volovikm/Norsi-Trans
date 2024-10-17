<?php

namespace app\models;

use yii\db\ActiveRecord;

class Item_type extends ActiveRecord
{
    public static function tableName()
    {
        return 'item_type';
    }

     //Связь с таблицей item по ключу item.item_type_id = item.id 
    public function getItems(){
      return $this->hasMany(Item::className(), ['item_type_id' => 'id']);
    }

    //Метод нахождения всех типов компонентов
    public function getItemTypesArray()
    {
        $item_types_arr=$this::find()->asArray()->all();

        $result_arr=[];
        foreach($item_types_arr as $type)
        {
            $result_arr+=[$type["id"]=>$type["name"]];
        }

        return($result_arr);
    }
}