<link rel="stylesheet" href="/style.css">
<?php
$pageTitle = "CONNEXION";
ob_start();
require('../templates/formulaires/connexion.php');
$pageContent = ob_get_clean();
require('../templates/layout.php');
?>