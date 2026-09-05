<?php
// session_start();
if(!empty($_SESSION)) {
    $user = unserialize($_SESSION['etudiant']);
    $profs = $_SESSION['profs_filiere'];
    $id_etud = $_SESSION["id_etudiant"];
    $filiere = $_SESSION["filiere"];
    $annonces = $_SESSION['actualite'];
    $cne = $_SESSION['cne'];
    $visitors=$_SESSION['visitors'];
    $count=7-count($visitors)-1;
    if(count($visitors)<7){
        for ($i=0; $i <=$count ; $i++) {
            array_unshift($visitors,['visitors'=>0]);
        }
        unset($count);
        }
        $visitors=array_map(fn($element)=>$element['visitors'],$visitors);
}else{
    header('location:/index.php?action=logout');
}
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
            <a class="nav-link" href="etudiant.php"><i class="fa-solid fa-house"></i> Acceuil</a>
        </li>
        <hr class="sidebar-divider col-10">
        <li class="nav-item">
            <a class="nav-link " data-bs-target="#deposer-rapport" data-bs-toggle="modal"><i class="fa-solid fa-book-open"></i> Deposer Rapport</a>
        </li>
        <hr class="sidebar-divider col-10">
        <li class="nav-item">
            <a class="nav-link" href="/index.php?action=getCours&filiere=<?=$filiere;?>"><i class="fa-solid fa-book"></i>Mes Cours</a>
        </li>
        <hr class="sidebar-divider col-10">
        <li class="nav-item">
            <a class="nav-link " href="/index.php?action=chat&type=etud&id=<?=$filiere;?>"><i class="fa-solid fa-comments"></i> Acceder Room</a>
        </li>
        <hr class="sidebar-divider col-10">
        <li class="nav-item">
            <a class="nav-link " href="/index.php?action=getNote&etud=<?=$id_etud;?>"><i class="fa-solid fa-clipboard"></i> Mes Notes</a>
        </li>
        <hr class="sidebar-divider col-10 ">
        <li class="nav-item">
            <a class="nav-link " href="etudiantProfile.php"><i class="fa-solid fa-user"></i>
                Profile</a>
        </li>
        <hr class="sidebar-divider col-10 ">
        <li class="nav-item">
            <a class="nav-link " href="/index.php?action=logout">
                <i class="fa-solid fa-right-from-bracket"></i>
                Deconnecter</a>
        </li>
    </ul>
</aside>
<!-- End Of Side Bar -->
