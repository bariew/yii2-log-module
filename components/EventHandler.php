<?php
/**
 * EventHandler class file.
 * @copyright (c) 2015, Pavel Bariev
 * @license http://www.opensource.org/licenses/bsd-license.php
 */

namespace bariew\logModule\components;


use bariew\logModule\models\Item;
use bariew\yii2Tools\helpers\EventHelper;
use yii\base\Event;
use yii\db\AfterSaveEvent;
use yii\db\ActiveRecord;

/**
 * Description.
 *
 * Usage:
 * @author Pavel Bariev <bariew@yandex.ru>
 *
 */
class EventHandler
{
    public static function common(Event $event)
    {
        return Item::create($event)->save(false);
    }
}