<?php include 'config/template/head.php'; 


$quantite=panierquantite();

?>
<header>
    <?php include 'config/template/nav.php'; ?>
</header>
<section>
    <h1 class="text-center mt-5 mb-5">Page panier</h1>

    <section>
      <p>Votre panier est vide</p>
    </section>

    <ul class="panier-liste">
      <?php foreach($_SESSION['panier'] AS $idproduit){?>
        <li class="panier-produit p-3">
            <div class="ml-3">
                <h2><?= $idproduit['nom'] ?></h2>
                <p><?= $idproduit['prix'] ?> €</p>
                <form class="panier-quantite" action="config/init.php" method="post">
                    <input type="submit" name="plus" value="+">
                    <p class="pr-2 pl-2"><?= $idproduit['quantite'] ?></p>
                    <input type="submit" name="minus" value="-">
                </form>
            </div>
            <img src="<?= $idproduit['photo']?>" alt="img-produit">
        </li>
      <?php } ?>
    </ul>

    <div class="panier-total text-center mb-5">
        <div class="d-flex justify-content-between mt-3">
            <p>Prix total :</p>
            <p>[Prix total]€</p>
        </div>
        <form action="config/init.php" method='post'>
            <input class="w-100" type="submit" name="acheter" value="Passer à l'achat">
        </form>
    </div>
    
</section>

<?php include 'config/template/footer.php'; ?>