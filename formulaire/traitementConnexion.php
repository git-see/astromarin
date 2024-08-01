<?php
session_start();
if (isset($_POST['btnConnexion'])) {

    if (isset($_POST) && !empty($_POST)) {
        if (
            isset($_POST["email"], $_POST["pass"])
            && !empty($_POST["email"] && !empty($_POST["pass"]))
        ) {

            require_once "../database/connexionBDD.php";

            $connexionCompte = $db->prepare("SELECT * FROM `users` WHERE `email`= :email");
            $connexionCompte->bindValue(':email', $_POST['email']);
            $connexionCompte->execute();
            $user = $connexionCompte->fetch();

            if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                header("Location: formConnexion.php");
                $_SESSION['erreur'] = "Cet utilisateur et/ou le mot de passe est incorrect";
                sleep(1); // Force brute
            }
            $pass = password_hash($_POST["pass"], PASSWORD_ARGON2ID);
            if (!password_verify($_POST["pass"], $pass)) {
                header("Location: formConnexion.php");
                $_SESSION['erreur'] = "Cet utilisateur et/ou le mot de passe est incorrect...";
                sleep(1);
            }
            if (!$user) {
                header("Location: formConnexion.php");
                $_SESSION['erreur'] = "Cet utilisateur et/ou le mot de passe est incorrect!";
                sleep(1);
            }
            if (!password_verify($_POST["pass"], $user["pass"])) {
                header("Location: formConnexion.php");
                $_SESSION['erreur'] = "Cet utilisateur et/ou le mot de passe est incorrect.";
                sleep(1);
            }

            $_SESSION["user"] = [
                "id" => $user["id"],
                "pseudo" => $user["pseudo"],
                "email" => $user["email"],
                "statut" => $user["statut"]
            ];
        }

        //Redirection selon le statut
        if (isset($_SESSION['user']) && $user["statut"] == "Membre") {
            header("Location: /consulter.php");
        } else if (isset($_SESSION['user']) && $user["statut"] == "Admin") {
            header("Location: /dashboard/accueil.php");
        } else {
            header("Location: formConnexion.php");
            die('Vous devez remplir tous les champs');
        }
    }

    // Bouton non utilisé  
} else {
    header("Location: formConnexion.php");
    die();
}
