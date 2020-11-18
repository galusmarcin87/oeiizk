<?php
$arr = [
    'request' => [
// !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
        'cookieValidationKey' => 'alsdaf8*D(as8dasj',
    ],
    'cache' => [
        'class' => 'yii\caching\FileCache',
    ],
    'user' => [
        'identityClass' => 'app\models\mgcms\db\User',
        'enableAutoLogin' => true,
    ],
    'errorHandler' => [
        'errorAction' => 'site/error',
        'class' => 'app\components\mgcms\ErrorHandler',
        'typesToExceptions' => YII_DEBUG ? E_ALL : false,
        'typesToLog' => E_ALL,
    ],
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
    'urlManager' => require __DIR__ . '/router.php',
    'assetManager' => [
        'appendTimestamp' => false,
        'forceCopy' => YII_DEBUG ? true : false,
        'converter' => [
            'class' => 'nizsheanez\assetConverter\Converter',
            'parsers' => [
                'less' => [// file extension to parse
                    'class' => 'nizsheanez\assetConverter\Less',
                    'output' => 'css', // parsed output file type
                    'options' => [
                        'auto' => true, // optional options
                    ]
                ]
            ]
        ],
        'bundles' => [
            'yii\web\JqueryAsset' => [
                'jsOptions' => ['position' => \yii\web\View::POS_HEAD],
            ],
            'yii\bootstrap\BootstrapAsset' => [
                'css' => [
                    'bootstrap.css' => null
                ]
            ]
        ],
    ],
    'assetsAutoCompress' =>
    [
        'class' => '\skeeks\yii2\assetsAuto\AssetsAutoCompressComponent',
    ],
    'assetsAutoCompress' => require __DIR__ . '/inc/assetsAutoCompress.php',
    'i18n' => [
        'class' => Zelenin\yii\modules\I18n\components\I18N::className(),
        'languages' => $params['languages'],
        'messageTable' => 'i18n_message',
        'sourceMessageTable' => 'i18n_source_message',
        'translations' => [
            'app' => [
                'class' => yii\i18n\PhpMessageSource::className(),
            ],
            'alt' => [
                'class' => yii\i18n\PhpMessageSource::className(),
            ],
        ]
    ],
    'formatter' => [
        'class' => 'app\components\mgcms\MgcmsFormatter',
    ],
    'languageSwitcher' => [
        'class' => 'app\components\mgcms\languageSwitcher',
    ],
    'backup' => [
        'class' => 'demi\backup\Component',
        // The directory for storing backups files
        'backupsFolder' => dirname(__DIR__) . '/backups', // <project-root>/backups
        // Directories that will be added to backup
        'directories' => [
            'images' => '@app/web/storage',
            'uploads' => '@app/web/upload',
        ],
        'db' => 'db',
    ],
    'globalVariable' => array(
        'class' => 'app\components\GlobalVariable',
    ),
];

return $arr;
