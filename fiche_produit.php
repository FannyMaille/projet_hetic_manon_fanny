
<?php include 'config/template/head.php';
//On récupère l'id du produit qu'on a mis dans l'url 
$id = $_GET['id'];

/*________Pour les élèments écrits___*/
//On sélectionne tous les élements de la base que l'on a besoin d'afficher sur notre page d'id $id
$req = $pdo->prepare('SELECT nom_produit, description_produit, prix, stock FROM hetic21_produit WHERE id_produit = :id');
$req->bindValue(':id', $id);
$req->execute();
$produit= $req->fetchAll(PDO::FETCH_ASSOC);
//on récupère tous les éléments et on les enregistre dans des variables que l'on va appeler plus tard dans notre html en faisant un foreach 
foreach ($produit AS $ligneresult){
  $nomproduit=$ligneresult['nom_produit'];
  $descriptionproduit=$ligneresult['description_produit'];
  $prixproduit=$ligneresult['prix'];
  $stockproduit=$ligneresult['stock'];
}

/*________Pour les photos des produits___*/
//obligé de faire 2 connexion differente car se sont des élèments dans un autre table que la précendente
$req = $pdo->prepare('SELECT url_image FROM hetic21_photos_produit WHERE id_produit = :id');
$req->bindValue(':id', $id);
$req->execute();
$photo= $req->fetchAll(PDO::FETCH_ASSOC);
$i=1;
//on récupère toutes les photos et on les enregistre dans des variables que l'on va appeler plus tard dans notre html en faisant un foreach
foreach ($photo AS $ligneresultphoto){
  $image[$i]=$ligneresultphoto['url_image'];
  $i++;
}
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
        <h1 class="text-center mt-0 mb-5"><?=$nomproduit?></h1>
        <p class="prix"><?=$prixproduit?> €</p>
        <p>Stock : <?=$stockproduit?></p>
        <form action="" method="post">
            <input type="submit" value="ajouter au panier">
        </form>
    </div>
    <div class="images-produit">
        <img class="main-produit-img" src="<?=$image[1]?>">
        <figure>
            <!--On crée une boucle for pour afficher toute les photos restantes-->
            <?php
            for($j=2; $j<=count($image); $j++){
            ?>
            <img class='second-produit-img'src="<?=$image[$j]?>">
            <?php
            }
            ?>
        </figure>
    </div>

</section>
<section class="text-center">
    <h1>Description</h1>
    <p><?=$descriptionproduit?></p>
</section>

<?php include 'config/template/footer.php'; ?>