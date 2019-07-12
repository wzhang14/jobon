<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use app\models\Category;
use app\models\Job;

class JobController extends \yii\web\Controller {

    // Access Control
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create', 'edit', 'delete'],
                'rules' => [
                    [
                    'actions' => ['create', 'edit', 'delete'],
                    'allow' => true,
                    'roles' => ['@'],
                    ]
                ]
            ]
        ];
    }

    public function actionIndex() {
        // Create Query
        $query = Job::find();

        $pagination = new Pagination([
            'defaultPageSize' => 20,
            'totalCount' => $query->count(),
        ]);

        $jobs = $query->orderBy('create_date DESC')
        ->offset($pagination->offset)
        ->limit($pagination->limit)
        ->all();

        return $this->render('index', [
            'jobs' => $jobs,
            'pagination' => $pagination,
        ]);
    }
    
    public function actionDetails($id) {
        // Get job
        $job = Job::find()
            ->where(['id' => $id])
            ->one();
        // Render View
        return $this->render('details', ['job' => $job]);
    }

    public function actionCreate() {
        $job = new Job();

        if ($job->load(Yii::$app->request->post())) {
            if ($job->validate()) {
                $job->save();
                Yii::$app->getSession()->setFlash('success', 'Job Added');
                return $this->redirect('index.php?r=job'); 
                
            }
        }
    
        return $this->render('create', [
            'job' => $job,
        ]);
    }

    public function actionDelete($id) {
        $job = Job::findOne($id);

        // Check for owner
        if(Yii::$app->user->identity->id != $job->user_id) {
            return $this->redirect('index.php?r=job'); 
        }

        $job->delete();
        
        Yii::$app->getSession()->setFlash('success', 'Job Deleted');
        
        return $this->redirect('index.php?r=job'); 
    }

    public function actionEdit($id) {
        $job = Job::findOne($id);

        // Check for owner
        if(Yii::$app->user->identity->id != $job->user_id) {
            return $this->redirect('index.php?r=job'); 
        }

        if ($job->load(Yii::$app->request->post())) {
            if ($job->validate()) {
                $job->save();
                Yii::$app->getSession()->setFlash('success', 'Job Updated');
                return $this->redirect('index.php?r=job'); 
                
            }
        }
    
        return $this->render('edit', [
            'job' => $job,
        ]);
    }



}
