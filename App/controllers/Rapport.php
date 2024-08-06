<?php

namespace Controllers;

use Core\Controller;
USE Models\Rapport as ModelRapport;
class Rapport extends Controller
{
public function __construct()
{
    parent::__construct(new ModelRapport());
}
public function addRapport($title,$fichier,$etudiant,$prof){
    try{
    $path=$this->handler->addToRapport($fichier);
    $this->model->ajouterRapport($title,$path,date_format(date_create(),'Y-m-d H:i:s'),$etudiant,$prof);
        return ['success'=>true,'message'=>'Le rapport a ete envoye avec success'];
}catch (\Exception $e){
        return ['success'=>false,'message'=>$e->getMessage()];
    }
}
public function getRapportByProf($prof){
    return $this->model->getRapportByProf($prof);
}
public function recieveRapport($rapport){
    $this->model->recevoirRapport($rapport);
}
}