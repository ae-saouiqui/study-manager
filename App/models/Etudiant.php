<?php
/**
 * @author : Es-saouiqui Amine
*/
namespace Models;

use Core\Model;
use Models\Utilisateur;

class Etudiant extends Utilisateur
{
    public static $table="ETUDIANT";

    public function ajouterEtudiant($nom,$prenom,$email,$mdp,$cin,$naissance,$telephone,$sexe,$cne,$filiere)
    {
        try {
            $this->ajouterUtilisateur($nom, $prenom, $email, $mdp, $cin, $naissance, $telephone, $sexe);
        } catch
        (\PDOException $e) {
            throw new \Exception("Un Utilisateur existe deja",$e);
        }
        try{
            $this->query("INSERT INTO ETUDIANT (id_user,cne,id_filiere) VALUES(?,?,?)",array(Model::getLastId(Utilisateur::$table)[0],$cne,$filiere));
        }catch(\PDOException $e){
            echo $e->getMessage();
            $this->supprimerUtilisateur(Model::getLastId(Utilisateur::$table)[0]);
            throw new \Exception("Un attribut existe deja");
        }
    }

    public function getAllEtudiant(){
        return $this->query("SELECT * ,ETUDIANT.id as id_etud FROM ".Etudiant::$table." INNER JOIN ".Utilisateur::$table." ON ".Utilisateur::$table.".id=ETUDIANT.id_user")->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function getEtudiantById($id){
        return $this->query("SELECT * ,ETUDIANT.id as id_etud FROM ".Etudiant::$table." INNER JOIN ".Utilisateur::$table." ON ".Utilisateur::$table.".id=ETUDIANT.id_user INNER JOIN ".Filiere::$table." ON ".Filiere::$table.".id=".Etudiant::$table.".id_filiere WHERE ETUDIANT.id_user=?",[$id])->fetch(\PDO::FETCH_ASSOC);
    }
    public function getEtudiantByCne($cne){
        return $this->query("SELECT * ,ETUDIANT.id as id_etud,UTILISATEUR.nom as nom_etudiant FROM ".Etudiant::$table." INNER JOIN ".Utilisateur::$table." ON ".Utilisateur::$table.".id=ETUDIANT.id_user INNER JOIN ".Filiere::$table." ON ".Filiere::$table.".id=".Etudiant::$table.".id_filiere WHERE ETUDIANT.cne=?",[$cne])->fetch(\PDO::FETCH_ASSOC);
    }
    public function getEtudiantUserId($id){
        return $this->query("SELECT id_user FROM ETUDIANT WHERE id=?",array($id))->fetch(\PDO::FETCH_ASSOC);
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
        return $this->query("SELECT COUNT(*)  as result FROM ETUDIANT RIGHT JOIN UTILISATEUR ON ETUDIANT.id_user=UTILISATEUR.id where cin=?  or telephone=? or cne=?",array($cin,$phone,$cne))->fetch(\PDO::FETCH_ASSOC);
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
        return $this->query("SELECT annee  FROM ETUDIANT INNER JOIN FILIERE ON ETUDIANT.id_filiere=FILIERE.id INNER JOIN PROMOTION ON FILIERE.id_promo=PROMOTION.id WHERE ETUDIANT.id=?",array($id))->fetch(\PDO::FETCH_ASSOC);
    }
    public function getEtudiantByFiliere($filiere){
        return $this->query("SELECT ETUDIANT.id,cne,UTILISATEUR.nom,prenom,telephone,photo_profile FROM ETUDIANT INNER JOIN FILIERE ON ETUDIANT.id_filiere=FILIERE.id INNER JOIN UTILISATEUR ON ETUDIANT.id_user=UTILISATEUR.id WHERE ETUDIANT.id_filiere=?",array($filiere))->fetchAll(\PDO::FETCH_ASSOC);
}
}