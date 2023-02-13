<?php
ob_start();
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'db-config.php';
function validate(PDO $PDO){
   
if(isset($_POST['publier'])){

    if(!empty($_POST['titre']) 
    AND !empty($_POST['description']) 
    AND !empty($_POST['contenu'])
   ) {
  
        $Q_titre =htmlspecialchars($_POST['titre']);
        $Q_description =nl2br(htmlspecialchars($_POST['description'])) ;
        $Q_contenu =nl2br(htmlspecialchars($_POST['contenu']));
        $Q_date=date('d/m/y');
        $Q_id_auteur=  $_SESSION['idAdherent'];

          $insertionQuestion=$PDO->prepare('INSERT INTO articles  
          (titre, description, contenu, date_publication,idAuteur)
         VALUES
        (?, ?, ?,  ?, ? )');
          $insertionQuestion->execute
          (array
          ($Q_titre,$Q_description,$Q_contenu , $Q_date,$Q_id_auteur)
        );
        header('Location: acceuil.php');
         $succes="Votre question bien inseree dans le site... ";
    

    }else{
        $erreur="Veuillez completer tous les champs... ";
       }   }

}
?>
<!DOCTYPE html>
<title>publierArticle</title>
<html lang="en">
<?php
require('header.php');
?>
<body>
   <?php
require('nav.php'); 
?> </br>
 <div class="container bg-white">
    <?php
    if(isset($erreur)){echo '<p>'.$erreur. '</p>';
    }
    elseif(isset($succes)){echo '<p>'.$succes. '</p>' ;}
     ?>
    <form method="POST" action="" align="center" class="container col-md-8   bg-secondary" >
 <p  class="text-white">Je publis un article !</p>          <input class="form-control"  type="text" name="titre" placeholder="titre">
        <br>  <input class="form-control"   name="description" placeholder="description"></input>
         <br> <textarea class="form-control"   name="contenu" placeholder="contenu"></textarea> <br>
         <p> <input class="btn btn-info form-control" type="submit" name="publier" ></p> <br> 
  </form>
 
<?php
    $PDO = new PDO(DB_DSN, DB_USER, DB_PASS, $options);
validate($PDO);  require_once('footer.php');?>
 </div>
</body>
</html>
