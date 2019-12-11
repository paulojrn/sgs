<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'SGS - Sistema de gerenciamento de senhas';
?>

<div class="site-index">
    <div>
        <center><h1>Sistema de gerenciamento de senhas</h1></center>
    </div>

    <div class="body-content">
        <div class="row center-block" style="width: 50%; margin-top: 5%;">
            <div class="col-md-12">
                <?php $form = ActiveForm::begin([
                    'id' => 'login-form',
                ]); ?>

                <?= $form->field($loginModel, 'username')->textInput(['autofocus' => true]) ?>
                <?= $form->field($loginModel, 'password')->passwordInput() ?>

                <div class="form-group" style="text-align:center; margin-top: 5%;">
                    <?= Html::submitButton('Entrar', ['class' => 'btn btn-primary', 'name' => 'login-button', 'style' => 'width: 20%;']) ?>              
                </div>

                <?php ActiveForm::end(); ?>

            </div>            
        </div>

    </div>
</div>