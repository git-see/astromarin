 <!-- FORMUALAIRE CONNEXION -->
 <section class="container pt-5 pb-5 mt-5 mb-5" id="containerForm">
  <p></p>
     <div class="row">
         <div class="col-12">
             <h2>Identification</h2>
             <form action="traitementConnexion.php" method="post">
                 <input type="email" name="email" placeholder="Email" required="required" />
                 <input type="password" name="pass" placeholder="Mot de passe" required="required" />
                 <button type="submit" name="btnConnexion">Connexion</button>
                 <p id="sinscrire"><a href="formInscription.php" class="fst-italic fw-bolder mx-5 text-decoration-none">ou s'inscrire</a></p>
             </form>
         </div>
     </div>
 </section