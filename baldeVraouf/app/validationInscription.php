<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'db-config.php';


function validate(PDO $PDO){
// Verifier si la personne  a cliqué sur le boutton 
if(isset($_POST['inscription'] )){
// Verifier si tous champs sont remplis
            if(!empty($_POST['nom']) 
            AND !empty($_POST['prenom']) 
            AND !empty($_POST['email'])
            AND !empty($_POST['profil'])
            AND !empty($_POST['mdp'])){

//verifier si les deux mots de passe sont identique
                        if(($_POST['mdp'])!=($_POST['confirmemdp'])){
                            $erreur="Les deux mots de pass doivent etre identiques ";
                        }
                        else{
// enlevez les eventuelles balises HTML pour se proteger des failles avec la fonction php (htmlspecialchars)
//creation des variables intermediaires pour toutes le colonnes 
                $nom =htmlspecialchars($_POST['nom']);
                $prenom =htmlspecialchars($_POST['prenom']);
                $email =htmlspecialchars($_POST['email']);
                $profil =htmlspecialchars($_POST['profil']);
                $mdp =htmlspecialchars($_POST['mdp']); 
// requette SQL permettant de verifier si l'email ne se trouve pas dans le site 

                $verification= $PDO->prepare('SELECT email FROM adherent WHERE email = ?');
                $verification->execute(array($email));

// si l'email n'est pas dans le site , je l'inscrit 
                        if($verification->rowCount()==0){

                        $sqlQuery=('INSERT INTO adherent(nom,prenom,email,mdp,profil)
                        VALUES(:nom,:prenom,:email,:mdp,:profil)');
                        $insertionUsers=$PDO->prepare($sqlQuery);
                        $insertionUsers->execute([
                                    'nom'=>$nom,
                                    'prenom'=>$prenom,
                                    'email'=>$email,
                                    'mdp'=>$mdp,
                                    'profil'=>$profil]);
//requette SQL permettant de recuperer l'adherent qui vient de s'inscrire 

                        $infoUsers= $PDO->prepare('SELECT * FROM adherent WHERE nom = ? AND prenom = ? 
                            AND  email = ?');
                        $infoUsers->execute(array($nom,$prenom,$email));
//stocker les informations dans ($info)
                         $info=$infoUsers->fetch();
//variables de sessions permettent l'adherent de naviguer sur toutes les pages 
                        $_SESSION['auth']=true;
                        $_SESSION['idAdherent']=$info['idAdherent'];
                        $_SESSION['nom']=$info['nom'];
                        $_SESSION['prenom']=$info['prenom'];
                        $_SESSION['email']=$info['email'];
                        $_SESSION['idAdherent']=$info['idAdherent'];
// une fois l'inscription puis  la connexion reussi,
// je le redirige sur la page d'acceuil qui a pour nom (tontine.php)

                        header('Location: acceuil.php');  }
               else{
// si l'email entré existe dans le site  ce message s'affichera sur la page 
            $erreur="L'utilisateur existe deja sur le site ";  }
            }
    }else{
// si tous les champs ne sont pas remplis  , je cree une variable $erreur qui sera 
//affichée dans la page de connexion 
  $erreur="Veuillez completer tous les champs... ";
}
}

}

$PDO = new PDO(DB_DSN, DB_USER, DB_PASS, $options);
validate($PDO);