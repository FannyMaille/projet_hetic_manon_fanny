<?php
$produit = ecritproduits();
$image = photosproduits();

$quantite=panierquantite();
if($quantite==0){
  $lien="paniervide.php";
}else{
  $lien="panier.php";
}
?>

<footer>
  <div class="listefooter">
    <div>
      <h4>Pages Produits</h4>
      <ul>
        <?php
          for($k=1; $k<=count($image); $k++){
        ?>
        <li><a href="fiche_produit.php?id=<?=$k?>"><?=$produit['nom'][$k]?></a></li>
        <?php
          }
        ?>
      </ul>
    </div>
    <div>
      <h4>Pages Interractives</h4>
      <ul>
        <li><a href="index.php">Accueil</a></li>
        <?php if(connecte()){?>
        <li><a href="profil.php">Profil</a></li>
        <?php }else{ ?>  
        <li><a href="login.php">Connexion</a></li>
        <?php } ?> 
        <li><a href="<?= $lien ?>">Panier</a></li>
      </ul>
    </div>
  </div>
  <p>© Canon 2021 - Tous droits réservés</p>
</footer>


<script src="asset/script/script.js"></script>
</body>

</html>