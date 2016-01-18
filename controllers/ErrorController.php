<?php

namespace bariew\logModule\controllers;

use bariew\logModule\controllers\actions\ErrorDelete;
use bariew\logModule\controllers\actions\ErrorIndex;
use bariew\logModule\controllers\actions\ErrorView;
use Yii;
use bariew\logModule\models\Error;
use bariew\logModule\models\ErrorSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ErrorController implements the CRUD actions for Error model.
 */
class ErrorController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'delete' => ErrorDelete::className(),
            'view' => ErrorView::className(),
            'index' => ErrorIndex::className(),
        ];
    }

    /**
     * Finds the Error model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Error the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Error::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
