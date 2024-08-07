<?php
/**
 * @author : Es-saouiqui Amine
*/
namespace Models;

use Core\Model;

class Filiere extends Model
{
    public static $table="filiere";
    public function ajouterFiliere($nom,$raccourci,$promo){
     $this->query("INSERT INTO filiere (nom,raccourci,id_promo) VALUES (?,?,?)",array($nom,$raccourci,$promo));
    }
    public function getFilieresByPromo($promo){
        return $this->query("SELECT * FROM filiere WHERE id_promo=?",array($promo))->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function getRaccourcis(){
        return $this->getColumns(Filiere::$table,"DISTINCT raccourci")->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function getFilieresNoms(){
        return $this->getColumns(Filiere::$table,"DISTINCT nom")->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function getFilieresById($id){
        return $this->query("SELECT * FROM filiere WHERE id=?",array($id))->fetch(\PDO::FETCH_ASSOC);
    }
    public function getFiliereNomRaccourci(){
        return $this->getColumns(Filiere::$table,"DISTINCT nom,raccourci")->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function getAllFilieres(){
        return $this->getColumns(Filiere::$table,"DISTINCT id,nom,raccourci")->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function getPromotion($id){
        return $this->query("SELECT annee FROM filiere INNER JOIN promotion ON filiere.id_promo=promotion.id WHERE filiere.id=?",array($id))->fetch(\PDO::FETCH_ASSOC);
    }
    public function getFiliereByProf($prof){
        return $this->query("SELECT filiere.id ,filiere.raccourci FROM filiere INNER JOIN module ON filiere.id=module.id_filiere INNER JOIN professeur ON professeur.id=module.id_prof WHERE professeur.id=?",array($prof))->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function getAllFiliereWithPromo(){
        return $this->query("SELECT filiere.id,filiere.raccourci,filiere.nom,promotion.annee FROM filiere INNER JOIN promotion ON filiere.id_promo=promotion.id")->fetchAll(\PDO::FETCH_ASSOC);
    }
}