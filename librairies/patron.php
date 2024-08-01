<?php

/*
* Retourne la connexion le template
*
* @return 2 string et 1 array
*/
function render(string $path1, string $path2, array $variables = []){
    extract($variables);
    ob_start();
    require($path1 . 'templates/' . $path2 . '.php');
    $pageContent = ob_get_clean();
    require($path1 . 'templates/layout.php');
}

/*
* Retourne une redirection
*
* @return 2 string et 1 array
*/
function redirect(string $url, string $msg){
    header("Location: $url");
    die($msg);
}




