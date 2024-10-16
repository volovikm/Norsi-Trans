<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Assembly $model */

$this->title = 'Редактировать сборку: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Сборки', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="assembly-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
