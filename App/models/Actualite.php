<?php
/**
 * @author : Es-saouiqui Amine
*/
namespace Models;

use Core\Model;
use Models\Annonce;
class Actualite extends Model
{
public static $table="ACTUALITE";
public function ajouterActualite($annonce,$filiere){
    $this->query("INSERT INTO ACTUALITE (id_annonce,id_filiere) VALUES(?,?)",func_get_args());
}
public function getAllActualites(){
    return $this->query("SELECT ")
}
public function getActualite($id_annonce){
    return $this->query("SELECT * FROM ACTUALITE WHERE id_annonce=?",array($id_annonce))->fetch(\PDO::FETCH_ASSOC);
}
public function getActualitesByFiliere($filiere){
    return $this->query("SELECT * ,ACTUALITE.id as id_actualite FROM ".Actualite::$table."INNER JOIN ".Annonce::$table." ON ".Actualite::$table.".id_annonce=".Annonce::$table.".id WHERE id_filiere=?",array($filiere))->fetchAll(\PDO::FETCH_ASSOC);
}
public function supprimerActualite($id){
    $this->DeleteRow(Actualite::$table,$id);
}
}