<?php
/**
 * @author : Es-saouiqui Amine
*/
namespace Models;

use Core\Model;

class Cours extends Model
{
    public static $table="cours";
    public function ajouterCours($titre,$fichier,$prof,$filiere,$module){
        $this->query("INSERT INTO cours (titre,fichier,id_prof,id_filiere,id_module) VALUES (?,?,?,?,?)",func_get_args());
    }
    public function updateCours($fichier,$id){
        $this->query("UPDATE cours SET fichier=? WHERE id=?",func_get_args());
    }
    public function getCoursbyProf($prof){
        return $this->query("SELECT cours.id,cours.titre as cours ,module.titre as module,filiere.raccourci,fichier FROM cours INNER JOIN module ON module.id=cours.id_module INNER JOIN filiere ON cours.id_filiere=filiere.id WHERE cours.id_prof=?",array($prof))->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function getCoursbyFiliere($filiere){
        return $this->query("SELECT cours.titre as cours,utilisateur.nom as nom,utilisateur.prenom as prenom,module.titre module,cours.fichier as fichier FROM cours INNER JOIN professeur ON cours.id_prof=professeur.id INNER JOIN utilisateur ON utilisateur.id=professeur.id_user INNER JOIN module ON cours.id_filiere=module.id_filiere WHERE cours.id_filiere=?",array($filiere))->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function supprimerCours($id){
        $this->DeleteRow(self::$table,$id);
    }


}