<?php
ob_start();
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'db-config.php';
function validate(PDO $PDO){
// Verifier si l'utilisateur a cliqué sur le boutton 
if(isset($_POST['connexion'])){
// Verifier si tous champs sont remplis 
    if(!empty($_POST['email']) AND !empty($_POST['mdp'])){
// enlevez les eventuelles balises HTML se proteger des failles avec la fonction php (htmlspecialchars)
//creation de deux variables (email et mdp)
            $email =htmlspecialchars($_POST['email']);
            $mdp =htmlspecialchars($_POST['mdp']);
// requette SQL permettant de recuperer l'adherent qui a pour email ( $email) :Verification s'il existe 
            $verification= $PDO->prepare('SELECT * FROM adherent WHERE email = ?');
            $verification->execute(array($email));
//Si l'adherent est prensent je recupere ses donnees dans la variable ($info)
             if($verification->rowCount() >0){
      
                $info=$verification->fetch();
                //je compare le mot de passe entre avec celui recuperee 
                $passe=$info['mdp'];
// requette SQL permettant de recuperer l'adherent qui a pour email ( $mdp) :Verification s'il existe
// si les mots de passes sont identique je le connecte 
                 if($mdp===$passe){
//variables de sessions permettent l'adherent de naviguer sur toutes les pages 
                    $_SESSION['auth']=true;
                    $_SESSION['idAdherent']=$info['idAdherent'];
                    $_SESSION['nom']=$info['nom'];
                    $_SESSION['prenom']=$info['prenom'];
                    $_SESSION['email']=$info['email'];
                    $_SESSION['idAdherent']=$info['idAdherent'];
//une fois la connexion reussi je le redirige sur la page d'acceuil qui 
//pour nom (tontine.php)

header('Location: acceuil.php');  }
            else{
//si les mots de passes sont differents  , je cree une variable $erreur qui sera affichée dans la page de connexion 
                 $erreur="Mot de pass incorrect..."; }
         }else{
//si les emails  sont differents  , je cree une variable $erreur qui sera affichée dans la page de connexion 
             $erreur="Login incorrect.... ";}
    }else{
//si les champs ne sont pas remplis  , je cree une variable $erreur qui sera afafichée dans la page de connexion 
     $erreur="Veuillez completer tous les champs... "; }
}}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
</head>
<body>
<div class=" container bg-white">
<?php
// insertitino du fichier "header.php" se trouvant dans un dossier  "includes"
   require('header.php');
// insertitino du fichier "nav.php" se trouvant dans un dossier  "includes"
?>
<nav class="bg-info text-black container text-center">Bienvenu sur notre site 
     <em>L3GLAR-ESTM</em></nav> <br> 
     <nav class="bg-info text-black container text-center">Nous réussissons mieux si nous reussissons ensemble </nav> </br>
<div class="container">
           
<div class="row" >


     <!-- debut du  formulaire d'inscription -->
     <form method="POST" action="index.php" align="center" class="container col-md-4  " >
             <?php
            // affichage des messages d'erreurs definis dans le fichier "connexionAction.php"
            if(isset($erreur)){echo '<p>'.$erreur. '</p>';} ?>
              <h4 class="bg-secondary text-white">Je m'authentifie !</h4>
         <div class="form-group"> 
               <input class="form-control  " type="email" name="email" placeholder="Entrez votre email" >
          </div>  <br>
         <div class="form-group">
              <input class="form-control  " type="password" name="mdp" placeholder="Saisissez votre mot de pass">
         </div> <br>
        <div class="form-group">
              <input class="form-control btn btn-secondary" type="submit" name="connexion" > 
         </div> <br>
         <div class="form-group">
               <p class="form-control container bg-secondary text-white">
               Je n'ai pas  un compte,<a class="btn bg-info text-white" href="inscription.php"> je m'inscris!</a>
               </p>
         </div>           
 </div>
</div>
    </form>
    
<?php
    $PDO = new PDO(DB_DSN, DB_USER, DB_PASS, $options);
validate($PDO);?>
<?php  
require_once('footer.php');
?> </div>
</body>
</html>
