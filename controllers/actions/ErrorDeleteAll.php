<?php
namespace bariew\logModule\controllers\actions;
use bariew\logModule\models\ErrorSearch;
use bariew\logModule\models\Error;
use yii\base\Action;
use Yii;
use yii\db\ActiveQuery;

/**
 * Created by PhpStorm.
 * User: pt
 * Date: 18.01.16
 * Time: 20:04
 */

class ErrorDeleteAll extends Action
{
    /**
     * @inheritdoc
     */
    public function run()
    {
        $searchModel = new ErrorSearch();
        $query = $searchModel->search(\Yii::$app->request->get())->query; /** @var ActiveQuery $query */
        \bariew\logModule\models\Error::deleteAll($query->where);
        return $this->controller->redirect(\Yii::$app->request->referrer);
    }
}