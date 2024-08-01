 <!-- GÉRER L'ANNÉE : MODIFIER -->
 <section class="container pb-5 mt-5 mb-5 bg-info text-white">
     <a href="/dashboard/crud/jour/jour.php" class="p-3 fs-5 fw-bold text-primary bg-light float-end">Retour à la liste</a>
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
                     <label for="dateJour" class="fs-5">AUJOURD'HUI</label>
                     <input type="text" id="dateJour" name="dateJour" class="form-control" value="<?= strip_tags(stripslashes(htmlentities(trim($modifie['dateJour'])))) ?>" required>
                 </div>
                 <div class="form-group mb-5">
                     <label for="textAmourJour" class="fs-5">AMOUR</label>
                     <textarea type="text" id="textAmourJour" name="textAmourJour" class="form-control" value="<?= strip_tags(stripslashes(htmlentities(trim($modifie['textAmourJour'])))) ?>" required>
                        </textarea>
                 </div>
                 <div class="form-group mb-5">
                     <label for="textTravailJour" class="fs-5">TRAVAIL</label>
                     <textarea type="text" id="textTravailJour" name="textTravailJour" class="form-control" value="<?= strip_tags(stripslashes(htmlentities(trim($modifie['textTravailJour'])))) ?>" required>
                        </textarea>
                 </div>
                 <div class="form-group mb-5">
                     <label for="textSanteJour" class="fs-5">SANTE</label>
                     <textarea type="text" id="textSanteJour" name="textSanteJour" class="form-control" value="<?= strip_tags(stripslashes(htmlentities(trim($modifie['textSanteJour'])))) ?>" required>
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