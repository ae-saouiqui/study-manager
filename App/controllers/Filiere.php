<?php

namespace Controllers;

use Core\Controller;
use Models\Filiere as ModelFiliere;
class Filiere extends Controller
{
    public function __construct()
    {
        parent::__construct(new ModelFiliere());
    }

    public function getAllFilieres(){
        $_SESSION['filieres']=serialize($this->model->getAllFilieres());
    }
    public function getFiliereByProf($prof){
        $_SESSION['filiere_prof']=$this->model->getFiliereByProf($prof);
    }
    public function getAllFiliereWithPromo(){
        return $this->model->getAllFiliereWithPromo();
    }
    public function getFiliereById($filiere){
        return $this->model->getFilieresById($filiere);
    }


}