<?php

declare(strict_types=1);

use App\Application;

error_reporting(E_ALL);
define('START_TIME', microtime(true));

define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/src');

try {
    require_once BASE_PATH . '/vendor/autoload.php';
    require_once APP_PATH . '/Application.php';

    /**
     * Load .env configurations
     */
    Dotenv\Dotenv::create(BASE_PATH)->load();

    /**
     * Run Application!
     */
    echo (new Application(BASE_PATH))->run();
} catch (Exception $e) {
    echo $e->getMessage(), '<br>';
    echo nl2br(htmlentities($e->getTraceAsString()));
}
