<?php include 'config/template/head.php'; 

//Si le panier est videon ne vient pas sur cette page
if(panierquantite()==0){
  header("location:paniervide.php");
  die();
}
//On enregistre le prix total de tous les articles
$prixtotal=montantpanier();

?>
<header>
    <?php include 'config/template/nav.php'; ?>
</header>
<section class="sectionpanier">
    <h1 class="text-center mt-5 mb-5">Page panier</h1>

    <ul class="panier-liste">
      <?php foreach($_SESSION['panier'] AS $idproduit){?>
        <li class="panier-produit p-3">
            <div class="ml-3">
                <h2><?= $idproduit['nom'] ?></h2>
                <p><?= $idproduit['prix'] ?> €</p>
                  <div class="panier-quantite">
                    <input type="submit" name="plus" value="+" class="quantitemodif">
                    <p class="pr-2 pl-2"><?= $idproduit['quantite'] ?></p>
                    <input type="submit" name="minus" value="-" class="quantitemodif">
                    <input type="submit" name="Supprimer" value="supprimer" class="supression_produit">
                  </div>
            </div>
            <img src="<?= $idproduit['photo']?>" alt="img-produit">
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