<?php

namespace Models;

use Core\Model;

class Absence extends Model
{
public static $table="ABSENCE";
public function ajouterAbsence($jour,$etudiant,$module){
    $this->query("INSERT INTO ABSENCE (jour,id_etudiant,id_module) VALUES (?,?,?)",func_get_args());
}
public function getEtudiantAbsence($etudiant)
{
    return $this->query("SELECT UTILISATEUR.nom,UTILISATEUR.prenom,ABSENCE.jour,MODULE.titre FROM ABSENCE INNER JOIN ETUDIANT ON ETUDIANT.id=ABSENCE.id_etudiant INNER JOIN UTILISATEUR ON ETUDIANT.id_user=UTILISATEUR.id INNER JOIN MODULE ON MODULE.id=ABSENCE.id_module WHERE ETUDIANT.id=?", array($etudiant))->fetchAll(\PDO::FETCH_ASSOC);
}
public function isRegistred($date,$module){
    return $this->query("SELECT * FROM ABSENCE WHERE jour=? AND id_module=?",func_get_args())->fetchAll(\PDO::FETCH_ASSOC);
}

}