<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "products".
 *
 * @property integer $id
 * @property string $name
 *
 * @property Discounts[] $discounts
 * @property Photos[] $photos
 * @property ProductsCategoriesCrossref[] $productsCategoriesCrossrefs
 * @property Categories[] $categories
 */
class Products extends \yii\db\ActiveRecord
{
    public $categories;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
            [['categories'], 'safe', ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    public function afterFind() {
        parent::afterFind();

        $this->categories = ArrayHelper::map($this->getCategories()->all(), 'name', 'id');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiscounts()
    {
        return $this->hasMany(Discounts::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhotos()
    {
        return $this->hasMany(Photos::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductsCategoriesCrossrefs()
    {
        return $this->hasMany(ProductsCategoriesCrossref::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Categories::className(), ['id' => 'category_id'])->viaTable('products_categories_crossref', ['product_id' => 'id']);
    }
}
