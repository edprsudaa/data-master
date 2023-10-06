<?php

// return [
//     'class'     => 'yii\db\Connection',
//     'dsn'       => 'pgsql:host=192.168.254.70;port=5432;dbname=simrs',
//     'username'  => 'postgres',
//     'password'  => '1satu2dua',
//     'charset'   => 'utf8',

//     // Schema cache options (for production environment)
//     //'enableSchemaCache' => true,
//     //'schemaCacheDuration' => 60,
//     //'schemaCache' => 'cache',
// ];



return [
  'class' => 'yii\db\Connection',
  'dsn' => 'pgsql:host=192.168.254.70;port=5432;dbname=simrs',
  'username' => 'postgres',
  'password' => '1satu2dua',
  'charset' => 'utf8',
  'schemaMap' => [
    'pgsql' => [
      'class' => 'yii\db\pgsql\Schema',
      'defaultSchema' => 'master' //specify your schema here
    ]
  ],
  'on afterOpen' => function ($event) {
    $event->sender->createCommand("SET search_path TO master;")->execute();
  },
  // Schema cache options (for production environment)
  //'enableSchemaCache' => true,
  //'schemaCacheDuration' => 60,
  //'schemaCache' => 'cache',
];
