<?php
/**
 * @author : Es-saouiqui Amine
*/
namespace Models;

use Core\Model;

class Message extends Model
{
public static $table="message";
public function ajouterMessage($contenu,$date,$user,$room){
    $this->query("INSERT INTO message (contenu,date_envoi,id_user,id_room) VALUES (?,?,?,?)",func_get_args());
}
public function getRoomMessage(){
    return $this->query("SELECT * FROM message WHERE id_room=?",func_get_arg(0));
}
public function supprimerMessage($id){
    $this->DeleteRow(Message::$table,$id);
}
public function modifierMessage($contenu,$date,$id){
    $this->query("UPDATE message contenu=?,date_envoi=? WHERE id=?",func_get_args());
}
public function deleteMessageByRoom($id){
    $this->query("DELETE FROM message WHERE id_room=?",array($id));
}
public function getMessageByRoom($room){
    return $this->query("SELECT contenu,date_envoi,id_room,id_user,nom,prenom,photo_profile FROM message INNER JOIN utilisateur ON message.id_user=utilisateur.id WHERE id_room=?",array($room))->fetchAll(\PDO::FETCH_ASSOC);
}
}