<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Jobs */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jobs-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'job_description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'job_type')->dropDownList(
        ['Recurring Waste Disposal' => 'Recurring Waste Disposal', 'One Time Waste Disposal' => 'One Time Waste Disposal'],
        [
            'prompt'=>'Select Waste PickUp Request Type',

        ]); ?>

    <?= $form->field($model, 'job_location')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Create', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
