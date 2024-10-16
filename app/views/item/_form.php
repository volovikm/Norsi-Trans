<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Item_type;

/** @var yii\web\View $this */
/** @var app\models\Item $model */
/** @var yii\widgets\ActiveForm $form */

$item_type=new Item_type;

//Значение поля выбора типа комплектующей
$type_dropdown_value=""; //Значение типа по-умолчанию
if(isset($model->itemType->attributes["id"]))
{$type_dropdown_value=$model->itemType->attributes["id"];}

?>

<div class="item-form">

    <?php $form = ActiveForm::begin([
    'enableAjaxValidation' => true
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'item_type_id') //Поле выбора типа комплектующей
    ->dropDownList(
        $item_type->getItemTypesArray(),
        ["value"=>$type_dropdown_value]);
    ?>

    <?= $form->field($model, 'in_stock') //Поле выбора "В наличие"
    ->dropDownList(
        $model->inStockValuesArr(),
        ["value"=>$model->in_stock]);
    ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success','name'=>'save']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
