CREATE DATABASE IF NOT EXISTS balderaouf CHARACTER SET utf8;

CREATE USER IF NOT EXISTS 'balderaouf'@'localhost' IDENTIFIED BY 'balderaouf';
GRANT ALL PRIVILEGES ON balderaouf.* TO 'balderaouf'@'localhost';

USE balderaouf;


CREATE TABLE IF NOT EXISTS  adherent (
  idAdherent int(11) NOT NULL AUTO_INCREMENT,
  nom varchar(50) NOT NULL,
  prenom varchar(50) NOT NULL,
  email varchar(40) NOT NULL,
  mdp varchar(56) NOT NULL,
  profil varchar(40) NOT NULL,
  PRIMARY KEY(idAdherent)

) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS articles (
    idarticle INT(11) NOT NULL AUTO_INCREMENT,
    titre text NOT NULL,
    description text NOT NULL,
    contenu text NOT NULL,
    date_publication text NOT NULL,
    idAuteur int(11) NOT NULL,
    PRIMARY KEY(idarticle ),
    FOREIGN KEY (`idAuteur`) REFERENCES `adherent` (`idAdherent`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



INSERT INTO `adherent` (`idAdherent`, `nom`, `prenom`, `email`, `mdp`, `profil`) VALUES
(1, 'ADMIN', 'Admin', 'admin@gmail', 'admin', 'Admin'),
(2, 'BALDE ', 'Ibrahima', 'balde@gmail', 'passer','Dévelopeur'),
(3, 'Bah', 'Amadou', 'bah@gmail', 'Amadou', 'Etudiant'),
(4, 'HAMBILI', 'Raouf', 'hambili@gmail', 'passer', 'Architecte');



INSERT INTO `articles` (`idarticle`, `titre`, `description`, `contenu`, `date_publication`, `idAuteur`) VALUES

(1, 'Devops', 'Virtualisation et Cloud', 'Conteneuriser une application web dynamique ','2023-01-22', 2),
(2, 'UML', 'Modelisation', 'Modeliser une application web via UML de structure de votre choix', '2023-01-03', 4),

(3, 'Php', 'Developement dynamique', 'Developper une  application web dynamique de gestion de logement','2023-01-22', 3),
(4, 'Memoire', 'Memoire de fin de formation', 'Conception et implementation dune application web de DON DE SANG pour une hopital','2023-01-22', 1);




