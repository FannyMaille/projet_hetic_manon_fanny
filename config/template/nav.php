<?php
$quantite=panierquantite();
if($quantite==0){
  $lien="paniervide.php";
}else{
  $lien="panier.php";
}
?>


<a href="index.php" class="logo">Fanon</a>
<nav class="nav">
    <a class="nav-link" href="index.php">Accueil</a>
    <?php if(connecte()){?>
      <a class="nav-link" href="profil.php">Profil</a>
    <?php }else{ ?>  
      <a class="nav-link" href="login.php">Connexion</a>
    <?php } ?> 
    <a class="nav-link panier" href="<?= $lien ?>">
      Panier
      <span><?= $quantite ?></span>
    </a>
</nav>