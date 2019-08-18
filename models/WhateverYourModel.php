<?php

namespace app\models;

use yii\base\Model;

class WhateverYourModel extends Model
{
    public $newFile;
    public function rules()
    {
        return [
            ['newFile', 'required'],
            [['newFile'], 'file', 'extensions' => 'jpg'],

        ];
    }
}