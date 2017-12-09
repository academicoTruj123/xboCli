<?php

use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = 'Cliente';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Felicitaciones!</h1>
        <p class="lead">Bienvenido al dashboard cliente.</p>        
    </div>

    <div class="body-content">

        <?= Html::a(
            'Mi Perfil',
            ['/usuariocliente/updateperfil'],            
            ['class' => 'btn btn-default']
        ) ?>
        

        
        
    </div>
</div>
