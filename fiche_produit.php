<?php include 'config/template/head.php'; 
$id = $_GET['id'];
?>
<header>
    <?php include 'config/template/nav.php'; ?>
</header>
<nav class="ariane">
    <a href="./index.php">accueil</a> 
    <p> > Page fiche produit <?= $id ?></p>
</nav>
<section class="produit-header">
    <div>
        <h1 class="text-center mt-0 mb-5">[Page fiche produit <?= $id ?>]</h1>
        <p class="prix">[prix]</p>
        <p>[stock]</p>
        <form action="" method="post">
            <input type="submit" value="ajouter au panier">
        </form>
    </div>
    <div class="images-produit">
        <img class="main-produit-img" src="asset/img/herofullimage.jpg">
        <figure>
            <img class='second-produit-img' src="asset/img/herofullimage.jpg">
            <img class='second-produit-img' src="asset/img/herofullimage.jpg">
        </figure>
    </div>

</section>
<section class="text-center">
    <h1>Description</h1>
    <p>[description du produit]</p>
</section>

<?php include 'config/template/footer.php'; ?>