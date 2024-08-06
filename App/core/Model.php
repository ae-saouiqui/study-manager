<?php
/**
 * @author : Es-saouiqui Amine
*/
namespace Core;
abstract class Model extends Database
{
    protected function getRows($table){
        return $this->query("SELECT * FROM $table");
    }
    protected function getRow($table,$id){
        return $this->query("SELECT * FROM ".$table." WHERE id=".$id);
    }
    protected function DeleteRow($table,$id){
        $res=$this->query("DELETE FROM ".$table." WHERE id=".$id);
    }
    protected function getColumns($table,$column){
        return $this->query("SELECT $column FROM ".$table);
    }
public static function getLastId($table){
        $connection=new \PDO("mysql:host=".DBHOST.";dbname=".DBNAME,DBUSER,DBPASS);
        $stmt=$connection->query("SELECT id FROM ".$table." ORDER BY id DESC LIMIT 1");
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_NUM);
}
public static function setQuery($query,$params=[]){
        $connection=new \PDO("mysql:host=".DBHOST.";dbname=".DBNAME,DBUSER,DBPASS);
        $stmt=$connection->prepare($query);
        if(!empty($params)){
        foreach ($params as $key=>$value){
            $stmt->bindParam($key+1,$params[$key]);
        }}
        $stmt->execute();
        return $stmt;
}
}