<!-- GESTION -->
<section>
    <div class="p-5">
        <h1 class="text-end">Bienvenue &nbsp; <strong><i><?php echo strip_tags(stripslashes(htmlentities(trim($_SESSION["user"]["pseudo"])))) ?></i></strong> &nbsp; !</h1> <br>
        <h2 class="text-primary text-end">Vous êtes dans votre espace " <?php echo strip_tags(stripslashes(htmlentities(trim($_SESSION["user"]["statut"])))) ?> "</h2>
    </div>
    <h2 class="text-center pb-4 mx-4">Que souhaitez-vous gérer?</h2>
    <?php
    echo "<div class='container w-100 my-5 pb-5'>
                <div class='text-center'>
                    <button type='button' class='col-md-12 btn btn-success fs-1 mb-5'><a class='text-white' href='crud/annee/annee.php'>L'année</a></button>
                    <button type='button' class='col-md-12 btn btn-warning fs-1 mb-5'><a href='crud/mois/mois.php'>Le mois</a></button>
                    <button type='button' class='col-md-12 btn btn-primary fs-1 mb-5'><a href='crud/jour/jour.php' class='text-white'>Le jour</a></button>
                    <button type='button' class='col-md-12 btn btn-secondary fs-1 mb-5'><a href='/index.php' class='text-white'>Consulter</a></button>
            </div>";
    ?>
</section>
