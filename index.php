<?php

declare(strict_types=1);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require 'vendor/autoload.php';

use Monolog\Handler\BrowserConsoleHandler;
use Monolog\Handler\FilterHandler;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

require 'buttons.html';


if (isset($_GET['type'])) {

    $message = $_GET['message'];

    $logger = new Logger('my_logger');
    $logger->pushHandler(new BrowserConsoleHandler());
    $logger->pushHandler(new FilterHandler(new StreamHandler(__DIR__ . '/logs/info.log'), Logger::DEBUG, Logger::NOTICE));
    $logger->pushHandler(new StreamHandler(__DIR__ . '/logs/warning.log', Logger::WARNING));
    $logger->pushHandler(new FilterHandler(new StreamHandler(__DIR__ . '/logs/danger.log'), Logger::ERROR, Logger::ALERT));
    $logger->pushHandler(new StreamHandler(__DIR__ . '/logs/emergency.log', Logger::EMERGENCY));


    switch ($_GET['type']) {

        case 'DEBUG':
            $logger->debug($message);
            break;
        case 'INFO':
            $logger->info($message);
            break;
        case 'NOTICE':
            $logger->notice($message);
            break;
        case 'WARNING':
            $logger->warning($message);
            break;
        case 'ERROR':
            $logger->error($message);
            break;
        case 'CRITICAL':
            $logger->critical($message);
            break;
        case 'ALERT':
            $logger->alert($message);
            break;
        case 'EMERGENCY':
            $logger->emergency($message);
            break;
    }
}



/*
// create a log channel
$log = new Logger('name');
$log->pushHandler(new StreamHandler(__DIR__.'/logs/info.log', Logger::WARNING));


// add records to the log
$log->warning('Foo');
$log->error('Bar');
*/


