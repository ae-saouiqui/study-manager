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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Public/static/Css/bootstrap.min.css">
    <script src="../../Public/static/Js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
          integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../../Public/static/Css/admin.css">
    <link rel="stylesheet" href="../../Public/static/Css/profile.css">
    <link rel="stylesheet" href="../../Public/static/Css/modal.css">
    <script defer src="../../Public/static/Js/profile.js"></script>
    <title>E-SERVICES</title>
    <link rel="icon" href="../../Public/static/Images/ensahb.png">
</head>

<body>
<?php
include_once 'sidebarAdmin.php';
include_once 'profile.php';
include_once 'modalAdmin.php';
?>
<style>
    .logo-editer,span{
        background-color: #d2601a;
    }
</style>
</body>
</html>