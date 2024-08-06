<?php

namespace Controllers;
use Core\Controller;
use Models\Professeur as ProfModel;

class Professeur extends Controller
{
    public function __construct(){
        parent::__construct(new ProfModel());
    }
    public function ajouter($nom,$prenom,$email,$password,$cin,$naissance,$telephone,$sexe,$profile){
        try {
            $this->model->ajouterProfesseur($nom,$prenom,$email,$password,$cin,$naissance,$telephone,$sexe);
            if(!empty($profile)) {
            $user = $this->model->getUtilisateurByCin($cin);
            $path = $this->handler->addToMedia($profile);
                $this->model->ajouterPhotoProfile($path, $user['id']);
                session_start();
                $this->getAllProfesseurIdName();
            }
            echo json_encode(array('success'=>true,'message'=>"$nom $prenom a ete ajoute avec succes"));
        }catch (\Exception $e){
            echo json_encode(['success' => false,'message' => $e->getMessage()]);
        }

    }
    public function getAllProfesseurIdName(){
        $_SESSION['profs']=$this->model->getAllProfesseurIdName();
    }
    public function getProfesseurByFiliere($filiere){
        $_SESSION['profs_filiere']=$this->model->getProfesseurByFiliere($filiere);
    }
    public function desactiverProf($prof){
        $this->model->desactiverProf($prof);
        $this->getAllProfesseurIdName();
    }
    public function activerProf($prof){
        $this->model->activerProf($prof);
        $this->getAllProfesseurIdName();
    }
    public function supprimerProf($prof){
        $this->model->supprimerProfesseur($prof);
    }
    public function modifierProfile($photo,$prof){
        $this->model->modifierPhotoProfile($photo,$prof);
    }
}