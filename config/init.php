<?php
session_start();

if(isset($_SESSION['user']) && (!isset($_GET['access']))){
  header('location:' . $_SERVER['REQUEST_URI'] . '?access=forbidden');
}

global $pdo;
$content = '';

/*_____connexion PDO, base de donnée_____*/
//en local
define('HOSTNAME', 'localhost');
define('USERNAME', 'root');
define('PASSWORD', 'root');
define('DATABASE', 'maillem599');

//en ligne
// define('HOSTNAME', 'maillem599.mysql.db');
// define('USERNAME', 'maillem599');
// define('PASSWORD', 'VPJDk2JBvE6t');
// define('DATABASE', 'maillem599');

$dsn = "mysql:host=" . HOSTNAME . ';dbname=' . DATABASE;

try{
  $pdo = new PDO($dsn, USERNAME, PASSWORD);
} catch(PDOException $e){
  die('<ul><li>Erreur sur le fichier : ' . 
  $e -> getfile() . '</li><li>Erreur à la ligne : ' .
  $e -> getLine() . 'Message d\'erreur : ' .
  $e -> getMessage() . '</li></ul>');
}

//variable d'affichage etc. 

require 'function.php';

if(isset($_POST['inscription'])){
  extract($_POST);

  if(strlen($pseudo) < 2 || strlen($pseudo) > 255){
    header('location:../inscription.php?error=1&access=forbidden');
    exit();
  }
  if(strlen($mdp) < 8 || strlen($mdp) > 25){
    header('location:../inscription.php?error=2&access=forbidden');
    exit();
  }
  $telCarac = str_split($telephone, 1);
  foreach($telCarac as $number){
    if(!is_numeric($number)){
      header('location:../inscription.php?error=3&access=forbidden');
      exit();
    }
  }
  if(strlen($telephone) != 10){
    header('location:../inscription.php?error=3&access=forbidden');
    exit();
  }
  if(!filter_var($mail, FILTER_VALIDATE_EMAIL)){
    header('location:../inscription.php?error=4&access=forbidden');
    exit();
  }

  // if(is_nan($numrue) || strlen(strval($numrue)) > 5){
  //  header('location:../inscription.php?error=5&access=forbidden');
  //  exit();
  // }

  // if(is_nan($codepostal) || strlen(strval($codepostal)) != 5){
  //  header('location:../inscription.php?error=6&access=forbidden');
  //  exit();
  // }

  $villeCarac = str_split($ville, 1);
  foreach($villeCarac as $caracter){
    if(is_int($caracter)){
      header('location:../inscription.php?error=7&access=forbidden');
      exit();
    }
  }
  $mdpCrypt = password_hash($mdp, PASSWORD_DEFAULT);

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
    ]
  );

  $querySelect = "SELECT *
  FROM hetic21_user
  WHERE pseudo = :pseudo";
  
  $reqPrep = $pdo->prepare($querySelect);
  $reqPrep->execute(
    [
      'pseudo' => $pseudo
    ]
  );
  
  $result = $reqPrep->fetchAll(PDO::FETCH_ASSOC);
  setSession($result);
  
}


if(isset($_POST['connexion'])){
  extract($_POST);
  
  $querySelect = "SELECT *
  FROM hetic21_user
  WHERE pseudo = :pseudo";
  
  $reqPrep = $pdo->prepare($querySelect);
  $reqPrep->execute(
    [
      'pseudo' => $pseudo
    ]
  );
  
  $result = $reqPrep->fetchAll(PDO::FETCH_ASSOC);

  if(!password_verify($mdp, $result[0]['mdp'])){
    header('location:../login.php?error=8&access=forbidden');
    exit();
  };

  setSession($result);

}

function setsession($result){
  switch($result[0]['civilite']){
    case 0:
      $civil = 'femme';
      break;
    case 1:
      $civil = 'homme';
      break;
    case 2:
      $civil = 'autre';
      break;
  }

  $statut = $result[0]['statut'] == 0 ? 'simple membre': 'admin';

  $_SESSION['user']['pseudo'] = $result[0]['pseudo'];
  $_SESSION['user']['tel'] = $result[0]['tel'];
  $_SESSION['user']['email'] = $result[0]['email'];
  $_SESSION['user']['numrue'] = $result[0]['numero_rue'];
  $_SESSION['user']['nomrue'] = $result[0]['nom_rue'];
  $_SESSION['user']['cp'] = $result[0]['cp'];
  $_SESSION['user']['ville'] = $result[0]['ville'];
  $_SESSION['user']['civil'] = $civil;
  $_SESSION['user']['statut'] = $statut;

  header('location:../profil.php?access=authorized');
  exit();
}


//constantes système 

// Gestion des erreurs de connexion

if(isset($_GET['error'])){
  switch ($_GET['error']){
    case 1:
      $content .= 'Votre pseudo doit contenir entre 2 et 255 caractères.';
      break;
    case 2:
      $content .= 'Votre mot de passe doit être compris entre 8 et 25 caractères.';
      break;
    case 3:
      $content .= 'Le numéro de téléphone n\'est pas valide. Il doit être écrit sans espace et à 10 chiffres.';
      break;
    case 4:
      $content .= 'L\'email est invalide.';
      break;
    case 5:
      $content .= 'Le numéro de rue est invalide';
      break;
    case 6:
      $content .= 'Le code postal doit contenir 5 chiffres.';
      break;
    case 7:
      $content .= 'Le nom de la ville n\'est pas valide';
      break;
    case 8:
      $content .= 'Le mot de passe ou l\'identifiant est incorrect';
      break;
  }
}