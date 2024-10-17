<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Assembly_item;

/**
 * Assembly_itemSearch represents the model behind the search form of `app\models\Assembly_item`.
 */
class Assembly_itemSearch extends Assembly_item
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'assembly_id', 'item_id', 'count', 'status'], 'integer'],
            [['added_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params,$assembly_id)
    {
        $query = Assembly_item::find()->where(['assembly_id'=>$assembly_id]);

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
            'asc' => ['item.item_type.name' => SORT_ASC],
            'desc' => ['item.item_type.name' => SORT_DESC],
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
            'assembly_item.status' => $this->status,
        ]);

        $query->andFilterWhere(['LIKE', 'item.name', $this->item_name]);
        $query->andFilterWhere(['LIKE', 'item.item_type.name', $this->item_type_name]);

        return $dataProvider;
    }
}
