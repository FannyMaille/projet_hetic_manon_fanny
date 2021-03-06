<?php include 'config/template/head.php'; ?>
<header>
    <?php include 'config/template/nav.php'; ?>
</header>
<section class="sectformulaire">
    <h1 class="text-center mt-5 mb-5">Page d'Inscription</h1>

    <form class="formulaire formulaireinscription" action="" method="post">
      <div class="deuxparties">
        <div class="partiesformulaire premierepartie">
          <label for="pseudo">Pseudo :</label>
          <input type="text" name="pseudo" id="pseudo">
          <label for="telephone">Téléphone :</label>
          <input type="tel" name="telephone" id="telephone">
          <label for="numrue">Numéro de rue :</label>
          <input type="number" name="numrue" id="numrue">
          <label for="codepostal">Code Postal :</label>
          <input type="number" name="codepostal" id="codepostal">
        </div>
        <div class="partiesformulaire deuxiemepartie">
          <label for="mdp">Mot de passe :</label>
          <input type="password" name="mdp" id="mdp">
          <label for="mail">Mail :</label>
          <input type="email" name="mail" id="mail">
          <label for="rue">Nom de rue :</label>
          <input type="text" name="rue" id="rue">
          <label for="ville">Ville :</label>
          <input type="text" name="ville" id="ville">
        </div>
      </div>
      <p>Civilité :</p>
      <div>
        <input type="radio" id="mme" name="mme" value="mme" checked>
        <label for="mme">Mme</label>
        <input type="radio" id="mr" name="mr" value="mr">
        <label for="mr">Mr</label>
        <input type="radio" id="autre" name="autre" value="autre">
        <label for="autre">Autre</label>
      </div>
      <input type="submit" value="Envoyer" name="envoyer">
    </form>

    <a href="login.php">Déjà Inscrit ?</a>
  </section>
<hr>
<?php include 'config/template/footer.php'; ?>