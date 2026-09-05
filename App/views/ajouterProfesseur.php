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
    <link rel="stylesheet" href="../../Public/static/Css/ajouterProfesseur.css">
    <link rel="stylesheet" href="../../Public/static/Css/modal.css">
    <title>E-SERVICES</title>
    <link rel="icon" href="../../Public/static/Images/ensahb.png">
</head>
<body>
<?php require_once  'sidebarAdmin.php';?>
<?php
$filieres=unserialize($_SESSION['filieres']);
?>
<main>
    <h1 class="display-5">Ajouter d'un Professeur</h1>
    <div class="form-container">
    <form action="" method="post" enctype="multipart/form-data">
        <label for="nom">Nom: </label>
        <input class="shadow" type="text"  name="nom" id="nom" placeholder="Saisir le nom" required>
        <label for="prenom">Prenom: </label>
        <input class="shadow" type="text"  name="prenom" id="prenom" placeholder="saisir le prenom"required >
        <label for="email">email: </label>
        <input class="shadow" type="email"  name="email" id="email" placeholder="saisir l'email" required>
        <label for="birthday">Date de Naissance: </label>
        <input class="shadow" type="date"   name="birthday" id="birthday" placeholder="mm/jj/aaaa"required >
        <label for="cin">CIN : </label>
        <input class="shadow" type="text"  name="cin" id="cin" placeholder="saisir CIN"required >
        <label for="phone">Numero de Telephone : </label>
        <input class="shadow" type="text"  name="phone" id="phone" placeholder="saisir le numero de telephone" required>
        <label for="password">Mot de Passe</label>
        <input class="shadow" type="password" name="password" id="password" placeholder="saisir le mot de passe" required >
        <label>Sexe :</label>
        <select name="sexe" id="sexe" required>
            <option disabled selected>Choisissez sexe</option>
            <option value="M">Homme</option>
            <option value="F">Femme</option>
        </select>
        <label>Photo de Profile :</label>
        <input  type="file" class="form-control shadow" id="picture" name="photo_profile" accept=".jpg, .jpeg, .png">
        <input type="submit" class="submit-btn" value="Ajouter">
    </form>
    </div>
</main>
<script src="../../Public/static/Js/ajouterProf.js"></script>
<?php require_once 'modalAdmin.php';?>
</body>
</html>