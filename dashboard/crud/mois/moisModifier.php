<?php
session_start();
if (!isset($_SESSION["user"]) && !($_SESSION["user"]["statut"] == "Admin")) {
    header("Location: /formulaire/formConnexion.php");
    die();
}

if ($_POST) {
    if (
        isset($_POST['id']) && !empty($_POST['id'])
        && isset($_POST['dateMois']) && !empty($_POST['dateMois'])
        && isset($_POST['textAmourMois']) && !empty($_POST['textAmourMois'])
        && isset($_POST['textTravailMois']) && !empty($_POST['textTravailMois'])
        && isset($_POST['textSanteMois']) && !empty($_POST['textSanteMois'])
    ) {

        require_once('..////..///../database/connexionBDD.php');

        $id = strip_tags($_POST['id']);
        $dateMois = strip_tags($_POST['dateMois']);
        $textAmourMois = strip_tags($_POST['textAmourMois']);
        $textTravailMois = strip_tags($_POST['textTravailMois']);
        $textSanteMois = strip_tags($_POST['textSanteMois']);

        // MODIFIER
        $sql = 'UPDATE mois SET dateMois = :dateMois, textAmourMois = :textAmourMois, textTravailMois = :textTravailMois, textSanteMois = :textSanteMois WHERE id = :id;';

        $query = $db->prepare($sql);
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->bindValue(':dateMois', $dateMois, PDO::PARAM_STR);
        $query->bindValue(':textAmourMois', $textAmourMois, PDO::PARAM_STR);
        $query->bindValue(':textTravailMois', $textTravailMois, PDO::PARAM_STR);
        $query->bindValue(':textSanteMois', $textSanteMois, PDO::PARAM_STR);
        $query->execute();

        $_SESSION['message'] = "Prédiction modifiée";
        require_once('..////..///../database/deconnexionBDD.php');

        header('Location: mois.php');
    } else {
        $_SESSION['erreur'] = "Le formulaire est incomplet";
    }
}

// RÉCUPÉRER ET AFFICHER
if (isset($_GET['id']) && !empty($_GET['id'])) {
    require_once('..////..///../database/connexionBDD.php');

    $id = strip_tags($_GET['id']);
    $sql = 'SELECT * FROM mois WHERE id = :id;';
    $query = $db->prepare($sql);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $modifie = $query->fetch();

    if (!$modifie) {
        $_SESSION['erreur'] = "Cet id n'existe pas";
        header('Location: index.php');
    }
} else {
    $_SESSION['erreur'] = "URL invalide";
    header('Location: index.php');
}
if (
    isset($_GET['id']) && !empty($_GET['id'])
) {
    $sql2 = 'SELECT signe FROM signes,mois WHERE signes.id = mois.signes_id AND mois.id = :id';
    $query2 = $db->prepare($sql2);
    $query2->execute(['id' => $_GET['id']]);
    $sign = $query2->fetch();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AstroMarin - DASHBOARD/Modifier une prédiction</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <header>
        <div id="entete">
            <div>
                <h1 id="h1">AstroMarin</h1>
            </div>
        </div>
        <div class="d-flex mt-5">
            <a href="/dashboard/accueil.php" class="px-3 fs-5 fw-bold text-info">Dashboard</a>
            <a href="/dashboard/crud/mois/mois.php" class="px-3 fs-5 fw-bold text-info">Mois</a>
        </div>
    </header>

    <!-- GÉRER LE MOIS : MODIFIER -->
    <section class="container pb-5 mt-5 mb-5 bg-info text-white">
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
                        <label for="dateMois" class="fs-5">MOIS</label>
                        <input type="text" id="dateMois" name="dateMois" class="form-control" value="<?= strip_tags(stripslashes(htmlentities(trim($modifie['dateMois'])))) ?>" required>
                    </div>
                    <div class="form-group mb-5">
                        <label for="textAmourMois" class="fs-5">AMOUR</label>
                        <textarea type="text" id="textAmourMois" name="textAmourMois" class="form-control" value="<?= strip_tags(stripslashes(htmlentities(trim($modifie['textAmourMois'])))) ?>" required>
                        </textarea>
                    </div>
                    <div class="form-group mb-5">
                        <label for="textTravailMois" class="fs-5">TRAVAIL</label>
                        <textarea type="text" id="textTravailMois" name="textTravailMois" class="form-control" value="<?= strip_tags(stripslashes(htmlentities(trim($modifie['textTravailMois'])))) ?>" required>
                        </textarea>
                    </div>
                    <div class="form-group mb-5">
                        <label for="textSanteMois" class="fs-5">SANTE</label>
                        <textarea type="text" id="textSanteMois" name="textSanteMois" class="form-control" value="<?= strip_tags(stripslashes(htmlentities(trim($modifie['textSanteMois'])))) ?>" required>
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

    <!-- FOOTER -->
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