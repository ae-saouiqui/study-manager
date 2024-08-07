<?php
extract($_GET);
session_start();
if(isset($_SESSION['etud_abs']) and isset($_SESSION['module_abs'])){
$etudiant =$_SESSION['etud_abs'];
$id_module=$_SESSION['module_abs'];
}else{
    header('location:/App/views/professeur.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Public/static/Css/bootstrap.min.css">
    <script src="../Public/static/Js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
          integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../Public/static/Css/absence.css">
    <link rel="stylesheet" href="../Public/static/Css/modal.css">
    <title>E-SERVICES</title>
    <link rel="icon" href="../Public/static/Images/ensahb.png">
</head>
<body>
<header>
    <h2>Absence</h2>
    <div class="col-12 d-flex table-classe" >
        <span class="col-3"></span>
    <div class="col-6">
        <table class="table">
            <tbody>
            <tr class="shadow">
                <td class="titre">Module : </td>
                <td><?=$module?></td>
            </tr>
            <tr class="shadow">
                <td class="titre">Filiere :</td>
                <td><?=$filiere?></td>
            </tr>
            <tr class="shadow">
                <td class="titre" colspan="2">Etudiant : </td>
            </tr>
            </tbody>
        </table>
    </div>
        <span class="col-3 p-2 d-flex flex-column btn-section">
            <button type="button" class="btn btn-primary select-all">Selectionne tout</button>
            <button type="button" class="btn btn-primary clear-btn">Clear</button>
            <button type="button" class="btn btn-primary noter-btn">Noter</button>
        </span>
    </div>
</header>
<section>
    <main>
        <form>
            <table class="table table-etud" data-module-id="<?=$id_module;?>">
                <thead>
                <tr class="table-primary">
                    <td>Absence</td>
                    <td>Nom</td>
                    <td>Prenom</td>
                    <td>CNE</td>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($etudiant as $etud):?>
                <tr class="shadow">
                    <td class="check"><input type="checkbox" name="etudiant[]" value="<?=$etud['id'];?>"></td>
                    <td><?=$etud['nom'];?></td>
                    <td><?=$etud['prenom'];?></td>
                    <td><?=$etud['cne'];?></td>
                </tr>
                <?php endforeach;?>
                </tbody>
            </table>
        </form>
    </main>
</section>
<script src="../../Public/static/Js/absence.js"></script>
</body>
</html>
