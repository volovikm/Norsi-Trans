<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Item;


class ItemSearch extends Item
{
    /**
    * {@inheritdoc}
    */
    public function rules()
    {
        return [
            [['id', 'item_type_id'], 'integer'],
            [['added_at', 'updated_at', 'name','in_stock','status'], 'safe'],
            [['item_type_name',], 'string'],
        ];
    }

    /**
    * {@inheritdoc}
    */
    public function scenarios()
    {return Model::scenarios();}

    //Создание экземпляра ActiveDataProvider с запросом поиска
    public function search($params)
    {
        $query = Item::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 100],
        ]);

        //join с таблицей item_type
        $query->joinWith("itemType", true,"INNER JOIN");

        //Дополнительные атрибуты
        $dataProvider->sort->attributes['item_type_name'] = [
            'asc' => ['item_type.name' => SORT_ASC],
            'desc' => ['item_type.name' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        //Фильтры поиска
        $query->andFilterWhere([
            'item.id' =>$this->id,
            'item.name' => $this->name,
            'item.added_at' => $this->added_at,
            'item.updated_at' => $this->updated_at,
            'item.in_stock' => $this->convertInStock(false,$this->in_stock), 
            'item.status' =>$this->convertStatus(false,$this->status),
        ]);

        $query->andFilterWhere(['LIKE', 'item.name', $this->name]);
        $query->andFilterWhere(['LIKE', 'item_type.name', $this->item_type_name]);

        return $dataProvider;
    }
}
