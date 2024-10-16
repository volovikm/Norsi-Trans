<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Item $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Комплектующие', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="item-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Удалить комплектующие?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        
        'attributes' => [
            'id',
            ['label' => 'Название', 'attribute' => 'name', 'value' => $model->name],
            ['label' => 'Тип', 'attribute' => 'item_type_name', 'value' => $model->itemType->name],
            ['label' => 'Добавлено', 'attribute' => 'added_at', 'value' => $model->added_at],
            ['label' => 'Обновлено', 'attribute' => 'updated_at', 'value' => $model->updated_at],
            ['label' => 'В наличие', 'attribute' => 'in_stock', 'value' => $model->convertInStock(true)],
        ],
    ]) ?>

</div>
