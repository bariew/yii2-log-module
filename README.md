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

* Add log component target in the main config components section:
```
    'components' => [
    ...
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\DbTarget',
                    'levels' => ['error', 'warning'],
                    'logTable' => 'log_error',
                    'except' => [
                        'yii\web\HttpException:404',
                        'yii\web\HttpException:403',
                        'yii\i18n\PhpMessageSource::loadMessages'
                    ],
                ],
            ]
        ]
    ],
```


* Apply migrations from module migrations folder. E.g. you may copy those migrations to your application migrations folder and run
    common yii console migration command.

* Go to log/error/index URL and see system errors.
