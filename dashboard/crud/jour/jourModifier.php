<?php
session_start();
if (!isset($_SESSION["user"]) && !($_SESSION["user"]["statut"] == "Admin")) {
    header("Location: /formulaire/formConnexion.php");
    die();
}

if ($_POST) {
    if (
        isset($_POST['id']) && !empty($_POST['id'])
        && isset($_POST['dateJour']) && !empty($_POST['dateJour'])
        && isset($_POST['textAmourJour']) && !empty($_POST['textAmourJour'])
        && isset($_POST['textTravailJour']) && !empty($_POST['textTravailJour'])
        && isset($_POST['textSanteJour']) && !empty($_POST['textSanteJour'])
    ) {

        require_once('..////..///../database/connexionBDD.php');

        $id = strip_tags($_POST['id']);
        $dateJour = strip_tags($_POST['dateJour']);
        $textAmourJour = strip_tags($_POST['textAmourJour']);
        $textTravailJour = strip_tags($_POST['textTravailJour']);
        $textSanteJour = strip_tags($_POST['textSanteJour']);

        $sql = 'UPDATE jour SET dateJour = :dateJour, textAmourJour = :textAmourJour, textTravailJour = :textTravailJour, textSanteJour = :textSanteJour WHERE id = :id;';

        $query = $db->prepare($sql);
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->bindValue(':dateJour', $dateJour, PDO::PARAM_STR);
        $query->bindValue(':textAmourJour', $textAmourJour, PDO::PARAM_STR);
        $query->bindValue(':textTravailJour', $textTravailJour, PDO::PARAM_STR);
        $query->bindValue(':textSanteJour', $textSanteJour, PDO::PARAM_STR);
        $query->execute();

        $_SESSION['message'] = "Prédiction modifiée";
        require_once('..////..///../database/deconnexionBDD.php');

        header('Location: jour.php');
    } else {
        $_SESSION['erreur'] = "Le formulaire est incomplet";
    }
}

if (isset($_GET['id']) && !empty($_GET['id'])) {
    require_once('..////..///../database/connexionBDD.php');

    $id = strip_tags($_GET['id']);
    $sql = 'SELECT * FROM jour WHERE id = :id;';
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
    $sql2 = 'SELECT signe FROM signes,jour WHERE signes.id = jour.signes_id AND jour.id = :id';
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
            <a href="/dashboard/crud/jour/jour.php" class="px-3 fs-5 fw-bold text-info">Jour</a>
        </div>
    </header>

    <!-- GÉRER L'ANNÉE : MODIFIER -->
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
                        <label for="dateJour" class="fs-5">AUJOURD'HUI</label>
                        <input type="text" id="dateJour" name="dateJour" class="form-control" value="<?= strip_tags(stripslashes(htmlentities(trim($modifie['dateJour'])))) ?>" required>
                    </div>
                    <div class="form-group mb-5">
                        <label for="textAmourJour" class="fs-5">AMOUR</label>
                        <textarea type="text" id="textAmourJour" name="textAmourJour" class="form-control" value="<?= strip_tags(stripslashes(htmlentities(trim($modifie['textAmourJour'])))) ?>" required>
                        </textarea>
                    </div>
                    <div class="form-group mb-5">
                        <label for="textTravailJour" class="fs-5">TRAVAIL</label>
                        <textarea type="text" id="textTravailJour" name="textTravailJour" class="form-control" value="<?= strip_tags(stripslashes(htmlentities(trim($modifie['textTravailJour'])))) ?>" required>
                        </textarea>
                    </div>
                    <div class="form-group mb-5">
                        <label for="textSanteJour" class="fs-5">SANTE</label>
                        <textarea type="text" id="textSanteJour" name="textSanteJour" class="form-control" value="<?= strip_tags(stripslashes(htmlentities(trim($modifie['textSanteJour'])))) ?>" required>
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