<?php

namespace app\models;

use yii\base\Model;

class LoginForm extends Model
{
    public $login;
    public $password;
    public function rules()
    {
        return [
            ['login', 'required'],
            ['password', 'required'],
        ];
    }
}