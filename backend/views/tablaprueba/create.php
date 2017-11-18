<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Tablaprueba */

$this->title = 'Create Tablaprueba';
$this->params['breadcrumbs'][] = ['label' => 'Tablapruebas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tablaprueba-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'isCreated' => $isCreated,
    ]) ?>

</div>
