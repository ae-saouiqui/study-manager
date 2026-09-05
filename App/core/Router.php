<?php

namespace Core;
use Controllers;
class Router
{
    private $factory;
    public function __construct(){
        $this->factory=new \Controllers\Factory();
    }
    public function get($action)
    {
        switch($action){
            case 'getAllAnnonce':
                $this->factory->Annonce()->getAllAnnonce();
                header('location:/App/views/annonce.php');
                break;
            case 'exportNote':
                $this->validatorSession($_GET['prof'],'id_prof');
                $etudiant=$this->factory->Etudiant()->getEtudiantByFiliere($_GET['filiere']);
                if (!empty($etudiant)){
                    $this->factory->Note()->exportNote($etudiant,$_GET['raccourci']);
                }
                break;
            case 'getNote':
                $this->validatorSession($_GET['etud'],'id_etudiant');
                $this->factory->Note()->getNoteParEtduiant($_GET['etud']);
                header('location:/App/views/notes.php');
                break;
            case 'getCours':
                $this->factory->Cours()->getCoursByFiliere($_GET['filiere']);
                header('location:/App/views/cours.php');
                break;
            case 'getAbsence':
                $this->validatorSession($_GET['prof'],'id_prof');
                $modules=array_values(array_filter($this->factory->Module()->getModuleByTitre($_GET['module']),fn($element)=>$element['id_filiere']==$_GET['filiere']));
                if(!empty($modules)){
                    $etudiant=$this->factory->Etudiant()->getEtudiantByFiliere($_GET['filiere']);
                    $_SESSION['etud_abs']=$etudiant;
                    $_SESSION['module_abs']=$modules[0]['id'];
                    echo json_encode(['success'=>true,'titre'=>$_GET['raccourci'],'module'=>$modules[0]['titre']]);
                }
                break;
            case 'chat':
                switch($_GET['type']){
                    case 'etud':
                        $this->validatorSession($_GET['id'],'filiere');
                        $_SESSION['rooms']=$this->factory->Room()->getRoomsByFiliere($_GET['id']);
                        header('location:/App/views/room.php?type=etudiant');
                        exit;
                        break;
                    case 'prof':
                        $this->validatorSession($_GET['id'],'id_prof');
                        $_SESSION['rooms']=$this->factory->Room()->getRoomByProf($_GET['id']);
                        header('location:/App/views/room.php?type=professeur');
                        break;
                }
                break;
            case 'message':
                echo json_encode($this->factory->Message()->getMessagesByRoom($_GET['room']));
                break;
            case 'getRapport':
                $this->validatorSession($_GET['prof'],'id_prof');
                $_SESSION['rapports']=$this->factory->Rapport()->getRapportByProf($_GET['prof']);
                header('location:/App/views/rapport.php');
                break;
            case 'getCoursProf':
                $this->validatorSession($_GET['prof'],'id_prof');
                $_SESSION['cours_prof']=$this->factory->Cours()->getCoursByProf($_GET['prof']);
                header("location:/App/views/coursProf.php");
                break;
            case 'logout':
                session_start();
                $this->logout();
                break;
            case 'getAllFiliere':
                session_start();
                $_SESSION['fil_full']=$this->factory->Filiere()->getAllFiliereWithPromo();
                header('location:/App/views/filiere.php');
                break;
            case 'getAllRooms':
                session_start();
                $_SESSION['all_rooms']=$this->factory->Room()->getAllRooms();
                header('location:/App/views/rooms.php');
                break;
            case 'getEtudiants':
                session_start();
                if ($_SESSION['id_admin']==$_GET['id']){
                    $_SESSION['etudiants']=$this->factory->Etudiant()->getEtudiantByFiliere($_GET['filiere']);
                    $filiere=$this->factory->Filiere()->getFiliereById($_GET['filiere']);
                    header('location:/App/views/etudiants.php?filiere='.$filiere['nom'].'&raccourci='.$filiere['raccourci']);
                }else $this->logout();
                break;
            default:
                session_start();
                $this->logout();
                break;
        }
    }
    public function post($action){
        switch ($action){
            case 'login':
                $data=json_decode(file_get_contents("php://input"));
                $respone=$this->factory->Login()->login($data->email,$data->password);
                if(count($respone)>=2) {
                    $_SESSION['actualite']=$this->factory->Annonce()->getNewsAnnonces();
                    $this->factory->Connection()->addVisitor();
                    $_SESSION['visitors']=$this->factory->Connection()->getConnections();
                    switch ($respone['type']){
                        case 'admin':
                            $this->factory->Filiere()->getAllFilieres();
                            $this->factory->Professeur()->getAllProfesseurIdName();
                            break;
                        case 'professeur':
                            $this->factory->Filiere()->getFiliereByProf($_SESSION['id_prof']);
                            $this->factory->Module()->getModuleByProf($_SESSION['id_prof']);
                            break;
                        case 'etudiant':
                            $this->factory->Professeur()->getProfesseurByFiliere($_SESSION['filiere']);
                            break;
                    }}
                echo json_encode($respone);
                break;
            case 'addProf':
                if(!empty($_POST)){
                    $this->factory->Professeur()->ajouter($_POST['nom'],$_POST['prenom'],$_POST['email'],$_POST['password'],$_POST['cin'],$_POST['birthday'],$_POST['phone'],$_POST['sexe'],(!empty($_FILES))?$_FILES['picture']:[]);
                }
                break;
            case 'AddClass':
                if(!empty($_POST) and !empty($_FILES)){
                    echo json_encode($this->factory->Etudiant()->AddFromExcel($_FILES['file'],$_POST['filiere'][0]));
                }else{
                    echo json_encode(array('success'=>false,'message'=>"Donees invalide"));
                }
                break;
            case 'DeleteStudent':
                if (!empty($_POST)) {
                    echo json_encode($this->factory->Etudiant()->supprimerEtudiantByCNE($_POST['cne']));
                }else{
                    echo json_encode(array('success'=>false,'message'=>"Donees invalide"));
                }
                break;
            case 'addAnnonce':
                if (!empty($_POST)) {
                    $params=[$_POST['title'],date_format(date_create(),"Y-m-d H:i:s"),$_POST['contenu']];
                    if (!empty($_FILES)) {
                        array_push($params,$_FILES['file']);
                    }
                    echo json_encode($this->factory->Annonce()->creerAnnonce(...$params));
                }
                break;
            case 'addModule':
                echo json_encode($this->factory->Module()->addModule($_POST['titre'],$_POST['prof'],$_POST['filieres'][0]));
                break;
            case 'addNote':
                $classe=array_values(array_filter($this->factory->Module()->getModuleByTitre($_POST['module']),fn($element)=>$element['id_filiere']==$_POST['filiere']));
                if(!empty($classe)){
                    echo json_encode($this->factory->Note()->AjouterNoteParExcel($_FILES['file'],$classe[0]['id']));
                }else{
                    echo json_encode(['success'=>false,'message'=>"Cette filiere ne possede pas a ce module"]);
                }
                break;
            case 'addRapport':
                echo json_encode($this->factory->Rapport()->addRapport($_POST['title'],$_FILES['file'],$_POST['etudiant'],$_POST['prof']));
                break;
            case 'addCours':
                try {
                    $modules = $this->factory->Module()->getModuleByTitre($_POST['module']);
                    $classes = array_filter($modules, fn($module) => $module['id_prof'] == $_POST['prof']);
                    $download=new Download();
                    $path=$download->addToCours($_FILES['file']);
                    foreach ($classes as $classe):
                        $this->factory->Cours()->addCours($_POST['titre'],$path,$classe['id_prof'],$classe['id_filiere'],$classe['id']);
                    endforeach;
                    echo json_encode(['success'=>true,'message'=>'Le cours a ete depose avec succes']);
                }catch(\Exception $e){
                    echo json_encode(['success'=>false,'message'=>$e->getMessage()]);
                }
                break;
            case 'desactiverProf':
                session_start();
                $this->factory->Professeur()->desactiverProf($_POST['prof']);
                break;
            case 'activerProf':
                session_start();
                $this->factory->Professeur()->activerProf($_POST['prof']);
                break;
            case 'deleteProf':
                session_start();
                $this->factory->Professeur()->supprimerProf($_POST['prof']);
                $this->factory->Professeur()->getAllProfesseurIdName();
                break;
            case 'noterAbsence':
                if(!$this->factory->Absence()->isRegistred(date_format(date_create(),'Y-m-d'),$_POST['module'])){
                    $etudiants=explode(',',$_POST['etudiants']);
                    foreach ($etudiants as $etudiant):
                        $this->factory->Absence()->noterAbsence($etudiant,$_POST['module']);
                    endforeach;
                    session_start();
                    unset($_SESSION['etud_abs']);
                    unset($_SESSION['module_abs']);
                    echo json_encode(['success'=>true,'message'=>"L'absence D'aujourd'hui a ete enregistre"]);
                }else {
                    session_start();
                    unset($_SESSION['etud_abs']);
                    unset($_SESSION['module_abs']);
                    echo json_encode(['success' => false, 'message' => 'Vous avez deja enrigtrer l\'absence pour ajourd\'hui']);
                }break;
            case 'addRoom':
                if($this->factory->Module()->isModuleExist($_POST['prof'],$_POST['filiere'])){
                    echo json_encode($this->factory->Room()->createRoom($_POST['prof'],$_POST['filiere'],$_POST['titre']));
                }else{
                    echo json_encode(['success'=>false,'message'=>'Ce Professeur N\'ensigne pas cette filiere']);
                }
                break;
            case 'recuRapport':
                $this->factory->Rapport()->recieveRapport($_POST['rapport']);
                session_start();
                $_SESSION['rapports']=$this->factory->Rapport()->getRapportByProf($_SESSION['id_prof']);
                break;
            case 'delCours':
                $this->factory->Cours()->deleteCours($_POST['cours']);
                session_start();
                $_SESSION['cours_prof']=$this->factory->Cours()->getCoursByProf($_SESSION['id_prof']);
                break;
            case 'changeProfile':
                switch ($_POST['type']){
                    case 'admin':
                        session_start();
                        if ($_SESSION['id_admin']==$_POST['id']){
                            $d=new Download();
                            $user=unserialize($_SESSION['admin']);
                            try {
                                $path=$d->ModifyMedia($_FILES['file'], $user['photo_profile']);
                                $this->factory->Admin()->modifierProfile($path,$_POST['id']);
                                $user['photo_profile']=$path;
                                $_SESSION['admin']=serialize($user);
                                echo json_encode(['success'=>true]);
                            }catch(\Exception $e){
                                echo json_encode(['success'=>false,'message'=>$e->getMessage()]);
                            }
                        }else{
                            $this->logout();
                        }
                        break;
                    case 'professeur':
                        session_start();
                        if ($_SESSION['id_prof']==$_POST['id']){
                            $d=new Download();
                            $user=unserialize($_SESSION['professeur']);
                            try {
                                $path=$d->ModifyMedia($_FILES['file'], $user['photo_profile']);
                                $this->factory->Professeur()->modifierProfile($path,$_POST['id']);
                                $user['photo_profile']=$path;
                                $_SESSION['professeur']=serialize($user);
                                echo json_encode(['success'=>true]);
                            }catch(\Exception $e){
                                echo json_encode(['success'=>false,'message'=>$e->getMessage()]);
                            }
                        }else{
                            $this->logout();
                        }
                        break;
                    case 'etudiant':
                        session_start();
                        if ($_SESSION['id_etudiant']==$_POST['id']){
                            $d=new Download();
                            $user=unserialize($_SESSION['etudiant']);
                            try {
                                $path=$d->ModifyMedia($_FILES['file'], $user['photo_profile']);
                                $this->factory->Etudiant()->modifierProfile($path,$_POST['id']);
                                $user['photo_profile']=$path;
                                $_SESSION['etudiant']=serialize($user);
                                echo json_encode(['success'=>true]);
                            }catch(\Exception $e){
                                echo json_encode(['success'=>false,'message'=>$e->getMessage()]);
                            }
                        }else{
                            $this->logout();
                        }
                        break;
                }
                break;

             case 'sendMessage':
                 $message=json_decode(file_get_contents('php://input'),true);
                  $this->factory->Message()->addMessage($message['message'],date_format(date_create(),'Y-m-d H:i:s'),$message['sender'],$message['room']);
                 echo json_encode($message);
                 break;
            default:
                session_start();
                $this->logout();
                break;
        }
    }
    public function run(){
        if(!empty($_GET) or !empty($_POST)){
            if($_SERVER['REQUEST_METHOD']==="GET"){
                if (isset($_GET['action'])){
                    $this->get($_GET['action']);}
                else {
                    session_start();
                    $this->logout();
                }
            }
            if($_SERVER['REQUEST_METHOD']==="POST"){
                if(isset($_GET['action'])){
                    $this->post($_GET['action']);
                }else{
                    session_start();
                    $this->logout();
                }
            }}else{
            header('location:/App/views/login.html');
        }
    }
    private function validatorSession($request,$property){
        session_start();
        if(isset($_SESSION[$property])){
            if ($request!=$_SESSION[$property])$this->logout();
        }
    }
    private function logout(){
        session_destroy();
        header('location:/App/views/login.html');

    }
}
