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


/*________Pour les élèments écrits___*/
//On sélectionne tous les élements de la base que l'on a besoin d'afficher sur notre page d'id $id
$req = $pdo->query('SELECT id_produit, nom_produit, description_produit, prix, stock FROM hetic21_produit');
$produit= $req->fetchAll(PDO::FETCH_ASSOC);
//initialisation des valeurs pour la boucle foreach
$j=1;
//on récupère tous les éléments et on les enregistre dans des variables que l'on va appeler plus tard dans notre html en faisant un foreach 
foreach ($produit AS $ligneresult){
  $nomproduit[$j]=$ligneresult['nom_produit'];
  $prixproduit[$j]=$ligneresult['prix'];
  $stockproduit[$j]=$ligneresult['stock'];
  $j++;
}

?>
<header>
    <?php include 'config/template/nav.php'; ?>
</header>

<section class="hero-full-image">
  <h1>Fanon</h1>
  <a href="#produits" class="btnclassique">Nos produits</a>
</section>

<section id="produits" class="nosproduits">
  <h2>Nos produits</h2>
  <div class="troisarticles">
    <!--On crée une boucle for pour afficher répeter a chaque fois la même suite d'opérations avec les bons id-->
    <?php
      for($k=1; $k<=count($image); $k++){
    ?>
    <article>
      <figure>
        <img class="articleimg" src="<?=$image[$k]?>" alt="<?=$nomproduit[$k]?>">
        <figcaption><h3><?=$nomproduit[$k]?></h3></figcaption>
      </figure>
      <p>Prix : <?=$prixproduit[$k]?> €</p>
      <p>Stock : <?=$stockproduit[$k]?></p>
      <a href="fiche_produit.php?id=<?=$k?>" class="btnclassique">Voir l'article</a>
    </article>
    <?php
      }
    ?>
  </div>
</section>

<?php include 'config/template/footer.php'; ?>