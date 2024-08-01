 <!-- GÉRER LE JOUR : CHOIX -->
 <section>
     <h2 class="text-primary text-center mt-5">Vous souhaitez gérer les données du jour</h2>
     <a href="jourAjouter.php?id=<?php echo strip_tags(stripslashes(htmlentities(trim($jour['id'])))) ?>" class="btn btn-warning float-end mx-5"><?php echo '&nbsp'; ?>Ajouter<?php echo '&nbsp'; ?></a>
     <div class="container pt-5 mt-5">
         <div class="row">
             <?php
                foreach ($result as $jour) {
                ?>
                 <div class="colmt-1 mb-5">
                     <div class="card col" style="height:550px">
                         <div class="card-body" style="height:200px">
                             <h2 pattern="^(20)\d{2}$" class="card-title text-center text-primary fw-bolder"><?php echo strip_tags(stripslashes(htmlentities(trim($jour['signe'])))) ?></h2>
                             <h3 class="card-title text-end"><?php echo strip_tags(stripslashes(htmlentities(trim($jour['dateJour'])))) ?></h3>

                             <h4 class="fw-bolder">Amour</h4>
                             <p class="card-text"><?php echo strip_tags(stripslashes(htmlentities(trim($jour['textAmourJour'])))) ?></p>

                             <h4 class="fw-bolder">Travail</h4>
                             <p class="card-text"><?php echo strip_tags(stripslashes(htmlentities(trim($jour['textTravailJour'])))) ?></p>

                             <h4 class="fw-bolder">Santé</h4>
                             <p class="card-text"><?php echo strip_tags(stripslashes(htmlentities(trim($jour['textSanteJour'])))) ?></p>

                             <div>
                                 <a onclick="return confirm('Voulez-vous supprimer définitivement ?')" href="jourSupprimer.php?id=<?php echo strip_tags(stripslashes(htmlentities(trim($jour['id'])))) ?>" class="btn btn-danger" role="button" aria-pressed="true">Supprimer</a>
                                 <a href="jourModifier.php?id=<?php echo strip_tags(stripslashes(htmlentities(trim($jour['id'])))) ?>" class="btn btn-success float-end" role="button" aria-pressed="true">Modifier</a>
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