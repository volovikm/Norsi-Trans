<?php

use app\models\Item;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\ItemSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Комплектующие';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить комплектующие', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>

    <?= 

    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            'id',
            ['label' => 'Название', 'attribute' => 'name', 'value' => 'name'],
            ['label' => 'Тип', 'attribute' => 'item_type_name', 'value' =>'itemType.name'],
            ['label' => 'Дата добавления', 'attribute' => 'added_at','value' =>'added_at'],
            ['label' => 'Дата обновления','attribute' => 'updated_at','value' => 'updated_at'],
            ['label' => 'В наличие','attribute' => 'in_stock','value' => function($model){return $model->convertInStock(true);}],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Item $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model["id"]]);
                 }
            ],
        ],
    ]); 
    ?>

    <?php Pjax::end(); ?>

</div>
