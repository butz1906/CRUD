#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: objet
#------------------------------------------------------------

CREATE TABLE objet(
        id_objet Int  Auto_increment  NOT NULL ,
        titre    Varchar (255) NOT NULL,
        format   Varchar (50) NOT NULL,
	CONSTRAINT objet_PK PRIMARY KEY (id_objet)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: inscrit
#------------------------------------------------------------

CREATE TABLE inscrit(
        id_inscrit Int  Auto_increment  NOT NULL ,
        nom        Varchar (50) NOT NULL ,
        prenom     Varchar (50) NOT NULL,
	CONSTRAINT inscrit_PK PRIMARY KEY (id_inscrit)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: emprunter
#------------------------------------------------------------

CREATE TABLE emprunter(
        id_inscrit   Int NOT NULL ,
        id_objet     Int NOT NULL ,
        date_emprunt Date NOT NULL ,
        date_retour  Date NOT NULL,
	CONSTRAINT emprunter_PK PRIMARY KEY (id_inscrit,id_objet,date_emprunt),
	CONSTRAINT emprunter_inscrit_FK FOREIGN KEY (id_inscrit) REFERENCES inscrit(id_inscrit),
	CONSTRAINT emprunter_objet_FK FOREIGN KEY (id_objet) REFERENCES objet(id_objet)
)ENGINE=InnoDB;
