<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Pruebarest */

$this->title = $model->idpruebarest;
$this->params['breadcrumbs'][] = ['label' => 'Pruebarests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pruebarest-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->idpruebarest], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idpruebarest], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idpruebarest',
            'nombre',
            'descripcion',
            'estado:boolean',
            'fecha',
        ],
    ]) ?>

</div>
