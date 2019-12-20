<?php

/* @var $this yii\web\View */

use yii\grid\GridView;
use yii\bootstrap\Html;
use yii\widgets\Pjax;

$this->title = 'SGS - Sistema de gerenciamento de senhas';
?>

<div class="site-index">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-6">
                    <h4>Chamada das senhas</h4>
                </div>
                <div class="col-md-6 text-right center-block">
                    <div class="btn-group">
                        <?= Html::button('Normal', [
                            'class' => 'btn btn-primary',
                            'onClick' => 'setAttendance("N")']) ?>
                        <?= Html::button('Preferencial', [
                            'class' => 'btn btn-primary',
                            'onClick' => 'setAttendance("P")']) ?>
                    </div>
                </div>
            </div>            
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <?php Pjax::begin(['id' => 'grid-pjax']); ?>
                    <?=
                        GridView::widget([
                            'dataProvider' => $dataProvider,
                            'layout' => '{items}{pager}',
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                                [
                                    'attribute' => 'queueid',
                                    'label' => 'Senha'
                                ],
                                [
                                    'attribute' => 'type',
                                    'label' => 'Tipo',
                                    'value' => function($model){
                                        return $model->type == 'N' ? 'Normal':'Preferencial';
                                    }
                                ],
                                [
                                    'attribute' => 'arrivaldatetime',
                                    'label' => 'Data/hora chegada',
                                    'format' => ['date', 'php:d/m/Y H:i:s']
                                ],
                                [
                                    'attribute' => 'user_id',
                                    'label' => 'Usuário',
                                    'value' => function($model){
                                        return $model->getUserName();
                                    }
                                ]                
                            ],
                        ]);
                    ?>
                    <?php Pjax::end(); ?>
                </div>
            </div>
        </div>
    </div>
    
</div>

<script>
    function setAttendance(type){
        $.ajax({
            url: 'index.php?r=site/set-attendance',
            type: 'post',
            dataType: 'json',
            data: {
                type: type
            },
            success: function(data, textStatus, jqXHR){// Anything data, String textStatus, jqXHR jqXHR
                if(data.save){
                    $.pjax.reload({container:"#grid-pjax",timeout: 5000});
                }
                else{
                    console.log('Erro ao gerar número de atendimento');
                }
            },
            error: function(jqXHR, textStatus, errorThrown){// jqXHR jqXHR, String textStatus, String errorThrown
                console.log(errorThrown);
            }/*,
             complete: function(jqXHR, textStatus){// jqXHR jqXHR, String textStatus
                console.log('complete');
                console.log(jqXHR);
                console.log(textStatus);
            } */
            
        });
    }
</script>