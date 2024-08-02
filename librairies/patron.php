<?php

/*
* Retourne le template
* 
* @param string $path1, $path2
* @param array $variables
* @return void
*/
function render(string $path1, string $path2, array $variables = [])
{
    extract($variables);
    ob_start();
    require($path1 . 'templates/' . $path2 . '.php');
    $pageContent = ob_get_clean();
    require($path1 . 'templates/layout.php');
}

/*
* Retourne une redirection
*
* @param string $url, $msg
* @return void
*/
function redirect(string $url, string $msg)
{
    header("Location: $url");
    die($msg);
}
