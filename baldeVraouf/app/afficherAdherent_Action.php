<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'db-config.php';

function getAdherents(PDO $PDO)
{
  $sql = "SELECT * FROM adherent ORDER BY idadherent DESC";
  $result = $PDO->query($sql);

  $adherents = $result->fetchAll(PDO::FETCH_ASSOC);

  $result->closeCursor();

  return $adherents;
}?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
 <div class=" container bg-white">
<?php
// insertitino du fichier "header.php" se trouvant dans un dossier  "includes"
   require('header.php');
// insertitino du fichier "nav.php" se trouvant dans un dossier  "includes"
   include("nav.php");?>
<table class="table caption-top"> <br>
     <caption class="bg-secondary text-white"> Listes des adherents </caption>
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Nom</th>
      <th scope="col">Prenom</th>
      <th scope="col">Email</th>
      <th scope="col">Profil</th>
    </tr>
  </thead>
   <tbody>  
     <?php
                   // affichage des email des tous les  adherents et recuperation de identifiant de chacun  
//include("afficherAdherent_Action.php");

$PDO = new PDO(DB_DSN, DB_USER, DB_PASS, $options); 
$adherents = getAdherents($PDO); 
 foreach ($adherents as $user) {
              echo '<tr scope="row">';
                  echo '<td>'.$user['idAdherent'] .'</td>';
                  echo '<td>'.$user['nom'] .'</td>';
                  echo '<td>'.$user['prenom'] .'</td>';
                  echo '<td>'.$user['email'] .'</td>';
                  echo '<td>'.$user['profil'] .'</td>'; 
                   '</tr>';
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


