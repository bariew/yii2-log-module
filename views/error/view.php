<?php

use yii\widgets\DetailView;
use common\modules\log\models\LogError;
use yii\web\View;
/**
 * @var View $this
 * @var LogError $model
 */

$this->registerJsFile("https://google-code-prettify.googlecode.com/svn/loader/run_prettify.js?skin=sons-of-obsidian");
$this->title = Yii::t('app', 'Error view');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Errors'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="view">

    <?php echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'levelName',
            'category',
            'request' => [
                'attribute' => 'request',
                'format' => 'raw',
                'value' =>  \yii\helpers\Html::a($model->getUrl(), $model->getUrl())
            ],
            'message' => [
                'attribute' => 'message',
                'format' => 'raw',
                'value' => '<pre class="prettyprint linenums"><code>'
                    . $model->message
                    . '</pre>'
            ],
            'log_time:datetime',
            'appMessage' => [
                'attribute' => 'appMessage',
                'format' => 'raw',
                'value' => '<pre class="prettyprint linenums"><code>'
                    . $model->appMessage
                    . '</pre>'
            ]
        ],
    ]) ?>

</div>
