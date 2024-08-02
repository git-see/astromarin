<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AstroMarin : <?= $pageTitle ?></title>
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
            <?php
            if (isset($_SESSION["user"])) {  ?>
                <div style="display:flex; justify-content:space-around;margin-right:3em; margin-left:2em;color:aqua;align-self:center;gap:1em;">
                    <a href="/formulaires/deconnexion.php"><img src="images/connexion.png" alt="Se déconnecter"></a>
                <?php
            } ?>
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
    <?= $pageContent ?>
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