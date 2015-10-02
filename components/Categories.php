<?php
namespace app\components;

use app\models\Categories as CategoriesModel;

class Categories
{
    public function categoriesToDisplay($model)
    {
        $toDisplay = '';
        foreach ($model->categories as $name => $id) {
            $toDisplay .= " {$name}";
        }
        return $toDisplay;
    }

    public function saveCategories($model)
    {
        // Unlink all categories first
        $model->unlinkAll('categories', true);
        if (is_array($model->categories) && count($model->categories) > 0) {
            // Link categories
            foreach ($model->categories as $category) {
                $category = CategoriesModel::findOne($category);
                $model->link('categories', $category);
            }
        }
    }

}