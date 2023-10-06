<?php

return [
    // 'class' => 'yii\db\Connection',
    // 'dsn' => 'pgsql:host=192.168.254.70;port=5432;dbname=simrs_dev',
    // 'dsn' => 'pgsql:host=192.168.254.21;port=5432;dbname=simrsfarmasiv2',

    // 'username' => 'postgres',
    // 'password' => '1satu2dua',
    // 'charset' => 'utf8',

    // 'class' => 'yii\db\Connection',
    // 'dsn' => 'sqlsrv:Server=192.168.254.21;Database=RS_AASimrs',
    // 'username' => 'sa',
    // 'password' => 'data_123',
    // 'charset' => 'utf8',
    // 'tablePrefix' => 'dbo.',

    // 'class' => 'yii\db\Connection',
    // 'dsn' => 'sqlsrv:Server=192.168.252.250;Database=RS_AASimrs',
    // 'username' => 'sa',
    // 'password' => 'data_123',
    // 'charset' => 'utf8',
    // 'tablePrefix' => 'dbo.',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
	
	    'class' => 'yii\db\Connection',
    //'dsn' => 'sqlsrv:Server=192.168.254.21;Database=RS_AASimrs',
    'dsn' => 'sqlsrv:Server=192.168.252.250;Database=RS_AASimrs',
    //'dsn' => 'sqlsrv:Server=RIDWANPC\SQLEXPRESS;Database=RS_AASimrs',
    //'connectionString' => 'sqlsrv:Server=RIDWANPC\SQLEXPRESS;Database=simrs',
    'username' => 'sa',
    'password' => 'data_123',
//    'password' => 'rify261011',
    'charset' => 'utf8',
    'tablePrefix' => 'dbo.',
];
