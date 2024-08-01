<!-- CHOIX -->
<section id="choix">
        <h2>Quel signe souhaitez-vous consulter?</h2>
        <div class="container w-100" id="containerAccueil">
            <div class="row d-flex flex-wrap justify-content-around text-center">
                <?php
                foreach ($result as $consulter) {
                ?>
                    <div class="col-4 m-4">
                        <a href="consulter.php?id=<?php echo strip_tags(stripslashes(htmlentities(trim($consulter['id'])))) ?>">
                            <div class="border m-auto rounded-circle">
                                <img src="<?php echo strip_tags(stripslashes(htmlentities(trim($consulter['image'])))) ?>" class="border m-auto rounded-circle w-100 h-100" alt="<?php echo strip_tags(stripslashes(htmlentities(trim($consulter['signe'])))) ?>">
                                <legend><?php echo strip_tags(stripslashes(htmlentities(trim($consulter['signe'])))) ?></legend>
                            </div>
                        </a>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </section>
    <i>Toutes les photos sont libre de droit et visibles via ce site: <a href="https://pixabay.com/fr/">https://pixabay.com/fr/</a></i>
    <hr>