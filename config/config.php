<?php


/*
 * Modified: prepend directory path of current file, because of this file own different ENV under between Apache and command line.
 * NOTE: please remove this comment.
 */

use function App\dd;

defined('APP_PATH') || define('APP_PATH', BASE_PATH . '/src');
defined('BASE_URI') || define('BASE_URI', isset($_SERVER['PATH_INFO'])? $_SERVER['PATH_INFO'] : '/');
defined('PROJECT_PATH') || define('PROJECT_PATH', str_replace('\\', '/', substr(BASE_PATH, strlen(str_replace( '/', DIRECTORY_SEPARATOR, $_SERVER['DOCUMENT_ROOT'])))));

return [
    'database'    => [
        'adapter'  => getenv('DB_ADAPTER'),
        'host'     => getenv('DB_HOST'),
        'port'     => getenv('DB_PORT'),
        'username' => getenv('DB_USERNAME'),
        'password' => getenv('DB_PASSWORD'),
        'dbname'   => getenv('DB_NAME'),
    ],
    'application' => [
        'baseUri'         => PROJECT_PATH,
        'publicUrl'       => getenv('APP_PUBLIC_URL'),
        'cryptSalt'       => getenv('APP_CRYPT_SALT'),
        'viewsDir'        => APP_PATH . '/Views/default',
        'controllersDir'  => APP_PATH . '/Controllers/',
        'modelsDir'       => APP_PATH . '/Models/',
        'cacheDir'        => BASE_PATH .'/var/cache/',
        'sessionSavePath' => BASE_PATH . 'var/cache/session/',
    ],
    'mail'        => [
        'fromName'  => getenv('MAIL_FROM_NAME'),
        'fromEmail' => getenv('MAIL_FROM_EMAIL'),
        'smtp'      => [
            'server'   => getenv('MAIL_SMTP_SERVER'),
            'port'     => getenv('MAIL_SMTP_PORT'),
            'security' => getenv('MAIL_SMTP_SECURITY'),
            'username' => getenv('MAIL_SMTP_USERNAME'),
            'password' => getenv('MAIL_SMTP_PASSWORD'),
        ],
    ],
    'logger'      => [
        'path'     => BASE_PATH .'/var/logs/',
        'format'   => '%date% [%type%] %message%',
        'date'     => 'D j H:i:s',
        // 'logLevel' => Logger::DEBUG,
        'filename' => 'application.log',
    ],
    // Set to false to disable sending emails (for use in test environment)
    'useMail'     => true,
];