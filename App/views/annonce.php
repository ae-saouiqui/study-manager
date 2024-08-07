<?php
session_start();
$annonces=$_SESSION['annonces'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../Public/static/Css/bootstrap.min.css">
    <script src="../../Public/static/Js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
          integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../../Public/static/Css/annonce.css">
    <title>E-SERVICES</title>
    <link rel="icon" href="../../Public/static/Images/ensahb.png">
</head>
<body>
<header class="shadow">
    <h1 class="container-fluid col-10  mt-4 ms-4 pt-3 pb-3"><img src="../../Public/static/Images/ensah.png">Annonces</h1>
</header>
<section>
    <aside>
            <?php
            foreach ($annonces as $annonce):
            ?>
        <ul class="shadow">
            <li class="annonce" ><p class="title"><?=$annonce['titre'];?></p>
            <p class="visually-hidden" data-path="<?= $annonce['fichier'];?>" data-date="<?=$annonce['date_publication']?>"><?=$annonce['contenu'];?></p>
            </li>
            <hr>
            <?php endforeach;?>
        </ul>
    </aside>
    <main>
        <div class="card col-10 shadow visually-hidden">
            <div class="card-header shadow">
                <h2>Title</h2>
            </div>
            <div class="card-body">
                <p></p>
            <span></span>
            </div>
            <div class="card-footer">
                <a href="" download><i class="fa-solid fa-download"></i></a>
            </div>
        </div>
    </main>
</section>
</body>
<script src="../../Public/static/Js/annonce.js"></script>
</html>