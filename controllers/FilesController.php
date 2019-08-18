<?php

namespace app\controllers;

use app\models\WhateverYourModel;
use Yii;
use yii\helpers\FileHelper;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\UploadedFile;

class FilesController extends Controller
{
    public function actionImageUpload()
    {
        $model = new WhateverYourModel();

        $model->newFile = UploadedFile::getInstance($model, 'newFile');
        Yii::setAlias('@uploads','./uploads');
        $directory = Yii::getAlias('@uploads');
        if (!is_dir($directory)) {
            FileHelper::createDirectory($directory);
        }

        if ($model->newFile) {
            $realName = $model->newFile->baseName . '.' . $model->newFile->extension;
            $fileName = md5(time() . rand(1, 9999) . $model->newFile->baseName) . '.' . $model->newFile->extension;
            $subdirname1 = $fileName[0];
            $subdirname2 = $fileName[1];
            if (!file_exists($directory . '/' . $subdirname1 . '/' . $subdirname2)) {
                mkdir($directory . '/' .
                    $subdirname1 . '/' .
                    $subdirname2, 0777, true);
            }
            if (file_exists($directory . '/' .
                $subdirname1 . '/' .
                $subdirname2)) {
                $filePath = $directory . '/' .
                    $subdirname1 . '/' .
                    $subdirname2 . '/' . $fileName;
                if ($model->newFile->saveAs($filePath)) {
                    $path = $directory . '/' .
                        $subdirname1 . '/' .
                        $subdirname2 . '/' . $fileName;
                    return Json::encode([
                        'files' => [
                            [
                                'name' => $fileName,
                                'size' => $model->newFile->size,
                                'url' => $path,
                                'thumbnailUrl' => $path,
                                'deleteUrl' => 'files/image-delete?name=' . $fileName,
                                'deleteType' => 'POST',
                            ],
                        ],
                    ]);
                }
            }
        }
        return $this->render('files', ['model' => $model]);
    }

    public function actionImageDelete($name)
    {
        Yii::setAlias('@uploads','./uploads');
        $directory = Yii::getAlias('@uploads');
        $subdirname1 = $name[0];
        $subdirname2 = $name[1];
        if (is_file($directory . '/' . $subdirname1 . '/' .
            $subdirname2 . '/' . $name)) {
            unlink($directory . '/' . $subdirname1 . '/' .
                $subdirname2 . '/' . $name);
        }

        $files = FileHelper::findFiles($directory . '/' . $subdirname1 . '/' .
            $subdirname2);
        $output = [];
        foreach ($files as $file) {
            $fileName = basename($file);
            $path = $directory . '/' .
                $subdirname1 . '/' .
                $subdirname2 . '/' . $fileName;
            $output['files'][] = [
                'name' => $fileName,
                'size' => filesize($file),
                'url' => $path,
                'thumbnailUrl' => $path,
                'deleteUrl' => 'files/image-delete?name=' . $fileName,
                'deleteType' => 'POST',
            ];
        }
        return Json::encode($output);
    }

}?>dfdfdfdfdfdfdf