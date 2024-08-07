<?php

namespace Models;

use Core\Model;

class Absence extends Model
{
public static $table="asbence";
public function ajouterAbsence($jour,$etudiant,$module){
    $this->query("INSERT INTO asbence (jour,id_etudiant,id_module) VALUES (?,?,?)",func_get_args());
}
public function getEtudiantAbsence($etudiant)
{
    return $this->query("SELECT utilisateur.nom,utilisateur.prenom,asbence.jour,module.titre FROM asbence INNER JOIN etudiant ON etudiant.id=asbence.id_etudiant INNER JOIN utilisateur ON etudiant.id_user=utilisateur.id INNER JOIN module ON module.id=asbence.id_module WHERE etudiant.id=?", array($etudiant))->fetchAll(\PDO::FETCH_ASSOC);
}
public function isRegistred($date,$module){
    return $this->query("SELECT * FROM asbence WHERE jour=? AND id_module=?",func_get_args())->fetchAll(\PDO::FETCH_ASSOC);
}

}