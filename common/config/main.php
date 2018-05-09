<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'geoip' => [
            'class' => 'app\components\CGeoIP',
            'filename' => dirname(__DIR__) . '/components/GeoIP/GeoIP.dat', // specify filename location for the corresponding database
            'mode' => 'STANDARD',  // Choose MEMORY_CACHE or STANDARD mode
        ]
    ],
];
