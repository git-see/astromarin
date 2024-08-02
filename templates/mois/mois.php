<!-- GÉRER L'ANNÉE : CHOIX -->
<section>
    <h2 class="text-primary text-center mt-5">Vous souhaitez gérer les données du mois</h2>
    <a href="moisAjouter.php?id=<?php echo strip_tags(stripslashes(htmlentities(trim($mois['id'])))) ?>" class="btn btn-warning float-end mx-5"><?php echo '&nbsp'; ?>Ajouter<?php echo '&nbsp'; ?></a>
    <div class="container pt-5 mt-5">
        <div class="row">
            <?php
            foreach ($result as $mois) {
            ?>
                <div class="col mt-1 mb-5">
                    <div class="card col" style="height:550px">
                        <div class="card-body" style="height:200px">
                            <h2 pattern="^(20)\d{2}$" class="card-title text-center text-primary fw-bolder"><?php echo strip_tags(stripslashes(htmlentities(trim($mois['signe'])))) ?></h2>
                            <h3 class="card-title text-end"><?php echo strip_tags(stripslashes(htmlentities(trim($mois['champDate'])))) ?></h3>

                            <h4 class="fw-bolder">Amour</h4>
                            <p class="card-text"><?php echo strip_tags(stripslashes(htmlentities(trim($mois['textAmour'])))) ?></p>

                            <h4 class="fw-bolder">Travail</h4>
                            <p class="card-text"><?php echo strip_tags(stripslashes(htmlentities(trim($mois['textTravail'])))) ?></p>

                            <h4 class="fw-bolder">Santé</h4>
                            <p class="card-text"><?php echo strip_tags(stripslashes(htmlentities(trim($mois['textSante'])))) ?></p>

                            <div>
                                <a onclick="return confirm('Voulez-vous supprimer définitivement ?')" href="moisSupprimer.php?id=<?php echo strip_tags(stripslashes(htmlentities(trim($mois['id'])))) ?>" class="btn btn-danger" role="button" aria-pressed="true">Supprimer</a>
                                <a href="moisModifier.php?id=<?php echo strip_tags(stripslashes(htmlentities(trim($mois['id'])))) ?>" class="btn btn-success float-end" role="button" aria-pressed="true">Modifier</a>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="fs-1 text-white bg-light.bg-gradient">
            <?php
            }
            ?>
        </div>
    </div>
    </div>
</section>