<?php

namespace Controllers;

use Core\Controller;
use Core\ExcelHandler;
use Models\Etudiant as ModelEtudiant;
class Etudiant extends Controller
{
    public function __construct()
    {
        parent::__construct(new ModelEtudiant());
    }

    public function AddFromExcel($file,$filiere){
        try{
            $students=ExcelHandler::toStudentArray($file['tmp_name']);
            foreach($students as $student){
                if ($this->model->isExist($student['cin'],$student['telephone'],$student['cne'])['result']!=0){
                    $message=<<<MESSAGE
ECHEC DE VALIDER LE FICHIER :
L'UTILISATEUR AVEC L'UN DES  COORDONNEES:
CIN : {$student['cin']}<br>
Telephone : {$student['telephone']}<br>
CNE  : {$student['cne']}<br>
existe deja;
MESSAGE;
                    throw new \Exception($message);
            }
            }
            foreach ($students as $student){
                $this->model->ajouterEtudiant($student['nom'],$student['prenom'],$student['email'],$student['mot_de_passe'],$student['cin'],$student['date_naissance'],$student['telephone'],$student['sexe'],$student['cne'],(integer)$filiere);
            }
            return ['success'=>true,'message'=>'les etudiants ont ete ajoute avec succes'];
        }catch (\Exception $e){
            return ['success'=>false,'message'=>$e->getMessage()];
        }
    }
    public function supprimerEtudiantByCNE($cne){
        try{
            $this->model->supprimerEtudiantbyCNE($cne);
            return  ['success'=>true,'message'=>"L'etudiant a ete supprime avec succes"];
        }catch (\Exception $e){
            return ['success'=>false,'message'=>$e->getMessage()];
        }
    }
    public function getEtudiantByFiliere($filiere)
    {
        return $this->model->getEtudiantByFiliere($filiere);
    }
    public function modifierProfile($photo,$prof){
        $this->model->modifierPhotoProfile($photo,$prof);
    }
}