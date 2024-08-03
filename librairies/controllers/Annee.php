<?php

namespace Controllers;

require_once('../../../librairies/patron.php');

class Annee extends Controller
{

    protected $modelName = \Models\Annee::class;  // ou "\Models\Annee()";

/*
* Afficher la liste des prédictions annuelles pour tous les signes
*/
    public function lireListe()
    {
        if (!isset($_SESSION["user"]) && !($_SESSION["user"]["statut"] == "Admin")) {

            redirect('../../../../formulaires/formConnexion.php', '');
        } else {

            $result = $this->model->panorama();
        }
?>
        <link rel="stylesheet" href="/style.css">
    <?php
        $pageTitle = "- GESTION ANNÉE";
        render('../../../', 'annee/annee', compact('pageTitle', 'result'));
    }

/*
* Rajouter une prédiction annuelle pour un signe
*/
    public function creer()
    {
        if (!isset($_SESSION["user"]) && !($_SESSION["user"]["statut"] == "Admin")) {

            redirect('../../../../formulaires/formConnexion.php', '');
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

                header('Location: annee.php');
            } else {
                $_SESSION['erreur'] = "Le formulaire est incomplet";
            }
        }
    ?>
        <link rel="stylesheet" href="/style.css">
    <?php
        $pageTitle = "- RAJOUTER UNE PRÉDICTION SUPPRIMÉE";
        render('../../../', 'annee/ajouter', compact('pageTitle'));
    }

/*
* Modifier la prédiction annuelle pour un signe : 3 étapes
*/
    public function rectifier()
    {
        if (!isset($_SESSION["user"]) && !($_SESSION["user"]["statut"] == "Admin")) {

            redirect('../../../../formulaires/formConnexion.php', '');
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

                header('Location: annee.php');
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
        $pageTitle = "- MODIFIER UNE PRÉDICTION ANNUELLE";
        render('../../../', 'annee/modifier', compact('pageTitle', 'sign', 'modifie'));
    }

/*
* Supprimer la prédiction annuelle pour un signe : 2 étapes
*/
    public function effacer()
    {
        if (!isset($_SESSION["user"]) && !($_SESSION["user"]["statut"] == "Admin")) {

            redirect('../../../../formulaires/formConnexion.php', '');
        }
        // VÉRIFIER QUE L'ID EXISTE
        if (isset($_GET['id']) && !empty($_GET['id'])) {

            $id = strip_tags($_GET['id']);

            $recuperer = $this->model->supprime1($id);

            if (!$recuperer) {
                $_SESSION['erreur'] = "Cet id n'existe pas";
                header('Location: annee.php');
                die();
            }
        // SUPPRIMER
            $this->model->supprime2($id);

            $_SESSION['message'] = "Prédiction supprimée";
            header('Location: annee.php');
        } else {
            $_SESSION['erreur'] = "URL invalide";
            header('Location: annee.php');
        }
    }
}
