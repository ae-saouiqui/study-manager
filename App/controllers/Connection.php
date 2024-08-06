<?php

namespace Controllers;

use Core\Controller;
use Models\Connection as ModelConnection;
class Connection extends Controller
{
    public function __construct()
    {
        parent::__construct(new ModelConnection());
    }
    public function addVisitor(){
        $this->model->AddVisitorToday();
    }
    public function getConnections(){
        return $this->model->getVisitorsLastSevenDays();
    }
}