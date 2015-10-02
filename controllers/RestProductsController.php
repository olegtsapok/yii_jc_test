<?php

namespace app\controllers;

use Yii;
use app\models\Products;
use app\models\search\ProductsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RestProductsController implements the Rest actions for Products model.
 */
class RestProductsController extends Controller
{
    public function response($data)
    {
        exit(json_encode($data));
    }

    /**
     */
    public function actionProductDetails($id)
    {
        $product = Products::findOne($id);

        if (!$product) {
            $this->response([
                'error' => [
                    'code' => 404,
                    'message' => 'Not found',
                ],
            ]);
        }

        $response = [
            'product' => [
                'id' => $product->id,
                'name' => $product->name,
                'categories' => $this->getCategories($product),
                'photos' => $this->getPhotos($product),
                'discounts' => $this->getDiscounts($product),
            ],
        ];

        $this->response($response);
    }

    public function getCategories($product)
    {
        $categories = [];
        foreach ($product->getCategories()->all() as $model) {
            $categories[] = [
                'id' => $model->id,
                'name' => $model->name,
            ];
        }
        return $categories;
    }

    public function getPhotos($product)
    {
        $categories = [];
        foreach ($product->getPhotos()->all() as $model) {
            $categories[] = [
                'id' => $model->id,
                'name' => $model->name,
                'extension' => $model->extension,
                'path' => "http://" . $_SERVER['SERVER_NAME'] .
                    Yii::getAlias('@web_uploads'). "/{$model->id}.{$model->extension}",
            ];
        }
        return $categories;
    }

    public function getDiscounts($product)
    {
        $categories = [];
        foreach ($product->getDiscounts()->all() as $model) {
            $categories[] = [
                'id' => $model->id,
                'amount' => $model->amount,
                'quantity_products' => $model->quantity_products,
            ];
        }
        return $categories;
    }

}
