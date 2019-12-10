<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Jobssearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jobs-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'job_description') ?>

    <?= $form->field($model, 'job_type') ?>

    <?= $form->field($model, 'job_location') ?>

    <?= $form->field($model, 'job_id') ?>

    <?php // echo $form->field($model, 'posted_by') ?>

    <?php // echo $form->field($model, 'assigned_to') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
