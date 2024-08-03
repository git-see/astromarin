<?php

namespace Controllers;

class Jour extends Controller
{

    protected $modelName = \Models\Jour::class;

/*
* Afficher la liste des prédictions quotidiennes pour tous les signes
*/
    public function lireListe()
    {
        if (!isset($_SESSION["user"]) && !($_SESSION["user"]["statut"] == "Admin")) {

            \Redirections::redirect('../../../../formulaires/formConnexion.php', '');
        } else {

            $result = $this->model->panorama();
        }
?>
        <link rel="stylesheet" href="/style.css">
    <?php
        $pageTitle = "- GESTION JOUR";
        \Rendus::render('../../../', 'jour/jour', compact('pageTitle', 'result'));
    }

/*
* Rajouter une prédiction quotidienne pour un signe
*/
    public function creer()
    {
        if (!isset($_SESSION["user"]) && !($_SESSION["user"]["statut"] == "Admin")) {

            \Redirections::redirect('../../../../formulaires/formConnexion.php', '');
        }

        if ($_POST) {

            if (
                isset($_POST['signes_id']) && !empty($_POST['signes_id'])
                && isset($_POST['champDate']) && !empty($_POST['champDate'])
                && isset($_POST['textAmour']) && !empty($_POST['textAmour'])
                && isset($_POST['textTravail']) && !empty($_POST['textTravail'])
                && isset($_POST['textSante']) && !empty($_POST['textSante'])
            ) {
                $this->model->ajout();

                $_SESSION['message'] = "Prédiction ajoutée";
                require_once('../../../librairies/database/deconnexionBDD.php');

                header('Location: jour.php');
            } else {
                $_SESSION['erreur'] = "Le formulaire est incomplet";
            }
        }
    ?>
        <link rel="stylesheet" href="/style.css">
    <?php
        $pageTitle = "- AJOUTER JOUR";
        \Rendus::render('../../../', 'jour/ajouter', compact('pageTitle'));
    }

/*
* Modifier la prédiction annuelle pour un signe : 3 étapes
*/
    public function rectifier()
    {
        if (!isset($_SESSION["user"]) && !($_SESSION["user"]["statut"] == "Admin")) {

            \Redirections::redirect('../../../../formulaires/formConnexion.php', '');
        }

        if ($_POST) {
            if (
                isset($_POST['id']) && !empty($_POST['id'])
                && isset($_POST['champDate']) && !empty($_POST['champDate'])
                && isset($_POST['textAmour']) && !empty($_POST['textAmour'])
                && isset($_POST['textTravail']) && !empty($_POST['textTravail'])
                && isset($_POST['textSante']) && !empty($_POST['textSante'])
            ) {
        // MODIFIER
                $this->model->modifie1();

                $_SESSION['message'] = "Prédiction modifiée";
                require_once('../../../librairies/database/deconnexionBDD.php');

                header('Location: jour.php');
            } else {
                $_SESSION['erreur'] = "Le formulaire est incomplet";
            }
        }
        // RÉCUPÉRER
        if (isset($_GET['id']) && !empty($_GET['id'])) {

            $id = strip_tags(stripslashes(htmlentities(trim($_GET['id']))));

            $modifie = $this->model->modifie2($id);

            if (!$modifie) {
                $_SESSION['erreur'] = "Cet id n'existe pas";
                header('Location: ../index.php');
            }
        } else {
            $_SESSION['erreur'] = "URL invalide";
            header('Location: ../index.php');
        }
        // AFFICHER
        if (
            isset($_GET['id']) && !empty($_GET['id'])
        ) {
            $id = strip_tags(stripslashes(htmlentities(trim($_GET['id']))));

            $sign = $this->model->modifie3($id);
        }
    ?>
        <link rel="stylesheet" href="/style.css">
<?php
        $pageTitle = "- MODIFIER JOUR";
        \Rendus::render('../../../', 'jour/modifier', compact('pageTitle', 'sign', 'modifie'));
    }

/*
* Supprimer la prédiction annuelle pour un signe
*/
    public function effacer()
    {
        if (!isset($_SESSION["user"]) && !($_SESSION["user"]["statut"] == "Admin")) {

            \Redirections::redirect('../../../../formulaires/formConnexion.php', '');
        }
        // VÉRIFIER QUE L'ID EXISTE
        if (isset($_GET['id']) && !empty($_GET['id'])) {

            $id = strip_tags($_GET['id']);

            $recuperer = $this->model->supprime1($id);

            if (!$recuperer) {
                $_SESSION['erreur'] = "Cet id n'existe pas";
                header('Location: jour.php');
                die();
            }
        // SUPPRIMER
            $this->model->supprime2($id);

            $_SESSION['message'] = "Prédiction supprimée";
            header('Location: jour.php');
        } else {
            $_SESSION['erreur'] = "URL invalide";
            header('Location: jour.php');
        }
    }
}
