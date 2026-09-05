<?php
session_start();
if (empty($_SESSION['admin'])) {
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
    <link rel="stylesheet" href="../../Public/static/Css/admin.css">
    <link rel="stylesheet" href="../../Public/static/Css/modal.css">
    <link rel="stylesheet" href="../../Public/static/Css/ajouterProfesseur.css">
    <title>E-SERVICES</title>
    <link rel="icon" href="../../Public/static/Images/ensahb.png">
</head>

<body>
<?php include_once 'sidebarAdmin.php'?>
<?php
if (isset($_SESSION['fil_full'])){
    $fills=$_SESSION['fil_full'];
}
?>
<section class="filiere-section">
    <header class="text-center p-3">
        <h1>Filieres</h1>
    </header>
    <main>
        <table class="table table-hover">
            <thead>
            <tr>
                <td>Filiere</td>
                <td>Raccourci</td>
                <td>Promotion</td>
                <td>Etudiant</td>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($fills as $fill): ?>
            <tr class="shadow">
            <td><?=$fill['nom'];?></td>
            <td><?=$fill['raccourci'];?></td>
            <td><?=$fill['annee'];?></td>
                <td><a class="etudiants" href="/index.php?action=getEtudiants&filiere=<?=$fill['id'];?>&id=<?=$admin;?>"><i class="fa-solid fa-users"></i></a></td>
            </tr>
            <?php endforeach;?>
            </tbody>
        </table>
    </main>
</section>
<style>
    body{
        height: 100vh !important;
        overflow-y: hidden !important;
    }
    main{
        height: 120vh !important;
        overflow-y: auto !important;
    }
    tbody td{
        padding: 20px !important;
    }
    table{
        border-collapse: separate;
        border-spacing: 0 10px;
    }
    .etudiants{
        display: inline-flex;
        width: 50px;
        height: 50px;
        background-color: #0a53be;
        border-radius: 50%;
        align-items: center;
        justify-content: center;
    }

</style>
<?php include_once 'modalAdmin.php';?>
</body>
</html>
