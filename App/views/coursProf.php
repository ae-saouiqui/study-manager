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
    <link rel="stylesheet" href="../../Public/static/Css/coursProf.css">
    <title>E-SERVICES</title>
    <link rel="icon" href="../../Public/static/Images/ensahb.png">
</head>

<body>

<?php include_once 'sidebarProf.php';?>
<?php if (isset($_SESSION['cours_prof'])){
    $cours=$_SESSION['cours_prof'];
}else{
    header('location:/index.php?action=logout');
}?>
<section class="cours-section">
    <header>
        <h1 class="text-center p-3">Cours Depose</h1>
    </header>
    <main>
        <table class="table table-hover">
            <thead>
            <tr>
                <td>Titre</td>
                <td>Module</td>
                <td>Filiere</td>
                <td>fichier</td>
                <td>supprimer</td>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($cours as $cour):?>
            <tr class="cours-row shadow" data-cours="<?=$cour['id'];?>">
                <td><?=$cour['cours']?></td>
                <td><?=$cour['module']?></td>
                <td><?=$cour['raccourci']?></td>
                <td><a href="<?=$cour['fichier']?>"></a></td>
                <td><button type="button"><i class="fa-solid fa-xmark"></i></button></td>
            </tr>
            <?php endforeach;?>
            </tbody>
        </table>
    </main>
</section>
<script src="../../Public/static/Js/coursProf.js"></script>
<?php include_once 'modalProf.php';?>
</body>
</html>
