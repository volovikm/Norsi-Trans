<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Item;

/** @var yii\web\View $this */
/** @var app\models\Assembly $model */
/** @var yii\widgets\ActiveForm $form */

$item=new Item;


$item_arr=$item->getItemsArray(); //Массив всех комплектующих

?>

<div class="assembly-form">

    <?php $form = ActiveForm::begin([
    'enableAjaxValidation' => true
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success','name'=>'save']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
