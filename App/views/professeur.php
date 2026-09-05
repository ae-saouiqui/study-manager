<?php
session_start();
if (empty($_SESSION['professeur'])) {
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
    <link rel="stylesheet" href="../../Public/static/Css/professeur.css">
    <link rel="stylesheet" href="../../Public/static/Css/modal.css">
    <title>E-SERVICES</title>
    <link rel="icon" href="../../Public/static/Images/ensahb.png">
</head>

<body>

<?php include_once 'sidebarProf.php';?>
<!-- Start of the main section -->
<section class="main-section col-10 main-section">
    <!-- Start of the navbar -->
    <nav class="navbar navbar-expand d-flex justify-content-between ps-5 pt-3 container-fluid">
        <div class="search-section">
            <form action="" method="get">
                <input type="search" class="search-field" placeholder="chercher ici">
                <button type="button" class="search-btn"><i class="fa fa-search"></i></button>
            </form>
        </div>
        <ul class="navbar-nav">
            <li class="nav-item notifications dropdown"><a href="" class="nav-link" data-bs-toggle="dropdown"><i
                    class="fa-regular fa-bell"></i></a>
                <ul class="dropdown-menu">
                    <li>
                        <h5 class="dropdown-header">Notifications</h5>
                    </li>
                    <li><a class="dropdown-item" href="#">Link 1</a></li>
                    <hr class="dropdown-divider">
                    <li><a class="dropdown-item" href="#">Link 2</a></li>
                    <hr class="dropdown-divider">
                    <li><a class="dropdown-item" href="#">Link 3</a></li>
                </ul>
            </li>
        </ul>
        <hr class="navbar-divider">
        <div class="welcome-user">
            <span>Bonjour <?=$user->prenom?></span>
            <a class="navbar-brand">
                <img src="<?=$user->photo_profile;?>" class="profile-picture" srcset=""
                     width="40px" height="40px">
            </a>
        </div>
    </nav>
    <!--End Of the navbar -->
    <!-- Start of the Main -->
    <main class="container-fluid col-12">
        <section class="header-section container-fluid col-12 mt-3">
            <h1>Bievenue Sur Le Platefome <span class="e-service">E-service</span></h1>
            <div class="services d-flex mt-4 justify-content-evenly">
                <div class="service-1 shadow"><a href="/index.php?action=getRapport&prof=<?=$prof_id;?>">Rapport<i class="fa-solid fa-newspaper"></i></a>
                </div>
                <div class="service-2 shadow"><a href="/index.php?action=chat&type=prof&id=<?=$prof_id;?>">Room<i class="fa-solid fa-comments"></i></a></div>
                <div class="service-3 shadow"><a href="/index.php?action=getAllAnnonce">Annonce<i class="fa-solid fa-newspaper"></i></a></div>
                <div class="service-4 shadow"><a href="/index.php?action=getCoursProf&prof=<?=$prof_id;?>">Cours<i class="fa-solid fa-book"></i></a></div>
            </div>
        </section>
        <section class="body-section d-flex col-12 justify-content-evenly">
            <div class="card col-8 chart-section shadow">
                <div class="card-header text-primary">Statistique d'Aujourd'hui</div>
                <div class="card-body">
                    <canvas id="myChart"></canvas>
                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                    <script>
                        const data=<?php echo json_encode($visitors);?>;
                        const today = new Date();
                        const dates = [];
                        for (let i = 6; i >= 0; i--) {
                            const date = new Date(today);
                            date.setDate(today.getDate() - i);
                            dates.push(date.toISOString().split('T')[0]);
                        }
                        const ctx = document.getElementById('myChart');
                        new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: dates,
                                datasets: [{
                                    label:'nombre de connections',
                                    borderColor: "#ffcce7",
                                    data: data,
                                    borderWidth: 3,
                                    tension: 0.5,
                                    fill: true,
                                     backgroundColor:"#ffcce7"
                                         //(context) => {
                                    //     const ctx = context.chart.ctx;
                                    //     const gradient = ctx.createLinearGradient(0, 0, 0, 350);
                                    //     gradient.addColorStop(0, "#ffcce7");
                                    //     gradient.addColorStop(1, "white");
                                    //     return gradient;
                                    // }
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        type: 'linear',
                                        min: 0,
                                        max: 200
                                    }
                                }
                            }
                        });
                    </script>
                </div>
            </div>
            <div class="actualite-section card col-3">
                <div class="card-header">Actualite</div>
                <ul class="card-body accordion col-12" id="actualites">
                    <?php foreach($annonces as $annonce):?>
                    <li class="actualite accordion-item col-12 container-fluid"><a
                            class="accordion-button collapsed" data-bs-toggle="collapse"
                            data-bs-target="#<?=$annonce['id'];?>"><?=$annonce['titre'];?></a>
                        <div class="accordion-collapse collapse" id="<?=$annonce['id'];?>" data-bs-parent="#actualites">
                            <div class="accordion-body">
                                <p class="actualite-text">
                                    <?=$annonce['contenu'];?>
                                </p>
                                <hr class="actualite-divider">
                                <div class="download-file col-12">
                                    <a href="<?=$annonce['fichier'];?>" download><i class="fa-solid fa-download"></i></a>
                                    <p>Telecharger ce fichier</p>
                                </div>
                            </div>
                        </div>
                    </li>
                    <?php endforeach;?>
                </ul>

            </div>
        </section>
    </main>
</section>
<!--End Of The main Section-->
<?php include_once 'modalProf.php';?>
</body>
</html>