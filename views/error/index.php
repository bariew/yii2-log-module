<?php

use yii\grid\GridView;
use bariew\logModule\models\ErrorSearch;
use bariew\yii2Tools\helpers\GridHelper;
$this->title = Yii::t('app', 'Errors');
$this->params['breadcrumbs'][] = $this->title;

/**
 * @var ErrorSearch $searchModel
 */
?>
<?php echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        GridHelper::listFormat($searchModel, 'level'),
        'category',
        GridHelper::dateFormat($searchModel, 'log_time', ['format' => 'datetime']),
        [
            'attribute' => 'message',
            'format' => 'raw',
            'value' => function($data) { return \yii\helpers\StringHelper::truncate($data->message, 170);}
        ],
        ['class' => 'yii\grid\ActionColumn', 'template' => '{view} {delete}', 'options' => ['width' => '50px']],
    ],
]); ?>