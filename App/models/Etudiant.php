<?php
/**
 * @author : Es-saouiqui Amine
*/
namespace Models;

use Core\Model;
use Models\Utilisateur;

class Etudiant extends Utilisateur
{
    public static $table="etudiant";

    public function ajouterEtudiant($nom,$prenom,$email,$mdp,$cin,$naissance,$telephone,$sexe,$cne,$filiere)
    {
        try {
            $this->ajouterUtilisateur($nom, $prenom, $email, $mdp, $cin, $naissance, $telephone, $sexe);
        } catch
        (\PDOException $e) {
            throw new \Exception("Un Utilisateur existe deja",$e);
        }
        try{
            $this->query("INSERT INTO etudiant (id_user,cne,id_filiere) VALUES(?,?,?)",array(Model::getLastId(Utilisateur::$table)[0],$cne,$filiere));
        }catch(\PDOException $e){
            echo $e->getMessage();
            $this->supprimerUtilisateur(Model::getLastId(Utilisateur::$table)[0]);
            throw new \Exception("Un attribut existe deja");
        }
    }

    public function getAllEtudiant(){
        return $this->query("SELECT * ,etudiant.id as id_etud FROM ".Etudiant::$table." INNER JOIN ".Utilisateur::$table." ON ".Utilisateur::$table.".id=etudiant.id_user")->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function getEtudiantById($id){
        return $this->query("SELECT * ,etudiant.id as id_etud FROM ".Etudiant::$table." INNER JOIN ".Utilisateur::$table." ON ".Utilisateur::$table.".id=etudiant.id_user INNER JOIN ".Filiere::$table." ON ".Filiere::$table.".id=".Etudiant::$table.".id_filiere WHERE etudiant.id_user=?",[$id])->fetch(\PDO::FETCH_ASSOC);
    }
    public function getEtudiantByCne($cne){
        return $this->query("SELECT * ,etudiant.id as id_etud,utilisateur.nom as nom_etudiant FROM ".Etudiant::$table." INNER JOIN ".Utilisateur::$table." ON ".Utilisateur::$table.".id=etudiant.id_user INNER JOIN ".Filiere::$table." ON ".Filiere::$table.".id=".Etudiant::$table.".id_filiere WHERE etudiant.cne=?",[$cne])->fetch(\PDO::FETCH_ASSOC);
    }
    public function getEtudiantUserId($id){
        return $this->query("SELECT id_user FROM etudiant WHERE id=?",array($id))->fetch(\PDO::FETCH_ASSOC);
    }
    public function supprimerEtudiant($id){
        $user=$this->getEtudiantUserId($id);
        if(!empty($user)){
            $this->supprimerUtilisateur($user['id_user']);
        }
    }
    public function modifierTelephone($telephone, $id)
    {
        parent::modifierTelephone($telephone, $id);
    }
    public function modifierPassword($password, $id)
    {
        parent::modifierPassword($password, $id);
    }
    public function modifierEmail($email, $id)
    {
        parent::modifierEmail($email, $id);
    }
    public function modifierPhotoProfile($photo, $id)
    {
        $user=$this->getEtudiantUserId($id);
        parent::modifierPhotoProfile($photo, $user['id_user']);
    }
    public function isExist($cin="",$phone="",$cne=""){
        return $this->query("SELECT COUNT(*)  as result FROM etudiant RIGHT JOIN utilisateur ON etudiant.id_user=utilisateur.id where cin=?  or telephone=? or cne=?",array($cin,$phone,$cne))->fetch(\PDO::FETCH_ASSOC);
    }
    public function supprimerEtudiantbyCNE($cne)
    {
        $user=$this->getEtudiantByCne($cne);
        if(!empty($user)){
                $this->supprimerEtudiant($user['id_etud']);
        }else{
                throw new \Exception("Cette utilisateur n'existe pas");
        }
    }
    public function getPromotion($id){
        return $this->query("SELECT annee  FROM etudiant INNER JOIN filiere ON etudiant.id_filiere=filiere.id INNER JOIN promotion ON filiere.id_promo=promotion.id WHERE etudiant.id=?",array($id))->fetch(\PDO::FETCH_ASSOC);
    }
    public function getEtudiantByFiliere($filiere){
        return $this->query("SELECT etudiant.id,cne,utilisateur.nom,prenom,telephone,photo_profile FROM etudiant INNER JOIN filiere ON etudiant.id_filiere=filiere.id INNER JOIN utilisateur ON etudiant.id_user=utilisateur.id WHERE etudiant.id_filiere=?",array($filiere))->fetchAll(\PDO::FETCH_ASSOC);
}
}