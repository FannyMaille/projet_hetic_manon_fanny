<?php include 'config/template/head.php'; 
//Définition des variables contenent les erreurs comme étant vide au départ
$erreur="";
$backgroud="";

//si l'utilisateur n'est pas conneté il ne peut pas acceder à cette page il est donc rediriger vers la page login
if(!connecte()){
  header("location:login.php");
  die();
}

//Si on envoie le formulaire on va vérifier quelques informations
if(isset($_POST['valider'])){
  extract($_POST);
  //On vérififie que toute les informations renseignées dans le formulaire n'on pas d'erreurs
  //Si il y a des erreurs un texte informatif est enregistré indiquant l'erreur
  $erreur=changementerreur($pseudo,$tel,$mail,$ville);
  //Pour afficher les erreurs en rouge
  $backgroud = 'style="background:tomato;padding:2%"';
  //Si il n'y a pas eu d'erreur dans la saisie des informations dans le formulaire alors on va pouvoir enregistrer les données dans la base de donnée
  if($erreur == ""){
    //On met a jour la base de donnée et les variables session
    $erreur = changementbasededonnee($_SESSION['user']['id'],$pseudo,$tel,$mail,$numrue, $rue, $cp, $ville, $civil);
  }
}

//Si on envoie le formulaire de l'admin
if(isset($_POST['changerstock'])){
  extract($_POST);
  changestock(intval($idproduit), intval($stock));
}

// Liste des produits récupérés pour l'admin
$image = photosproduits(false);
$produits = ecritproduits(false);

?>
<header>
    <?php include 'config/template/nav.php'; ?>
</header>
<section class="sectformulaire">
    <h1 class="text-center mt-5">Bonjour <?= $_SESSION['user']['pseudo'] ?> !</h1>
    <p class="text-center mb-5">Vous êtes <?= $_SESSION['user']['statut'] ?></p>
    <div <?=$backgroud?>><?=$erreur?></div>

    <form action="profil.php" method="post" class="formulaireprofil">
      <ul class="formulaireprofil">
        <li>
          <label for="pseudo">Pseudo :</label>
          <input type="text" class="hidden" name="pseudo" id="pseudo" value="<?= $_SESSION['user']['pseudo'] ?>">
          <p class="profil-element"><?= $_SESSION['user']['pseudo'] ?></p>
        </li>
        <li>
          <p>Civilité :</p>
          <div class="btnradio" >
            <div>
              <input type="radio" class="radiocivil hidden" id="civ0" name="civil" value="0">
              <label for="mme" class="hidden">Mme</label>
            </div>
            <div>
              <input type="radio" class="radiocivil hidden" id="civ1" name="civil" value="1">
              <label for="mr" class="hidden">Mr</label>
            </div>
            <div>
              <input type="radio" class="radiocivil hidden" id="civ2" name="civil" value="2">
              <label for="autre" class="hidden">Autre</label>
            </div>
        </div>
          <input type="hidden" id="civnum" value="<?=$_SESSION['user']['civilnombre']?>"></input>
          <p class="profil-element" id="motcivil"><?= $_SESSION['user']['civil'] ?></p>
        </li>
        <li>
          <p>Adresse postale :</p>
          <label for="numrue" class="hidden">Numéro de rue :</label>
          <input type="number" class="hidden" name="numrue" id="numrue" value="<?= $_SESSION['user']['numrue'] ?>">
          <label for="rue" class="hidden">Nom de rue :</label>
          <input type="text" class="hidden" name="rue" id="rue" value="<?= $_SESSION['user']['nomrue'] ?>">
          <label for="cp" class="hidden">Code postal :</label>
          <input type="number" class="hidden" name="cp" id="cp" value="<?= $_SESSION['user']['cp'] ?>">
          <label for="ville" class="hidden">Ville :</label>
          <input type="text" class="hidden" name="ville" id="ville" value="<?= $_SESSION['user']['ville'] ?>">
          <p class="profil-element"><?= $_SESSION['user']['numrue'] . ' ' .
          $_SESSION['user']['nomrue'] . ', ' . 
          $_SESSION['user']['cp'] . ' ' .
          $_SESSION['user']['ville'] ?></p>
        </li>
        <li>
          <label for="tel">Numéro de téléhpone :</label>
          <input type="tel" class="hidden" name="tel" id="tel" value="<?= $_SESSION['user']['tel'] ?>">
          <p class="profil-element"><?= $_SESSION['user']['tel'] ?></p>
        </li>
        <li>
          <label for="mail">Adresse mail :</label>
          <input type="email" class="hidden" name="mail" id="mail" value="<?= $_SESSION['user']['email'] ?>">
          <p class="profil-element"><?= $_SESSION['user']['email'] ?></p>
        </li>
      </ul>
      <a id="modifier-profil" class="btnclassique alink profil-element" value="hidden">Modifier</a>
      <input type="submit" class="hidden" value="Valider" name="valider">
      <a href="profil.php" class="hidden">Annuler</a>
      <a href="mot_de_passe.php" class="alink">Changer mon mot de passe</a>
    </form>

    <?php if($_SESSION['user']['statut'] === 'admin'){ ?>
    <section class="admin-profil-part">
      <h2 class="admin-titles">Gérer les stocks</h2>
      <div class="article-profil-parent">
      
        <?php for($k=0; $k<count($produits); $k++){ ?>
        <article class="admin-produit">
          <form action="profil.php" method="post" class="stock-form">
            <!-- // boucle des produits -->
            <label><?php echo $produits[$k]['nom_produit'] ?></label>
            <p>Stock actuel : <?php echo $produits[$k]['stock'] ?></p>
            <input type="number" name="stock" class="hidden">
            <input type="hidden" name="idproduit" value="<?php echo $produits[$k]['id_produit'] ?>">
            <input type="submit" name="changerstock" value="Changer les stocks" class='hidden'>
            <a class="hidden undo-modify">Annuler</a>
            <a class="modify-stock profil-element">Modifier</a>
          </form>
        </article>
        <?php } ?>
      </div>
    </section>

    <section>
      <h2 class="admin-titles">Ajouter un nouveau produit</h2>
      <form action="profil.php" method="post" class="add-produit-form">
        <label for="nouveau-produit-nom">Nom du produit :</label>
        <input id="nouveau-produit-nom" type="text" name="nouveau-produit-nom" required>
        <label for="nouveau-produit-stock">Stock :</label>
        <input id="nouveau-produit-stock" type="number" name="nouveau-produit-stock" required>
        <label for="nouveau-produit-prix">Prix :</label>
        <input id="nouveau-produit-prix" type="float" name="nouveau-produit-prix" required>
        <label for="nouveau-produit-desc">Description du produit :</label>
        <textarea id="nouveau-produit-desc" required></textarea>
        <label for="nouveau-produit-pic">Les images :</label>
        <input id="nouveau-produit-pic" type="file" name="nouveau-produit-pic">
        <input type="submit" name="add-new-produit" value="Ajouter le produit">
      </form>
    </section>
    <?php } ?>

    
    <a href="index.php?session=destroy" class="btnclassique">Déconnexion</a>

    <!-- //https://www.w3schools.com/howto/howto_js_filter_lists.asp 
    if willing to make a search bar if multiple products -->

    
</section>

<script src="asset/script/profil.js"></script>
<?php include 'config/template/footer.php'; ?>