DROP DATABASE IF EXISTS  BDPSI;
CREATE DATABASE BDPSI;
USE BDPSI;


DROP TABLE IF EXISTS Salle;
CREATE TABLE Salle(
id_salle BIGINT AUTO_INCREMENT,
numero_salle BIGINT,
capacite_salle BIGINT,
nb_postes BIGINT,
projecteur BOOL,
PRIMARY KEY (id_salle)
);


DROP TABLE IF EXISTS Type_Seance;
CREATE TABLE Type_Seance
(
id_type_seance BIGINT AUTO_INCREMENT,
libelle_type_seance VARCHAR(255) ,
PRIMARY KEY (id_type_seance)
);


DROP TABLE IF EXISTS Seance;
CREATE TABLE Seance
(
id_seance BIGINT AUTO_INCREMENT,
fid_salle BIGINT ,
fid_type_seance BIGINT ,
PRIMARY KEY (id_seance),
FOREIGN KEY (fid_salle) REFERENCES Salle(id_salle),
FOREIGN KEY (fid_type_Seance) REFERENCES Type_Seance(id_type_Seance)
);


DROP TABLE IF EXISTS Composante;
CREATE TABLE Composante
(
id_composante BIGINT AUTO_INCREMENT,
libelle_composante VARCHAR(255) ,
PRIMARY KEY (id_composante)
);


DROP TABLE IF EXISTS Formation;
CREATE TABLE Formation
(
id_formation BIGINT AUTO_INCREMENT,
libelle_formation VARCHAR(255) ,
VET VARCHAR(255) ,
fid_composante BIGINT,
PRIMARY KEY (id_formation),
FOREIGN KEY (fid_composante) REFERENCES Composante (id_composante)
);


DROP TABLE IF EXISTS Modalite;
CREATE TABLE Modalite
(
id_modalite BIGINT AUTO_INCREMENT,
libelle_modalite VARCHAR(255) ,
PRIMARY KEY (id_modalite)
);


DROP TABLE IF EXISTS Niveau;
CREATE TABLE Niveau
(
id_niveau BIGINT AUTO_INCREMENT,
libelle_niveau VARCHAR(255) ,
PRIMARY KEY (id_niveau)
);


DROP TABLE IF EXISTS Groupe;
CREATE TABLE Groupe
(
id_groupe BIGINT AUTO_INCREMENT,
libelle_groupe VARCHAR(255) ,
annee VARCHAR(255) ,
fid_formation BIGINT,
fid_modalite BIGINT,
fid_niveau BIGINT,
PRIMARY KEY (id_groupe),
FOREIGN KEY (fid_formation) REFERENCES Formation (id_formation),
FOREIGN KEY (fid_modalite) REFERENCES Modalite (id_modalite),
FOREIGN KEY (fid_niveau) REFERENCES Niveau (id_niveau)
);


DROP TABLE IF EXISTS Type_Individu;
CREATE TABLE Type_Individu
(
id_type_individu BIGINT,
libelle_type_individu VARCHAR(255) ,
PRIMARY KEY (id_type_individu)
);


DROP TABLE IF EXISTS Individu;
CREATE TABLE individu
(
id_individu BIGINT,
annuaire BIGINT,
nom_individu VARCHAR(255),
prenom_individu VARCHAR(255),
mail_individu VARCHAR(255),
tel_individu VARCHAR(255),
fid_type_individu BIGINT,
PRIMARY KEY (id_individu),
FOREIGN KEY (fid_type_individu) REFERENCES Type_Individu (id_type_individu)
);


DROP TABLE IF EXISTS Groupe_Individu;
CREATE TABLE Groupe_Individu
(
fid_groupe BIGINT,
fid_individu BIGINT,
PRIMARY KEY (fid_groupe, fid_individu),
FOREIGN KEY (fid_groupe) REFERENCES Groupe(id_groupe),
FOREIGN KEY (fid_individu) REFERENCES Individu(id_individu)
);


DROP TABLE IF EXISTS Cours;
CREATE TABLE Cours(
id_cours BIGINT AUTO_INCREMENT,
libelle_cours VARCHAR(255) ,
PRIMARY KEY (id_cours)
);


DROP TABLE IF EXISTS Seance_Groupe;
CREATE TABLE Seance_Groupe(
date_debut_seance DATETIME,
date_fin_seance DATETIME,
fid_seance BIGINT,
fid_groupe BIGINT,
fid_individu BIGINT,
fid_cours BIGINT,
PRIMARY KEY (fid_seance,fid_groupe, fid_individu,fid_cours),
FOREIGN KEY (fid_seance) REFERENCES Seance(id_seance),
FOREIGN KEY (fid_groupe) REFERENCES Groupe(id_groupe),
FOREIGN KEY (fid_individu) REFERENCES Individu(id_individu),
FOREIGN KEY (fid_cours) REFERENCES Cours(id_cours)
);


