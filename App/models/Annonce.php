<?php
/**
 * @author : Es-saouiqui Amine
*/
namespace Models;

use Core\Model;
class Annonce extends Model
{
public static $table="ANNONCE";
public function ajouterAnonceSansFichier($titre,$date,$contenu){
    try {
    $this->query("INSERT INTO ANNONCE (titre,date_publication,contenu) VALUES (?,?,?)",func_get_args());
}catch(\Exception $e){
        throw new \Exception("Un Erreur s'est produite lors de la creation d'une annonce");
    }
}
public function ajouterAnonceAvecFichier($titre,$date,$contenu,$fichier){
    try {


        $this->query("INSERT INTO ANNONCE (titre,date_publication,contenu,fichier) VALUES (?,?,?,?)", func_get_args());
    }catch (\Exception $e) {
        throw new \Exception("Un Erreur s'est produite lors del a creation d'une annonce");
    }}


public function getAllAnnonce(){
    return $this->getRows(Annonce::$table)->fetchAll(\PDO::FETCH_ASSOC);
}
public function getAnnonceById($id){
    return $this->query("SELECT * FROM ANNONCE WHERE id=?",array($id))->fetch(\PDO::FETCH_ASSOC);
}
public function getAnnonceByDate($date){
    return $this->query("SELECT * FROM ANNONNCE WHERE date_publication<=?",array($date))->fetchAll(\PDO::FETCH_ASSOC);
}
public function modifierTitre($titre,$id){
    $this->query("UPDATE ANNONCE SET titre=? WHERE id=?",func_get_args());
}
public function modifierFichier($fichier,$id){
    $this->query("UPDATE ANNONCE SET fichier=? WHERE id=?",func_get_args());
}
public function supprimerAnnonce($id){
    $this->DeleteRow(Annonce::$table,$id);
}
public function getNewestAnnonces(){
    return $this->query("SELECT * FROM ANNONCE ORDER BY date_publication LIMIT 5;")->fetchAll(\PDO::FETCH_ASSOC);
}
}