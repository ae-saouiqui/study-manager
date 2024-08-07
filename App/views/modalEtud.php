<!--functionnalitie section-->
<section>
    <div class="modal fade" id="deposer-rapport" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-between">
                    <h5 class="modal-title">Deposer Rapport</h5>
                    <button type="button"  data-bs-dismiss="modal"><i class="fa-solid fa-xmark"></i></button>
                </div>
                <div class="modal-body">
                    <form id="add-rapport">
                        <input type="text" placeholder="titre" required>
                        <select name="prof" data-etud-id="<?=$id_etud;?>">
                            <?php foreach ($profs as $prof):?>
                            <option value="<?=$prof['id']?>"><?=$prof['nom']." ".$prof['prenom'];?></option>
                        <?php endforeach;?>
                        </select>
                        <input type="file" required>
                        <input type="submit" value="Deposer">
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="../../Public/static/Js/etudiant.js"></script>
