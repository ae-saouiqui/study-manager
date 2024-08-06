<?php

namespace Core;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;
use Ratchet\Http\HttpServer;
use Core\Chat;
class Server
{
    private $server;
    public function __construct(){
        $this->server=IoServer::factory(
            new HttpServer(
                new WsServer(
                    new Chat()
                )
            ),
            8080
        );
    }
    public function run(){
        $this->server->run();
    }

}