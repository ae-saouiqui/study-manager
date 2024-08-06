<?php

namespace Controllers;

use Core\Controller;
use Core\ExcelHandler;
use Models\Note as ModelNote;
class Note extends Controller
{
    public function __construct()
    {
        parent::__construct(new ModelNote());
    }
    public function exportNote($students,$filiere){
        ExcelHandler::createNoteFile($students,$filiere);
    }
    public function AjouterNoteParExcel($file,$module){
        try{
        $notes=ExcelHandler::toNoteArray($file['tmp_name']);
        foreach ($notes as $note) {
            $this->model->ajouterNote($note['note'],$module,$note['id']);
        }
        return ['success'=>true,'message'=>'les notes sont ajoutes avec succes'];
    }catch (\Exception $e){
            return ['success'=>false,'message'=>$e->getMessage()];
        }
    }
    public function getNoteParEtduiant($etudiant){
        $_SESSION['notes']=$this->model->getNoteByEtudiant($etudiant);
    }
}