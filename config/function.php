<?php
///////////////////////////______________________________________CONNEXION
//___FONCTION___fonction qui permt de voir si quelqu'in est connecté
function connecte(){
  if(isset($_SESSION['user'])){
    return true;
  }else{
    return false;
  }
}

///////////////////////////______________________________________PAGE INDEX

//___FONCTION___Pour les photos des produits___
function photosproduits(){
  global $pdo;
  $req = $pdo->query('SELECT id_produit, url_image FROM hetic21_photos_produit');
  $photo= $req->fetchAll(PDO::FETCH_ASSOC);
  //initialisation des valeurs pour la boucle foreach
  $i=1;
  $valeurdepart=0;
  //boucle froeacch pour parcourir tout le tableau récupéré de la base de données
  foreach ($photo AS $ligneresultphoto){
    //si l'identifiant du produit est different du précendent il s'agit d'un nouveau produit donc on enregistre la première photo du produit dans notre tableau
    //l'indice de notre tableau coorespond a l'id du produit
    if ($ligneresultphoto['id_produit'] != $valeurdepart){
      $image[$i]=$ligneresultphoto['url_image'];
      $i++;
      $valeurdepart = $ligneresultphoto['id_produit'];
    }
  }
  return $image;
}

//___FONCTION___Pour les élèments écrits___
function ecritproduits(){
  global $pdo;
  //On sélectionne tous les élements de la base que l'on a besoin d'afficher sur notre page d'id $id
  $req = $pdo->query('SELECT id_produit, nom_produit, description_produit, prix, stock FROM hetic21_produit');
  $produit= $req->fetchAll(PDO::FETCH_ASSOC);
  //initial sation des valeurs pour la boucle foreach
  $j=1;
  //on récupère tous les éléments et on les enregistre dans des variables que l'on va appeler plus tard dans notre html en faisant un foreach 
  foreach ($produit AS $ligneresult){
    $produit['nom'][$j]=$ligneresult['nom_produit'];
    $produit['prix'][$j]=$ligneresult['prix'];
    $produit['stock'][$j]=$ligneresult['stock'];
    $j++;
  }
  return $produit;
}


///////////////////////////______________________________________PAGE PRODUITS

//___FONCTION___Pour les élèments écrits___
function ecritunproduit(){
  global $pdo;
  //On récupère l'id du produit qu'on a mis dans l'url
  $id = $_GET['id'];
  //On sélectionne tous les élements de la base que l'on a besoin d'afficher sur notre page d'id $id
  $req = $pdo->prepare('SELECT nom_produit, description_produit, prix, stock FROM hetic21_produit WHERE id_produit = :id');
  $req->bindValue(':id', $id);
  $req->execute();
  $unproduit= $req->fetchAll(PDO::FETCH_ASSOC);
  //on récupère tous les éléments et on les enregistre dans des variables que l'on va appeler plus tard dans notre html en faisant un foreach 
  foreach ($unproduit AS $ligneresult){
    $unproduit['nom']=$ligneresult['nom_produit'];
    $unproduit['description']=$ligneresult['description_produit'];
    $unproduit['prix']=$ligneresult['prix'];
    $unproduit['stock']=$ligneresult['stock'];
  }
  return $unproduit;
}

//___FONCTION___Pour les photos des produits___
function photosunproduit(){
  global $pdo;
  //On récupère l'id du produit qu'on a mis dans l'url
  $id = $_GET['id'];
  //obligé de faire 2 connexion differente car se sont des élèments dans un autre table que la précendente
  $req = $pdo->prepare('SELECT url_image FROM hetic21_photos_produit WHERE id_produit = :id');
  $req->bindValue(':id', $id);
  $req->execute();
  $photo= $req->fetchAll(PDO::FETCH_ASSOC);
  $i=1;
  //on récupère toutes les photos et on les enregistre dans des variables que l'on va appeler plus tard dans notre html en faisant un foreach
  foreach ($photo AS $ligneresultphoto){
    $image[$i]=$ligneresultphoto['url_image'];
    $i++;
  }
  return $image;
}



///////////////////////////______________________________________PAGE INSCRIPTION

