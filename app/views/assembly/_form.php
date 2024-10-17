<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Item;
use app\models\Assembly_item;
use app\widgets\AssemblyItemGridview;
use yii\bootstrap5\Modal;

/** @var yii\web\View $this */
/** @var app\models\Assembly $model */
/** @var yii\widgets\ActiveForm $form */
/** @var app\models\Assembly_itemSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$assembly_item = new Assembly_item();
$item = new Item();
?>

<div class="assembly-form">

    <?php $form = ActiveForm::begin([
    'enableAjaxValidation' => true
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php 
    //Вывод списка комплектующих (Только в update, после create)
    if(Yii::$app->controller->action->id!="create")
    {
        echo '<p>';

        //Модальное окно добавления компонента
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
        ]);
        echo '</p>';

        //Содержимое модального окна
        echo '<div id="error_message" class="hint-block"></div>';

        echo $form->field($assembly_item, 'item_id',) //Поле выбора комплектующей
        ->dropDownList(
        $item->getItemsArray(),
        ['field_id'=>'item_id']);

        echo '<div style="display:none">';
        echo $form->field($model, 'id')->textInput(['field_id'=>'assembly_id','type'=>'hidden']);
        echo '</div>';

        echo $form->field($assembly_item, 'count',)->textInput(['type' => 'number','field_id'=>'count']);

        echo '<div class="form-group">';
        echo    Html::Button('Сохранить', ['id'=>'save_assembly_item','class' => 'btn btn-primary']);
        echo '</div>';

        Modal::end();

        //Таблица комплектующих данной сборки
        echo AssemblyItemGridview::widget(['assembly_id'=>$model->id]);
    }?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success','name'=>'save','id'=>'save_assembly']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
