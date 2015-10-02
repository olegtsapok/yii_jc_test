<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use app\models\Products;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Discounts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="discounts-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'product_id')
            ->dropDownList(
                ArrayHelper::map(Products::find()->all(), 'id', 'name'),
                ['prompt' => '']
            )  ?>

    <?= $form->field($model, 'amount')->textInput() ?>

    <?= $form->field($model, 'quantity_products')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
