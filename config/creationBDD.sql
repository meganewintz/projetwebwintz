#------------------------------------------------------------
#        Script Postgre : création des tables
#------------------------------------------------------------


#------------------------------------------------------------
# Table: utilisateur
#------------------------------------------------------------

CREATE TABLE utilisateur (
    idUtilisateur SERIAL PRIMARY KEY NOT NULL,
    pseudo Varchar(20),
    mdp Varchar(20)
);

#------------------------------------------------------------
# Table: pays
#------------------------------------------------------------

CREATE TABLE pays (
    idPays SERIAL PRIMARY KEY NOT NULL,
    nomPays Varchar(50)
);

#------------------------------------------------------------
# Table: ville
#------------------------------------------------------------

CREATE TABLE ville (
    idVille SERIAL PRIMARY KEY NOT NULL,
    nomVille Varchar(50),
    idPays int REFERENCES pays(idPays)
);

#------------------------------------------------------------
# Table: position
#------------------------------------------------------------

CREATE TABLE position (
    idPosition SERIAL PRIMARY KEY NOT NULL,
    latitude decimal,
    longitude decimal,
    idVille int REFERENCES ville(idVille)
);

#------------------------------------------------------------
# Table: catégorie
#------------------------------------------------------------

CREATE TABLE categorie (
    idCategorie SERIAL PRIMARY KEY NOT NULL,
    nomCategorie Varchar(50)
);

#------------------------------------------------------------
# Table: photo
#------------------------------------------------------------

CREATE TABLE photo(
    idPhoto SERIAL PRIMARY KEY NOT NULL,
    titre Varchar(100),
    description Varchar(500),
    url Varchar(200),
    idUtilisateur int REFERENCES utilisateur(idUtilisateur),
    idCategorie int REFERENCES categorie(idCategorie),
    idPosition int REFERENCES position(idPosition)
);
