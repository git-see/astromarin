<?php
session_start();
if (!isset($_SESSION["user"]) && !($_SESSION["user"]["statut"] == "Admin")) {
    header("Location: /formulaire/formConnexion.php");
    die();
} else {
    require_once('..////..///../database/connexionBDD.php');
    $sql = 'SELECT * FROM signes, jour WHERE signes.id = jour.signes_id LIMIT 12';
    $query = $db->prepare($sql);
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AstroMarin - DASHBOARD/JOUR</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <!-- ENTETE -->
    <header>
        <div id="entete">
            <div>
                <h1 id="h1">AstroMarin</h1>
            </div>
        </div>
        <div class="d-flex mt-5">
            <a href="/dashboard/accueil.php" class="px-3 fs-5 fw-bold text-info">Dashboard</a>
        </div>
    </header>

    <!-- GÉRER LE JOUR : CHOIX -->
    <section>
        <h2 class="text-primary text-center mt-5">Vous souhaitez gérer les données du jour</h2>
        <a href="jourAjouter.php?id=<?php echo strip_tags(stripslashes(htmlentities(trim($jour['id'])))) ?>" class="btn btn-warning float-end mx-5"><?php echo '&nbsp'; ?>Ajouter<?php echo '&nbsp'; ?></a>
        <div class="container pt-5 mt-5 bg-info">
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

    <footer>
        <ul>
            <li><a href="/rgpd.php">RGPD</a></li>
            <li><a href=""> GitHub</a></li>
            <li>&#xA9; AstroMarin</li>
        </ul>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>