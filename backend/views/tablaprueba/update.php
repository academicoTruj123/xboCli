<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tablaprueba */

$this->title = 'Update Tablaprueba: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tablapruebas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tablaprueba-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'isCreated' => $isCreated,
    ]) ?>

</div>
