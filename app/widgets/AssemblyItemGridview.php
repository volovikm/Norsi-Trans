<?php
namespace app\widgets;

use yii\grid\GridView;
use yii\base\Widget;
use yii\helpers\Html;
use app\models\Assembly_itemSearch; 

class AssemblyItemGridview extends Widget
{
    /*
        Виджет вывода списка компонентов сборки
    */

    public $assembly_id;
    public $show_buttons=true;

    public function run()
    {
        //searchModel для gridview комплектующих
        $searchModel = new Assembly_itemSearch();
        $dataProvider = $searchModel->search([],$this->assembly_id);

        $config_columns=[
            'id',
            ['attribute' => 'item_type_name', 'value' =>'item.itemType.name'],
            ['attribute' => 'item_name', 'value' =>'item.name'],
            'added_at',
            'updated_at',
            'count',
            ['attribute' => 'status', 'value' => function($model){return $model->convertStatus(true);}],
        ];

        //Кнопки списка компонентов сборки
        if($this->show_buttons) 
        {
            $assembly_item_buttons = [[
            'class' => 'yii\grid\ActionColumn',
            'template' => '{delete}',
            'buttons' => [
                    'delete' => function ($url, $assembly_item,$id) {
                        return Html::a('Удалить', ['/assembly_item/delete', 'id' => $assembly_item->id],[]);
                    },
                ]
            ]];

            $config_columns=array_merge($config_columns,$assembly_item_buttons);
        }

        return 
        Html::tag('label', 'Комплектующие сборки', ['class' => 'control-label']).
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => $config_columns,
        ]);
    }
}