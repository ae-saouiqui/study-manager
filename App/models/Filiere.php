<?php
/**
 * @author : Es-saouiqui Amine
*/
namespace Models;

use Core\Model;

class Filiere extends Model
{
    public static $table="FILIERE";
    public function ajouterFiliere($nom,$raccourci,$promo){
     $this->query("INSERT INTO FILIERE (nom,raccourci,id_promo) VALUES (?,?,?)",array($nom,$raccourci,$promo));
    }
    public function getFilieresByPromo($promo){
        return $this->query("SELECT * FROM FILIERE WHERE id_promo=?",array($promo))->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function getRaccourcis(){
        return $this->getColumns(Filiere::$table,"DISTINCT raccourci")->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function getFilieresNoms(){
        return $this->getColumns(Filiere::$table,"DISTINCT nom")->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function getFilieresById($id){
        return $this->query("SELECT * FROM FILIERE WHERE id=?",array($id))->fetch(\PDO::FETCH_ASSOC);
    }
    public function getFiliereNomRaccourci(){
        return $this->getColumns(Filiere::$table,"DISTINCT nom,raccourci")->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function getAllFilieres(){
        return $this->getColumns(Filiere::$table,"DISTINCT id,nom,raccourci")->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function getPromotion($id){
        return $this->query("SELECT annee FROM FILIERE INNER JOIN PROMOTION ON FILIERE.id_promo=PROMOTION.id WHERE FILIERE.id=?",array($id))->fetch(\PDO::FETCH_ASSOC);
    }
    public function getFiliereByProf($prof){
        return $this->query("SELECT FILIERE.id ,FILIERE.raccourci FROM FILIERE INNER JOIN MODULE ON FILIERE.id=MODULE.id_filiere INNER JOIN PROFESSEUR ON PROFESSEUR.id=MODULE.id_prof WHERE PROFESSEUR.id=?",array($prof))->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function getAllFiliereWithPromo(){
        return $this->query("SELECT FILIERE.id,FILIERE.raccourci,FILIERE.nom,PROMOTION.annee FROM FILIERE INNER JOIN PROMOTION ON FILIERE.id_promo=PROMOTION.id")->fetchAll(\PDO::FETCH_ASSOC);
    }
}