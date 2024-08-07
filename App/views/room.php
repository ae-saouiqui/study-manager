<?php
session_start();
    $rooms=$_SESSION['rooms'];
    $user=unserialize($_SESSION[$_GET['type']]);
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
    <link rel="stylesheet" href="../../Public/static/Css/room.css">
    <link rel="stylesheet" href="../../Public/static/Css/modal.css">
    <title>E-SERVICES</title>
    <link rel="icon" href="../../Public/static/Images/ensahb.png">
</head>
<body>
<header class="container-fluid d-flex shadow">
<!--    <img src="../../Public/static/Images/ensahb.png">-->
    <h3 class="text-primary text-center display-5">
        <i class="fa-solid fa-comments"></i>
        Room
    </h3>
</header>
<section class="body-section d-flex col-12">
    <aside class="col-2 d-flex flex-column text-center">
        <div class="chat-backround"></div>
        <h5>Chat</h5>
        <div class="chat-container">
            <?php foreach ($rooms as $room):?>
            <div class="room d-flex" data-room-id="<?=$room['id'];?>">
                <img class="profile-room" src="../../Public/static/Images/us2.png">
                <h6 class="room-name"><?=$room['titre'];?></h6>
            </div>
            <hr>
            <?php endforeach;?>
        </div>
    </aside>
    <main class="col-8">
        <div class="card shadow visually-hidden" data-user="<?=$user['id'];?>" data-profile="<?=$user['photo_profile']?>" data-name="<?=$user['nom']." ".$user['prenom'];?>">
            <div class="card-header logo">
                <img src="../../Public/static/Images/ensahb.png">
            </div>
            <div class="card-header active-room d-flex shadow mb-2">
                <img src="../../Public/static/Images/us2.png">
                <h3>Name</h3>
            </div>

            <div class="card-body">
                <div class="chat-body">
            </div>
            <div class="card-footer">
                <input type="text" id="send-message">
                <button type="button" class="btn btn-primary btn-send"><i class="fa-solid fa-paper-plane"></i></button>
            </div>
        </div>
    </main>
</section>
<script src="../../Public/static/Js/room.js"></script>
</body>
</html>