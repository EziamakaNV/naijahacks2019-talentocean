<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\Jobssearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Manage Your Waste Disposal';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jobs-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::button('Create Your Waste Pickup Request',['value'=>Url::to('create'),'class'=>'modalButton btn btn-primary'])?>

        <?= Html::button('Rate Service of Waste Company',['value'=>Url::to('/wastorr/site/rateservice'),'class'=>'modalButton btn btn-primary'])?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'job_id',
            'job_description',
            'job_location',
            'status',
            'assigned_to',
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
