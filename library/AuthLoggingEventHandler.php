<?php

use Tebe\Pvc\Application;
use Tebe\Pvc\Event;
use Tebe\Pvc\EventHandler;

class AuthLoggingEventHandler implements EventHandler {

    protected $logFile;

    public function __construct($logFile) {
        $this->logFile = $logFile;
    }

    public function handle(Event $event) : void {

        $authData = $event->getInfo();

        $fields = array(
                    date('Y-m-d H:i:s'),
                    json_encode(Application::instance()->getRequest()->getServerParams()),
                    $event->getName(),
                    $authData['user'],
                    $authData['password']
                );

        error_log(implode('|', $fields) . "\n", 3, $this->logFile);
    }
}
