<?php

namespace app\controllers;

use Yii;
use yii\web\Response;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use app\models\PendaftaranStatusKeluar;
use app\models\PendaftaranStatusKeluarSearch;

/**
 * PendaftaranStatusKeluarController implements the CRUD actions for PendaftaranStatusKeluar model.
 */
class PendaftaranStatusKeluarController extends Controller
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
     * Lists all PendaftaranStatusKeluar models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PendaftaranStatusKeluarSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = new PendaftaranStatusKeluar();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }

    /**
     * Displays a single PendaftaranStatusKeluar model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new PendaftaranStatusKeluar model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

    public function actionCreate()
    {

        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = new PendaftaranStatusKeluar();

        $maxKode = PendaftaranStatusKeluar::find()->max('kode');

        $model->kode = $maxKode + 1;
        $model->nama       = Yii::$app->request->post('nama');
        $model->aktif      = 1;
        $model->created_at = date('Y-m-d H:i:s');        
        $model->created_by = Yii::$app->user->identity->id;

        // echo '<pre>';
        // print_r($maxKode);
        // die;

        if ($model->save()) {
            return [
                'success' => true,
                'message' => 'Data Berhasil Ditambah.',
                'data'  => $model
            ];
        }else{
            $errors = $model->getErrors();
            return [
                'success' => false,
                'message' => 'Terjadi kesalahan saat Menambahkan Data.',
                 'data'  => $errors
            ];
        }

       
    }

    public function actionUpdate($id)
    {
        
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = $this->findModel($id);
        $model->nama = Yii::$app->request->post('nama');
        $model->aktif = Yii::$app->request->post('aktif');

        // echo '<pre>';
        // print_r(Yii::$app->request->post());
        // die;

        if (Yii::$app->request->post() && $model->save()) {
            return [
                'success' => true,
                'message' => 'Data Berhasil Diubah.'
            ];
        }else{
            return [
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengubah data.',
                'error' => $model->getErrors()
            ];
        }

    }
    
    public function actionDelete($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON; 

        $model = $this->findModel($id);     

        if ($model->delete()) {
            return [
                'success' => true,
                'message' => 'Data Berhasil Dihapus.'
            ];

        }else{                    
            return [
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengubah data.',
                'error' => $model->getErrors()
            ];
        }  
    }


   
    protected function findModel($id)
    {
        if (($model = PendaftaranStatusKeluar::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
