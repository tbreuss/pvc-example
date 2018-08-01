<?php

require "../vendor/autoload.php";
require "../library/HeaderMiddleware.php";
require "../library/HttpBasicAuthMiddleware.php";
require "../library/HtmlMiddleware.php";
require "../library/ResponseTimeMiddleware.php";

use Tebe\Pvc\Application;

try {

    $config = require "../config/main.php";
    Application::instance($config)
        ->addMiddleware(new HtmlMiddleware('HTML Prepend 1', HtmlMiddleware::MODE_PREPEND))
        ->addMiddleware(new HtmlMiddleware('HTML Prepend 2', HtmlMiddleware::MODE_PREPEND))
        ->addMiddleware(new HtmlMiddleware('HTML Append 2', HtmlMiddleware::MODE_APPEND))
        ->addMiddleware(new HtmlMiddleware('HTML Append 1', HtmlMiddleware::MODE_APPEND))
        ->addMiddleware(new HeaderMiddleware('X-Pvc', '@dev'))
        ->addMiddleware(new ResponseTimeMiddleware())
        ->addMiddleware(new HttpBasicAuthMiddleware(['user' => 'pass']))
        ->run();

} catch (Throwable $t) {

    echo $t->getMessage() . '<br>';
    echo nl2br($t->getTraceAsString());

}
