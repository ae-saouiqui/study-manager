<?php

namespace Controllers;
use Core\Controller;
use Models\Module as ModelModule;
class Module extends Controller
{
    public function __construct()
    {
        parent::__construct(new ModelModule());
    }
    public function addModule($title,$prof,$filieres){
        try{
             $arr=explode(',',$filieres);
            foreach ($arr as $filiere):
                $this->model->ajouterModule($title,$prof,$filiere);
            endforeach;
            return ["success"=>true,'message'=>'le module a ete ajoute avec succes'];
        }catch(\Exception $e){
            return ["success"=>false,'message'=>$e->getMessage()];
        }
    }
    public function getModuleByProf($prof){
        $_SESSION['modules']=$this->model->getModuleByProf($prof);
    }
    public function getModuleByTitre($titre){
        return $this->model->getModulesByTitre($titre);
    }
    public function isModuleExist($prof,$filiere){
        return (bool) !empty($this->model->isModuleExist($prof,$filiere));
    }
}