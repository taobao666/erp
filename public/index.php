<?php

//ini_set('display_errors', 'ON');
//error_reporting(E_ALL);
date_default_timezone_set('PRC');
defined("ROOT_PATH") || define("ROOT_PATH", realpath(dirname(__DIR__)));
defined("UPLOAD_PATH") || define("UPLOAD_PATH", ROOT_PATH . '/public/upload');

try {

    /**
     * Read the configuration
     */
    $config = include __DIR__ . "/../app/config/config.php";

    /**
     * Read auto-loader
     */
    include __DIR__ . "/../app/config/loader.php";

    /**
     * Read services
     */
    include __DIR__ . "/../app/config/services.php";

    /**
     * Handle the request
     */
    $application = new \Phalcon\Mvc\Application($di);

    echo $application->handle()->getContent();

} catch (\Exception $e) {
    echo $e->getMessage();
}
