<?php

use Yii;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\PhotosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Photos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="photos-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Photos', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id' => [
                'attribute' => 'id',
                'contentOptions' => ['style' => 'width:100px;'],
            ],
            'name',
            'extension',
            'photo' => [
                'label' => 'Photo',
                'format' => 'raw',
                'value' => function ($model, $key, $index, $column) {
                    return "<img
                        src='" . Yii::getAlias('@web_uploads') . "/{$model->id}.{$model->extension}?name={$model->name}'
                        width='150px'
                    >";
                }
            ],
            'product' =>             [
                'attribute' => 'product',
                'enableSorting' => true,
                'label' => 'Product',
                'value' => function ($model, $key, $index, $column) {
                    return $model->getProduct()->one() ? $model->getProduct()->one()->name : '';
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
