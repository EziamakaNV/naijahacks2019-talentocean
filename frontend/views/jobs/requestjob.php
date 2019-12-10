<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model frontend\models\Jobs */

$this->title = 'Create Jobs';
$this->params['breadcrumbs'][] = ['label' => 'Jobs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jobs-request">
    <p>
        <?= Html::button('Request To Pick Up Customer Waste',['value'=>Url::to('requestjobpopup'),'class'=>'modalButton btn btn-primary'])?>

        <?= Html::button('Update Customer Pickup Request Status',['value'=>Url::to('updatecustomerrequest'),'class'=>'modalButton btn btn-primary'])?>
    </p>
<br><br>
<h3>List of Waste PickUps Assigned to You</h3>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'job_id',
            'job_description',
            'job_type',
            'job_location',
             'posted_by',
            //'assigned_to',
             'status',
             //'created_at',

            // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>

<?php
Modal::begin([
    'id'=>'modal',
    'size'=>'modal-md',
]);
echo "<div id='modalContent'></div>";
Modal::end();
?>
