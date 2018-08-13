<?php

$envConfig = new Phalcon\Config\Adapter\Ini(__DIR__ . '/../../app/config/config.ini');
// 全局配置变量
define('DOMAIN', $envConfig->selenium->domain);
define('STATIC_DOMAIN', $envConfig->selenium->static_domain);

return new \Phalcon\Config(array(
    'database' => array(
        'adapter'     => 'Mysql',
        'host'        => $envConfig->db->server,
        'username'    => $envConfig->db->username,
        'password'    => $envConfig->db->password,
        'dbname'      => $envConfig->db->database,
        'charset'     => 'utf8mb4',
    ),
    'application' => array(
        'controllersDir' => __DIR__ . '/../../app/controllers/',
        'modelsDir'      => __DIR__ . '/../../app/models/',
        'viewsDir'       => __DIR__ . '/../../app/views/',
        'libraryDir'     => __DIR__ . '/../../app/library/',
    ),
));
