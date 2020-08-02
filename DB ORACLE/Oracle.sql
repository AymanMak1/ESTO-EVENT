/*==============================================================*/
/* Table : DEPARTEMENT                                          */
/*==============================================================*/
create table DEPARTEMENT 
(
   ID_DEPARTEMENT       NUMBER               not null,
   NOMDEPT              VARCHAR2(55),
   constraint PK_DEPARTEMENT primary key (ID_DEPARTEMENT)
);

/*==============================================================*/
/* Table : ETUDIANT                                             */
/*==============================================================*/
create table ETUDIANT 
(
   ID_ETUDIANT          NUMBER               not null,
   EMAIL                VARCHAR2(55),
   NOMETUD              VARCHAR2(30),
   PRENOMETUD           VARCHAR2(20),
   MOTDEPASSE           VARCHAR2(30),
   constraint PK_ETUDIANT primary key (ID_ETUDIANT)
);

/*==============================================================*/
/* Table : EVENEMENT                                            */
/*==============================================================*/
create table EVENEMENT 
(
   ID_EVENEMENT         NUMBER               not null,
   ID_PROFESSEUR        NUMBER               not null,
   ID_DEPARTEMENT       NUMBER               not null,
   SUJET                VARCHAR2(55),
   DESCRIPTION          VARCHAR2(255),
   PHOTOEVENT           VARCHAR2(255),
   DATEDEBUT            DATE,
   DATEFIN              DATE,
   constraint PK_EVENEMENT primary key (ID_EVENEMENT)
);

/*==============================================================*/
/* Index : ORGANISER_FK                                         */
/*==============================================================*/
create index ORGANISER_FK on EVENEMENT (
   ID_PROFESSEUR ASC
);

/*==============================================================*/
/* Index : PLANIFIER_FK                                         */
/*==============================================================*/
create index PLANIFIER_FK on EVENEMENT (
   ID_DEPARTEMENT ASC
);

/*==============================================================*/
/* Table : PROFESSEUR                                           */
/*==============================================================*/
create table PROFESSEUR 
(
   ID_PROFESSEUR        NUMBER               not null,
   ID_DEPARTEMENT       NUMBER               not null,
   NOMPROF              VARCHAR2(30),
   PRENOMPROF           VARCHAR2(20),
   DISCIPLINE           VARCHAR2(30),
   MOTDEPASSE           VARCHAR2(30),
   PHOTOPROF            VARCHAR2(255),
   constraint PK_PROFESSEUR primary key (ID_PROFESSEUR)
);

/*==============================================================*/
/* Index : APPARTENIR_FK                                        */
/*==============================================================*/
create index APPARTENIR_FK on PROFESSEUR (
   ID_DEPARTEMENT ASC
);

alter table EVENEMENT
   add constraint FK_EVENEMEN_ORGANISER_PROFESSE foreign key (ID_PROFESSEUR)
      references PROFESSEUR (ID_PROFESSEUR);

alter table EVENEMENT
   add constraint FK_EVENEMEN_PLANIFIER_DEPARTEM foreign key (ID_DEPARTEMENT)
      references DEPARTEMENT (ID_DEPARTEMENT);
des
alter table PROFESSEUR
   add constraint FK_PROFESSE_APPARTENI_DEPARTEM foreign key (ID_DEPARTEMENT)
      references DEPARTEMENT (ID_DEPARTEMENT);




*********************************Sequences*************************************

***********ID_ETUDIANT SEQUENCE*****************

CREATE SEQUENCE ID_Etudiant_seq
 START WITH     1
 INCREMENT BY   1
 NOCACHE
 NOCYCLE;

 ***********ID_Professeur SEQUENCE*****************
CREATE SEQUENCE ID_Professeur_seq
 START WITH     1
 INCREMENT BY   1
 NOCACHE
 NOCYCLE;

***********ID_Evenement SEQUENCE*****************

CREATE SEQUENCE ID_Evenement_seq
 START WITH     1
 INCREMENT BY   1
 NOCACHE
 NOCYCLE;

***********ID_Deprtement SEQUENCE*****************

CREATE SEQUENCE ID_Departement_seq
 START WITH     1
 INCREMENT BY   1
 NOCACHE
 NOCYCLE;