<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel kouosl\gallery\models\GallerySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Galleries';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gallery-index">
    <?php foreach ($model as $models) { 
          echo '<img src="'.$model['name'].'" rel="list-gallery" />';
    }
          
    ?>
   
   
</div>
