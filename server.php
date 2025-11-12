<?php
/**
 * @important :  Host this in a reactive server/async server.
   @important :  Ensure you disable the hosting glitch node server 
*/
require_once 'vendor/autoload.php';
use Core\Server;
$server=new Server();
$server->run();

