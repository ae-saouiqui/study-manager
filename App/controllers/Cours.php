<?php

namespace Controllers;

use Core\Controller;
use Models\Cours as ModelCours;
class Cours extends Controller
{
    public function __construct()
    {
        parent::__construct(new ModelCours());
    }

    public function addCours($titre,$fichier,$prof,$filiere,$module){
        $this->model->ajouterCours($titre,$fichier,$prof,$filiere,$module);
    }
    public function getCoursByFiliere($filiere){
        session_start();
        $_SESSION['cours']=$this->model->getCoursbyFiliere($filiere);
    }
    public function getCoursByProf($prof)
    {
        return $this->model->getCoursbyProf($prof);
    }
    public function deleteCours($cours){
        $this->model->supprimerCours($cours);
    }
}