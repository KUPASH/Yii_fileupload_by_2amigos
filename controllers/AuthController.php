<?php
namespace app\controllers;

use app\models\LoginForm;
use app\models\Users;
use \yii\web\Controller;
use Yii;
class AuthController extends Controller
{
    public function actionLogin()
    {
        $model = new LoginForm();

        if(\Yii::$app->request->post()) {
            $model->load(\Yii::$app->request->post());
            $user = Users::find()->where('login=:login',[':login' => $model->login])->one();
            if (!empty($user)) {
                $salt = \Yii::$app->params['salt'];
                $saltedPassword = md5($model->password . $salt);
                if ($user['password'] == $saltedPassword) {
                    $session = Yii::$app->session;
                    $session->open();
                    $session->set('id', $user['id']);
                    return $this->redirect(['files/filesharing']);
                }


            }

        }

        return $this->render('firstpage', ['model' => $model]);


    }
}
