<?php

require '../vendor/autoload.php';

require '../library/HttpBasicAuthMiddleware.php';
require '../library/HeaderMiddleware.php';
require '../library/HtmlMiddleware.php';
require '../library/ResponseTimeMiddleware.php';
require '../library/AuthLoggingEventHandler.php';

use Tebe\Pvc\Application;
use Zend\Diactoros\ServerRequestFactory;

try {

    $config = require '../config/main.php';
    $request = ServerRequestFactory::fromGlobals();

    Application::instance()
        ->setConfig($config)
        ->setRequest($request)
        ->addEventHandler('onRun', new AuthLoggingEventHandler(__DIR__ . '/auth.log'))
        ->setMiddleware([
            new HtmlMiddleware('<!-- HTML Before 1 -->', HtmlMiddleware::MODE_PREPEND),
            new HtmlMiddleware('<!-- HTML After 3 -->', HtmlMiddleware::MODE_APPEND),
            new HtmlMiddleware('<!-- HTML After 2 -->', HtmlMiddleware::MODE_APPEND),
            new HtmlMiddleware('<!-- HTML Before 2 -->', HtmlMiddleware::MODE_PREPEND),
            new HtmlMiddleware('<!-- HTML After 1 -->', HtmlMiddleware::MODE_APPEND),
            new HtmlMiddleware('<!-- HTML Before 3 -->', HtmlMiddleware::MODE_PREPEND),
            new HeaderMiddleware('X-Pvc', '@dev'),
            new ResponseTimeMiddleware(),
            new HttpBasicAuthMiddleware(['user' => 'pass'])
        ])
        ->run();

} catch (Throwable $t) {

    echo $t->getMessage() . '<br>';
    echo nl2br($t->getTraceAsString());

}
