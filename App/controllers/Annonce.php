<?php

namespace Controllers;

use Core\Controller;
use Models\Annonce as ModelAnnonce;
class Annonce extends Controller
{
    public function __construct()
    {
        parent::__construct(new ModelAnnonce());
    }
    public function creerAnnonce($title,$date,$contenu,$file=[]){
        try{
        if(!empty($file)){
            $path=$this->handler->addToAnnonce($file);
            $this->model->ajouterAnonceAvecFichier($title,$date,$contenu,$path);
        }else{
            $this->model->ajouterAnnonceSansFichier($title,$date,$contenu);
        }
        return ['success'=>true,'message'=>"L'annonce a ete cree"];
        }
    catch(Exception $e){
        return ['success'=>false,'message'=>$e->getMessage()];
}}
    public function getAllAnnonce(){
        session_start();
        $_SESSION['annonces']=$this->model->getAllAnnonce();
    }
    public function getNewsAnnonces(){
        return $this->model->getNewestAnnonces();
    }
}
