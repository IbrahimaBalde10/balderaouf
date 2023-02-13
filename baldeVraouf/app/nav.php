<!-- fichier "nav "(menu du site ) qui sera inclut dans tous les fichiers visibles par un utilisateur  s-->
<?php
// insertitino du fichier "header.php" se trouvant dans un dossier  "includes"
 require_once('header.php');
?>
      <!-- menu -->
    <ul class="nav justify-content-beginning bg-info text-white container">
  
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="acceuil.php">Acceuil</a>
      </li>
       <li class="nav-item">
           <a class="nav-link active" aria-current="page" href="publierQuestion.php">Publier un artiocle</a>
      </li>
       <li class="nav-item">
           <a class="nav-link active" aria-current="page"href="afficherAdherent_Action.php">Afficher Adhernts</a>
      </li> 
    
           <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="deconnexion.php">Deconnexion</a>
      </li>
    </ul>
     <style>
   
    ul  li {
    color :white;
    }
 </style>

  