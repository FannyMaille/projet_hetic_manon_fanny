<?php include 'config/template/head.php'; 
/*________Pour les photos des produits___*/
$req = $pdo->query('SELECT id_produit, url_image FROM hetic21_photos_produit');
$photo= $req->fetchAll(PDO::FETCH_ASSOC);
//initialisation des valeurs pour la boucle foreach
$i=1;
$valeurdepart=0;
//boucle froeacch pour parcourir tout le tableau récupéré de la base de données
foreach ($photo AS $ligneresultphoto){
  //si l'identifiant du produit est different du précendent il s'agit d'un nouveau produit donc on enregistre la première photo du produit dans notre tableau
  //l'indice de notre tableau coorespond a l'id du produit
  if ($ligneresultphoto['id_produit'] != $valeurdepart){
    $image[$i]=$ligneresultphoto['url_image'];
    $i++;
    $valeurdepart = $ligneresultphoto['id_produit'];
  }
}
?>
<header>
    <?php include 'config/template/nav.php'; ?>
</header>

<section class="hero-full-image">
  <h1>Canon</h1>
</section>

<section class="nosproduits">
  <h2>Nos produits</h2>
  <div class="troisarticles">
    <article>
      <figure>
        <img class="articleimg" src="<?=$image[1]?>" alt="Abonnement">
        <figcaption><h3>1 Article</h3></figcaption>
      </figure>
      <p>Prix</p>
      <p>Stock</p>
      <a href="fiche_produit.php?id=1" class="btnclassique">Voir l'article</a>
    </article>
    <article>
      <figure>
        <img class="articleimg" src="<?=$image[2]?>" alt="Abonnement">
        <figcaption><h3>2 Article</h3></figcaption>
      </figure>
      <p>Prix</p>
      <p>Stock</p>
      <a href="fiche_produit.php?id=2" class="btnclassique">Voir l'article</a>
    </article>
    <article>
      <figure>
        <img class="articleimg" src="<?=$image[3]?>" alt="Abonnement">
        <figcaption><h3>3 Article</h3></figcaption>
      </figure>
      <p>Prix</p>
      <p>Stock</p>
      <a href="fiche_produit.php?id=3" class="btnclassique">Voir l'article</a>
    </article>
  </div>
</section>

<?php include 'config/template/footer.php'; ?>