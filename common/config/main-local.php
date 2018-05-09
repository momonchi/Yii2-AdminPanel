<?php


return [
   'components' => [
       'db' => [                   
           'class' => 'yii\db\Connection',
           'dsn' => 'mysql:host=localhost;dbname=adminpaneldb',  
           'username' => 'root',
           'password' => '',
           'charset' => 'utf8',
       ],  
       'geoip' => [
           'class' => 'app\components\CGeoIP',
           'filename' => dirname(__DIR__) . '/components/GeoIP/GeoIP.dat', // specify filename location for the corresponding database
           'mode' => 'STANDARD',  // Choose MEMORY_CACHE or STANDARD mode
       ],
//        'redis' => [
//            'class' => 'yii\redis\Connection',
//            'hostname' => '54.254.227.208',
//            'port' => 6379,
//            'database' => 0,
//        ],
//        'redis_local' => [
//            'class' => 'yii\redis\Connection',
//            'hostname' => '127.0.0.1',
//            'port' => 6379,
//            'database' => 0,
//        ],
//        'redisslavetest' => [
//            'class' => 'yii\redis\Connection',
//            'hostname' => '127.0.0.1',
//            'port' => 6301,
//            'database' => 0,
//        ],
       
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
             'transport' => [
                        'class' => 'Swift_SmtpTransport',
                        'host' => 'gator4187.hostgator.com',                         
                        'username' => 'momonchi.main@gmail.com', // from orlyonx@gmail.com
                        'password' => 'testpassword',                                   
                        'port' => '465',
                        'encryption' => 'ssl',
                        ], 
        ],
        
        //http://techisworld.com/working-with-multiple-languages-app-in-yii2-framework-using-i18n-system.html
         'i18n' => [ 
                'translations' => [ 
                    'app' => [ 'class' => 'yii\i18n\PhpMessageSource', 
                    'basePath' => '../../common/messages', 
                    // 'sourceLanguage' => 'en-US', 
                    'fileMap' => [ 'app' => 'app.php', 
                                    'app/error' => 'error.php', ], 
                               ], 
                ], 
              ], 
        
    ],
];