<?php

use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = 'dashboardempresa';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Felicitaciones!</h1>
        <p class="lead">Bienvenido al dashboard empresa.</p>        
    </div>

    <div class="body-content">
        <?= Html::a(
            'Mi Perfil',
            ['/usuarioempresa/updateperfil'],            
            ['class' => 'btn btn-default']
        ) ?>

    </div>
</div>