//___FONCTION___
// Traitement si il ya des erreurs dans le renseignement des champs
function erreurinscription($pseudo,$mdp,$telephone,$mail,$ville){
  $content="";
  // on vérifie que le pseudo enregistré est bbien compris entre 2 et 255 caractères
  if(strlen($pseudo) < 2 || strlen($pseudo) > 255){
    $content .= 'Votre pseudo doit contenir entre 2 et 255 caractères.</br>';
  }
  // on vérifie que le mot de passe enregistré est bien compris entre 8 et 25 caractères
  if(strlen($mdp) < 8 || strlen($mdp) > 25){
    $content .= 'Votre mot de passe doit être compris entre 8 et 25 caractères.</br>';
  }
  // on vérifie que le téléphone enregistré est bien composé que de chiffres
  $telCarac = str_split($telephone, 1);
  foreach($telCarac as $number){
    if(!is_numeric($number)){
      $content .= 'Le numéro de téléphone n\'est pas valide. Il doit être écrit que des chiffres sans espaces.</br>';
    }
  }
  // on vérifie que le téléphone enregistré est bien composé que de 10 chiffres
  if(strlen($telephone) != 10){
    $content .= 'Le numéro de téléphone n\'est pas valide. Il doit être contenir 10 chiffres.</br>';
  }
  // on vérifie que l'e-mail enregistré est bien valide
  if(!filter_var($mail, FILTER_VALIDATE_EMAIL)){
    $content .= 'L\'email est invalide.</br>';
  }
  // on vérifie que le nom de la ville enregistré est composé que de lettres
  $villeCarac = str_split($ville, 1);
  foreach($villeCarac as $caracter){
    if(is_int($caracter)){
      $content .= 'Le nom de la ville n\'est pas valide</br>';
    }
  }
  return $content;
}

//___FONCTION___
//Function pour enregistre les informations du formulaire dans la base de donées
function enregistrementbasededonnee($pseudo,$mdp,$telephone,$mail,$numrue, $rue, $codepostal, $ville, $civil){
  global $pdo;
  $erreur="";

  //on va commence par vérifier si il existe un utilisateur possédant le meme pseudo ou le même e-mail dans notre bbase de données
  //Requete dans la tabble user pour saisir les pseudo ou e-mail qui qont similaire à ceux insrits dans le formulaire
  $querySelect = "SELECT id_user FROM hetic21_user WHERE(pseudo = :pseudo OR email = :email) LIMIT 1";
  $req = $pdo->prepare($querySelect);
  $req->execute(
    [
      'pseudo' => $pseudo,
      'email' => $mail
    ]
  );
  $dejainscrit= $req->fetchAll(PDO::FETCH_ASSOC);
  //Si il ya au moins 1 réponse cela veut dire qu'il existe un utilisateur possédant le meme pseudo ou le même e-mail
  //Dans ce cas on enregistre pas les données et on enregitre un message d'erreur
  if(count($dejainscrit)>0){
    $erreur="Un utilisateur à ce pseudo/e-mail est déja inscrit";
  }
  //Sinon il n'y a pas de doublons donc on peut enreidtre les informations dans la base de donnée
  else{
    //on hash le mot de passe avant de l'enregistrer dans la base de donnée
    $mdpCrypt = password_hash($mdp, PASSWORD_DEFAULT);

    //on dit dans quelle table et quelles informations on souhaite enregistrer
    $queryInsert = "INSERT INTO hetic21_user (pseudo, mdp, tel, email, numero_rue, nom_rue, cp, ville, civilite)
    VALUES (:pseudo, :mdp, :tel, :email, :numero_rue, :nom_rue, :cp, :ville, :civilite)";

    $reqPrep = $pdo->prepare($queryInsert);
    $reqPrep->execute(
      [
        'pseudo' => $pseudo,
        'mdp' => $mdpCrypt,
        'tel' => $telephone,
        'email' => $mail,
        'numero_rue' => $numrue,
        'nom_rue' => $rue,
        'cp' => $codepostal,
        'ville' => $ville,
        'civilite' => $civil
      ]);
    }
  return $erreur;
}


///////////////////////////______________________________________PAGE LOGIN

//___FONCTION___
//fonction pour vérifier si le pseudo et le mot de passe enregistré sont correctes
function verificationlogin($pseudo,$mdp){
  global $pdo;
  //Requete dans la table user pour récupérer les éléments qui correspondent au pseudo inscrit dans le formulaire login
  $querySelect = "SELECT * FROM hetic21_user WHERE pseudo = :pseudo";
  $reqPrep = $pdo->prepare($querySelect);
  $reqPrep->execute(
    [
      'pseudo' => $pseudo
    ]
  );
  $result = $reqPrep->fetchAll(PDO::FETCH_ASSOC);
  //S'il n'y a aucun résultat qui correspond au même pseudo alors on retrourne false
  if(count($result)!=1){
    return false;
  }
  //Sinon il y a donc un pseudo qui correspon, on vérifie alors que le mot de passe correspond à ce pseudo
  else{
    //si le mot de passee inscrit est different de celui enregitré dans la base de donnée alors on retrourne false
    if(!password_verify($mdp, $result[0]['mdp'])){
      return false;
    }
    //Sinon on retrourne vrai et on appel la fonction setSession
    else{
      //On appel la fonnction setSession() pour mettre à jour les varibbales de session
      setSession($result);
      return true;
    }
  }
  
}

