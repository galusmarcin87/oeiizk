<?php
$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'app\commands',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
//        'useFileTransport' => true,
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'poczta.oeiizk.waw.pl', // e.g. smtp.mandrillapp.com or smtp.gmail.com
                'username' => 'pos.noreply@oeiizk.waw.pl',
                'password' => 'pooS#2018',
                'port' => '587', // Port 25 is a very common port too
//            'port' => '465',
                'encryption' => 'tls', // It is often used, check your provider or mail server specs
            ],
        ],
        'urlManager' => require __DIR__ . '/router.php',
    ],
    'params' => $params,
    /*
      'controllerMap' => [
      'fixture' => [ // Fixture generation command line.
      'class' => 'yii\faker\FixtureController',
      ],
      ],
     */
];

if (YII_ENV_DEV) {
  // configuration adjustments for 'dev' environment
  $config['bootstrap'][] = 'gii';
  $config['modules']['gii'] = [
      'class' => 'yii\gii\Module',
  ];
}

return $config;
