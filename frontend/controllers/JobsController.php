<?php

namespace frontend\controllers;

use Yii;
use common\models\User;
use frontend\models\Jobs;
use frontend\models\Jobssearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * JobsController implements the CRUD actions for Jobs model.
 */
class JobsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Jobs models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = 'main3';
        $searchModel = new Jobssearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if (Yii::$app->user->identity->account_type == "customer"){
            return $this->redirect(['jobs/yourjobs']);
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionYourjobs()
    {
        $this->layout = 'main3';
        $searchModel = new Jobssearch();
        $dataProvider = $searchModel->search2(Yii::$app->request->queryParams);

        return $this->render('yourjobs', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Displays a single Jobs model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $this->layout = 'main3';
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Jobs model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->layout = 'main3';
        $model = new Jobs();

        if ($model->load(Yii::$app->request->post())) {
            $model->job_id = User::getref(7);
            $model->posted_by = Yii::$app->user->identity->phone;
            $model->status = "pending";
            if ($model->save()) {
                Yii::$app->session->setFlash('success', "Your job was successfully created with job id $model->job_id");
            }else{
                Yii::$app->session->setFlash('warning', "Your job creation was not successful");
            }
            return $this->redirect(['index']);
        }

        return $this->renderAjax('create', [
            'model' => $model,
        ]);
    }

    public function actionRequestjob()
{
    $this->layout = 'main3';
    $model = new Jobs();

//    if ($model->load(Yii::$app->request->post())) {
//        $job_id=$model->job_id;
//        $model2= Jobs::find()->where(['job_id'=>$job_id,'status'=>'pending'])->one();
//        if ($model2) {
//            $customer_phone = $model2->posted_by;
//            $model2->assigned_to = Yii::$app->user->identity->phone;
//            $model2->status= "assigned";
//            $model2->save();
//            Yii::$app->session->setFlash('success', "You have gotten the job. Here is your customer's number : $customer_phone");
//        }else{
//            Yii::$app->session->setFlash('warning', "Sorry you did not get the job, The job have been taken already)");
//        }
//        return $this->redirect(['requestjob']);
//    }

    $searchModel = new Jobssearch();
    $dataProvider = $searchModel->search4(Yii::$app->request->queryParams);

    return $this->render('requestjob', [
        'model' => $model,
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
    ]);
}

    public function actionRequestjobpopup()
    {
        $this->layout = 'main3';
        $model = new Jobs();

        if ($model->load(Yii::$app->request->post())) {
            $job_id=$model->job_id;
            $model2= Jobs::find()->where(['job_id'=>$job_id,'status'=>'pending'])->one();
            if ($model2) {
                $customer_phone = $model2->posted_by;
                $model2->assigned_to = Yii::$app->user->identity->phone;
                $model2->status= "assigned";
                $model2->save();
                Yii::$app->session->setFlash('success', "You have gotten the request. Here is your customer's number : $customer_phone");
            }else{
                Yii::$app->session->setFlash('warning', "Sorry you did not get the request, The customer's request have been taken already)");
            }
            return $this->redirect(['requestjob']);
        }

        return $this->renderAjax('requestjobpopup', [
            'model' => $model
        ]);
    }

    public function actionUpdatecustomerrequest()
    {
        $this->layout = 'main3';
        $model = new Jobs();

        if ($model->load(Yii::$app->request->post())) {
            $job_id=$model->job_id;
            $model2= Jobs::find()->where(['job_id'=>$job_id])->one();
            if ($model2) {
                $model2->status=$model->status;
                $model2->save();
                $customer_request_id=$model2->job_id;
                Yii::$app->session->setFlash('success', "You have successfully change customer pickup request $customer_request_id status");
            }else{
                Yii::$app->session->setFlash('warning', "Sorry no customer request ID matches your input");
            }
            return $this->redirect(['requestjob']);
        }

        return $this->renderAjax('updatecustomerrequest', [
            'model' => $model
        ]);
    }

    /**
     * Updates an existing Jobs model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $this->layout = 'main3';
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Jobs model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->layout = 'main3';
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Jobs model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Jobs the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Jobs::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionCustomerregistration($phonenumber,$fullname,$bvn,$password)
    {
        $user = new User();
        $user->username = $fullname;
        $user->phone = $phonenumber;
        $user->bvn= $bvn;
        $user->pin=$password;
        $user->setPassword($password);
        $user->generateAuthKey();

        return ($user->save(false)) ? json_encode(["responseCode"=>"200","responseDescription"=>"Operation Successful","data"=>$user]) : json_encode(["responseCode"=>"400","responseDescription"=>"Operation Failed","data"=>[]]);
    }

    public function actionSubmitClaim($phone,$description,$insuranceid)
    {
//        $user = new User();
//        $user->username = $fullname;
//        $user->phone = $phonenumber;
//        $user->bvn= $bvn;
//        $user->pin=$password;
//        $user->setPassword($password);
//        $user->generateAuthKey();

        return (1==1) ? json_encode(["responseCode"=>"200","responseDescription"=>"Operation Successful","data"=>$user]) : json_encode(["responseCode"=>"400","responseDescription"=>"Operation Failed","data"=>[]]);
    }

}
