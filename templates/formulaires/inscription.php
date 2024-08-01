<!-- FORMUALIRE INSCRIPTION -->
<section class="container pt-5 pb-5 mt-5 mb-5" id="containerForm">
  <p></p>
  <div class="row">
    <div class="col-12">
      <h2>Inscription</h2>
      <form action="traitementInscription.php" method="post">
        <input
          type="text"
          name="pseudo"
          placeholder="Pseudo"
          required="required"
        />
        <input
          type="email"
          name="email"
          placeholder="Email"
          required="required"
        />
        <input
          type="password"
          name="pass"
          placeholder="Mot de passe"
          required="required"
        />
        <button type="submit" name="btnInscription">Je m'incris</button>
        <p class="fw-bolder">
          <a href="/formulaires/formConnexion.php"><i>Retour à la connexion</i></a>
        </p>
      </form>
    </div>
  </div>
</section>
