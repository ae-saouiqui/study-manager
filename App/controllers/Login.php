<?php

namespace Controllers;

use Core\Controller;
use Models\Utilisateur;

class Login extends Controller
{
    public function __construct()
    {
        parent::__construct("");
    }
    public function login($email, $password){
        session_start();
        $user=Utilisateur::login($email,$password);
        if(!empty($user)){
                session_regenerate_id(true);
            $isactive=Utilisateur::isActive($user["id"]);
            if($isactive['active']==1){
                $admin=Utilisateur::isAdmin($user['id']);
                if(!empty($admin)){
                $_SESSION["admin"]=serialize($user);
                    $_SESSION['id_admin']=$admin['id'];
                    $_SESSION['type']='admin';
                    return ['success'=>true,
                        'type'=>"admin"];
                }else{
                    $prof=Utilisateur::isProfesseur($user['id']);
                    if(!empty($prof)){
                $_SESSION["professeur"]=serialize($user);
                        $_SESSION['id_prof']=$prof['id'];
                        $_SESSION['type']='professeur';
                        return ['success'=>true,
                            'type'=>"professeur"];
                    }else{
                        $etudiant=Utilisateur::isEtduiant($user['id']);
                        if(!empty($etudiant)){
                $_SESSION["etudiant"]=serialize($user);
                        $_SESSION["id_etudiant"]=$etudiant['id'];
                        $_SESSION['filiere']=$etudiant['id_filiere'];
                        $_SESSION['cne']=$etudiant['cne'];
                        $_SESSION['type']='etudiant';
                        return ['success'=>true,
                            'type'=>"etudiant"];
                    }else{
                            session_destroy();
                            return ['success'=>false];
                        }
                    }
                }
            }else{
                session_destroy();
                return ['success'=>false];
            }
        }else{
            session_destroy();
            return ['success'=>false];
        }

    }
}
