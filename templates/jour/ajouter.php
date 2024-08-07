<!-- GÉRER LE JOUR : AJOUTER-->
<section class="container pb-5 mt-5 mb-5 bg-info text-white">
    <a href="/dashboard/crud/jour/jour.php" class="p-3 fs-5 fw-bold text-primary bg-light float-end">Retour à la liste</a>
    <div class="row">
        <section class="col-12">
            <?php
            if (!empty($_SESSION['erreur'])) {
                echo '<div class="alert alert-danger" role="alert"> ' . $_SESSION['erreur'] . ' </div>';
                $_SESSION['erreur'] = "";
            }
            ?>
            <h1 class="text-center m-5">Vous avez supprimé par erreur? <br> Recréez votre prédiction ici</h1>
            <form action="/dashboard/crud/jour/jour.php?controller=jour&action=creer" method="post">
                <div class="form-group card-title text-center text-primary fw-bolder mt-5 mb-5">
                    <label for="signes_id">QUEL SIGNE ? &#x2B9B;</label>
                    <select type="text" id="signes_id" class="form-control text-center fs-5 text-primary " name="signes_id" required>
                        <option value="1" selected="selected">Écrevisse</option>
                        <option value="2">Crabe</option>
                        <option value="3">Homard</option>
                        <option value="4">Méduse</option>
                        <option value="5">Pieuvre</option>
                        <option value="6">Calamar</option>
                        <option value="7">Tortue</option>
                        <option value="8">Oursin</option>
                        <option value="9">Crocodile</option>
                        <option value="10">Cormoran</option>
                        <option value="11">Pinguoin</option>
                        <option value="12">Hippopotame</option>
                    </select>
                </div>
                <div class="form-group w-25 m-auto mb-5">
                    <label for="champDate" class="fs-5">AUJOURD'HUI</label>
                    <input type="text" id="champDate" name="champDate" class="form-control" required>
                </div>
                <div class="form-group mb-5">
                    <label for="textAmour" class="fs-5">AMOUR</label>
                    <textarea type="text" id="textAmour" name="textAmour" class="form-control" required>
                        </textarea>
                </div>
                <div class="form-group mb-5">
                    <label for="textTravail" class="fs-5">TRAVAIL</label>
                    <textarea type="text" id="textTravail" name="textTravail" class="form-control" required>
                        </textarea>
                </div>
                <div class="form-group mb-5">
                    <label for="textSante" class="fs-5">SANTE</label>
                    <textarea type="text" pattern="^[A-Za-z0-9 ]+$" id="textSante" name="textSante" class="form-control" required>
                        </textarea>
                </div>
                <button class="btn btn-primary float-end">Envoyer</button>
            </form>
        </section>
    </div>
</section>