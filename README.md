# Yii2 Sender

[![Latest Stable Version](https://poser.pugx.org/zakharov-andrew/yii2-sender/v/stable)](https://packagist.org/packages/zakharov-andrew/yii2-sender)
[![License](https://poser.pugx.org/zakharov-andrew/yii2-sender/license)](https://packagist.org/packages/zakharov-andrew/yii2-sender)
[![Yii2](https://img.shields.io/badge/Powered_by-Yii_Framework-green.svg?style=flat)](http://www.yiiframework.com/)

Yii2 module for sending emails and messages in Telegram to users.

## 🚀 Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
$ composer require zakharov-andrew/yii2-sender
```
or add

```
"zakharov-andrew/yii2-sender": "*"
```

to the ```require``` section of your ```composer.json``` file.

Subsequently, run

```
./yii migrate/up --migrationPath=@vendor/zakharov-andrew/yii2-sender/migrations
```

in order to create the settings table in your database.

Or add to console config

```php
return [
    // ...
    'controllerMap' => [
        // ...
        'migrate' => [
            'class' => 'yii\console\controllers\MigrateController',
            'migrationPath' => [
                '@console/migrations', // Default migration folder
                '@vendor/zakharov-andrew/yii2-sender/src/migrations'
            ]
        ]
        // ...
    ]
    // ...
];
```


## License

**yii2-sender** it is available under a MIT License. Detailed information can be found in the `LICENSE.md`.
