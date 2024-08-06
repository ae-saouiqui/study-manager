<?php

namespace Controllers;

use Core\Controller;
use Models\Absence as ModelAbsence;
class Absence extends Controller
{
public function __construct()
{
    parent::__construct(new ModelAbsence());
}
public function isRegistred($date,$module){
    return (bool) !empty($this->model->isRegistred($date,$module));
}
public function noterAbsence($etudiant,$module){
    $this->model->ajouterAbsence(date_format(date_create(),'Y-m-d'),$etudiant,$module);
}
}