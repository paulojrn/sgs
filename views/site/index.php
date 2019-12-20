<?php

/* @var $this yii\web\View */

use yii\grid\GridView;
use yii\bootstrap\Html;
use yii\widgets\Pjax;
use Yii;

$this->title = 'SGS - Sistema de gerenciamento de senhas';
?>

<div class="site-index">
    <?php if(isset(Yii::$app->user->identity) && (Yii::$app->user->identity->profile == 'G')){ ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>Administrativo</h4>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <fieldset>
                            <legend>Chamadas</legend>
                            
                            <?= Html::button('Chamar senha', [
                                'class' => 'btn btn-success',
                                'onClick' => 'removeAttendance()']) ?> 
                        </fieldset>                                               
                    </div>
                </div>
                <div class="row" style="margin-top: 1%;">
                    <div class="col-md-12">
                        <fieldset>
                            <legend>Reiniciar senha</legend>
                                <?= Html::button('Normais', [
                                    'class' => 'btn btn-danger',
                                    'onClick' => 'resetCounters("N")']) ?>
                                <?= Html::button('Preferenciais', [
                                    'class' => 'btn btn-danger',
                                    'onClick' => 'resetCounters("P")']) ?>
                                <?= Html::button('TODAS', [
                                    'class' => 'btn btn-danger',
                                    'onClick' => 'resetCounters("A")']) ?>
                        </fieldset>
                    </div>
                </div>
                
            </div>
        </div>
    <?php } ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-6">
                    <h4>Chamada das senhas</h4>
                </div>
                <div class="col-md-6 text-right center-block">
                    <label for="btns-group" style="margin-right: 3%">Gerar senha:</label>
                    <div class="btn-group"id="btns-group">
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
                            'emptyText' => 'Sem resultados encontrados',
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
            }            
        });
    }
    
    function removeAttendance(){
        $.ajax({
            url: 'index.php?r=site/remove-attendance',
            type: 'post',
            dataType: 'json',
            success: function(data, textStatus, jqXHR){// Anything data, String textStatus, jqXHR jqXHR
                if(data.remove){
                    $.pjax.reload({container:"#grid-pjax",timeout: 5000});
                }
                else{
                    console.log('Erro ao chamar um número de atendimento');
                }
            },
            error: function(jqXHR, textStatus, errorThrown){// jqXHR jqXHR, String textStatus, String errorThrown
                console.log(errorThrown);
            }            
        });
    }
    
    function resetCounters(param){
        $.ajax({
            url: 'index.php?r=site/reset-counters',
            type: 'post',
            dataType: 'json',
            data: {
                param: param
            }
        });
    }
</script>