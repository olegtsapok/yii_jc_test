<?php
namespace app\components;

use Yii;
use yii\web\UploadedFile;

class Photos
{
    public function upload($model)
    {
        if (Yii::$app->request->isPost) {
            $model->photo = UploadedFile::getInstance($model, 'photo');

            if ($model->validate() and $model->photo) {
                $model->photo->saveAs(Yii::getAlias('@uploads') . '/' .
                    $model->id . '.' .
                    $model->photo->extension
                );
                $model->name = $model->photo->baseName;
                $model->extension = $model->photo->extension;
                $model->save();
            }
        }
    }
}
