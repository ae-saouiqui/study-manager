<!--Main Section -->
<main class="container-fluid">
    <h1 class="display-4 mt-5 ms-2">Informations <?=$_SESSION['type']=='admin'?"d'Admin":"de Professeur";?></h1>
    <section class="container-fluid col-12 d-flex justify-content-evenly">
        <div class="info-section col-6">
            <table class="table  table-borderless">
                <tbody>
                <tr>
                    <td><span>Nom :</span> </td>
                    <td><?=$user->nom;?> </td>
                </tr>
                <tr>
                    <td><span>Prenom :</span></td>
                    <td><?=$user->prenom;?> </td>
                </tr>
                <tr>
                    <td><span>email :</span></td>
                    <td><?=$user->email;?> </td>
                </tr>
                <tr>
                    <td><span>Cin:</span></td>
                    <td><?=$user->cin;?></td>
                </tr>
                <tr>
                    <td><span>Date de Naissance :</span></td>
                    <td><?=$user->date_naissance;?></td>
                </tr>
                <tr>
                    <td><span>Sexe :</span></td>
                    <td><?=$user->sexe=="M"?"Homme":"Femme";?></td>
                </tr>
                <tr>
                    <td><span>Numero de Telephone :</span></td>
                    <td><?=$user->telephone;?></td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="logo-section">
            <img src="<?=$user->photo_profile;?>" class="shadow" alt="" srcset="">
            <button class="logo-editer" data-user="<?=$_SESSION['type']=='admin'?$admin:$prof_id;?>" data-type="<?=$_SESSION['type'];?>"><i class="fa-solid fa-pen"></i></button>
            <input type="file" class="form-control file-input"  style="display:none" name="profile_picture" accept="image/*">
        </div>
    </section>
</main>