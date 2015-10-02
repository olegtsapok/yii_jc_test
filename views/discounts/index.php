<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\DiscountsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Discounts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="discounts-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Discounts', ['create'], ['class' => 'btn btn-success']) ?>
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
            'product' =>             [
                'attribute' => 'product',
                'enableSorting' => true,
                'label' => 'Product',
                'value' => function ($model, $key, $index, $column) {
                    return $model->getProduct()->one() ? $model->getProduct()->one()->name : '';
                }
            ],

            'amount',
            'quantity_products',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
