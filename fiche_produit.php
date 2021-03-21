
<?php include 'config/template/head.php';
 
$unproduit = ecritunproduit();
$image = photosunproduit();

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
        <form action="config/init.php" method="post">
            <input type="submit" value="Ajouter au panier">
        </form>
    </div>
    <div class="images-produit">
        <img class="main-produit-img" src="<?=$image[1]?>" alt="[alt-recupere-php]">
        <figure>
            <!--On crée une boucle for pour afficher toute les photos restantes-->
            <?php
            for($j=1; $j<=count($image); $j++){
            ?>
            <img class='second-produit-img' id="<?=$j?>" src="<?=$image[$j]?>" alt="[alt-recupere-php]">
            <?php
            }
            ?>
        </figure>
    </div>
</section>


<?php include 'config/template/footer.php'; ?>