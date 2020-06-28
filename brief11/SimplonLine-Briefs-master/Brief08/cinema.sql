/* CREATION DE DB*/

create database db_cinema;
use db_cinema;

/* creation d'un utilisateur avec un accès de la lecture seulement*/

create user 'viewer'@'localhost';
alter user 'viewer'@'localhost' IDENTIFIED BY 'test123';
grant select on db_cinema.* to 'viewer'@'localhost';

/* Affichage */

select * from Cinema;

/* Insertion */

insert into Cinema (id,nom,adresse) values(1,'Cinema Atlas','El hanaa Qu Bab Laarbi Tafillalte');
insert into Cinema (id,nom,adresse) values(2,'Cinema Jawhara','El karame Qu Mohammed 6 Dakhla');

/* Modification */

update Cinema set adresse = 'El karame Qu Mohammed 5 Dakhla' where id = 2;

/* Suppression  */

delete from Cinema where id = 1;

/*==============================================================*/
/* Nom de SGBD :  MySQL 5.0                                     */
/* Date de création :  4/26/2020 11:32:27 PM                    */
/*==============================================================*/


drop table if exists Appartient;

drop table if exists Cinema;

drop table if exists Film;

drop table if exists Genre;

drop table if exists Projection;

drop table if exists Salle;

/*==============================================================*/
/* Table : Appartient                                           */
/*==============================================================*/
create table Appartient
(
   id                   varchar(254),
   Gen_id               int
);

/*==============================================================*/
/* Table : Cinema                                               */
/*==============================================================*/
create table Cinema
(
   id                   int not null,
   nom                  varchar(254),
   adresse              varchar(254),
   primary key (id)
);

/*==============================================================*/
/* Table : Film                                                 */
/*==============================================================*/
create table Film
(
   id                   varchar(254) not null,
   titre                int,
   evaluation           int,
   duration             int,
   dateDeSortie         datetime,
   primary key (id)
);

/*==============================================================*/
/* Table : Genre                                                */
/*==============================================================*/
create table Genre
(
   id                   int not null,
   libelle              varchar(254),
   description          varchar(254),
   primary key (id)
);

/*==============================================================*/
/* Table : Projection                                           */
/*==============================================================*/
create table Projection
(
   id                   int,
   Fil_id               varchar(254),
   projection           datetime
);

/*==============================================================*/
/* Table : Salle                                                */
/*==============================================================*/
create table Salle
(
   id                   int not null,
   nombresDeChaises     int,
   primary key (id)
);

alter table Appartient add constraint FK_Association_3 foreign key (id)
      references Film (id) on delete restrict on update restrict;

alter table Appartient add constraint FK_Association_4 foreign key (Gen_id)
      references Genre (id) on delete restrict on update restrict;

alter table Projection add constraint FK_Association_1 foreign key (Fil_id)
      references Film (id) on delete restrict on update restrict;

alter table Projection add constraint FK_Association_1 foreign key (id)
      references Salle (id) on delete restrict on update restrict;

alter table Salle add constraint FK_Association_2 foreign key (id)
      references Cinema (id) on delete restrict on update restrict;

/* TESTING */

