<?php

/* @var $this yii\web\View */

$this->title = 'Informações';

?>
<div class="site-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>Sobre o sistema</h4>
        </div>
        <div class="panel-body">
            <p><b>O sistema para testes pode ser utilizado das seguintes formas:</b></p>
            <ul>
                <li>Sem logar:
                    <ul>
                        <li>Possível selecionar senha normal ou preferencial</li>
                    </ul>
                </li>                
                <li>Logando como usuário:
                    <ul>
                        <li>Possível selecionar senha normal ou preferencial</li>
                        <li>É identificado pelo nome</li>
                    </ul>
                <li>Logando como admin:
                    <ul>
                        <li>Possível selecionar senha normal ou preferencial</li>
                        <li>É identificado pelo nome</li>
                        <li>Pode reiniciar as senhas</li>
                        <li>Pode chamar uma senha</li>
                    </ul>
                </li>
            </ul>
            
            <p><b>Para logar os seguintes usuários estão disponíveis:</b></p>
            <ul>
                <li>Usuário 1:
                    <ul>
                        <li>Login: usuario1</li>
                        <li>Senha: u1</li>
                    </ul>                    
                </li>
                <li>Usuário 2:
                    <ul>
                        <li>Login: usuario2</li>
                        <li>Senha: u2</li>
                    </ul>
                </li>
                <li>Gerência:
                    <ul>
                        <li>Login: gerente</li>
                        <li>Senha: g</li>
                    </ul>
                </li>
            </ul>
            
            <p><b>O código pode ser encontrado em: </b><a href="https://github.com/PauloJRN/sgs/tree/dev">https://github.com/PauloJRN/sgs/tree/dev</a></p>
        </div>
    </div>
</div>
