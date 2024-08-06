<?php

namespace Controllers;

use Core\Controller;
use Models\Admin as ModelAdmin;
class Admin extends Controller
{
public function __construct()
{
    parent::__construct(new ModelAdmin());
}
    public function getAdmin($id){
        return $this->model->getAdminUser($id);
}
public function modifierProfile($photo,$id){
    $this->model->modifierPhotoProfile($photo,$id);
}

}