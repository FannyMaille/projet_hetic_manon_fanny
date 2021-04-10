<?php include 'config/template/head.php'; 
$prixtotal=montantfinal();
$commande=payement();
// $usercommande =personnecommande();
?>

<header>
<?php include 'config/template/nav.php'; ?>
</header>

<section class="sectionpayment">
    <h1 class="text-center mt-5 mb-5">Payement Effectué</h1>
    <section>
      <h2 class="mt-5 mb-5">Recap de la commande :</h2>
      <ul>
        <?php foreach($commande AS $unproduit){?>
          <li class="payement-produit p-3 <?= $unproduit['nom_produit'] ?>">
              <div class="ml-3">
                <p class="pr-2 pl-2"><?= $unproduit['quantite'] ?> x </p>
                <p><?= $unproduit['nom_produit'] ?> à </p>
                <p> <?= $unproduit['prix'] ?> €</p>
                <p class="pr-2 pl-2"> <?= $unproduit['quantite']*$unproduit['prix'] ?></p>
              </div>
          </li>
        <?php } ?>
      </ul>
      <div class="mb-5 ml-5 mt-3">
        <p>Prix total :</p>
        <p><?= $prixtotal['total_commande'] ?> €</p>
      </div>
    </section>
    <!-- <section>
      <h2 class="mt-5 mb-5">Personne qui a commande :</h2>
      <ul>
        <?php foreach($usercommande AS $userinfos){?>
          <li>Commandé par<?= $userinfos['pseudo'] ?> x </li>
          <li>Doit être livré à cette adresse<?= $userinfos['numero_rue'].' '.$userinfos['nom_rue'].' '.$userinfos['cp'].' '.$userinfos['ville'] ?> à </li>
          <li>Adresse mail :<?= $userinfos['email'] ?> €</li>
          <li>Téléphone<?= $userinfos['tel']*$unproduit['prix'] ?></li>
        <?php } ?>
      </ul>
    </section> -->
</section>

<?php include 'config/template/footer.php'; ?>