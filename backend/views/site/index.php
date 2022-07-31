<?php

/**
 * @var yii\web\View $this
 * @var $latestVideo \common\models\Video
 * @var $numberOfViews integer
 * @var $numberOfSubscribers integer
 * @var $subscribers \common\models\Subscriber[]
 */

$this->title = 'My Yii Application';
?>
<div class="site-index d-flex">
    <div class="card m-2" style="width: 14rem;">
        <div class="card-body">
            <h6 class="card-title">Total Views: </h6>
            <p class="card-text" style="font-size: 32px">
                <?php echo $numberOfViews?>
            </p>
        </div>
    </div>

    <div class="card m-2" style="width: 14rem;">
        <div class="card-body">
            <h6 class="card-title">Total Subscribers: </h6>
            <p class="card-text" style="font-size: 32px">
                <?php echo $numberOfSubscribers?>
            </p>
        </div>
    </div>

    <div class="card m-2" style="width: 14rem;">
        <div class="card-body">
            <h6 class="card-title">Latest Subscribers: </h6>
            <?php foreach ($subscribers as $subscriber):?>
                <div class="">
                    <?php echo \common\helpers\Html::studioLink($subscriber->user)?>
                </div>
            <?php endforeach;?>
        </div>
    </div>

</div>
