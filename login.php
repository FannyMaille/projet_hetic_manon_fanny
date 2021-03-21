<?php 
include 'config/template/head.php';

//Définition des variables contenent les erreurs comme étant vide au départ
$content=""; 
$backgroud="";

//si l'utilisateur est pas conneté il ne peut pas acceder à cette page il est donc rediriger vers la page login
if(connecte()){
  header("location:profil.php");
  die();
}


if(isset($_POST['connexion'])){
  extract($_POST);
  if(!verificationlogin($pseudo,$mdp)){
    $content="Erreur de connexion";
    $backgroud = 'style="background:tomato;padding:2%"';
  };
}

?>
<header>
    <?php include 'config/template/nav.php'; ?>
</header>
  <section class="sectformulaire">
    <h1 class="text-center mt-5 mb-5">Connexion</h1>
    <div <?=$backgroud?>><?=$content?></div>

    <form class="formulaire formulaireconexion" action="login.php" method="post">
      <label for="pseudo"></label>
      <input type="text" name="pseudo" id="pseudo" class="filter" placeholder="Pseudo *">
      <input type="password" name="mdp" id="mdp" class="filter" placeholder="Mot de passe *">
      <input type="submit" value="Envoyer" name="connexion">
    </form>

    <a href="inscription.php">Pas Inscrit ? Inscrivez vous</a>
  </section>

<?php include 'config/template/footer.php'; ?>