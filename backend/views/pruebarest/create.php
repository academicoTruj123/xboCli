<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Pruebarest */

$this->title = 'Create Pruebarest';
$this->params['breadcrumbs'][] = ['label' => 'Pruebarests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pruebarest-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
