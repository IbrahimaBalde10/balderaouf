

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>
<body>
<div class=" container bg-white">
     <?php
// insertitino du fichier "header.php" se trouvant dans un dossier  "includes"
   require('header.php');
// insertitino du fichier "nav.php" se trouvant dans un dossier  "includes"
  ?><nav class="bg-info text-white container text-center">Bienvenu sur notre site 
     <em>L3GLAR-ESTM</em></nav> <br> 
<div class="container"> 
 
   <div class="row " >

<!-- debut du  formulaire d'inscription -->
     <form method="POST"  align="center" action="validationInscription.php" class="container col-md-4  " >

           <h3 class="container bg-secondary text-white">Je m'inscris !</h3>
       
           <div class="form-group">
              <input class="form-control " type="text" name="nom" required placeholder="Entrez votre nom">
           </div>
           <div class="form-group">
              <input class="form-control " type="text" name="prenom" required placeholder="Entrez votre prenom">
           </div>
          <div class="form-group">
              <input class="form-control " type="email"name="email" required placeholder="Entrez votre email">
          <div class="form-group">
              <input class="form-control " type="text" name="profil"  required placeholder="Entrez votre profil">
            </div>
          <div class="form-group">
              <input class="form-control " type="password" name="mdp" required placeholder="Entrez votremot de pass">
            </div>
          <div class="form-group">
              <input class="form-control "  type="password" name="confirmemdp" required placeholder="Confirmer mot de pass">
           </div>    
          <div class="form-group">
              <input class="form-control btn btn-secondary" type="submit" name="inscription" >
          </div><br>
            <div class="form-group">
               <p class="form-control container bg-secondary text-white">J'ai deja un compte,<a class="btn bg-info text-white" href="index.php"> je m'identifie!</a>
               </p>
          </div>
      </form>
<!-- fin du  formulaire d'inscription -->
 </div>
 <?php  
require_once('footer.php');
 ?>
 </div>
</body>
</html>