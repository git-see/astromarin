<!-- GÉRER L'ANNÉE : MODIFIER -->
<section class="container pb-5 mt-5 mb-5 bg-info text-white">
    <a href="/dashboard/crud/annee/annee.php" class="p-3 fs-5 fw-bold text-primary bg-light float-end">Retour à la liste</a>
    <div class="row">
        <section class="col-12">
            <?php
            if (!empty($_SESSION['erreur'])) {
                echo '<div class="alert alert-danger" role="alert">
    ' . $_SESSION['erreur'] . '
</div>';
                $_SESSION['erreur'] = "";
            }
            ?>
            <h1 class="card-title text-center text-primary fw-bolder mt-5">SIGNE : <?php echo strip_tags(stripslashes(htmlentities(trim($sign['signe'])))) ?></h1>

            <form action="" method="post">
                <div class="form-group m-5">
                    <label for="dateAnnee" class="fs-5">ANNEE</label>
                    <input type="text" id="dateAnnee" name="dateAnnee" class="form-control" value="<?= strip_tags(stripslashes(htmlentities(trim($modifie['dateAnnee'])))) ?>" required>
                </div>
                <div class="form-group mb-5">
                    <label for="textAmourAnnee" class="fs-5">AMOUR</label>
                    <textarea type="text" id="textAmourAnnee" name="textAmourAnnee" class="form-control" value="<?= strip_tags(stripslashes(htmlentities(trim($modifie['textAmourAnnee'])))) ?>" required>
                        </textarea>
                </div>
                <div class="form-group mb-5">
                    <label for="textTravailAnnee" class="fs-5">TRAVAIL</label>
                    <textarea type="text" id="textTravailAnnee" name="textTravailAnnee" class="form-control" value="<?= strip_tags(stripslashes(htmlentities(trim($modifie['textTravailAnnee'])))) ?>" required>
                        </textarea>
                </div>
                <div class="form-group mb-5">
                    <label for="textSanteAnnee" class="fs-5">SANTE</label>
                    <textarea type="text" id="textSanteAnnee" name="textSanteAnnee" class="form-control" value="<?= strip_tags(stripslashes(htmlentities(trim($modifie['textSanteAnnee'])))) ?>" required>
                        </textarea>
                </div>
                <div class="float-end mx-5">
                    <input type="hidden" value="<?= strip_tags(stripslashes(htmlentities(trim($modifie['id'])))) ?>" name="id">

                    <button class="btn btn-primary">Modifier</button>
                </div>
            </form>
        </section>
    </div>
</section>