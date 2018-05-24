<?php

namespace kouosl\gallery\controllers\backend;

use Yii;
use kouosl\gallery\models\Photos;
use kouosl\gallery\models\PhotosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

/**
 * PhotosController implements the CRUD actions for Photos model.
 */
class PhotosController extends Controller
{
    /**
     * @inheritdoc
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
     * Lists all Photos models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider();
        $searchModel = new PhotosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if (isset(Yii::$app->session['viewPhotosId'])) {
            $param = Yii::$app->session['viewPhotosId'];
            $dataProvider->query->andFilterWhere(['gallery_id'=>$param]);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'id' => $param,
            ]);
         } else {
            $param = null;
            $this->redirect(array('/gallery/gallery'));
         }
    }

    /**
     * Displays a single Photos model.
     * @param integer $id
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
     * Creates a new Photos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Photos();
        if ($model->load(Yii::$app->request->post())) {
            $imageName = $this->randomString(10);
            FileHelper::createDirectory('assets/uploads');
            $model->file = UploadedFile::getInstance($model, 'file');
            $model->file->saveAs('assets/uploads/'.$imageName.'.'.$model->file->extension);
            
            $model->name =Yii::$app->getUrlManager()->getBaseUrl().'/assets/uploads/'.$imageName.'.'.$model->file->extension;
            $model->save();
            return $this->redirect(['view', 'id' => $model->photo_id]);
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Photos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->photo_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionGallery($id)
    {
        $models = new Photos();
        $searchModel = new PhotosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere(['gallery_id'=>$id]);
        $models = $this->findAll($id);
        $data = $this->getSliderContentData($id);
        return $this->render('gallery', [
            'dataProvider' => $dataProvider,
            'id' => $id,
            'data' => $data,
            'models' => $models,
        ]);
    }

    /**
     * Deletes an existing Photos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Photos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Photos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Photos::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findAll($id)
    {
        $model = Photos::find()->where(['gallery_id' => $id])->all();
        if ($model !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function getSliderContentData($id) {
        
        $data = array();
        $models = $this->findAll($id);
        foreach($models as $model) {
                $data[] = array('content' => Html::img(Yii::$app->getUrlManager()->getBaseUrl().'/assets/'.$model->name));
    
        }
        return $data;
    }
    protected function randomString($length) {
        $key = '';
        $keys = array_merge(range(0, 9), range('a', 'z'));
    
        for ($i = 0; $i < $length; $i++) {
            $key .= $keys[array_rand($keys)];
        }
    
        return $key;
    }
}
