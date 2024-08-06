<?php
/**
 * @author : Es-saouiqui Amine
*/
namespace Core;
use PDO;
require 'config.php';
abstract class Database
{

    private $con;

    public function __construct(){
        $this->con=new \PDO("mysql:host=".DBHOST.";dbname=".DBNAME,DBUSER,DBPASS);
    }

    public function query($query,$params=[]){
        $stmt=$this->con->prepare($query);
        if(!empty($params)) {
            foreach ($params as $key => $value):
                $stmt->bindParam($key+1,$params[$key]);
            endforeach;
        }
        $stmt->execute();
        return $stmt;
}
protected function getAllTables(){
        return $this->con->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
}
public function beginTransaction(){
    $this->con->beginTransaction();
}
public function rollback(){
        if($this->con->inTransaction()) {
            $this->con->rollBack();
        }
}
public function commmit(){
        $this->con->commit();
}
public function isTransactionActive()
{
    return $this->con->inTransaction() ? true : false;
}
public function lastInsertedId(){
        return $this->con->lastInsertId();
}
}


