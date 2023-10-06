<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';
$dbSso = require __DIR__ . '/dbSso.php';
$dbSimrsOld = require __DIR__ . '/dbSimrsOld.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'timeZone' => "Asia/Jakarta",
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'sso',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        // 'user' => [
        //     'class' => 'app\models\User',
        //     'identityClass' => 'app\models\Identitas',
        //     'enableAutoLogin' => true,
        //     'loginUrl' => '@.sso/masuk?b=http://master.simrs.aa',
        //     'identityCookie' => ['name' => '_identity-id', 'httpOnly' => true, 'domain' => 'rsud-arifin.localhost'],
        // ],
        'user' => [
            'class' => 'app\models\User',
            'identityClass' => 'app\models\Identitas',
            'enableAutoLogin' => true,
            // 'loginUrl' => 'http://localhost:8080/masuk?b=http://localhost:9090/',

            // 'loginUrl' => 'http://localhost/sso/web/masuk?b=http://localhost/data_master/web/',
            'loginUrl' => '@.sso/masuk?b=http://master.simrs.aa',
            'identityCookie' => ['name' => '_identity-id', 'httpOnly' => true, 'domain' => 'rsud-arifin.localhost'],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'dbSso' => $dbSso,
        'dbSimrsOld' => $dbSimrsOld,

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '' => 'site/index',
                '<controller:\w+>/<id:\d+>' => '<controller>/view',                 // only for integer id
                '<controller:\w+>/<action:\w+[-\w]+\w>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+[-\w]+\w>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>s' => '<controller>/index',
            ],
        ],

        'authManager' => [
            'class' => 'yii\rbac\DbManager', // or use 'yii\rbac\DbManager'
            'db' => $db,
            'itemTable' => 'master.auth_item',
            'assignmentTable' => 'master.auth_assignment',
            'itemChildTable' => 'master.auth_item_child',
            'ruleTable' => 'master.auth_rule'
        ],
        'assetManager' => [
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'sourcePath' => null,
                    'basePath' => '@webroot',
                    'baseUrl' => '@web/theme',
                    'js' => [
                        'adminlte3/plugins/jquery/jquery.min.js',
                    ]
                ],
                'yii\bootstrap\BootstrapPluginAsset' => [
                    'sourcePath' => null,
                    'basePath' => '@webroot',
                    'baseUrl' => '@web/theme',
                    'js' => [
                        'adminlte3/plugins/bootstrap/js/bootstrap.bundle.min.js',
                    ]
                ],
                'yii\bootstrap\BootstrapAsset' => [
                    'sourcePath' => null,
                    'basePath' => '@webroot',
                    'baseUrl' => '@web/theme',
                    'css' => [
                        'adminlte3/dist/css/bootstrap.min.css',
                    ]
                ],




            ],
        ],

    ],
    'params' => $params,
    'modules' => [
        'utility' => [
            'class' => 'c006\utility\migration\Module',
        ],
        'gridview' => [
            'class' => '\kartik\grid\Module'
        ],
        'treemanager' => [
            'class' => '\kartik\tree\Module',
            // other module settings, refer detailed documentation
        ],
        'rbac' => [
            'class' => 'app\modules\rbac\Module',
        ],
        'gridviewKartik' =>  [
            'class' => '\kartik\grid\Module',
            // your other grid module settings
        ]

    ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            'auth/*',
            'api/api-referensi/*',
        ]
    ],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
        'allowedIPs' => ['*'],
    ];
}

if (!YII_ENV_TEST) {
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'generators' => [ // here
            'crud' => [ // generator name
                'class' => 'yii\gii\generators\crud\Generator', // generator class
                'templates' => [ // setting for our templates
                    'yii2-adminlte3' => '@vendor/hail812/yii2-adminlte3/src/gii/generators/crud/default' // template name => path to template
                ]
            ]
        ]
    ];
}

return $config;
