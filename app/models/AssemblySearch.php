<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Assembly;

class AssemblySearch extends Assembly
{
    /**
    * {@inheritdoc}
    */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['added_at', 'updated_at', 'name','status'], 'safe'],
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
        $query = Assembly::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 100],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        //Фильтры поиска
        $query->andFilterWhere([
            'id' => $this->id,
            'added_at' => $this->added_at,
            'updated_at' => $this->updated_at,
            'assembly.status' => $this->convertStatus(false,$this->status),
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}