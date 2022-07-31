<?php
    /**
     * @var $model \common\models\Video
     */

use yii\helpers\Url;

?>

<div class="card m-2" style="width: 18rem;">
    <a href="<?php echo Url::to(['/video/view', 'id' => $model->video_id]) ?>">
        <div class="embed-responsive embed-responsive-16by9">
            <video class="embed-responsive-item"
                   poster="<?php echo $model->getThumbnailLink()?>"
                   src="<?php echo $model->getVideoLink()?>"></video>
        </div>
    </a>
    <div class="card-bod">
        <h6 class="card-title m-0"><?php echo $model->title ?></h6>
        <p class="card-text m-0">
            <?php echo \common\helpers\Html::channelLink($model->createdBy)?>
        </p>
        <p class="card-text m-0">
            <?php echo $model->getViews()->count()?> views
            <span style='font-size:15px;'>&#9830;</span>
            <?php echo Yii::$app->formatter->asRelativeTime($model->created_at) ?>
        </p>
    </div>
</div>

