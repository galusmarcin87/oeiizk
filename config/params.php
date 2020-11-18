<?php
return [
    'adminEmail' => 'admin@example.com',
    'roles' => ['user','admin'],
    'languages' => ['pl','en'],
    'icon-framework' => 'bsg',
    'containerComponents' => require __DIR__ . '/containerComponents.php',
    'secretKey' => 'Kda*dudjasd12@3N',
    'dateControlDisplay' => [
        kartik\datecontrol\Module::FORMAT_DATE => 'dd-MM-yyyy',
        kartik\datecontrol\Module::FORMAT_TIME => 'hh:mm:ss a',
        kartik\datecontrol\Module::FORMAT_DATETIME => 'dd-MM-yyyy hh:mm:ss a', 
    ],
    
];
