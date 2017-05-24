#------------------------------------------------------------
#        Script Postgre : création des tables
#------------------------------------------------------------


#------------------------------------------------------------
# Table: utilisateur
#------------------------------------------------------------

CREATE TABLE utilisateur (
    idUtilisateur SERIAL PRIMARY KEY NOT NULL,
    pseudo VARCHAR(20),
    mdp TEXT
);

#------------------------------------------------------------
# Table: pays
#------------------------------------------------------------

CREATE TABLE pays (
    idPays SERIAL PRIMARY KEY NOT NULL,
    nomPays VARCHAR(50)
);

#------------------------------------------------------------
# Table: ville
#------------------------------------------------------------

CREATE TABLE ville (
    idVille SERIAL PRIMARY KEY NOT NULL,
    nomVille VARCHAR(50),
    idPays INT REFERENCES pays(idPays)
);


#------------------------------------------------------------
# Table: catégorie
#------------------------------------------------------------

CREATE TABLE categorie (
    idCategorie SERIAL PRIMARY KEY NOT NULL,
    nomCategorie VARCHAR(50)
);

#------------------------------------------------------------
# Table: photo
#------------------------------------------------------------

CREATE TABLE photo(
    idPhoto SERIAL PRIMARY KEY NOT NULL,
    titre VARCHAR(100),
    description VARCHAR(500),
    urlFull VARCHAR(200),
    urlThumb VARCHAR(200),
    latitude INT,
    longitude INT,
    idUtilisateur INT REFERENCES utilisateur(idUtilisateur),
    idCategorie INT REFERENCES categorie(idCategorie),
    idVille INT REFERENCES ville(idVille)
);
