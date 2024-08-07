<?php
session_start();
if(!empty($_SESSION)){
    $user = (object)unserialize($_SESSION['professeur']);
    if(isset($_SESSION['filiere_prof']))$filieres = $_SESSION['filiere_prof'];
    if(isset( $_SESSION['modules']))$modules = $_SESSION['modules'];
    $prof_id = $_SESSION['id_prof'];
    $annonces = $_SESSION['actualite'];
    $visitors=$_SESSION['visitors'];
    $count=7-count($visitors)-1;
    if(count($visitors)<7){
        for ($i=0; $i <=$count ; $i++) {
            array_unshift($visitors,['visitors'=>0]);
            }
        unset($count);
        }
    $visitors=array_map(fn($element)=>$element['visitors'],$visitors);
} else{ header('location:/index.php?action=logout');}
?>
<!--sidebar Bar section -->
<aside class="sidebar p-3 pb-4">
    <div class="logo-container container-fluid text-center p-2 mt-2">
        <a class="logo-link">
            <img src="../../Public/static/Images/ensah.png" class="logo" width="80px" height="80px">
        </a>
    </div>
    <hr class="sidebar-divider col-10 ">
    <ul class="nav flex-column container-fluid">
        <li class="nav-item">
            <a class="nav-link " href="professeur.php"><i class="fa-solid fa-house"></i> Acceuil</a>
        </li>
        <hr class="sidebar-divider col-10">
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="modal" data-bs-target="#deposer-cours"><i class="fa-solid fa-book"></i></i> Deposer Cours</a>
        </li>        <hr class="sidebar-divider col-10">
        <li class="nav-item">
            <a href="#note" data-bs-toggle="collapse" class="nav-link"><i class="fa-solid fa-clipboard"></i>Note</a>
            <ul id="note" class="collapse options mt-1 p-2 rounded">
                <li >
                    <a class="nav-link " data-bs-toggle="modal" data-bs-target="#deposer-note"><i class="fa-solid fa-clipboard"></i> Deposer Notes</a>
                </li>
                <li>
                    <a class="nav-link" data-bs-toggle="modal" data-bs-target="#exporter-note">Exporter Fichier des notes</a>
                </li>
            </ul>
        </li>
        <hr class="sidebar-divider col-10">
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="modal" data-bs-target="#absence"><i class="fa-solid fa-user-pen"></i> Gerer Absence</a>
        </li>
        <hr class="sidebar-divider col-10">
        <li class="nav-item">
            <a class="nav-link" href="/index.php?action=chat&type=prof&id=<?=$prof_id;?>"><i class="fa-solid fa-comments"></i> Acceder Room</a>
        </li>
        <hr class="sidebar-divider col-10 ">
        <li class="nav-item">
            <a class="nav-link" href="professeurProfile.php"><i class="fa-solid fa-user"></i>
                Profile</a>
        </li>
        <hr class="sidebar-divider col-10 ">
        <li class="nav-item">
            <a class="nav-link" href="creerAnonce.php?type=Prof"><i class="fa-solid fa-newspaper"></i>
                Cree Annonce</a>
        </li>
        <hr class="sidebar-divider col-10 ">
        <li class="nav-item">
            <a class="nav-link" href="/index.php?action=logout">
                <i class="fa-solid fa-right-from-bracket"></i>
                Deconnecter</a>
        </li>
    </ul>
</aside>
