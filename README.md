Yii2 log module.
===================

Description
-----------
Manages system logs from web views.


Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist bariew/yii2-log-module "*"
```

or add

```
"bariew/yii2-log-module": "*"
```

to the require section of your `composer.json` file.


Usage
-----

* Add log component target and module in the main config components section:
```
    'components' => [
    ...
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\DbTarget',
                    'levels' => ['error', 'warning'],
                    'logTable' => '{{%log_error}}',
                    'except' => [
                        'yii\web\HttpException:404',
                        'yii\web\HttpException:403',
                        'yii\web\HttpException:400',
                        'yii\i18n\PhpMessageSource::loadMessages'
                    ],
                ],
            ]
        ]
    ],
    'modules' => [
        ...
        'log' => [
            'class' => 'bariew\logModule\Module'
        ]
    ],
```

* Apply migrations from the module migrations folder.

* Go to log/error/index URL
