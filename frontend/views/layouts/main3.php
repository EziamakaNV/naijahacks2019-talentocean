<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\helpers\Url;
use backend\models\Chat;
use common\models\User;
$unreadMessageCount=Chat::find()->where(['user_id'=>Yii::$app->user->id,'sent_from'=>'support','seen'=>0])->count();
$pursevalue= User::find()->where(['id' => Yii::$app->user->id])->one();
//$pursevalue=$pursevalue->purse;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <?= Html::csrfMetaTags() ?>
    <title>Insurgator</title>
    <?php $this->head() ?>
</head>
<body class="main3-body">
<?php $this->beginBody() ?>


   
       <!-- /.navbar -->
        <div class=" row">
            <?php if (Yii::$app->user->identity->account_type == "customer") : ?>
                <div class="main3 col-md-2 sideColor">
                <div class="sidenav">
            <?php endif; ?>
            <?php if (Yii::$app->user->identity->account_type == "company") : ?>
            <div class="main3 col-md-2 sideColor2">
                <div class="sidenav2">
            <?php endif; ?>
          <div class="wik8">
          <a href="<?=Url::to("@web/")?>">
              <h3>Insurgator</h3>
          </a>
          </div>
                    <?php if (Yii::$app->user->identity->account_type == "company") : ?>
          <div class="sidebar-box">
          <a href="<?=Url::to("/insurgator/products/index")?>"><div class="col-sm-4"><img src="../images/home.svg" class="wik35"></div><div class="col-sm-8"><h4 style="margin-top:23px">Products</h4></div></a>
        </div>
        <div class="sidebar-box">
          <a href="<?=Url::to("/insurgator/subscription/index")?>"><div class="col-sm-4"><img src="../images/history.svg" class="wik35"></div><div class="col-sm-8"><h4>Customers</h4></div></a>
        </div>
        <div class="sidebar-box">
            <a href="<?=Url::to("/insurgator/claims/index")?>"><div class="col-sm-4"><img src="../images/history.svg" class="wik35"></div><div class="col-sm-8"><h4>Claims</h4></div></a>
        </div>

        <?php endif; ?>
        <?php if (Yii::$app->user->identity->account_type == "customer") : ?>
        <div class="sidebar-box">
          <a href="<?=Url::to("/insurgator/site/dashboard")?>"><div class="col-sm-4"><img src="../images/history.svg" class="wik35"></div><div class="col-sm-8"><h4>Dashboard</h4></div></a>
        </div>
        <div class="sidebar-box">
            <a href="<?=Url::to("/insurgator/site/accounthistory")?>"><div class="col-sm-4"><img src="../images/history.svg" class="wik35"></div><div class="col-sm-8"><h4>Insurance History</h4></div></a>
        </div>
        <div class="sidebar-box">
            <a href="<?=Url::to("/insurgator/claims/index")?>"><div class="col-sm-4"><img src="../images/history.svg" class="wik35"></div><div class="col-sm-8"><h4>Claims</h4></div></a>
        </div>
        <?php endif; ?>
        <?php if (Yii::$app->user->identity->is_agent == "truee") : ?>
        <div class="sidebar-box">
            <a href="<?=Url::to("/insurgator/jobs/yourjobs")?>"><div class="col-sm-4"><img src="../images/history.svg" class="wik35"></div><div class="col-sm-8"><h4>Agent Portal</h4></div></a>
        </div>
        <?php endif; ?>
        <div class="sidebar-box">
          <a href="<?=Url::to("/insurgator/site/support")?>"><div class="col-sm-4"><img src="../images/message.svg" class="wik35"></div><div class="col-sm-8"><h4 style="margin-top:20px">Message</h4></div></a>
        </div>
        <div class="sidebar-box">
          <a href="<?=Url::to("/insurgator/site/transferpage")?>"><div class="col-sm-4"><img src="../images/withdraw.svg" class="wik35"></div><div class="col-sm-8"><h4 style="margin-top:19px">Transfer Fund</h4></div></a>
        </div>
        <div class="sidebar-box">
          <a href="<?=Url::to("/insurgator/site/fundwallet")?>"><div class="col-sm-4"><img src="../images/withdraw.svg" class="wik35"></div><div class="col-sm-8"><h4 style="margin-top:19px">Fund Purse</h4></div></a>
        </div>
        <div class="sidebar-box">
          <a href="<?=Url::to("/insurgator/site/edit-account")?>"><div class="col-sm-4"><img src="../images/editaccount.svg" class="wik35"></div><div class="col-sm-8"><h4 >Edit Profile</h4></div></a>
        </div>
        <div class="space200">
    
        </div>
        <div class="sidebar-box-logout">
          <?='<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                '<div class="col-sm-8"><h2 class="wik36">Logout</h2></div><div class="col-sm-4"><img src="../images/logout.svg" width="40px" height="40px"></div>',
                ['class' => 'btn btn-link lOGOUT']
            )
            . Html::endForm()
            . '</li>'?>
        </div>
        <div class="space90">
    
        </div>
        </div>
      </div>

<div class="main3 col-md-10 main-body-padding">
<!-- nav starts-->
    <?php if (Yii::$app->user->identity->account_type == "customer") : ?>
        <div class="dashboard_nav">
        <?php endif; ?>
        <?php if (Yii::$app->user->identity->account_type == "company") : ?>
        <div class="dashboard_nav2">
        <?php endif; ?>
  <div class=" dropdown mobile-menu">
  <span class="">Menu</span>
  <span class="dropdown-toggle" data-toggle="dropdown">
    <span class="caret"></span>
            </span>
  <ul class="dropdown-menu">
<?php if (Yii::$app->user->identity->account_type == "company") : ?>
    <li><a href="<?=Url::to("/insurgator/jobs/index")?>">Customer Orders</a></li>
    <li> <a href="<?=Url::to("/insurgator/jobs/requestjob")?>">Your Jobs</a></li>
<?php endif; ?>
<?php if (Yii::$app->user->identity->account_type == "customer") : ?>
    <li><a href="<?=Url::to("/insurgator/jobs/yourjobs")?>">Dashboard</a></li>
<?php endif; ?>
    <li>  <a href="<?=Url::to("/insurgator/site/support")?>">Message</li>
    <li><a href="<?=Url::to("/insurgator/site/transferpage")?>">Transfer Fund</a></li>
      <li><a href="<?=Url::to("/insurgator/site/fundwallet")?>">Fund Purse</a></li>
      <li>  <a href="<?=Url::to("/insurgator/site/edit-account")?>">Edit Profile</li>
      <li><a href="<?=Url::to("/insurgator/site/signup")?>">Logout</a></li>
  </ul>
</div>
<span> <h4 class="logo-style2">Insurgator</h4>
</span>
       <div class="nav2"><span class="width2"></span><?= ($unreadMessageCount==0) ? "" : '<span class="width2"></span><span class="width2"></span> You have <a href="'.Url::to("/insurgator/site/support").'"><span style="color:rgb(217, 155, 74)">'.$unreadMessageCount.' unread message(s) <span class="messagedivider">|</span></span></a>'?><span class="width2"></span>Welcome <?= Yii::$app->user->identity->username; echo "(Purse : ₦$pursevalue->purse)"?>&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp

       </div>

  </div>

  <!-- nav ends-->
<div class="main3-container">
         <?= Alert::widget() ?>
        <?= $content ?>
        </div>

</div>

</div>




<?php $this->endBody() ?>
<script>
$('.dropdown-toggle').dropdown()

</script>
</body>
</html>
<?php $this->endPage() ?>