<?php
session_start();

require_once ('../../../librairies/database/database.php');
require_once ('../../../librairies/patron.php');

if (!isset($_SESSION["user"]) && !($_SESSION["user"]["statut"] == "Admin")) {

    redirect('../../../../formulaires/formConnexion.php', '');
    
} else {

    $db = getPdo();

    $sql = 'SELECT * FROM signes, annee WHERE signes.id = annee.signes_id LIMIT 12';
    $query = $db->prepare($sql);
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
}
?>
<link rel="stylesheet" href="/style.css">
<?php
$pageTitle = "- GESTION ANNÉE";
render('../../../', 'annee/annee', compact('pageTitle', 'result'));
?>