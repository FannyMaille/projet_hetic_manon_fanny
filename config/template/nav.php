<nav class="nav">
    <a class="nav-link" href="index.php">Accueil</a>
    <?php if(!isset($_SESSION['user'])){ ?>
    <a class="nav-link" href="inscription.php">Inscription</a>
    <?php }
    else if (isset($_SESSION['user']) && $_GET['access'] == 'forbidden'){ ?>
    <a class="nav-link" href="login.php">Login</a>
    <?php }
    else {?>
    <a class="nav-link" href="profil.php">Profil</a>
    <?php } ?>
    <a class="nav-link" href="panier.php">Panier</a>
</nav>