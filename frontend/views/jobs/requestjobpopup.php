<?php
/**
 * Created by IntelliJ IDEA.
 * User: oolabampe
 * Date: 22/06/2019
 * Time: 8:40 AM
 */


use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model frontend\models\Jobs */

$this->title = 'Request To PickUp Customer Waste';
$this->params['breadcrumbs'][] = ['label' => 'Jobs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jobs-request">
    <div class="jobs-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'job_id')->textInput(['autofocus' => true, 'maxlength' => true])->label('Enter Customer PickUp Request ID to handle pickup'); ?>

        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>