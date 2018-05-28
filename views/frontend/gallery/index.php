<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel kouosl\gallery\models\GallerySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Galleries';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gallery-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php foreach ($models as $model) { 
            echo '<div class="gallery">';
            foreach($model as $item){
                echo '<img src="'.$item.'" width="300" height="200"/>';
               
            }
             echo '</div><hr/>';
        }  
    ?>
</div>
