<?php
session_start();
if (!isset($_SESSION["user"]) && !($_SESSION["user"]["statut"] == "Admin")) {
    header("Location: /formulaire/formConnexion.php");
    die();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AstroMarin - DASHBOARD/ACCUEIL</title>
    <link rel="stylesheet" href="/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<!-- ENTETE -->
<header>
    <div id="entete">
        <div>
            <h1 id="h1">AstroMarin</h1>
        </div>
        <div>
            <a href="/formulaire/formDeconnexion.php"><img class="mt-3" src="/images/connexion.png" alt="Se déconnecter"></a>
        </div>
    </div>
</header>

<!-- GESTION -->
<section id="gestion">
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

<!-- FOOTER -->
<footer>
    <ul>
        <li><a href="/rgpd.php">RGPD</a></li>
        <li><a href="https://github.com/git-see"> GitHub</a></li>
        <li>&#xA9; AstroMarin</li>
    </ul>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>