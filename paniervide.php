<?php include 'config/template/head.php'; 
if(!panierquantite()==0){
  header("location:panier.php");
  die();
}
?>
<header>
    <?php include 'config/template/nav.php'; ?>
</header>
<section class="sectionpanier">
    <h1 class="text-center mt-5 mb-5">Page panier</h1>
      <p>Votre panier est vide</p>
      <a href="index.php#produits" class="btnclassique">Nos acticles</a>  
</section>

<?php include 'config/template/footer.php'; ?>