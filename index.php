<?php
session_start();

require_once ('librairies/database/database.php');
require_once ('librairies/patron.php');

if (!isset($_SESSION["user"]) || !isset($_SESSION["user"]) && !($_SESSION["user"]["statut"] == "Membre") || !isset($_SESSION["user"]) &&  !($_SESSION["user"]["statut"] == "Admin")) {
    
    redirect('/formulaires/formConnexion.php', '');

} else {

    $db = getPdo();

    $sql = 'SELECT `id`, `signe`, `image` FROM `signes`
';
    $query = $db->prepare($sql);
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);

    require_once('librairies/database/deconnexionBDD.php');
}
?>
<?php
$pageTitle = "ACCUEIL";
render('', 'indexAccueil', ['pageTitle' => $pageTitle, 'result' => $result]);
?>