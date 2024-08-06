<?php
/**
 * @author : Es-saouiqui Amine
*/
namespace Models;
use Core\Model;
/**
 * @Utilisateur : Le Modele Concerne La table utilisateur ( Classe abstraite avec des methodes protegees )
*/
 abstract class Utilisateur extends Model
{
    /**
     * @table : Le Nom de la Table dans la base de donnee
    */
    public static $table = "UTILISATEUR";
    /**
     * @param $nom : Nom D'utilisateur
     * @param $prenom : Prenom
     * @param $email : Email D'utilisateur (unique)
     * @param $password : Mot de Passe
     * @param $cin : Carte d'identite National (unique)
     * @param $phone : Numero de Telephone (unique)
     * @param $naissance : date de naissance
     * @param $sexe : Le genre d'utilisateur
    */
    protected function ajouterUtilisateur($nom,$prenom,$email,$password,$cin,$naissance,$phone,$sexe){
        try {
        $this->query("INSERT INTO UTILISATEUR (nom,prenom,email,password,cin,date_naissance,telephone,sexe) VALUES (?,?,?,?,?,?,?,?)",func_get_args());
    }catch (\PDOException $e){
            throw new \Exception("Cette Utilisateur existe deja");
        }
    }

      /**
       * @return array-key : tableau associative contient tous les infos d'utilisateur identifire par ce CIN
        */
    public  function getUtilisateurByCin($cin){
        return $this->query("SELECT * FROM UTILISATEUR WHERE cin=?",array($cin))->fetch(\PDO::FETCH_ASSOC);
    }
    protected function supprimerUtilisateur($id){
        $this->DeleteRow(Utilisateur::$table,$id);
    }
    protected function modifierTelephone($telephone,$id){
        $this->query("UPDATE UTILISATEUR SET telephone=? where id=?",array($telephone,$id));
    }
    protected function modifierEmail($email,$id){
        $this->query("UPDATE UTILISATEUR SET email=? where id=?",array($email,$id));
    }
    protected function modifierPassword($password,$id){
        $this->query("UPDATE UTILISATEUR SET password=? where id=?",array($password,$id));
    }
    protected function modifierPhotoProfile($photo,$id)
    {
        $this->query("UPDATE UTILISATEUR SET photo_profile=? where id=?",array($photo,$id));
    }

    /**
     * @return array-key : tableau assocsiative contient tous les utilisateurs
    */
    protected function getAllUtilisateurs(){
        return $this->getRows(Utilisateur::$table);
    }

    public function ajouterPhotoProfile($photo,$id){
        $this->query("UPDATE UTILISATEUR SET photo_profile=? where id=? ",array($photo,$id));
    }

   protected function getUtilisateurById($id){
        return $this->getRow(Utilisateur::$table,$id)->fetchAll(\PDO::FETCH_ASSOC);
    }
   public static  function login($email,$password){
        return Model::setQuery("SELECT * FROM UTILISATEUR WHERE email=? AND password=?",func_get_args())->fetch(\PDO::FETCH_ASSOC);
    }
   public static  function isActive($id){
        return Model::setQuery("SELECT active FROM UTILISATEUR WHERE id=?",array($id))->fetch(\PDO::FETCH_ASSOC);
    }
   protected function activerUtilisateur($id){
        $this->query("UPDATE UTILISATEUR SET active=1 where id=?",array($id));
    }
  protected function desactiverUtilisateur($id){
        $this->query("UPDATE UTILISATEUR SET active=0 where id=?",array($id));
    }
  protected function getAllTelephones(){
        return $this->getColumns(Utilisateur::$table,"telephone")->fetchAll(\PDO::FETCH_NUM);
  }
  public static function isProfesseur($id){
        return Model::setQuery("SELECT * FROM PROFESSEUR WHERE id_user=?",array($id))->fetch(\PDO::FETCH_ASSOC);
  }
  public static function isAdmin($id){
      return Model::setQuery("SELECT * FROM ADMIN WHERE id_user=?",array($id))->fetch(\PDO::FETCH_ASSOC);
  }
  public static function isEtduiant($id){
      return Model::setQuery("SELECT * FROM ETUDIANT WHERE id_user=?",array($id))->fetch(\PDO::FETCH_ASSOC);
  }
}