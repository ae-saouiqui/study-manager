<?php
/**
 * @author : Es-saouiqui Amine
*/
namespace Models;

use Core\Model;

class Note extends Model
{
public static $table="NOTE";

public function ajouterNote($note,$module,$etudiant){
    $this->query("INSERT INTO NOTE (valeur,id_module,id_etudiant) VALUES (?,?,?)",func_get_args());
}
public function getNoteByEtudiant($etudiant){
    return $this->query("SELECT * FROM NOTE INNER JOIN MODULE ON MODULE.id=NOTE.id_module WHERE id_etudiant=?",array($etudiant))->fetchAll(\PDO::FETCH_ASSOC);
}
public function getNotesByModuleFiliere($module,$filiere){
    $this->query("SELECT * FROM NOTE INNER JOIN MODULE ON NOTE.id_module=MODULE.id WHERE NOTE.id_module=? AND MODULE.id_filiere=?",func_get_args())->fetchAll(\PDO::FETCH_ASSOC);
}
public function modifierNote($note,$id){
    $this->query("UPDATE NOTE SET valeur=? WHERE id=?",func_get_args());
}
}