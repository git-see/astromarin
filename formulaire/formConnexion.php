<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AstroMarin : FORMULAIRE DE CONNEXION/INSCRIPTION</title>
    <link rel="stylesheet" href="/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <!-- ENTETE -->
    <header>
        <div id="entete">
            <h1 id="h1">AstroMarin</h1>
        </div>
        <div id="slogan">
            <p>Le monde marin nous parle,</p>
            <p>découvrez ses prédictions !</p>
        </div>
    </header>

    <!-- FORMUALIRE CONNEXION -->
    <section class="container pt-5 pb-5 mt-5 mb-5" id="containerForm">
        <p id="sinscrire"><a href="formInscription.php" class="fst-italic fw-bolder mx-5 text-decoration-none">S'inscrire</a></p>
        <div class="row">
            <div class="col-12">
                <h2>Identification</h2>
                <form action="traitementConnexion.php" method="post">
                    <input type="email" name="email" placeholder="Email" required="required" />
                    <input type="password" name="pass" placeholder="Mot de passe" required="required" />
                    <button type="submit" name="btnConnexion">Connexion</button>
                    <p class=" fw-bolder"><a href="/index.php"><i>Retour à l'accueil</i></a></p>
                </form>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer>
        <ul>
            <li><a href="/rgpd.php">RGPD</a></li>
            <li><a href=""> GitHub</a></li>
            <li>&#xA9; AstroMarin</li>
        </ul>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>