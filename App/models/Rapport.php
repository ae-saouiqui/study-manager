<?php
/**
 * @author : Es-saouiqui Amine
*/
namespace Models;

use Core\Model;

class Rapport extends Model
{
public static $table="rapport";

public function ajouterRapport($titre,$fichier,$date,$etudiant,$prof){
    $this->query("INSERT INTO rapport (titre,fichier,date_envoi,id_etudiant,id_prof) VALUES (?,?,?,?,?)",func_get_args());
}
public function getRapportByEtudiant($etudiant){
    return $this->query("SELECT * FROM rapport WHERE id_etudiant=?",array($etudiant));
}
public function getRapportByFiliere($prof,$filiere){
    return $this->query("SELECT * FROM rapport INNER JOIN etudiant ON etudiant.id=rapport.id_etudiant INNER JOIN filiere ON filiere.id=etudiant.id_filiere WHERE id_prof=? AND filiere.id=?",func_get_args())->fetchAll(\PDO::FETCH_ASSOC);
}
public function getRapportByProf($prof){
    return $this->query("SELECT rapport.id,utilisateur.nom,utilisateur.prenom,raccourci,photo_profile,fichier,rapport.titre FROM rapport INNER JOIN etudiant ON etudiant.id=rapport.id_etudiant INNER JOIN utilisateur ON utilisateur.id=etudiant.id_user INNER JOIN filiere ON filiere.id=etudiant.id_filiere  WHERE id_prof=? AND recu=0",array($prof))->fetchAll(\PDO::FETCH_ASSOC);
}
public function recevoirRapport($id){
    $this->query("UPDATE rapport SET recu=? WHERE id=?",array(1,$id));
}
}