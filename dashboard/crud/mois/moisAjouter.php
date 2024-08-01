<?php
session_start();
if (!isset($_SESSION["user"]) && !($_SESSION["user"]["statut"] == "Admin")) {
    header("Location: /formulaire/formConnexion.php");
    die();
}

if ($_POST) {

    if (
        isset($_POST['signes_id']) && !empty($_POST['signes_id'])
        && isset($_POST['dateMois']) && !empty($_POST['dateMois'])
        && isset($_POST['textAmourMois']) && !empty($_POST['textAmourMois'])
        && isset($_POST['textTravailMois']) && !empty($_POST['textTravailMois'])
        && isset($_POST['textSanteMois']) && !empty($_POST['textSanteMois'])
    ) {

        require_once('..////..///../database/connexionBDD.php');

        $signe = strip_tags($_POST['signes_id']);
        $dateMois = strip_tags($_POST['dateMois']);
        $textAmourMois = strip_tags($_POST['textAmourMois']);
        $textTravailMois = strip_tags($_POST['textTravailMois']);
        $textSanteMois = strip_tags($_POST['textSanteMois']);

        $sql = 'INSERT INTO mois (signes_id, dateMois, textAmourMois, textTravailMois, textSanteMois) VALUES (:signes_id, :dateMois, :textAmourMois, :textTravailMois, :textSanteMois)';

        $query = $db->prepare($sql);

        $query->bindValue(':signes_id', $signe, PDO::PARAM_INT);
        $query->bindValue(':dateMois', $dateMois, PDO::PARAM_STR);
        $query->bindValue(':textAmourMois', $textAmourMois, PDO::PARAM_STR);
        $query->bindValue(':textTravailMois', $textTravailMois, PDO::PARAM_STR);
        $query->bindValue(':textSanteMois', $textSanteMois, PDO::PARAM_STR);

        $query->execute();

        $_SESSION['message'] = "Prédiction ajoutée";
        require_once('..////..///../database/deconnexionBDD.php');

        header('Location: mois.php');
    } else {
        $_SESSION['erreur'] = "Le formulaire est incomplet";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AstroMarin - DASHBOARD/Rajouter une prédiction supprimée</title>
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

    <!-- GÉRER LE MOIS : AJOUTER-->
    <section class="container pb-5 mt-5 mb-5 bg-info text-white">
        <div class="row">
            <section class="col-12">
                <?php
                if (!empty($_SESSION['erreur'])) {
                    echo '<div class="alert alert-danger" role="alert"> ' . $_SESSION['erreur'] . ' </div>';
                    $_SESSION['erreur'] = "";
                }
                ?>
                <h1 class="text-center m-5">Vous avez supprimé par erreur? <br> Recréez votre prédiction ici</h1>
                <form action="" method="post">
                    <div class="form-group card-title text-center text-primary fw-bolder mt-5 mb-5">
                        <label for="signes_id">QUEL SIGNE ? &#x2B9B;</label>
                        <select type="text" id="signes_id" class="form-control text-center fs-5 text-primary " name="signes_id" required>
                            <option value="1" selected="selected">Écrevisse</option>
                            <option value="2">Crabe</option>
                            <option value="3">Homard</option>
                            <option value="4">Méduse</option>
                            <option value="5">Pieuvre</option>
                            <option value="6">Calamar</option>
                            <option value="7">Tortue</option>
                            <option value="8">Oursin</option>
                            <option value="9">Crocodile</option>
                            <option value="10">Cormoran</option>
                            <option value="11">Pinguoin</option>
                            <option value="12">Hippopotame</option>
                        </select>
                    </div>
                    <div class="form-group w-25 m-auto mb-5">
                        <label for="dateMois" class="fs-5">MOIS</label>
                        <input type="text" id="dateMois" name="dateMois" class="form-control" required>
                    </div>
                    <div class="form-group mb-5">
                        <label for="textAmourMois" class="fs-5">AMOUR</label>
                        <textarea type="text" id="textAmourMois" name="textAmourMois" class="form-control" required>
                        </textarea>
                    </div>
                    <div class="form-group mb-5">
                        <label for="textTravailMois" class="fs-5">TRAVAIL</label>
                        <textarea type="text" id="textTravailMois" name="textTravailMois" class="form-control" required>
                        </textarea>
                    </div>
                    <div class="form-group mb-5">
                        <label for="textSanteMois" class="fs-5">SANTE</label>
                        <textarea type="text" pattern="^[A-Za-z0-9 ]+$" id="textSanteMois" name="textSanteMois" class="form-control" required>
                        </textarea>
                    </div>
                    <button class="btn btn-primary float-end">Envoyer</button>
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