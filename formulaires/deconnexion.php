<?php
session_start();

require_once ('../librairies/database/deconnexionBDD.php');
require_once ('../librairies/Redirections.php');

// Assurer la suppression de session
if (isset($_SESSION["user"])) {
    unset($_SESSION["user"]);

    \Redirections::redirect('formConnexion.php', '');
}

\Redirections::redirect('formConnexion.php', '');