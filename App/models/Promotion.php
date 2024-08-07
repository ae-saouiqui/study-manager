<?php
/**
 * @author : Es-saouiqui Amine
*/
namespace Models;

use Core\Model;

class Promotion extends Model
{
public static $table="promotion";
public function ajouterPromotion($annee){
    if (in_array($annee),$this->getAllPromotions()){
        $this->query("INSERT INTO promotion (annee) VALUES (?)",array($annee));
    }
}
public function getAllPromotions(){
    return $this->getColumns(Promotion::$table,'annee')->fetchAll(\PDO::FETCH_NUM);
}
public function getPromotion($id){
    $this->query("SELECT annee FROM promotion WHERE id=?",array($id))->fetch(\PDO::FETCH_ASSOC);
}
}