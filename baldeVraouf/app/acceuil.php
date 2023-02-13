<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'db-config.php';

function getArticles(PDO $PDO)
{
  $sql = "SELECT articles.*,adherent.nom as nomadherent FROM articles 
  inner join adherent 
   on articles.idAuteur= adherent.idAdherent ";
  $result = $PDO->query($sql);

  $articles = $result->fetchAll(PDO::FETCH_ASSOC);

  $result->closeCursor();

  return $articles;
}?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
</head>
<body>
    
<!-- div principal -->
<div class=" container bg-white">
<?php
// insertitino du fichier "header.php" se trouvant dans un dossier  "includes"
   require('header.php');
// insertitino du fichier "nav.php" se trouvant dans un dossier  "includes"
   include("nav.php");?>
      <!-- <?php if(isset($erreur)){echo '<p>'.$erreur. '</p>';} ?> -->
<!-- tableau qui contiendra tous les adherents  -->
<br><p class="nav justify-content-end bg-secondary text-white container"><br>
    <em class="bg-secondary text-white">Bienvenu Mr/Md <?=$_SESSION['nom'] ." ".$_SESSION['prenom'] ?></em> </p>
  <?php
                   // affichage des email des tous les  adherents et recuperation de identifiant de chacun  

$PDO = new PDO(DB_DSN, DB_USER, DB_PASS, $options); 
$articles = getArticles($PDO); 
 ?>
                  <?php
 foreach ($articles as $article) {
    ?>
    <div class="card container">
        <h5> <a class="text-info card-title" href="#"><?=$article['titre'] ;?></a> </h5>
        <div class="row">
        <div class="card-text col-md-8">
           <h6 class="card-text col-md-9"> <em><?=$article['description'] ;?></em></h6>
         <p><?=$article['contenu'] ;?></p> 
        </div>
         <div class="card-text col-md-4 text-secondary">
           <p><em>publie par</em><h6 class="col-md-2 "> <cite><?=$article['nomadherent'] ;?></cite></h6> le 
       <em> <?=$article['date_publication'] ;?></em></p>
         </div>
       </div>
    </div>
    <hr>
    <?php
}
?>
         
  </tbody>
</table>
<!-- fin de l'affichage -->
<!-- debut de la page   -->

<?php  
require_once('footer.php');
 ?>
</div>
<!-- debut de la page   -->
</body>
</html>