<?php
/**
 * @important :  run this one in the command line prompt before starting the project
*/
require_once 'vendor/autoload.php';
use Core\Server;
$server=new Server();
$server->run();

