<?php
session_start();
if (empty($_SESSION['admin']) and empty($_SESSION['professeur'])) {
    header('Location: /index.php?action=logout');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="../../Public/static/Css/bootstrap.min.css">
    <script src="../../Public/static/Js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
          integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../../Public/static/Css/<?=$_GET['type']=='Prof'?'professeur':'admin'?>.css">
    <link rel="stylesheet" href="../../Public/static/Css/modal.css">
    <link rel="stylesheet" href="../../Public/static/Css/ajouterProfesseur.css">
    <title>E-SERVICES</title>
    <link rel="icon" href="../../Public/static/Images/ensahb.png">
</head>
<body>
<?php include_once 'sidebar'.$_GET['type'].'.php';?>
<section class="col-10">
    <h1 class="display-5 mb-5">Creer Annonce</h1>
<form class="d-flex flex-column justify-content-between" id="creer-annonce">
    <label>Saisir le titre</label>
    <input type="text" placeholder="saisir le text" name="titre" required>
    <label>Annoncez</label>
    <textarea placeholder="saisir le text" name="contenu" required></textarea>
    <label>Saisir un Fichier</label>
    <input type="file">
    <input type="submit">
</form>
</section>
<style>
    .sidebar{
        height: 150vh !important;
    }
    body{
        height: 140vh !important;
        overflow-y: hidden !important;
    }
    section{
        width: 50%;
        padding: 10px;
    }
    label{
        margin: 20px;
    }
    textarea{
        resize: none;
        height: 23vh;
        border-top:none;
        border-left: none;
        border-right: none;
        border-bottom: solid 2px #d2601a;
        outline: none;
        padding: 5px;
        box-shadow: 0px 5px 30px 4px rgba(149, 133, 133, 0.44);
        margin-bottom: 30px;
    }
    textarea:focus{
        margin-top:10px;
        padding: 7px;
        transition-property: margin-top,border-bottom,padding;
        border-bottom: solid 5px #d2601a;
        transition-duration: 0.2s;
        transition-timing-function: ease-in-out;
    }
    input[type="submit"]{
        background-color: #0a53be;
        padding: 5px 0;
        color: #fff;
        border-radius: 40px;
        outline: none;
        border: none;
    }
</style>
<?php include_once 'modal'.$_GET['type'].'.php';?>

</body>
<script src="../../Public/static/Js/addAnnonce.js"></script>
</html>
