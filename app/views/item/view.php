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
                'confirm' => 'Удалить/вернуть комплектующие?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        
        'attributes' => [
            'id',
            'name',
            ['attribute' => 'item_type_name', 'value' => $model->itemType->name],
            'added_at',
            'updated_at',
            ['attribute' => 'in_stock', 'value' => $model->convertInStock(true)],
            ['attribute' => 'status', 'value' => $model->convertStatus(true)],
        ],
    ]) ?>

</div>
