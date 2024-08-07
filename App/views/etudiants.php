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
$nom=$_GET['filiere'];
$raccourci=$_GET['raccourci'];
$etudiants=$_SESSION['etudiants'];
?>
<section>
<header>
    <h2 class="shadow">Etudiant</h2>
    <div class="col-12 d-flex table-classe" >
        <span class="col-3"></span>
        <div class="col-6">
            <table class="table">
                <tbody>
                <tr class="shadow">
                    <td class="titre">Filiere : </td>
                    <td><?=$nom?></td>
                </tr>
                <tr class="shadow">
                    <td class="titre">Raccourci :</td>
                    <td><?=$raccourci?></td>
                </tr>
                <tr class="shadow">
                    <td class="titre" colspan="2">Etudiant : </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</header>
    <main class="shadow">
    <table class="table etuds-table table-hover">
        <thead>
        <tr class="table-primary">
        <td></td>
        <td>Nom</td>
        <td>Prenom</td>
        <td>CNE</td>
        <td>Telephone</td>
        </tr>
        </thead>
        <tbody>
        <?php if(!empty($etudiants)):
            foreach ($etudiants as $etudiant):?>
                <tr class="shadow">
                    <td><img src="<?=$etudiant['photo_profile'];?>"></td>
                    <td><?=$etudiant['nom'];?></td>
                    <td><?=$etudiant['prenom'];?></td>
                    <td><?=$etudiant['cne'];?></td>
                    <td><?=$etudiant['telephone'];?></td>
                </tr>
            <?php endforeach;
        endif;?>
        </tbody>
    </table>
    </main>
</section>
<?php include_once 'modalAdmin.php';?>
<style>
    header h2{
        background-color: #0a53be;
        color: #fff;
        text-align: center;
        padding: 20px;
    }
    .table-classe{
        position: relative;
        top: 20px;
    }
    .table-classe table{
        border-collapse: separate;
        border-spacing: 0 20px;
    }
    .titre{
        background-color: #0a58ca !important;
        color: #fff !important;
    }
    .table-classe td{
        text-align: center;
        border-radius: 40px 0 40px!important;
    }
    .table-classe tr{
        border-radius: 40px 0 40px!important;
    }
    table img{
        width: 30px;
        height: 30px;
        border-radius: 50%;
    }
    main{
        height: 50vh !important;
        overflow-y:auto ;
    }
</style>
</body>
</html>
