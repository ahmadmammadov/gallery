<?php

namespace kouosl\gallery\controllers\frontend;

use Yii;
use kouosl\gallery\models\Photos;
use kouosl\gallery\models\PhotosSearch;
use kouosl\gallery\models\Gallery;
use kouosl\gallery\models\GallerySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;
use yii\helpers\Url;

class GalleryController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $models = new Photos();
        $searchModel = new PhotosSearch();
        $models = $this->getGalleryData();
        return $this->render('index', [
            'models' => $models
        ]);
    }

    protected function findAllGallery()
    {
        $model = Gallery::find()->where(['<>','gallery_id', '99999'])->all();
        if ($model !== null) {
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


    protected function getGalleryContentData($id) {
        
        $data = array();
        $models = $this->findAll($id);
        foreach($models as $model) {
                $data[] = Url::to('/data/', true).$model->name;
        }

        return $data;
    }
    protected function getGalleryData() {
        
        $data = array();
        $models = $this->findAllGallery();
        foreach($models as $model) {
                $data[] = $this->getGalleryContentData($model->gallery_id);
        }

        return $data;
    }

}
