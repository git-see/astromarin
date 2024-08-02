<button id="boutonAccueil"><a href="/index.php">ACCUEIL</a></button>
    <section id="consulter">
        <!---------- LE SIGNE ---------->
        <h2 class="text-center fw-bolder text-primary"><?php echo strip_tags(stripslashes(htmlentities(trim($result['signe'])))) ?></h2>

        <!---------- AUJOURD'HUI ---------->
        <h3 class="fw-bolder text-primary m-5">AUJOURD'HUI <n style="color:blue"><?php echo strip_tags(stripslashes(htmlentities(trim($aujourdhuiFR->format($aujourdhui))))) ?></n>
        </h3>

        <h4 class="consulter">Amour</h4>
        <p class="consulter"><?php echo strip_tags(stripslashes(htmlentities(trim($result['textAmour'])))) ?></p>

        <h4 class="consulter">Travail</h4>
        <p class="consulter"><?php echo strip_tags(stripslashes(htmlentities(trim($result['textTravail'])))) ?></p>

        <h4 class="consulter">Santé</h4>
        <p class="consulter"><?php echo strip_tags(stripslashes(htmlentities(trim($result['textSante'])))) ?></p>

        <!---------- CE MOIS ---------->
        <h3 class="fw-bolder text-primary m-5">MOIS <n style="color:blue"><?php echo strip_tags(stripslashes(htmlentities(trim($result['champDate'])))) ?></n>
        </h3>

        <h4 class="consulter">Amour</h4>
        <p class="consulter"><?php echo strip_tags(stripslashes(htmlentities(trim($result['textAmour'])))) ?></p>

        <h4 class="consulter">Travail</h4>
        <p class="consulter"><?php echo strip_tags(stripslashes(htmlentities(trim($result['textTravail'])))) ?></p>

        <h4 class="consulter">Santé</h4>
        <p class="consulter"><?php echo strip_tags(stripslashes(htmlentities(trim($result['textSante'])))) ?></p>

        <!---------- CETTE ANNÉE ---------->
        <h3 class="fw-bolder text-primary m-5">ANNÉE <n style="color:blue"><?php echo strip_tags(stripslashes(htmlentities(trim(Date('Y'))))) ?></n>
        </h3>
        <h4 class="consulter">Amour</h4>
        <p class="consulter"><?php echo strip_tags(stripslashes(htmlentities(trim($result['textAmour'])))) ?></p>

        <h4 class="consulter">Travail</h4>
        <p class="consulter"><?php echo strip_tags(stripslashes(htmlentities(trim($result['textTravail'])))) ?></p>

        <h4 class="consulter">Santé</h4>
        <p class="consulter"><?php echo strip_tags(stripslashes(htmlentities(trim($result['textSante'])))) ?></p>
    </section>