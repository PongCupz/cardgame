<?php

return [
  'settings' => [
    'displayErrorDetails' => true,
    'addContentLengthHeader' => false,

    'logger' => [
      'path' => __DIR__ . '/../logs/' . date('Y-m-d') . '.log',
      'level' => \Monolog\Logger::DEBUG,
    ],

    'db' => [
      'driver' => 'mysql',
      'host' => 'db',
      'database' => 'game',
      'username' => 'game',
      'password' => 'password',
      'charset'   => 'utf8',
      'collation' => 'utf8_unicode_ci',
      'prefix'    => '',
    ],
  ],
];