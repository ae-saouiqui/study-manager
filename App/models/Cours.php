<?php
/**
 * @author : Es-saouiqui Amine
*/
namespace Models;

use Core\Model;

class Cours extends Model
{
    public static $table="COURS";
    public function ajouterCours($titre,$fichier,$prof,$filiere,$module){
        $this->query("INSERT INTO COURS (titre,fichier,id_prof,id_filiere,id_module) VALUES (?,?,?,?,?)",func_get_args());
    }
    public function updateCours($fichier,$id){
        $this->query("UPDATE COURS SET fichier=? WHERE id=?",func_get_args());
    }
    public function getCoursbyProf($prof){
        return $this->query("SELECT cours.id,cours.titre as cours ,module.titre as module,filiere.raccourci,fichier FROM COURS INNER JOIN MODULE ON MODULE.id=COURS.id_module INNER JOIN FILIERE ON COURS.id_filiere=FILIERE.id WHERE cours.id_prof=?",array($prof))->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function getCoursbyFiliere($filiere){
        return $this->query("SELECT COURS.titre as cours,UTILISATEUR.nom as nom,UTILISATEUR.prenom as prenom,MODULE.titre module,COURS.fichier as fichier FROM COURS INNER JOIN PROFESSEUR ON COURS.id_prof=PROFESSEUR.id INNER JOIN UTILISATEUR ON UTILISATEUR.id=PROFESSEUR.id_user INNER JOIN MODULE ON COURS.id_filiere=MODULE.id_filiere WHERE COURS.id_filiere=?",array($filiere))->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function supprimerCours($id){
        $this->DeleteRow(self::$table,$id);
    }


}