<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

return [
        'enablePrettyUrl' => true,
        'showScriptName' => false,
        'rules' => [
            '/admin' => '/backend/default',
            [
                'encodeParams' => false,
                'pattern' => '/art<categorySlug:.*>/<slug:[a-z0-9\-_\.]+>',
                'route' => '/article/view',
            ],
            '/art/<slug>' => '/article/view',
            [
                'encodeParams' => false,
                'pattern' => '/cat<categorySlug:.*>',
                'route' => '/article/category',
            ],
            '/gallery/<slug>' => '/gallery/view',
            '/tag/<tagSlug>' => '/article/tag'
        ],
    ];