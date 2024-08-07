<!--Function Section-->
<section>
    <div class="modal fade" id="supprimer-etud" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-between">
                    <h5 class="modal-title">Supprimer Etudiant</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="delete-etud-form">
                        <input type="text" placeholder="Saisir CNE">
                        <input type="submit" value="supprimer">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="ajouter-etud" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-between">
                    <h5 class="modal-title">Ajouter Etudiant</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="add-etud-form">
                        <label>Saisir la filiere :</label>
                            <select name="filiere">
                                <?php foreach ($filieres as $filiere):?>
                                    <option value=<?=$filiere['id'];?>><?=$filiere['raccourci'];?></option>
                                <?php endforeach;?>
                            </select>
                        <label>CNE :</label>
                        <input type="text" placeholder="saisir CNE">
                        <input type="submit" value="Ajouter">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="ajouter-filiere" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ajouter Classe</h5>
                </div>
                <div class="modal-body">
                    <form enctype="multipart/form-data" class="d-flex flex-column justify-content-between" id="add-class-form">
                        <label>Saisir la filiere</label>
                        <select name="filiere" required>
                            <?php foreach ($filieres as $filiere):?>
                            <option value=<?=$filiere['id'];?>><?=$filiere['raccourci'];?></option>
                            <?php endforeach;?>
                        </select>
                        <label>Saisir le fichier Excel</label>
                        <input type="file" accept=".xls,.xlsx" name="etudiants" required>
                        <input type="submit">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="ajouter-module" tabindex="-1" role="dialog" >
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Ajouter Module</h3>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="create-module" class="d-flex flex-column">
                        <label>Saisir le Nom</label>
                        <input type="text" name="module" placeholder="saisir module" required>
                        <label>Saisir la filiere</label>
                        <div class="filieres-checkbox d-flex flex-row flex-wrap border p-2 mb-3 ms-3" style="height: 20vh;overflow: auto">
                            <?php foreach($filieres as $filiere):?>
                            <div class="element-filiere">
                            <input type="checkbox" value="<?=$filiere['id']?>" name="filieres[]" id="<?=$filiere['raccourci'];?>">
                            <label for="<?=$filiere['raccourci'];?>" style="background-color: transparent;color:#000000;"><?=$filiere['raccourci'];?></label>
                            </div>
                            <?php endforeach;?>
                        </div>
                        <label>Saisir le professeur</label>
                        <select name="professeur">
                            <?php foreach ($profs as $prof):?>
                            <option value=<?=$prof['id']?>><?=$prof['nom']." ".$prof['prenom'];?></option>
                            <?php endforeach;?>
                        </select>
                        <input type="submit" style="background-color: #0a53be;margin: 20px 0px;padding: 5px;color: #fff;border-radius: 40px;border: none;outline: none;">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" id="ajouter-room" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Creer Room</h4>
                    <a class="btn-close" data-bs-dismiss="modal"></a>
                </div>
                <div class="modal-body">
                    <form id="create-room" class="d-flex flex-column">
                        <label>Saisir le titre</label>
                        <input type="text" placeholder="saisir le titre">
                        <label>Saisir la filiere</label>
                        <select name="filiere">
                            <?php foreach ($filieres as $filiere):?>
                            <option value="<?=$filiere['id']?>"><?=$filiere['raccourci']?></option>
                            <?php endforeach;?>
                        </select>
                        <label>Saisir le Professeur</label>
                        <select>
                            <?php foreach ($profs as $prof):?>
                            <option value="<?=$prof['id']?>"><?=$prof['nom']." ".$prof['prenom'];?></option>
                            <?php endforeach;?>
                        </select>
                        <input type="submit" value="Creer">
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="../../Public/static/Js/admin.js"></script>
