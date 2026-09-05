<?php
session_start();
if (empty($_SESSION['etudiant'])) {
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
    <link rel="stylesheet" href="../../Public/static/Css/etudiant.css">
    <link rel="stylesheet" href="../../Public/static/Css/modal.css">
    <link rel="stylesheet" href="../../Public/static/Css/cours.css">
    <title>E-SERVICES</title>
    <link rel="icon" href="../../Public/static/Images/ensahb.png">
</head>
<body>
<?php include_once 'sidebarEtud.php';?>
<?php
$cours=$_SESSION['cours'];
?>
<section>
<header class="shadow">
    <h1>Cours</h1>
</header>
    <main>
        <table class="table table-hover">
            <thead>
            <tr>
                <td>Titre</td>
                <td>Module</td>
                <td>Professeur</td>
                <td>Fichier</td>
            </tr>
            </thead>
            <tbody>
            <?php
            if(!empty($cours)):
            foreach($cours as $cour):
            ?>
            <tr class="shadow">
                <td><?=$cour['cours'];?></td>
                <td><?=$cour['module'];?></td>
                <td><?=$cour['nom']." ".$cour['prenom'];?></td>
                <td><a download href="<?=$cour['fichier'];?>"><i class="fa-solid fa-download"></a></td>
            </tr>
            <?php endforeach;
            endif;?>
            </tbody>
        </table>
    </main>
</section>
<?php include_once 'modalEtud.php';?>
</body>
</html>
