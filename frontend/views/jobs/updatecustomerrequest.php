<?php
/**
 * Created by IntelliJ IDEA.
 * User: oolabampe
 * Date: 22/06/2019
 * Time: 8:59 AM
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;



/* @var $this yii\web\View */
/* @var $model frontend\models\Jobs */

$this->title = 'Update Customer Pickup Request Status';
$this->params['breadcrumbs'][] = ['label' => 'Jobs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jobs-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'job_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList(
        ['Completed' => 'Completed', 'pending' => 'ABANDONED','blocked' => 'Invalid Customer Request'],
        [
            'prompt'=>'Select Customer New Status',

        ]); ?>
    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>