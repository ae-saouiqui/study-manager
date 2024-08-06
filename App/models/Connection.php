<?php

namespace Models;

use Core\Model;

class Connection extends Model
{
    public static $table="connection";
    public function isToDayExist(){
        return $this->query("SELECT * FROM connection WHERE date_visit=?",array(date_format(date_create(),'Y-m-d')))->fetch(\PDO::FETCH_ASSOC);
    }
    public function getTodayVisitors(){
        return $this->query("SELECT visitors FROM connection WHERE date_visit=?",array(date_format(date_create(),'Y-m-d')))->fetch(\PDO::FETCH_ASSOC);
    }
    public function getVisitorsLastSevenDays(){
        return $this->query("SELECT visitors FROM connection LIMIT 7",[])->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function AddVisitorToday()
    {
        if (!empty($this->isToDayExist())){
            $visitors=$this->getTodayVisitors()['visitors'];
            $visitors++;
            $this->query("UPDATE  connection SET visitors=? WHERE date_visit=?",[$visitors,date_format(date_create(),'Y-m-d')]);
        }else{
            $this->AddToday();
            $this->query("UPDATE  connection SET visitors=? WHERE date_visit=?",[1,date_format(date_create(),'Y-m-d')]);
        }
    }
    private function AddToday(){
        $this->query("INSERT INTO connection (date_visit) VALUES(?)",array(date_format(date_create(),'Y-m-d')));
    }
}