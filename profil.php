<?php include 'config/template/head.php'; ?>
<header>
    <?php include 'config/template/nav.php'; ?>
</header>
<section class="sectformulaire">
    <h1 class="text-center mt-5">Bonjour [pseudo] !</h1>
    <p class="text-center mb-5">Vous êtes [simple membre / admin]</p>

    <ul class="formulaireprofil">
        <li>
            <form action="" method="post">
                <div>
                    <label for="pseudo">Pseudo :</label>
                    <input type="hidden" name="pseudo" id="pseudo">
                    <p>[pseudo]</p>
                </div>
                <div>
                    <input type="submit" value="Modifier" name="modifier-pseudo">
                </div>
            </form>
        </li>
        <li>
            <form action="" method="post">
                <div>
                    <label for="new-mdp">Mot de passe :</label>
                    <input type="hidden" name="new-mdp" id="new-mdp">
                    <p>*******</p>
                </div>
                <div>
                    <input type="submit" value="Modifier" name="modifier-mdp">
                </div>
            </form>
        </li>
        <li>
            <form action="" method="post">
                <div>
                    <label for="civilite">Civilité :</label>
                    <input type="hidden" name="civilite" id="civilite">
                    <p>[sexe]</p>
                </div>
                <div>
                    <input type="submit" value="Modifier" name="modifier-civilite">
                </div>
            </form>
        </li>
        <li>
            <form action="" method="post">
                <div>
                    <label for="adresse">Adresse postale :</label>
                    <input type="hidden" name="adresse" id="adresse">
                    <p>[numrue] [nom de rue] [CP], [ville]</p>
                </div>
                <div>
                    <input type="submit" value="Modifier" name="modifier-adresse">
                </div>
            </form>
        </li>
        <li>
            <form action="" method="post">
                <div>
                    <label for="tel">Numéro de téléhpone :</label>
                    <input type="hidden" name="tel" id="tel">
                    <p>[numéro de téléphone]</p>
                </div>
                <div>
                    <input type="submit" value="Modifier" name="modifier-tel">
                </div>
            </form>
        </li>
        <li>
            <form action="" method="post">
                <div>
                    <label for="mail">Adresse mail :</label>
                    <input type="hidden" name="mail" id="mail">
                    <p>[adresse mail]</p>
                </div>
                <div>
                    <input type="submit" value="Modifier" name="modifier-mail">
                </div>
            </form>
        </li>
    </ul>
    
</section>
<?php include 'config/template/footer.php'; ?>