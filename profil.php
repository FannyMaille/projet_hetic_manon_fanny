<?php include 'config/template/head.php'; ?>
<header>
    <?php include 'config/template/nav.php'; ?>
</header>
<section class="sectformulaire">
    <h1 class="text-center mt-5">Bonjour [pseudo] !</h1>
    <p class="text-center mb-5">Vous êtes [simple membre / admin]</p>

    <ul class="formulaireprofil">
        <li>
            <form action="init.php" method="post" class="profil-pseudo">
                <label for="pseudo">Pseudo :</label>
                <input type="text" class="hidden" name="pseudo" id="pseudo">
                <input type="submit" class="hidden" name="modifier-pseudo" value="Valider">
                <p class="profil-element">[pseudo]</p>
            </form>
            <div>
                <button type="submit" class="modifier-profil" value="profil-pseudo">Modifier</button>
            </div>
        </li>
        <li>
            <form action="init.php" method="post" class="profil-mdp">
                <label for="new-mdp">Mot de passe :</label>
                <input type="password" class="hidden" name="new-mdp" id="new-mdp">
                <input type="submit" class="hidden" name="modifier-mdp" value="Valider">
                <p class="profil-element">*******</p>
            </form>
            <div>
                <button type="submit" class="modifier-profil" value="profil-mdp">Modifier</button>
            </div>
        </li>
        <li>
            <form action="init.php" method="post" class="profil-civil">
                <label for="civilite">Civilité :</label>
                <input type="text" class="hidden" name="civilite" id="civilite">
                <input type="submit" class="hidden" name="modifier-civil" value="Valider">
                <p class="profil-element">[sexe]</p>
            </form>
            <div>
                <button type="submit" class="modifier-profil" value="profil-civil">Modifier</button>    
            </div>
        </li>
        <li>
            <form action="init.php" method="post" class="profil-adresse">
                <p>Adresse postale :</p>
                <label for="numrue" class="hidden">Numéro de rue :</label>
                <input type="number" class="hidden" name="numrue" id="numrue">
                <label for="rue" class="hidden">Nom de rue :</label>
                <input type="text" class="hidden" name="rue" id="rue">
                <label for="cp" class="hidden">Code postal :</label>
                <input type="number" class="hidden" name="cp" id="cp">
                <label for="ville" class="hidden">Ville :</label>
                <input type="text" class="hidden" name="ville" id="ville">
                <input type="submit" class="hidden" name="modifier-adresse" value="Valider">
                <p class="profil-element">[numrue] [nom de rue] [CP], [ville]</p>
            </form>
            <div>
                <button type="submit" class="modifier-profil" value="profil-adresse">Modifier</button>    
            </div>
        </li>
        <li>
            <form action="init.php" method="post" class="profil-tel">
                <label for="tel">Numéro de téléhpone :</label>
                <input type="tel" class="hidden" name="tel" id="tel">
                <input type="submit" class="hidden" name="modifier-tel" value="Valider">
                <p class="profil-element">[numéro de téléphone]</p>
            </form>
            <div>
                <button type="submit" class="modifier-profil" value="profil-tel">Modifier</button>
            </div>
        </li>
        <li>
            <form action="init.php" method="post" class="profil-mail">
                <label for="mail">Adresse mail :</label>
                <input type="email" class="hidden" name="mail" id="mail">
                <input type="submit" class="hidden" name="modifier-mail" value="Valider">
                <p class="profil-element">[adresse mail]</p>
            </form>
            <div>
                <button type="submit" class="modifier-profil" value="profil-mail">Modifier</button>
            </div>
        </li>
    </ul>
    
</section>
<?php include 'config/template/footer.php'; ?>