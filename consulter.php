<?php
session_start();
if (isset($_GET['id']) && !empty($_GET['id'])) {

    require_once('database/connexionBDD.php');

    $aujourdhui = new DateTime();
    $aujourdhuiFR = new IntlDateFormatter('fr_FR', IntlDateFormatter::FULL, IntlDateFormatter::NONE);

    $id = strip_tags(stripslashes(htmlentities(trim($_GET['id']))));
    $sql = 'SELECT signes.signe, jour.textAmourJour, jour.textTravailJour, jour.textSanteJour, mois.dateMois, mois.textAmourMois, mois.textTravailMois, mois.textSanteMois, annee.textAmourAnnee, annee.textTravailAnnee, annee.textSanteAnnee
    FROM signes, jour, mois, annee
    WHERE signes.id = :id
    AND signes.id = jour.signes_id
    AND signes.id = mois.signes_id
    AND signes.id = annee.signes_id
';
    $query = $db->prepare($sql);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $result = $query->fetch();

    require_once('database/deconnexionBDD.php');
} else {
    echo 'Une erreur est survenue';
    header('Location: /index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AstroMarin : CONSULTER</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <button id="boutonAccueil"><a href="/index.php">ACCUEIL</a></button>
    <section id="consulter">

        <!---------- LE SIGNE ---------->
        <h2 class="text-center fw-bolder text-primary"><?php echo strip_tags(stripslashes(htmlentities(trim($result['signe'])))) ?></h2>

        <!---------- AUJOURD'HUI ---------->
        <h3 class="fw-bolder text-primary m-5">AUJOURD'HUI <n style="color:blue"><?php echo strip_tags(stripslashes(htmlentities(trim($aujourdhuiFR->format($aujourdhui))))) ?></n>
        </h3>

        <h4>Amour</h4>
        <p><?php echo strip_tags(stripslashes(htmlentities(trim($result['textAmourJour'])))) ?></p>

        <h4>Travail</h4>
        <p><?php echo strip_tags(stripslashes(htmlentities(trim($result['textTravailJour'])))) ?></p>

        <h4>Santé</h4>
        <p><?php echo strip_tags(stripslashes(htmlentities(trim($result['textSanteJour'])))) ?></p>

        <!---------- CE MOIS ---------->
        <h3 class="fw-bolder text-primary m-5">MOIS <n style="color:blue"><?php echo strip_tags(stripslashes(htmlentities(trim($result['dateMois'])))) ?></n>
        </h3>

        <h4>Amour</h4>
        <p><?php echo strip_tags(stripslashes(htmlentities(trim($result['textAmourMois'])))) ?></p>

        <h4>Travail</h4>
        <p><?php echo strip_tags(stripslashes(htmlentities(trim($result['textTravailMois'])))) ?></p>

        <h4>Santé</h4>
        <p><?php echo strip_tags(stripslashes(htmlentities(trim($result['textSanteMois'])))) ?></p>

        <!---------- CETTE ANNÉE ---------->
        <h3 class="fw-bolder text-primary m-5">ANNÉE <n style="color:blue"><?php echo strip_tags(stripslashes(htmlentities(trim(Date('Y'))))) ?></n>
        </h3>
        <h4>Amour</h4>
        <p><?php echo strip_tags(stripslashes(htmlentities(trim($result['textAmourAnnee'])))) ?></p>

        <h4>Travail</h4>
        <p><?php echo strip_tags(stripslashes(htmlentities(trim($result['textTravailAnnee'])))) ?></p>

        <h4>Santé</h4>
        <p><?php echo strip_tags(stripslashes(htmlentities(trim($result['textSanteAnnee'])))) ?></p>
    </section>
</body>

</html>