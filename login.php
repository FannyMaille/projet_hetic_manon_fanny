<?php include 'config/template/head.php'; ?>
<header>
    <?php include 'config/template/nav.php'; ?>
</header>
  <section class="sectformulaire">
    <h1 class="text-center mt-5 mb-5">Connexion</h1>

    <form class="formulaire formulaireconexion" action="config/init.php" method="post">
      <label for="pseudo"></label>
      <input type="text" name="pseudo" id="pseudo" class="filter" placeholder="Pseudo *">
      <input type="password" name="mdp" id="mdp" class="filter" placeholder="Mot de passe *">
      <input type="submit" value="Envoyer" name="connexion">
    </form>

    <a href="inscription.php">Pas Inscrit ?</a>
  </section>

<?php include 'config/template/footer.php'; ?>