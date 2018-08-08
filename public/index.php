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
        ->setMiddleware([
            new HtmlMiddleware('HTML Prepend 1', HtmlMiddleware::MODE_PREPEND),
            new HtmlMiddleware('HTML Prepend 2', HtmlMiddleware::MODE_PREPEND),
            new HtmlMiddleware('HTML Append 2', HtmlMiddleware::MODE_APPEND),
            new HtmlMiddleware('HTML Append 1', HtmlMiddleware::MODE_APPEND),
            new HeaderMiddleware('X-Pvc', '@dev'),
            new ResponseTimeMiddleware(),
            new HttpBasicAuthMiddleware(['user' => 'pass'])
        ])
        ->run();

} catch (Throwable $t) {

    echo $t->getMessage() . '<br>';
    echo nl2br($t->getTraceAsString());

}
