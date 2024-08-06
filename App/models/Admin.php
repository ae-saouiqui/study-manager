<?php

namespace Models;
use Core\Model;
use Models\Utilisateur;

class Admin extends Utilisateur
{
    public static $table="ADMIN";
    public function ajouterAdmin($nom,$prenom,$email,$mdp,$cin,$naissance,$telephone,$sexe){
        try {
            $this->ajouterUtilisateur(...func_get_args());
            $this->query("INSERT INTO ADMIN (id_user) VALUES (?)", Model::getLastId(\Models\Utilisateur::$table));
        }catch(\PDOException $e){
            throw new \Exception("Un attribut existe deja ",$e);
        }}
    public function supprimerAdmin($id){
        $user=$this->getAdminUserId($id);
        if(!empty($user)){
            try {
                $this->beginTransaction();
            $this->query("DELETE FROM ADMIN WHERE id_user=?",[$user['id_user']]);
            $this->supprimerUtilisateur($user['id_user']);
            $this->commmit();
            $this->rollback();
        }catch (\PDOException $e){
                $this->rollback();
            }}
    }
    public function modifierPassword($id,$password){
        $user=$this->getAdminUserId($id);
        if(!empty($user)){
            parent::modifierPassword($password,$user['id_user']);
        }
    }
    public function modifierEmail($email, $id)
    {
        $user=$this->getAdminUserId($id);
        if(!empty($user)) {
            parent::modifierEmail($email, $user['id_user']);
        }
    }
    public function modifierPhotoProfile($photo, $id)
    {
        $user=$this->getAdminUserId($id);
        if(!empty($user)) {
            parent::modifierPhotoProfile($photo, $user['id_user']);
        }
    }
    public function modifierTelephone($telephone, $id)
    {
        $user=$this->getAdminUserId($id);
        if(!empty($user)) {
            parent::modifierTelephone($telephone, $user['id_user']);
        }
    }

    public function getAllAdmins(){
        return $this->query("SELECT * , ".Admin::$table.".id as id_admin FROM ".Admin::$table." INNER JOIN ".Utilisateur::$table." ON ".Admin::$table.".id_user=".Utilisateur::$table.".id")->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function getAdminById($id){
        return $this->query("SELECT * ,ADMIN.id as id_admin FROM ".Admin::$table." INNER JOIN ".Utilisateur::$table." ON ADMIN.id_user=".Utilisateur::$table.".id WHERE admin.id = ?",array($id))->fetch(\PDO::FETCH_ASSOC);
}
   public function getAdminUserId($id){
        return $this->query("SELECT admin.id_user FROM ADMIN WHERE admin.id = ?",array($id))->fetch(\PDO::FETCH_ASSOC);
}
   public function getAdminUser($admin){
        $user=$this->getAdminUserId($admin);
        return $this->getUtilisateurById($user['id_user']);
   }
}