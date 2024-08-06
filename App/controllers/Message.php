<?php

namespace Controllers;

use Core\Controller;
use Models\Message as ModelMessage;
class Message extends Controller
{
    public function __construct()
    {
        parent::__construct(new ModelMessage());
    }
    public function addMessage($message,$date,$auteur,$room){
        $this->model->ajouterMessage($message,$date,$auteur,$room);
    }
    public function getMessagesByRoom($room){
        return $this->model->getMessageByRoom($room);
    }
}