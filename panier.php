<?php include 'config/template/head.php'; ?>
<header>
    <?php include 'config/template/nav.php'; ?>
</header>
<section>
    <h1 class="text-center mt-5 mb-5">Page panier</h1>

    <ul class="panier-liste">
        <li class="panier-produit p-3">
            <div class="ml-3">
                <h2>[Nom du produit]</h2>
                <p>[Prix]</p>
                <form class="panier-quantite" action="" method="post">
                    <input type="submit" name="plus" value="+"></button>
                    <p class="pr-2 pl-2">[quantite]</p>
                    <input type="submit" name="minus" value="-"></button>
                </form>
            </div>
            <img src="asset/img/herofullimage.jpg">
        </li>
        <li class="panier-produit p-3">
            <div class="ml-3">
                <h2>[Nom du produit]</h2>
                <p>[Prix]</p>
                <form class="panier-quantite" action="" method="post">
                    <input type="submit" name="plus" value="+"></button>
                    <p class="pr-2 pl-2">[quantite]</p>
                    <input type="submit" name="minus" value="-"></button>
                </form>
            </div>
            <img src="asset/img/herofullimage.jpg">
        </li>
    </ul>

    <div class="panier-total text-center mb-5">
        <div class="d-flex justify-content-between mt-3">
            <p>Prix total :</p>
            <p>[Prix total]€</p>
        </div>
        <form>
            <input class="w-100" type="submit" name="acheter" value="Passer à l'achat">
        </form>
    </div>
    
</section>

<?php include 'config/template/footer.php'; ?>