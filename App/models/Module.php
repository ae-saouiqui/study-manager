<?php
/**
 * @author : Es-saouiqui Amine
*/
namespace Models;

use Core\Model;

class Module extends Model
{
public static $table="module";

public function ajouterModule($titre,$prof,$filiere){
    try{
    $this->query("INSERT INTO module (titre,id_prof,id_filiere) VALUES (?,?,?)",func_get_args());
}catch (\Exception $e){
        throw new \Exception("Impossible d'ajouter le module ".$e->getMessage());
    }
}
public function getModuleByFliere($filiere){
    return $this->query("SELECT * FROM module WHERE id_filiere=?",array($filiere))->fetchAll(\PDO::FETCH_ASSOC);
}
public function getModuleByProf($prof){
    return $this->query("SELECT DISTINCT titre FROM module WHERE id_prof=?",array($prof))->fetchAll(\PDO::FETCH_ASSOC);
}
public function getModulesByTitre($titre){
    return $this->query("SELECT * FROM module WHERE titre=?",array($titre))->fetchAll(\PDO::FETCH_ASSOC);
}
public function isModuleExist($prof,$filiere){
    return $this->query("SELECT * FROM module WHERE id_prof=? AND id_filiere=?",func_get_args())->fetchAll(\PDO::FETCH_ASSOC);
}
}