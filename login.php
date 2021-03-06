<?php include 'config/template/head.php'; ?>
<header>
    <?php include 'config/template/nav.php'; ?>
</header>
  <section class="sectformulaire">
    <h1 class="text-center mt-5 mb-5">Page de connexion</h1>

    <form class="formulaire formulaireconexion" action="" method="post">
      <label for="pseudo">Pseudo</label>
      <input type="text" name="pseudo" id="pseudo">
      <label for="mdp">Mot de passe</label>
      <input type="password" name="mdp" id="mdp">
      <input type="submit" value="Envoyer" name="envoyer">
    </form>

    <a href="inscription.php">Pas Inscrit ?</a>
  </section>
<hr>
<?php include 'config/template/footer.php'; ?>