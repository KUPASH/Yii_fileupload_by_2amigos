<?php

namespace app\models;


class Users extends \yii\db\ActiveRecord
{
    public function rules()
    {
        return [
            ['login', 'required'],
            ['password', 'required'],
        ];
    }
}