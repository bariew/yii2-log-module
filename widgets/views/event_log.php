<?php
use yii\grid\GridView;
/** @var \yii\data\ActiveDataProvider $dataProvider */
?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'summary'=> false,
    'columns' => [
        'created_at:datetime',
        'message:raw',
    ]
]) ?>