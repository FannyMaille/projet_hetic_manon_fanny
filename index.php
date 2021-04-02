<?php include 'config/template/head.php'; 

$image = photosproduits(false);
$produit = ecritproduits(false);

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
      for($k=0; $k<count($produit); $k++){
    ?>
    <article>
      <figure>
        <?php if(isset($image[$k])){ ?>
        <img class="articleimg" src="<?=$image[$k]?>" alt="<?=$produit[$k]['nom_produit']?>">
        <?php } ?>
        <figcaption><h3><?=$produit[$k]['nom_produit']?></h3></figcaption>
      </figure>
      <p>Prix : <?=$produit[$k]['prix']?> €</p>
      <p>Stock : <?=$produit[$k]['stock']?></p>
      <!-- modifier L'ID !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! -->
      <a href="fiche_produit.php?id=<?=$k?>" class="btnclassique">Voir l'article</a>
    </article>
    <?php
      }
    ?>
  </div>
</section>

<?php include 'config/template/footer.php'; ?>