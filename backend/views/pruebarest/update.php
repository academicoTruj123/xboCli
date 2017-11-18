<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Pruebarest */

$this->title = 'Update Pruebarest: ' . $model->idpruebarest;
$this->params['breadcrumbs'][] = ['label' => 'Pruebarests', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idpruebarest, 'url' => ['view', 'id' => $model->idpruebarest]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pruebarest-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
