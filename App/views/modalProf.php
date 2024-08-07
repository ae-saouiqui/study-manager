<!--Functionnalities section-->
<section>
    <div class="modal fade" id="deposer-cours" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Deposer Cours</h5>
                    <a class="btn-close" data-bs-dismiss="modal"></a>
                </div>
                <div class="modal-body">
                    <form id="add-cours">
                        <input type="text" placeholder="saisir titre" required>
                        <select name="module" data-prof-id="<?=$prof_id;?>">
                            <?php foreach ($modules as $module):?>
                                <option value="<?=$module['titre'];?>"><?=$module['titre'];?></option>
                            <?php endforeach;?>
                        </select>
                        <input type="file" required>
                        <input type="submit">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="deposer-note" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-between">
                    <h5 class="modal-title">Deposer Note</h5>
                    <button type="button"  data-bs-dismiss="modal"><i class="fa-solid fa-xmark"></i></button>
                </div>
                <div class="modal-body">
                    <form id="add-note">
                        <select name="filiere">
                            <?php foreach ($filieres as $filiere):?>
                            <option value="<?=$filiere['id'];?>"><?=$filiere['raccourci']?></option>
                            <?php endforeach;?>
                        </select>
                        <select name="module">
                            <?php foreach ($modules as $module):?>
                            <option value="<?=$module['titre'];?>"><?=$module['titre'];?></option>
                            <?php endforeach;?>
                        </select>
                        <input type="file">
                        <input type="submit" value="Deposer">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exporter-note" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-between">
                    <h5 class="modal-title">
                        Exporter fichiers des notes
                    </h5>
                    <a class="btn-close" data-bs-dismiss="modal"></a>
                </div>
                <div class="modal-content">
                    <form id="export-note" data-prof="<?=$prof_id?>">
                        <select name="filiere" style="margin: 10px 0">
                            <?php foreach ($filieres as $filiere):?>
                                <option value="<?=$filiere['id']?>"><?=$filiere['raccourci']?></option>
                            <?php endforeach;?>
                        </select>
                        <input type="submit" value="Exporter" style="margin: 10px 0">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="absence" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Noter L'Absence</h5>
                    <a class="btn-close" data-bs-dismiss="modal"></a>
                </div>
                <div class="modal-body">
                    <form id="noter-absence" data-prof="<?=$prof_id;?>">
                        <label>Saisir la filiere</label>
                        <select name="filiere" style="margin: 10px 0">
                            <?php foreach ($filieres as $filiere):?>
                                <option value="<?=$filiere['id']?>"><?=$filiere['raccourci']?></option>
                            <?php endforeach;?>
                        </select>
                        <label>Saisir le module</label>
                        <select name="module">
                            <?php foreach ($modules as $module):?>
                                <option value="<?=$module['titre'];?>"><?=$module['titre'];?></option>
                            <?php endforeach;?>
                        </select>
                        <input type="submit">
                    </form>
                </div>
            </div>
        </div>

    </div>
</section>
<script src="../../Public/static/Js/professeur.js"></script>
