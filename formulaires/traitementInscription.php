<?php
session_start();

require_once ('../librairies/database/Database.php');

if (isset($_POST) && !empty($_POST)) {
    if (
        isset($_POST["pseudo"]) && !empty($_POST["pseudo"])
        && isset($_POST["email"]) && !empty($_POST["email"])
        && isset($_POST["pass"]) && !empty($_POST["pass"])
    ) {
        $pseudo = trim($_POST["pseudo"]);
        $pseudo = strip_tags($_POST["pseudo"]);
        $pseudo = stripslashes($_POST["pseudo"]);
        $pseudo = htmlentities($_POST["pseudo"]);
        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            die("L'adresse mail est invalide");
        }
        $pass = password_hash($_POST["pass"], PASSWORD_ARGON2ID);

        $db = \Database::getPdo();

        $recupNouvelEntree = $db->prepare(" INSERT INTO `users`(`pseudo`,`email`,`pass`)
            VALUES (:pseudo, :email, '$pass')");
        $recupNouvelEntree->bindValue(':pseudo', $pseudo);
        $recupNouvelEntree->bindValue(':email', $_POST['email']);
        $recupNouvelEntree->execute();
        $id = $db->lastInsertId();

        $_SESSION["user"] = [
            "id" => $id,
            "pseudo" => $pseudo,
            "email" => $_POST["email"],
            "statut" => $user["statut"]
        ];

        \Redirections::redirect('', '');
    } else {
        $_SESSION['erreur'] = "Vous devez remplir tous les champs";
        header("Location: formInscription.php");
    }
}
