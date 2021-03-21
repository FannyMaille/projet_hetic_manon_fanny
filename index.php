<?php include 'config/template/head.php'; 

$image = photosproduits();
$produit = ecritproduits();

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
        <img class="articleimg" src="<?=$image[$k]?>" alt="<?=$produit['nom'][$k]?>">
        <figcaption><h3><?=$produit['nom'][$k]?></h3></figcaption>
      </figure>
      <p>Prix : <?=$produit['prix'][$k]?> €</p>
      <p>Stock : <?=$produit['stock'][$k]?></p>
      <a href="fiche_produit.php?id=<?=$k?>" class="btnclassique">Voir l'article</a>
    </article>
    <?php
      }
    ?>
  </div>
</section>

<?php include 'config/template/footer.php'; ?>