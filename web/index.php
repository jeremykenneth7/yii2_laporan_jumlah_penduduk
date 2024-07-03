<?php
require __DIR__ . '/../vendor/autoload.php';

(new Symfony\Component\Dotenv\Dotenv)->usePutenv(true)->load(__DIR__ . '/../.env');

defined('YII_DEBUG') or define('YII_DEBUG', intval($_ENV['YII_DEBUG'] ?? 0) == 1);
defined('YII_ENV') or define('YII_ENV', $_ENV['YII_ENV'] ?? 'prod');

require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

$config = require __DIR__ . '/../config/web.php';

(new yii\web\Application($config))->run();
