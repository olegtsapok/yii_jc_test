<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "discounts".
 *
 * @property integer $id
 * @property integer $product_id
 * @property integer $amount
 * @property integer $quantity_products
 *
 * @property Products $product
 */
class Discounts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'discounts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'amount', 'quantity_products'], 'integer'],
            [['amount', 'quantity_products'], 'required']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'amount' => 'Amount',
            'quantity_products' => 'Quantity Products',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Products::className(), ['id' => 'product_id']);
    }
}
