<?php

namespace bariew\logModule\models;

use Yii;
use yii\base\Event;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\Html;
use yii\helpers\Inflector;
use app\modules\user\models\User;
/**
 * This is the model class for table "log_item".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $event
 * @property string $model_name
 * @property string $model_id
 * @property string $message
 * @property integer $created_at
 *
 * @property User $user
 */
class Item extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%log_item}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'created_at'], 'integer'],
            [['message'], 'string'],
            [['event', 'model_name', 'model_id'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('modules/log', 'ID'),
            'user_id' => Yii::t('modules/log', 'User'),
            'event' => Yii::t('modules/log', 'Event'),
            'model_name' => Yii::t('modules/log', 'Model Name'),
            'model_id' => Yii::t('modules/log', 'Model ID'),
            'message' => Yii::t('modules/log', 'Message'),
            'viewMessage' => Yii::t('modules/log', 'Message'),
            'created_at' => Yii::t('modules/log', 'Created At'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [static::EVENT_BEFORE_INSERT => 'created_at']
            ],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Yii::$app->user->identityClass, ['id' => 'user_id']);
    }

    /**
     * @return array
     */
    public static function userList()
    {
        return User::find()->orderBy('username')->indexBy('id')->select('username')->column();
    }

    /**
     * Gets link to logged model
     * @param array $options
     * @return string
     */
    public function getLink($options = [])
    {
        list($app, $module, $moduleName, $model, $modelName) = explode('\\', $this->model_name);
        list($moduleController, $modelController)
            = [Inflector::camel2id($moduleName), Inflector::camel2id($modelName)];
        return Html::a(
            "{$moduleName} {$modelName}#{$this->model_id}",
            ["/{$moduleController}/{$modelController}/view", 'id' => $this->model_id],
            $options
        );
    }

    /**
     * Generates new event log
     * @param Event $event
     * @param array $attributes
     * @return \self
     */
    public static function create(Event $event, $attributes = [])
    {
        /** @var ActiveRecord $model */
        $sender = $event->sender;
        /** @var \self $model */
        $model = new static(array_merge([
            'user_id' => Yii::$app->user->id,
            'model_name' => get_class($sender),
            'model_id' => $sender->primaryKey,
            'event' => $event->name,
        ], $attributes));
        $model->message = $model->message
            ? : $model->createMessage(Inflector::camel2words($event->name));
        return $model;
    }

    /**
     * Generates auto message for event.
     * @param $eventName
     * @return string
     */
    public function createMessage($eventName)
    {
        return Yii::t('modules/log', "{event} for {model} by {username}", [
            'event' => $eventName,
            'model' => $this->getLink(),
            'username' => Html::a(@Yii::$app->user->identity->username,
                ['/user/user/view', 'id' => Yii::$app->user->id]),
        ]);
    }
}
