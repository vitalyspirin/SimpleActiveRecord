<?php
ini_set('display_errors', 1);
error_reporting(-1);

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require(__DIR__ . '/../../vendor/yiisoft/yii2/Yii.php');


if (php_sapi_name() === 'cli') {
    $config = require(__DIR__ . '/config/console.php');
    $application = new yii\console\Application($config);
} else {
    $yiiConfig = require(__DIR__ . '/config/web.php');
    new yii\web\Application($yiiConfig); // Do NOT call run() here
}



ini_set('display_errors', 1);
error_reporting(-1);
