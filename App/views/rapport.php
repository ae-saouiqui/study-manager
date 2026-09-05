<?php
session_start();
if (empty($_SESSION['professeur'])) {
    header('Location: /index.php?action=logout');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Public/static/Css/bootstrap.min.css">
    <script src="../../Public/static/Js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
          integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../../Public/static/Css/professeur.css">
    <link rel="stylesheet" href="../../Public/static/Css/modal.css">
    <link rel="stylesheet" href="/Public/static/Css/rapport.css">
    <title>E-SERVICES</title>
    <link rel="icon" href="../../Public/static/Images/ensahb.png">
</head>
<body>
<?php include_once 'sidebarProf.php';?>
<?php $rapports=$_SESSION['rapports'];?>
<section class="rapport-section">
    <header class="text-center p-4">
        <h1>Rapport</h1>
    </header>
    <main>
        <table class="table table-hover">
            <thead>
            <tr>
                <td>Profile</td>
                <td>Titre</td>
                <td>Nom</td>
                <td>Filiere</td>
                <td>fichier</td>
                <td>Recu</td>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($rapports as $rapport):?>
            <tr data-rapport="<?=$rapport['id'];?>" class="shadow">
                <td><img class="rapport-img" src="<?=$rapport['photo_profile']?>"></td>
                <td class="rapport-text"><?=$rapport['titre'];?></td>
                <td class="rapport-text"><?=$rapport['nom']." ".$rapport['prenom'];?></td>
                <td class="rapport-text"><?=$rapport['raccourci'];?></td>
                <td><a  class="file" href="<?=$rapport['fichier'];?>"><i class="fa-solid fa-download"></i></a></td>
                <td><button type="button"><i class="fa-solid fa-check"></i></button></td>
            </tr>
            <?php endforeach;?>
            </tbody>
        </table>
    </main>
</section>
<script src="../../Public/static/Js/rapport.js"></script>
<?php include_once 'modalProf.php';?>
</body>
</html>