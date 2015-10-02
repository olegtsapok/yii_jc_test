<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use Yii;
use app\models\Products;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Photos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="photos-form">

    <?php $form = ActiveForm::begin([
        'options' => [
            'enctype' => 'multipart/form-data',
        ]
    ]); ?>

    <img
        src="<?=Yii::getAlias('@web_uploads')?>/<?=$model->id?>.<?=$model->extension?>?name=<?=$model->name?>"
        width="150px"
    >
    <?= $form->field($model, 'photo')->fileInput() ?>
    <?= $form->field($model, 'product_id')
            ->dropDownList(
                    ArrayHelper::map(Products::find()->all(), 'id', 'name'),
                    ['prompt' => '']
            )  ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
