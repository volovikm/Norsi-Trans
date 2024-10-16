<?php

use app\models\Assembly;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\AssemblySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Assemblies';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="assembly-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Assembly', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'added_at',
            'updated_at',
            'name',
            'status',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Assembly $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
