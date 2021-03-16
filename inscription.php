<?php include 'config/template/head.php'; ?>
<header>
    <?php include 'config/template/nav.php'; ?>
</header>
<section class="sectformulaire">
    <h1 class="text-center mt-5 mb-5">Inscription</h1>

    <form class="formulaire formulaireinscription" action="init.php" method="post">
      <div class="deuxparties">
        <div class="partiesformulaire premierepartie">
          <label for="pseudo"></label>
          <input type="text" name="pseudo" id="pseudo" class="filter" placeholder="Pseudo *">
          <label for="telephone"></label>
          <input type="tel" name="telephone" id="telephone" class="filter" placeholder="Téléphone *">
          <label for="numrue"></label>
          <input type="number" name="numrue" id="numrue" class="filter" placeholder="Numéro de rue *">
          <label for="codepostal"></label>
          <input type="number" name="codepostal" id="codepostal" class="filter" placeholder="Code Postal *">
        </div>
        <div class="partiesformulaire deuxiemepartie">
          <label for="mdp"></label>
          <input type="password" name="mdp" id="mdp" class="filter" placeholder="Mot de passe *">
          <label for="mail"></label>
          <input type="email" name="mail" id="mail" class="filter" placeholder="Email *">
          <label for="rue"></label>
          <input type="text" name="rue" id="rue" class="filter" placeholder="Nom de rue *">
          <label for="ville"></label>
          <input type="text" name="ville" id="ville" class="filter" placeholder="Ville *">
        </div>
      </div>
      <div class="divcivilite">
        <p class="civilite">Civilité :</p>
        <div class="btnradio">
          <div>
            <input type="radio" id="mme" name="civil" value="0" checked>
            <label for="mme">Mme</label>
          </div>
          <div>
            <input type="radio" id="mr" name="civil" value="1">
            <label for="mr">Mr</label>
          </div>
          <div>
            <input type="radio" id="autre" name="civil" value="2">
            <label for="autre">Autre</label>
          </div>
        </div>
      </div>
      <input type="submit" value="Envoyer" name="inscription">
    </form>

    <a href="login.php">Déjà Inscrit ?</a>
  </section>

<?php include 'config/template/footer.php'; ?>