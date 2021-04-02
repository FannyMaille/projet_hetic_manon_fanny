<?php include 'config/template/head.php'; 

//Si le panier est videon ne vient pas sur cette page
if(panierquantite()==0){
  header("location:paniervide.php");
  die();
}
//On enregistre le prix total de tous les articles
$prixtotal=montantpanier();

$urlerreur="";
$backgroudurl="";
$backgroudqt="";
$qterreur="";

if(isset($_GET['supprimer'])){
  if(isset($_SESSION['panier'][$_GET['supprimer']])){
  supprimerpanier($_GET['supprimer']);
  $prixtotal=montantpanier();
  }
  else{
    $urlerreur="Merci de ne pas toucher à l'url";
    $backgroudurl="style='background:tomato;padding:2%'";
  }
}
if(isset($_GET['moins'])){
  if(isset($_SESSION['panier'][$_GET['moins']])){
  moins($_GET['moins']);
  $prixtotal=montantpanier();
  }
  else{
    $urlerreur="Merci de ne pas toucher à l'url";
    $backgroudurl="style='background:tomato;padding:2%'";
  }
}
if(isset($_GET['plus'])){
  if(isset($_SESSION['panier'][$_GET['plus']])){
    $resultat=plus($_GET['plus']);
    if($resultat==false){
      $prixtotal=montantpanier();
    }
    else{
      $qterreur="Il n'y a pas assez de stock pour le produit : ".$_SESSION['panier'][$_GET['plus']]['nom'];
      $backgroudqt="style='background:tomato;padding:2%'";
    }
  }
  else{
    $urlerreur="Merci de ne pas toucher à l'url";
    $backgroudurl="style='background:tomato;padding:2%'";
  }
}

?>
<header>
    <?php include 'config/template/nav.php'; ?>
</header>
<section class="sectionpanier">
    <h1 class="text-center mt-5 mb-5">Page panier</h1>
    <div <?=$backgroudurl?>><?=$urlerreur?></div>
    <div <?=$backgroudqt?>><?=$qterreur?></div>
    <ul class="panier-liste">
      <?php foreach($_SESSION['panier'] AS $idproduit){?>
        <li class="panier-produit p-3 <?= $idproduit['nom'] ?>">
            <div class="ml-3">
                <h2><?= $idproduit['nom'] ?></h2>
                <p><?= $idproduit['prix'] ?> €</p>
                  <div class="panier-quantite">
                  <a href="panier.php?plus=<?=$idproduit['id']?>" class="quantitemodif">+</a>
                    <p class="pr-2 pl-2"><?= $idproduit['quantite'] ?></p>
                    <a href="panier.php?moins=<?=$idproduit['id']?>" class="quantitemodif">-</a>
                    <a href="panier.php?supprimer=<?=$idproduit['id']?>" class="supression_produit btnclassique">Supprimer</a>
                  </div>
            </div>
            <img src="<?= $idproduit['photo']?>" alt="<?= $idproduit['nom']?>">
        </li>
      <?php } ?>
    </ul>

    <div class="panier-total text-center mb-5">
        <div class="d-flex justify-content-between mt-3">
            <p>Prix total :</p>
            <p><?= $prixtotal ?> €</p>
        </div>
        <form action="config/init.php" method='post'>
            <input class="w-100" type="submit" name="acheter" value="Passer à l'achat">
        </form>
    </div>
    
</section>

<?php include 'config/template/footer.php'; ?>