-- Fichier de sample pour le dev
-- Droits
INSERT INTO DROITS (nomDroit) VALUES ('UTILISATEUR');
INSERT INTO DROITS (nomDroit) VALUES ('GESTIONNAIRE');
INSERT INTO DROITS (nomDroit) VALUES ('ADMIN');

-- Utilisateurs
INSERT INTO UTILISATEURS (refDroit, nomUtilisateur, prenomUtilisateur, mailUtilisateur, mdpUtilisateur) VALUES ('1', 'Moulin', 'Jean', 'jeanMoul@chut.com', '81dc9bdb52d04dc20036dbd8313ed055');
INSERT INTO UTILISATEURS (refDroit, nomUtilisateur, prenomUtilisateur, mailUtilisateur, mdpUtilisateur) VALUES ('1', 'Quiroule', 'Pierre', 'pierreQuir@chut.com', '81dc9bdb52d04dc20036dbd8313ed055');
INSERT INTO UTILISATEURS (refDroit, nomUtilisateur, prenomUtilisateur, mailUtilisateur, mdpUtilisateur) VALUES ('2', 'De Chateau', 'Mathieu', 'mathDechate@chut.com', '81dc9bdb52d04dc20036dbd8313ed055');
INSERT INTO UTILISATEURS (refDroit, nomUtilisateur, prenomUtilisateur, mailUtilisateur, mdpUtilisateur) VALUES ('3', 'Deschapeau', 'Yvan', 'yvanDeschap@chut.com', '81dc9bdb52d04dc20036dbd8313ed055');

-- Sessions
INSERT INTO SESSIONS (refCreateur, nomSession, nbMaxInscritEvenement, nbMinParticipationEvenement, dateLimiteInscription, dateRappelMail) VALUES ('3', 'Soutenances RT1', '8', '2', '23-jan-2013', '20-jan-2013');
INSERT INTO SESSIONS (refCreateur, nomSession, nbMaxInscritEvenement, nbMinParticipationEvenement, dateLimiteInscription, dateRappelMail) VALUES ('3', 'Soutenances RT2', '8', '2', '23-jan-2013', '20-jan-2013');

-- Associations Utilisateurs-Sessions
INSERT INTO AUS (idRefUtilisateur, idRefSession) VALUES ('3', '1');
INSERT INTO AUS (idRefUtilisateur, idRefSession) VALUES ('4', '2');

-- Evenements
INSERT INTO EVENEMENTS (refSession, nomEvenement, descEvenement, dateDebutEvenement, dateFinEvenement, emplacementEvenement) VALUES ('1', 'La fête de la patate', 'C\'est le jour où toutes les patates se retrouvent et dansent jusqu\'au bout de la nuit !', TIMESTAMP '20013-01-18 10:00:00', TIMESTAMP '20013-01-18 12:00:00', 'C251');
INSERT INTO EVENEMENTS (refSession, nomEvenement, descEvenement, dateDebutEvenement, dateFinEvenement, emplacementEvenement) VALUES ('1', 'Résolution dynamique du lien fort', 'Gestion d\'un lien fort entre deux base de donnée avec mise à jour dynamique et gestion des exeptions', TIMESTAMP '20013-01-17 10:00:00', TIMESTAMP '20013-01-18 12:00:00', 'C251');
INSERT INTO EVENEMENTS (refSession, nomEvenement, descEvenement, dateDebutEvenement, dateFinEvenement, emplacementEvenement) VALUES ('2', 'Parallélisme dans les clusters de calcule virtuels', 'Etude les mouvements de données dans les clusters de calcule virtualisé a l\'aide d\'un agent hyperviseur', TIMESTAMP '20013-01-18 14:00:00', TIMESTAMP '20013-01-18 14:30:00', 'C252');
INSERT INTO EVENEMENTS (refSession, nomEvenement, descEvenement, dateDebutEvenement, dateFinEvenement, emplacementEvenement) VALUES ('2', 'Exploration d\'espace hostils par robots autonome', 'Programation de robots permettant de cartographier en toute autonomie des milieux hostils. Récuperation des données sur grande distance (~100 km) via une technologie sans-fil', TIMESTAMP '20013-01-18 16:00:00', TIMESTAMP '20013-01-18 18:00:00', 'C251');

-- Participations
INSERT INTO PARTICIPER (idRefUtilisateur, idRefEvenement) VALUES ('1', '1');
INSERT INTO PARTICIPER (idRefUtilisateur, idRefEvenement) VALUES ('2', '1');
INSERT INTO PARTICIPER (idRefUtilisateur, idRefEvenement) VALUES ('1', '2');
INSERT INTO PARTICIPER (idRefUtilisateur, idRefEvenement) VALUES ('1', '4');
INSERT INTO PARTICIPER (idRefUtilisateur, idRefEvenement) VALUES ('1', '3');
