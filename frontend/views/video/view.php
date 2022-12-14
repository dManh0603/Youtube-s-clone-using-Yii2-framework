<?php
/**
 * @var $model \common\models\Video
 * @var $similarVideos \common\models\Video[]
 */

?>
<div class="row">
    <div class="col-sm-8">
        <div class="embed-responsive embed-responsive-16by9">
            <video class="embed-responsive-item"
                   poster="<?php echo $model->getThumbnailLink() ?>"
                   src="<?php echo $model->getVideoLink() ?>"
                   controls>
            </video>
        </div>
        <h6 class="mt-2"><?php echo $model->title ?></h6>
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <?php echo $model->getViews()->count() ?> views
                <span style='font-size:15px'>&#9830;</span>
                <?php echo Yii::$app->formatter->asDate($model->created_at) ?>
            </div>
            <div>
                <?php \yii\widgets\Pjax::begin() ?>

                <?php echo $this->render('_buttons', [
                    'model' => $model
                ]) ?>

                <?php \yii\widgets\Pjax::end() ?>
            </div>
        </div>
        <div class="">
            <p>
                <?php echo \common\helpers\Html::channelLink($model->createdBy) ?>
            </p>
            <?php echo \yii\helpers\Html::encode($model->description) ?>
        </div>
    </div>
    <div class="col-sm-4">
        <?php foreach ($similarVideos as $similarVideo): ?>
            <div class="media mb-3">
                <a href="<?php echo \yii\helpers\Url::to(['/video/view', 'id' => $similarVideo->video_id]) ?>">
                    <div class="embed-responsive embed-responsive-16by9"
                         style="width: 200px;height: 120px">
                        <video class="embed-responsive-item"
                               poster="<?php echo $model->getThumbnailLink() ?>"
                               src="<?php echo $model->getVideoLink() ?>"
                               controls>
                        </video>
                    </div>
                </a>
                <div class="media-body">
                    <h6 class="mt-0"><?php echo $similarVideo->title ?></h6>
                    <div class="text-muted">
                        <p class="m-0">
                            <?php echo \common\helpers\Html::channelLink($similarVideo->createdBy) ?>
                        </p>
                        <small>
                            <?php echo $similarVideo->getViews()->count() ?> views
                            <span style='font-size:15px'>&#9830;</span>
                            <?php echo Yii::$app->formatter->asRelativeTime($similarVideo->created_at) ?>
                        </small>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
