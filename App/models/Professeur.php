<?php

/**
 * @author : Es-saouiqui Amine
*/
namespace Models;

use Core\Model;
use Models\Utilisateur;

class Professeur extends Utilisateur
{
public static $table="PROFESSEUR";
public function ajouterProfesseur($nom,$prenom,$email,$mdp,$cin,$naissance,$telephone,$sexe){
    try{
    $this->ajouterUtilisateur(...func_get_args());
    $this->query("INSERT INTO PROFESSEUR (id_user) VALUES (?)",Model::getLastId(Utilisateur::$table));
    }catch (\Exception $e){
        throw $e;
    }}
public function supprimerProfesseur($id){
        $user = $this->getProfesseurUserId($id);
        $this->supprimerUtilisateur($user['id_user']);}
public function getProfesseurUserId($id){
    return $this->query("SELECT PROFESSEUR.id_user FROM PROFESSEUR WHERE id=?",array($id))->fetch(\PDO::FETCH_ASSOC);
}
public function getAllProfesseurs(){
    return $this->query("SELECT * ".Professeur::$table."id as id_prof  FROM ".Professeur::$table." INNER JOIN ".Utilisateur::$table." ON ".Professeur::$table.".id_user=".Utilisateur::$table.".id")->fetchAll(\PDO::FETCH_ASSOC);
}
    public function modifierPassword($id,$password){
        $user=$this->getProfesseurUserId($id);
        if(!empty($user)){
            parent::modifierPassword($password,$user['id_user']);
        }
    }
    public function modifierEmail($email, $id)
    {
        $user=$this->getProfesseurUserId($id);
        if(!empty($user)) {
            parent::modifierEmail($email, $user['id_user']);
        }
    }
    public function modifierPhotoProfile($photo, $id)
    {
        $user=$this->getProfesseurUserId($id);
        if(!empty($user)) {
            parent::modifierPhotoProfile($photo, $user['id_user']);
        }
    }
    public function modifierTelephone($telephone, $id)
    {
        if(in_array($telephone,$this->getAllTelephones())){
        $user=$this->getProfesseurUserId($id);
        if(!empty($user)) {
            parent::modifierTelephone($telephone, $user['id_user']);
        }
    }else{
            throw new \Exception("Un utilisateur Avec ce numero existe deja ");
}}
     protected function getAllTelephones()
     {
         $telephone=[];
         foreach (parent::getAllTelephones() as $key=>$value):
             array_push($telephone,$value[0]);
         endforeach;
         return $telephone;

     }
     public function getProfesseurById($id){
         return $this->query("SELECT * ,PROFESSEUR.id as id_prof FROM ".Professeur::$table." INNER JOIN ".Utilisateur::$table." ON ADMIN.id_user=".Utilisateur::$table.".id WHERE admin.id = ?",array($id))->fetch(\PDO::FETCH_ASSOC);
}
public function getAllProfesseurIdName(){
    return $this->query("SELECT PROFESSEUR.id as id ,nom,prenom,active,photo_profile FROM PROFESSEUR INNER JOIN UTILISATEUR ON PROFESSEUR.id_user=UTILISATEUR.id")->fetchAll(\PDO::FETCH_ASSOC);
}
public function getProfesseurByFiliere($filiere){
    return $this->query("SELECT PROFESSEUR.id as id ,UTILISATEUR.nom as nom,UTILISATEUR.prenom as prenom FROM PROFESSEUR INNER JOIN UTILISATEUR ON PROFESSEUR.id_user=UTILISATEUR.id INNER JOIN MODULE ON PROFESSEUR.id=MODULE.id_prof where MODULE.id_filiere=?",array($filiere))->fetchAll(\PDO::FETCH_ASSOC);
}
public function desactiverProf($id)
{
    $prof=$this->getProfesseurUserId($id);
    $this->desactiverUtilisateur($prof['id_user']);
}
public function activerProf($id){
    $prof= $this->getProfesseurUserId($id);
    $this->activerUtilisateur($prof['id_user']);
}
}