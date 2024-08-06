<?php
namespace Core;
trait Validator
{
     private static function checkEmail($email){
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
     private static function checkPhone($phone){
        return preg_match('/^\d{9}$/',$phone);
    }
     private static function checkCin($cin){
        return preg_match('/^[A-Z][A-Z0-9]\d{5}$/',$cin);
    }
     private static function checkCne($cne){
        return preg_match('/^[A-Z]\d{9}$/',$cne);
    }
    private static function checkName($name){
         return preg_match('/^[A-Za-z\s]+$/',$name);
    }
}
