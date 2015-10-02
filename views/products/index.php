<?php

use yii\helpers\Html;
use yii\grid\GridView;

use Yii;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\ProductsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Products', ['create'], ['class' => 'btn btn-success']) ?>
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
            'categories' =>             [
                'label' => 'Categories',
                'value' => function ($model, $key, $index, $column) {
                    return Yii::$app->cpCategories->categoriesToDisplay($model);
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
