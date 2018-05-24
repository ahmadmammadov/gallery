<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model kouosl\gallery\models\Photos */

$this->title = 'Create Photos';
$this->params['breadcrumbs'][] = ['label' => 'Photos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="photos-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php $model->gallery_id = Yii::$app->session['viewPhotosId']; ?>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
