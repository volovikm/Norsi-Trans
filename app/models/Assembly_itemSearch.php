<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Assembly_item;

class Assembly_itemSearch extends Assembly_item
{
    /**
    * {@inheritdoc}
    */
    
    public function rules()
    {
        return [
            [[ 'assembly_id', 'item_id',], 'integer'],
        ];
    }

    /**
    * {@inheritdoc}
    */
    public function scenarios()
    {return Model::scenarios();}

    //Создание экземпляра ActiveDataProvider с запросом поиска
    public function search($params,$assembly_id)
    {
        $query = Assembly_item::find()->where(['assembly_id'=>$assembly_id,'assembly_item.status'=>1]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 20],
        ]);

        //join с таблицей item
        $query->joinWith("item", true,"INNER JOIN");

        //Дополнительные атрибуты
        $dataProvider->sort->attributes['item_name'] = [
            'asc' => ['item.name' => SORT_ASC],
            'desc' => ['item.name' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['item_type_name'] = [
            'asc' => ['item.item_type_id' => SORT_ASC],
            'desc' => ['item.item_type_id' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        //Фильтры поиска
        $query->andFilterWhere([
            'assembly_item.id' => $this->id,
            'assembly_item.added_at' => $this->added_at,
            'assembly_item.updated_at' => $this->updated_at,
            'assembly_item.assembly_id' => $this->assembly_id,
            'assembly_item.item_id' => $this->item_id,
            'assembly_item.count' => $this->count,
            'assembly_item.status' => $this->convertStatus(false,$this->status),
        ]);

        $query->andFilterWhere(['LIKE', 'item.name', $this->item_name]);
        $query->andFilterWhere(['LIKE', 'item.itemType.name', $this->item_type_name]);

        return $dataProvider;
    }
}