<link rel="stylesheet" href="/style.css">
<?php
$pageTitle = "INSCRIPTION";
ob_start();
require('../templates/formulaires/inscription.php');
$pageContent = ob_get_clean();
require('../templates/layout.php');
?>