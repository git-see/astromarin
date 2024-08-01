<?php
session_start();
if (!isset($_SESSION["user"]) || !isset($_SESSION["user"]) && !($_SESSION["user"]["statut"] == "Membre") || !isset($_SESSION["user"]) &&  !($_SESSION["user"]["statut"] == "Admin")) {
    header("Location: /formulaire/formConnexion.php");
    die();
} else {
    require_once('database/connexionBDD.php');

    $sql = 'SELECT `id`, `signe`, `image` FROM `signes`
';
    $query = $db->prepare($sql);
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);

    require_once('database/deconnexionBDD.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AstroMarin : ACCUEIL</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body id="bodyAccueil">

    <!-- ENTETE -->
    <header>
        <div id="entete">
            <div>
                <h1 id="h1">AstroMarin</h1>
            </div>
            <div style="display:flex; justify-content:space-around;margin-right:3em; margin-left:2em;color:aqua;align-self:center;gap:1em;">
                <a href="/formulaire/formDeconnexion.php"><img src="images/connexion.png" alt="Se déconnecter"></a>

                <!-- PRIVILÈGE ADMIN -->
                <?php
                if (isset($_SESSION["user"]) && ($_SESSION["user"]["statut"] == "Admin")) {  ?>
                    <a href="/dashboard/accueil.php" style="font-size:20px;color:aqua;align-self:center;">Dashboard</a>
                <?php
                } ?>

            </div>
        </div>
        <div id="slogan">
            <p>Le monde marin nous parle,</p>
            <p>découvrez ses prédictions !</p>
        </div>
    </header>

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

    <!-- FOOTER -->
    <footer>
        <ul>
            <li><a href="/rgpd.php">RGPD</a></li>
            <li><a href="https://github.com/git-see"> GitHub</a></li>
            <li><a href="http://welcome-my-skills.free.nf/"><img style="width:30px;" src="/images/w.png" alt="Welcome"></a></li>
            <li>&#xA9; AstroMarin</li>
        </ul>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>