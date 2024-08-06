<?php
/**
 * @author : Es-saouiqui Amine
*/
namespace Models;

use Core\Model;

class Room extends Model
{
    public static $table="ROOM";
    public function ajouterRoom($prof,$filiere,$titre){
        $this->query("INSERT INTO ROOM (id_prof,id_filiere,titre) VALUES (?,?,?)",array($prof,$filiere,$titre));
    }
    public function supprimerRoom($id){
        $this->DeleteRow(Room::$table,$id);
    }
    public function getAllRooms(){
        return $this->getRows(Room::$table)->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function getRoomsbyProf($prof){
        return $this->query("SELECT * FROM ROOM WHERE id_prof=?",array($prof))->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function getRoomsByFiliere($filiere)
    {
        return $this->query("SELECT * FROM ROOM WHERE id_filiere=?",array($filiere))->fetchAll(\PDO::FETCH_ASSOC);
    }

}