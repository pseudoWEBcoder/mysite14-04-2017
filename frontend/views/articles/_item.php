<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Articles */

?>

    <a href="<?=\yii\helpers\Url::to(['view', 'id' => $model->id_article])?>" class="list-group-item">
        <h4 class="list-group-item-heading"><?= $model->title;?><small class="pull-right text-muted"><?= $model->updateTime;?></small><small class="pull-right text-muted"><?= $model->user0->username;?></small></h4>
        <p class="list-group-item-text"><?= $model->getPreview_text();?></p>


    </a>

