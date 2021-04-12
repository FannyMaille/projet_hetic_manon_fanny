<?php include 'config/template/head.php'; 
suppsessioncommane();
//Définition des variables contenent les erreurs comme étant vide au départ
$erreur="";
$backgroud="";

//si l'utilisateur n'est pas conneté il ne peut pas acceder à cette page il est donc rediriger vers la page login
if(!connecte()){
  header("location:login.php");
  die();
}

//Si on envoie le formulaire de l'admin
if(isset($_POST['modifierproduit'])){
  extract($_POST);
  changeProduit(intval($idproduit), intval($stock), $prix, $nomproduit);
}

// Liste des produits récupérés pour l'admin
$produits = infosproduits(0);

if(isset($_POST['add-new-produit'])){
  extract($_POST);
  addNewProduct($nouveaunom, $nouveaudesc, $nouveauprix, $nouveaustock);


  // create the directory and save the images
  $produits = infosproduits(0);
  $newProduct = end($produits);
  $newProductId = $newProduct['id_produit'];
  $files = $_FILES;

  createDirForImages($newProductId, $files);
}

?>

<header>
    <?php include 'config/template/nav.php'; ?>
</header>
    <section class="admin-profil-part">
      <h2 class="admin-titles">Gérer les produits</h2>
      <div class="article-profil-parent">
      
        <?php for($k=0; $k<count($produits); $k++){ ?>
        <article class="admin-produit">
          <form action="admin.php" method="post" class="stock-form">
            <!-- // boucle des produits -->
            <div>
              <label for="nomproduit"><?php echo $produits[$k]['nom_produit'] ?></label>
              <input type="text" name="nomproduit" class="hidden input-produit" value="<?php echo $produits[$k]['nom_produit'] ?>">
            </div>
            <div>
              <label for="stock">Stock actuel : <?php echo $produits[$k]['stock'] ?></label>
              <input type="number" name="stock" class="hidden input-produit" value="<?php echo $produits[$k]['stock'] ?>">
            </div>
            <div>
              <label for="prix">Prix actuel : <?php echo $produits[$k]['prix'] ?> euros</label>
              <input type="float" name="prix" class="hidden input-produit" value="<?php echo $produits[$k]['prix'] ?>">
            </div>
            <input type="hidden" name="idproduit" value="<?php echo $produits[$k]['id_produit'] ?>">
            <input type="submit" name="modifierproduit" value="Changer les stocks" class='hidden'>
            <a class="hidden undo-modify">Annuler</a>
            <a class="modify-stock profil-element">Modifier</a>
          </form>
        </article>
        <?php } ?>
      </div>
    </section>

    <section class="add-new-product-section">
      <h2 class="admin-titles">Ajouter un nouveau produit</h2>
      <form enctype="multipart/form-data" action="admin.php" method="post" class="add-produit-form">
        <label for="nouveaunom">Nom du produit :</label>
        <input id="nouveaunom" type="text" name="nouveaunom" required>
        <label for="nouveaustock">Stock :</label>
        <input id="nouveaustock" type="number" name="nouveaustock" required>
        <label for="nouveauprix">Prix :</label>
        <input id="nouveauprix" type="float" name="nouveauprix" required>
        <label for="nouveaudesc">Description du produit :</label>
        <textarea id="nouveaudesc" name='nouveaudesc' required></textarea>
        <!-- Drag and drop des images -->
        <div>
          <div class="drop-space">
            <p class="drag-n-drop-text">Vous pouvez déposer vos images ici (la première sera l'image principale du produit)</p>
            <div class="image-preview" id="image-preview"></div>
          </div>
        </div>
        
        <input type="submit" name="add-new-produit" value="Ajouter le produit">
      </form>
    </section>

    <!-- //https://www.w3schools.com/howto/howto_js_filter_lists.asp 
    if willing to make a search bar if multiple products -->

<script src="asset/script/admin.js"></script>
<?php include 'config/template/footer.php'; ?>