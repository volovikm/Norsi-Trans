<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Assembly $model */

$this->title = 'Update Assembly: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Assemblies', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="assembly-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
