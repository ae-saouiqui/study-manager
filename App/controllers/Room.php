<?php

namespace Controllers;

use Core\Controller;
use Models\Room as RoomModel;


class Room extends Controller
{
public function __construct()
{
    parent::__construct(new RoomModel());
}
public function createRoom($prof,$filiere,$titre){
    try {
        $this->model->ajouterRoom($prof, $filiere, $titre);
        return ['success' => true,'message'=>"Room $titre a ete cree avec succes"];
    }catch (\Exception $e){
        return ['success' => false, 'message' => "Un Erreur s'est Produite Lors de La creation de Room"];
    }
}
public function getRoomsByFiliere($filiere){
    return $this->model->getRoomsByFiliere($filiere);
}
public function getRoomByProf($prof){
    return $this->model->getRoomsbyProf($prof);
}
public function getAllRooms()
{
    return $this->model->getAllRooms();
}
}