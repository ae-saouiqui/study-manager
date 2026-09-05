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
  <link rel="stylesheet" href="../../Public/static/Css/bootstrap.min.css">
  <script src="../../Public/static/Js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="../../Public/static/Css/admin.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="../../Public/static/Css/gestionProfesseur.css">
   <link rel="stylesheet" href="/Public/static/Css/modal.css">
    <title>E-SERVICES</title>
    <link rel="icon" href="../../Public/static/Images/ensahb.png">
</head>
<body>
<?php include_once 'sidebarAdmin.php'; ?>
<main>
  <h1 class="display-5 shadow">Gestion Des Professeurs</h1>
  <section class="professeurs-section col-12 d-flex">
    <table class="table profs-table table-hover">
      <thead>
      <td></td>
      <td>Nom</td>
      <td>Prenom</td>
      <td>etat</td>
      <td>Des/Activer</td>
      <td>Supprimer</td>
      </thead>
      <tbody>
      <?php if(!empty($profs)):
      foreach ($profs as $prof):?>
      <tr data-prof-id="<?=$prof['id'];?>" class="shadow">
          <td><img src="<?=$prof['photo_profile'];?>"></td>
        <td><?=$prof['nom'];?></td>
        <td><?=$prof['prenom'];?></td>
        <td><span class="<?=($prof['active']==1)?"activer bg-primary":"desactiver bg-danger"?>"><i class="fa-solid <?=($prof['active']==1)?"fa-check":"fa-xmark";?>"></i></span></td>
        <td><button type="button" class="<?=$prof['active']==1?"desactiver-btn btn btn-danger":"activer-btn btn btn-success"?>"><?=$prof['active']==1?"desactive":"activer"?></button></td>
        <td><button type="button" class="supprimer-btn btn btn-danger">Supprimer</button></td>
      </tr>
      <?php endforeach;
      endif;?>
      </tbody>
    </table>
  </section>
    <script src="../../Public/static/Js/gererProfesseur.js"></script>
  </main>
<?php include_once 'modalAdmin.php';?>
</body>
</html>