//___FONCTION___
//fonction qui permet d'enregitrer toutes les infoamrions de l'utilisateur dans la session
//$result contient les informations d'enregistrement de l'utilisateur (=de la base de donnée hetic21_user )
function setsession($result){
    //Nous avons enregistrer la civilité sous forme de nombre dans notre base de donnée (lee 0 coorespond à femmen, le 1 à homme et 2 à autre)
    //Ici pour afficheer un contenu compréhensible à l'utilisateur on faiit afficher le texte qui correspond au numéro enregistré
    switch($result[0]['civilite']){
      case 0:
        $civil = 'Madame';
        break;
      case 1:
        $civil = 'Monsieur';
        break;
      case 2:
        $civil = 'Autre';
        break;
    }
  
    //on enregistre toutes les valeurs du formulaires dans nos variales session

    $statut = $result[0]['statut'] == 0 ? 'simple membre': 'admin';
  
    $_SESSION['user']['id'] = $result[0]['id_user'];
    $_SESSION['user']['pseudo'] = $result[0]['pseudo'];
    $_SESSION['user']['tel'] = $result[0]['tel'];
    $_SESSION['user']['email'] = $result[0]['email'];
    $_SESSION['user']['numrue'] = $result[0]['numero_rue'];
    $_SESSION['user']['nomrue'] = $result[0]['nom_rue'];
    $_SESSION['user']['cp'] = $result[0]['cp'];
    $_SESSION['user']['ville'] = $result[0]['ville'];
    $_SESSION['user']['civilnombre'] = $result[0]['civilite'];
    $_SESSION['user']['civil'] = $civil;
    $_SESSION['user']['statut'] = $statut;

    //On redirige vers profil une fois tout cela terminé
    header('location:profil.php');
    exit();
  }

///////////////////////////______________________________________PAGE PROFIL

//___FONCTION___
// Traitement si il ya des erreurs de saisie dans le formualaire
function changementerreur($pseudo,$telephone,$mail,$ville){
  $content="";
  // on vérifie que le pseudo enregistré est bbien compris entre 2 et 255 caractères
  if(strlen($pseudo) < 2 || strlen($pseudo) > 255){
    $content .= 'Votre pseudo doit contenir entre 2 et 255 caractères.</br>';
  }
  // on vérifie que le téléphone enregistré est bien composé que de chiffres
  $telCarac = str_split($telephone, 1);
  foreach($telCarac as $number){
    if(!is_numeric($number)){
      $content .= 'Le numéro de téléphone n\'est pas valide. Il doit être écrit que des chiffres sans espaces.</br>';
    }
  }
  // on vérifie que le téléphone enregistré est bien composé que de 10 chiffres
  if(strlen($telephone) != 10){
    $content .= 'Le numéro de téléphone n\'est pas valide. Il doit être contenir 10 chiffres.</br>';
  }
  // on vérifie que l'e-mail enregistré est bien valide
  if(!filter_var($mail, FILTER_VALIDATE_EMAIL)){
    $content .= 'L\'email est invalide.</br>';
  }
  // on vérifie que le nom de la ville enregistré est composé que de lettres
  $villeCarac = str_split($ville, 1);
  foreach($villeCarac as $caracter){
    if(is_int($caracter)){
      $content .= 'Le nom de la ville n\'est pas valide</br>';
    }
  }
  return $content;
}  

