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
    <link rel="stylesheet" href="../../Public/static/Css/profile.css">
    <link rel="stylesheet" href="../../Public/static/Css/modal.css">
    <script defer src="../../Public/static/Js/profile.js"></script>
    <title>E-SERVICES</title>
    <link rel="icon" href="../../Public/static/Images/ensahb.png">
</head>

<body>
<?php include_once 'sidebarEtud.php';?>
<!--Main Section -->
<main class="container-fluid">
    <h1 class="display-4 mt-5 ms-2">Informations d'Etudiant</h1>
    <section class="container-fluid col-12 d-flex justify-content-evenly">
        <div class="info-section col-6">
            <table class="table  table-borderless">
                <tbody>
                <tr>
                    <td><span>Nom :</span> </td>
                    <td><?=$user['nom'];?> </td>
                </tr>
                <tr>
                    <td><span>Prenom :</span></td>
                    <td><?=$user['prenom'];?> </td>
                </tr>
                <tr>
                    <td><span>email :</span></td>
                    <td><?=$user['email'];?>  </td>
                </tr>
                <tr>
                    <td><span>Cin:</span></td>
                    <td><?=$user['cin'];?> </td>
                </tr>
                <tr>
                    <td><span>Date de Naissance :</span></td>
                    <td><?=$user['date_naissance'];?> </td>
                </tr>
                <tr>
                    <td><span>Sexe :</span></td>
                    <td><?=$user['sexe']=='M'?"Homme":"Femme";?> </td>
                </tr>
                <tr>
                    <td><span>Numero de Telephone :</span></td>
                    <td><?=$user['telephone'];?> </td>
                </tr>
                <tr>
                    <td><span>CNE :</span></td>
                    <td><?=$cne;?> </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="logo-section">
            <img src="<?=$user['photo_profile'];?> " class="shadow" alt="" srcset="">
            <button class="logo-editer" data-user="<?=$id_etud;?>" data-type="<?=$_SESSION['type'];?>"><i class="fa-solid fa-pen"></i></button>
                <input type="file" class="form-control file-input"  style="display:none" name="profile_picture" accept="image/*">
        </div>
    </section>
</main>
<style>
    .logo-editer,span{
        background-color: #dc3545;
    }
</style>
<?php include_once 'modalEtud.php';?>
</body>
</html>