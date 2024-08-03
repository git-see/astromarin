<?php
session_start();

require_once('librairies/models/Consulter.php');
require_once('librairies/Rendus.php');

$model = new \Models\Consulter();


if (!isset($_SESSION["user"]) || !isset($_SESSION["user"]) && !($_SESSION["user"]["statut"] == "Membre") || !isset($_SESSION["user"]) &&  !($_SESSION["user"]["statut"] == "Admin")) {

    \Redirections::redirect('/formulaires/formConnexion.php', '');
} else {

    $result = $model->afficherTout();

    require_once('librairies/database/deconnexionBDD.php');
}
?>
<?php
$pageTitle = "ACCUEIL";
\Rendus::render('', 'indexAccueil', ['pageTitle' => $pageTitle, 'result' => $result]);
?>