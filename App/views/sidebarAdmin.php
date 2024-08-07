<?php
session_start();
if(!empty($_SESSION)) {
        $user = (object)unserialize($_SESSION['admin']);
        $admin = $_SESSION['id_admin'];
        $filieres = unserialize($_SESSION['filieres']);
        $profs = $_SESSION['profs'];
        $annonces = $_SESSION['actualite'];
        $visitors = $_SESSION['visitors'];
        $count = 7 - count($visitors) - 1;
        if (count($visitors) < 7) {
            for ($i = 0; $i <= $count; $i++) {
                array_unshift($visitors, ['visitors' => 0]);
            }
            unset($count);
        }
        $visitors = array_map(fn($element) => $element['visitors'], $visitors);
}else {
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
            <a class="nav-link " href="admin.php"><i class="fa-solid fa-house"></i> Acceuil</a>
        </li>
        <hr class="sidebar-divider col-10">
        <li class="nav-item">
            <a href="#professeur" class="nav-link " data-bs-toggle="collapse"><i
                    class="fa-solid fa-chalkboard-user"></i> Gerer
                Professeur</a>
            <ul id="professeur" class="collapse options mt-1 p-2 rounded">
                <li><a class="nav-link" href="ajouterProfesseur.php"><i class="fa-solid fa-user-plus"></i> Ajouter Professeur</a></li>
                <hr class="p-0 m-0">
                <li><a class="nav-link" href="gestionProfesseur.php"><i class="fa-solid fa-user-check"></i> Activer/Desactiver Professeur</a>
                </li>
            </ul>
        </li>
        <hr class="sidebar-divider col-10 ">
        <li class="nav-item">
            <a href="#student" class="nav-link " data-bs-toggle="collapse"><i class="fa-solid fa-user-graduate"></i>
                Gerer
                Etudiant</a>
            <ul id="student" class="collapse options mt-1 p-2 rounded">
                <li><a class="nav-link" data-bs-toggle="modal" data-bs-target="#ajouter-filiere" ><i class="fa-solid fa-user-group"></i> Ajouter Class</a></li>
                <hr class="p-0 m-0">
                <li><a class="nav-link" data-bs-toggle="modal" data-bs-target="#supprimer-etud"><i class="fa-solid fa-user-minus"></i> Supprimer Etudiant</a></li>
                <hr class="p-0 m-0">
                <li><a class="nav-link" data-bs-toggle="modal" data-bs-target="#ajouter-etud"><i class="fa-solid fa-user-plus"></i> Ajouter Etudiant</a></li>
            </ul>
        </li>
        <hr class="sidebar-divider col-10 ">
        <li class="nav-item">
            <a href="#note" class="nav-link " data-bs-toggle="modal" data-bs-target="#ajouter-module"><i class="fa-solid fa-clipboard"></i>Ajouter Module</a>
        </li>
        <hr class="sidebar-divider col-10 ">
        <li class="nav-item">
            <a href="#room" class="nav-link " data-bs-toggle="collapse"><i class="fa-solid fa-comments"></i> Gerer
                Room</a>
            <ul id="room" class="collapse options mt-1 p-2 rounded">
                <li><a class="nav-link" data-bs-toggle="modal" data-bs-target="#ajouter-room">Creer Room</a></li>
            </ul>
        </li>
        <hr class="sidebar-divider col-10 ">
        <li class="nav-item">
            <a class="nav-link" href="adminProfile.php"><i class="fa-solid fa-user"></i>
                Profile</a>
        </li>
        <hr class="sidebar-divider col-10 ">
        <li class="nav-item">
            <a class="nav-link" href="creerAnonce.php?type=Admin"><i class="fa-solid fa-newspaper"></i>
                Creer Annonce</a>
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
