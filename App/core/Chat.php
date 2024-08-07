<?php

namespace Core;

use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;
use Controllers\Message;
use Controllers\Room;
class Chat implements MessageComponentInterface
{
    private $message;
    private $room;
    private $clients;

    public function __construct(){
        $this->message=new Message();
        $this->room=new Room();
        $this->clients=new \SplObjectStorage;
    }
    function onOpen(ConnectionInterface $conn)
    {
        $this->clients->attach($conn);
        echo "Connection Established\n";
    }

    function onClose(ConnectionInterface $conn)
    {
        $this->clients->detach($conn);
    }

    function onError(ConnectionInterface $conn, \Exception $e)
    {
    }

    function onMessage(ConnectionInterface $from, $msg)
    {
        $data = json_decode($msg);
        $date=date_format(date_create(),"Y-m-d H:i:s");
            $this->message->addMessage($data->message,$date,$data->sender,$data->room);
        foreach ($this->clients as $client) {
            if($client!==$from)$client->send(json_encode(["success"=>true,"message"=>$data->message,"profile"=>$data->profile,"name"=>$data->name,"date"=>$date,"room"=>$data->room]));
        }
    }
}