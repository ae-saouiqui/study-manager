<?php
/**
 * @author : Es-saouiqui Amine
*/
namespace Core;
use Core\Download;
abstract class Controller
{
    protected $model;
    protected $handler;
    public function __construct($model)
    {
        $this->model = $model;
        $this->handler=new Download();
    }
}