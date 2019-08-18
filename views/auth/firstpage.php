<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin() ?>
<?= $form->field($model, 'login') ?>
<?= $form->field($model, 'password')?>

<div class="form-group" xmlns="http://www.w3.org/1999/html">
    <div class="col-lg-offset-1 col-lg-11">
        <?= Html::submitButton('Login', ['class' => 'btn btn-primary']) ?>
    </div>
</div>

<?php ActiveForm::end();

//$form = ActiveForm::begin() ?>
<?//= $form->field($model, 'login') ?>
<?//= $form->field($model, 'password')?>
<!---->
<!--<div class="form-group" xmlns="http://www.w3.org/1999/html">-->
<!--    <div class="col-lg-offset-1 col-lg-11">-->
<!--        --><?//= Html::submitButton('Sign Up', ['class' => 'btn btn-primary']) ?>
<!--    </div>-->
<!--</div>-->
<!---->
<?php //ActiveForm::end() ?>
