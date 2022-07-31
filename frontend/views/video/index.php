<?php
/**
 * @var $dataProvider ActiveDataProvider
 */

use yii\data\ActiveDataProvider;

?>

<?php echo \yii\widgets\ListView::widget([
        'dataProvider' => $dataProvider, //by default only display primary key of video
        'itemView' => '_video_item',
        'layout' => '<div class = "d-flex flex-wrap">{items}</div>{pager}',
        'itemOptions' => [
            'tag' => false
        ]
]) ?>
