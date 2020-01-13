<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
?>
<div class="site-login">
    
    <div class="body-content">
        <div class="row center-block" style="width: 50%; margin-top: 5%;">
            <div class="col-md-12">
                <?php $form = ActiveForm::begin([
                    'id' => 'login-form'
                ]); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
                <?= $form->field($model, 'password')->passwordInput() ?>

                <div class="form-group" style="text-align:center; margin-top: 5%;">
                    <?= Html::submitButton('Entrar', ['class' => 'btn btn-primary', 'name' => 'login-button', 'style' => 'width: 20%;']) ?>              
                </div>

                <?php ActiveForm::end(); ?>

            </div>            
        </div>

    </div>
</div>