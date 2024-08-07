<?php
/**
 * @author : Es-saouiqui Amine
*/
namespace Models;

use Core\Model;

class Note extends Model
{
public static $table="note";

public function ajouterNote($note,$module,$etudiant){
    $this->query("INSERT INTO note (valeur,id_module,id_etudiant) VALUES (?,?,?)",func_get_args());
}
public function getNoteByEtudiant($etudiant){
    return $this->query("SELECT * FROM note INNER JOIN module ON module.id=note.id_module WHERE id_etudiant=?",array($etudiant))->fetchAll(\PDO::FETCH_ASSOC);
}
public function getNotesByModuleFiliere($module,$filiere){
    $this->query("SELECT * FROM note INNER JOIN module ON note.id_module=module.id WHERE note.id_module=? AND module.id_filiere=?",func_get_args())->fetchAll(\PDO::FETCH_ASSOC);
}
public function modifierNote($note,$id){
    $this->query("UPDATE note SET valeur=? WHERE id=?",func_get_args());
}
}