//___FONCTION___
//Function pour enregistre les informations du formulaire dans la base de donées
function changementbasededonnee($id,$pseudo,$telephone,$mail,$numrue, $rue, $codepostal, $ville, $civil){
  global $pdo;
  $erreur="";

  //on va commence par vérifier si il existe un utilisateur possédant le meme pseudo ou le même e-mail dans notre bbase de données
  //Requete dans la tabble user pour saisir les pseudo ou e-mail qui qont similaire à ceux insrits dans le formulaire mais avec un id different de l'utilisateur actuel
  $querySelect = "SELECT id_user FROM hetic21_user WHERE(pseudo = :pseudo OR email = :email) AND (id_user != :id) LIMIT 1";
  $req = $pdo->prepare($querySelect);
  $req->execute(
    [
      'pseudo' => $pseudo,
      'id' => $id,
      'email' => $mail
    ]
  );
  $dejainscrit= $req->fetchAll(PDO::FETCH_ASSOC);
  //Si il ya au moins 1 réponse cela veut dire qu'il existe un utilisateur possédant le meme pseudo ou le même e-mail
  //Dans ce cas on enregistre pas les données et on enregitre un message d'erreur
  if(count($dejainscrit)>0){
    $erreur="Un utilisateur à ce pseudo/e-mail est déja inscrit".$dejainscrit[0]['id_user'];
  }
  else{
    //on fait une requette pour dire dans quelle table et quelles informations on souhaite mettre à jour
    $queryUpdate = "UPDATE hetic21_user 
    SET pseudo = :pseudo, tel = :tel, email = :email, numero_rue = :numero_rue, nom_rue = :nom_rue, cp = :cp, ville = :ville, civilite = :civilite
    WHERE id_user = :id";
    $reqPrep = $pdo->prepare($queryUpdate);
    $reqPrep->execute(
      [
        'id'=> $id,
        'pseudo' => $pseudo,
        'tel' => $telephone,
        'email' => $mail,
        'numero_rue' => $numrue,
        'nom_rue' => $rue,
        'cp' => $codepostal,
        'ville' => $ville,
        'civilite' => $civil
      ]
    );

    //on fait une requette pour selectionner les informations que l'on souhaite récupérer
    //C'est à dires les dernières informations que l'on vient d'enregistre juste au-dessus
    $querySelect = "SELECT * FROM hetic21_user WHERE id_user = :id";
    $reqPrep = $pdo->prepare($querySelect);
    $reqPrep->execute(
      [
        'id' => $id
        ]
    );
    $result = $reqPrep->fetchAll(PDO::FETCH_ASSOC);
    //On appel la fonnction setSession() pour mettre à jour les varibbales de session
    setSession($result);
  }
  return $erreur;
}


///////////////////////////______________________________________PAGE MOT DE PASSE

//___FONCTION___
//Fonction qui permet de changer son mot de passe actuel
function changemdp($mdp_ancien, $mdp_nouveau, $id){
  global $pdo;
  $erreur="";

  //on fait une requête qui va selectionner le mot de passe (hash) de l'utilisateur actuel enregistre dans notre bas de donnée
  $querySelect = "SELECT mdp FROM hetic21_user WHERE id_user = :id";
  $reqancien = $pdo->prepare($querySelect);
  $reqancien->execute(
    [
      'id' => $id
    ]
  );
  //On enregistre ce mot de passe dans une variable
  $mdpCrypt= $reqancien->fetchAll(PDO::FETCH_ASSOC);
  foreach ($mdpCrypt AS $ligne){
    $mdpCryptBbd = $ligne['mdp'];
  }


  //On regarde si le mot de passe hash de la base de donnée et le mot de passe inscrit dans le formulaire par l'utilisateur ne correspondent pas
  if(!password_verify($mdp_ancien, $mdpCryptBbd)){
    //Si ils ne correspondent pas on enregitre une erreur et on ne va pas plus loin
    $erreur="Mot de passe actuel incorrect";
  }
  //Sinon cela veut dire que le mot de passe actuel saisie est corecte
  else{
    // on vérifie alors que le nouveua mot de passe enregistré est bien compris entre 8 et 25 caractères
    if(strlen($mdp_nouveau) < 8 || strlen($mdp_nouveau) > 25){
      //Si ce n'est pas la cas on enregitre une erreur et on ne va pas plus loin
      $erreur = 'Votre mot de passe doit être compris entre 8 et 25 caractères.</br>';
    }
    //Sinon cela veut dire que la saisie du nouveau mot de passe est correcte
    else{
      //On hash le mot de passe
      $mdpCrypt_nouveau = password_hash($mdp_nouveau, PASSWORD_DEFAULT);
      //On met à jour la tabe de notre base de donnée de l'utilisateur actuellement connecté avec son nouveau mot de passe
      $queryUpdate = "UPDATE hetic21_user SET mdp = :mdp WHERE id_user = :id";
      $reqnouveau = $pdo->prepare($queryUpdate);
      $reqnouveau->execute(
        [
          'mdp' => $mdpCrypt_nouveau,
          'id' => $id
        ]
      );
    }
  }
  return $erreur;
}

?>