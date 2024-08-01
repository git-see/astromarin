<?php
session_start();

require_once ('../librairies/database/deconnexionBDD.php');
require_once ('../librairies/patron.php');

// Assurer la suppression de session
if (isset($_SESSION["user"])) {
    unset($_SESSION["user"]);

    redirect('formConnexion.php', '');
}

redirect('formConnexion.php', '');