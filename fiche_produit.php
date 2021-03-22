
<?php include 'config/template/head.php';

//On récupère l'id du produit qu'on a mis dans l'url
$id = $_GET['id'];

//Définition des variables contenent les erreurs comme étant vide au départ
$content="";
$backgroud="";

//On appel une fonction qui nous retourne sous forme de tableau la liste des informations écrite du produit concerné
$unproduit = ecritunproduit($id);
//On appel une fonction qui nous retourne sous forme de tableau la liste des photos du produit concerné
$image = photosunproduit($id);

//On regarde si quelqu'un a cliqué sur le btn ajouter au panier
if(isset($_POST['ajout_panier'])){
  //On enregistre la session avec les informations du produit et on affiche un messag pour informer l'utilisateur
  $content= setProduit($unproduit, $image, $id);
  //Si le message d'info n'est pas celui de l'erreur alors le fond du message d'information sera vert
  //Donc si il ya du stock =succes
  if($content!="Il n'y a plus de stock, votre produit ne peut être ajouter au panier"){
    $backgroud="style='background:chartreuse;padding:2%'";
  }
  //Si le message d'erreur est celui de l'erreur alors le fond du message d'information sera vert
  //Donc si il ya du plus de stock =echec
  else{
    $backgroud="style='background:tomato;padding:2%'";
  }
}

?>

<header>
    <?php include 'config/template/nav.php'; ?>
</header>
<nav class="ariane">
    <a href="./index.php">Accueil </a> 
    <p> > <?= $unproduit['nom'] ?></p>
</nav>
<section class="produit-header">
    <div>
        <h1 class="text-center mt-0 mb-5"><?=$unproduit['nom']?></h1>
        <p class="prix">Prix : <?=$unproduit['prix']?> €</p>
        <p>Stock : <?=$unproduit['stock']?></p>
        <h2>Description</h2>
        <p><?=$unproduit['description']?></p>
        <form action="fiche_produit.php?id=<?=$id?>" method="post">
          <div <?=$backgroud?>><?=$content?></div>
          <input type="submit" value="Ajouter au panier" name="ajout_panier">
        </form>
    </div>
    <div class="images-produit">
        <img class="main_produit_img" src="<?=$image[1]?>" alt="[alt-recupere-php]">
        <figure>
            <!--On crée une boucle for pour afficher toute les photos restantes-->
            <?php
            for($j=1; $j<=count($image); $j++){
            ?>
              <img class='second_produit_img' id="<?=$j?>" src="<?=$image[$j]?>" alt="[alt-recupere-php]">
            <?php
            }
            ?>
        </figure>
    </div>
</section>

<script src="asset/script/ficheproduit.js"></script>
<?php include 'config/template/footer.php'; ?>