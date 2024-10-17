<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Item;
use app\models\Assembly_item;
use app\models\Assembly_itemSearch; 
use app\controllers\Assembly_itemController;
use yii\grid\GridView;
use yii\bootstrap5\Modal;

/** @var yii\web\View $this */
/** @var app\models\Assembly $model */
/** @var yii\widgets\ActiveForm $form */
/** @var app\models\Assembly_itemSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

//searchModel для gridview комплектующих
$searchModel = new Assembly_itemSearch();
$dataProvider = $searchModel->search([],$model->id);

$assembly_item = new Assembly_item();
$item = new Item();

//Кнопки списка компонентов сборки
$assembly_item_buttons =   ['class' => 'yii\grid\ActionColumn',
    'template' => '{delete}',

    'buttons' => [
        'delete' => function ($url, $assembly_item,$id) {
            return Html::a('Удалить', ['/assembly_item/delete', 'id' => $assembly_item->id],[]);
        },
    ]

    ];
?>

<div class="assembly-form">

    <?php $form = ActiveForm::begin([
    'enableAjaxValidation' => true
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>



    <p>
    <?php //Модальное окно добавления компонента
    Modal::begin([
        'id'=>'assembly_item_modal',
        'title'=>'Добавление комплектующих в сборку',
        'toggleButton' => [
            'label' => 'Добавить комплектующие в сборку',
            'class' => 'btn btn-success'
        ],
        'closeButton'=>[
            'id'=>'close_modal_button',
        ]
    ]);?>
    </p>

    <div id="error_message" class="hint-block"></div>

    <?= $form->field($assembly_item, 'item_id',) //Поле выбора комплектующей
    ->dropDownList(
        $item->getItemsArray(),
        ['field_id'=>'item_id']);
    ?>

    <div style="display: none">
    <?= $form->field($model, 'id')->textInput(['field_id'=>'assembly_id']) ?>
    </div>
    
    <?= $form->field($assembly_item, 'count',)->textInput(['type' => 'number','field_id'=>'count']) ?>

    <div class="form-group">
        <?= Html::Button('Сохранить', ['id'=>'save_assembly_item','class' => 'btn btn-primary']) ?>
    </div>

    <?php Modal::end(); ?>



    <?= Html::tag('label', 'Комплектующие сборки', ['class' => 'control-label']) ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['attribute' => 'item_name', 'value' =>'item.name'],
            ['attribute' => 'item_type_name', 'value' =>'item.itemType.name'],
            'count',
            $assembly_item_buttons,
        ],
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success','name'=>'save']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
