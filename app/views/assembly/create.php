<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Assembly $model */

$this->title = 'Create Assembly';
$this->params['breadcrumbs'][] = ['label' => 'Assemblies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="assembly-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
