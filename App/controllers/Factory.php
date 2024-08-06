<?php
/**
 * @author : Es-saouiqui Amine
*/
namespace Controllers;
class Factory
{
    public function Login(){
        return new Login();
    }
    public function Professeur(){
        return new Professeur();
    }
    public  function Filiere()
    {
        return new Filiere();
    }
    public function Etudiant()
    {
        return new Etudiant();
    }
    public function Annonce(){
        return new Annonce();
    }
    public function Module(){
        return new Module();
    }
    public function Note(){
        return new Note();
}
public function Rapport(){
        return new Rapport();
}
public function Cours(){
        return new Cours();
}
public function Absence(){
        return new Absence();
}
public function Message(){
        return new Message();
}
public function Room()
{
    return new Room();
}
public function Admin(){
        return new Admin();
}
public function Connection(){
        return new Connection();
}
}