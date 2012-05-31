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
INSERT INTO SESSIONS (refCreateur, nomSession, nbMaxInscritEvenement, nbMinParticipationEvenement, dateLimiteInscription, dateRappelMail) VALUES ('2', 'Soutenances RT1', '8', '2', '23-jan-2013', '20-jan-2013');
INSERT INTO SESSIONS (refCreateur, nomSession, nbMaxInscritEvenement, nbMinParticipationEvenement, dateLimiteInscription, dateRappelMail) VALUES ('2', 'Soutenances RT2', '8', '2', '23-jan-2013', '20-jan-2013');

-- Associations Utilisateurs-Sessions
INSERT INTO AUS (idRefUtilisateur, idRefSession) VALUES ('1', '1');
INSERT INTO AUS (idRefUtilisateur, idRefSession) VALUES ('2', '1');
INSERT INTO AUS (idRefUtilisateur, idRefSession) VALUES ('1', '2');

-- Evenements
INSERT INTO EVENEMENTS (refSession, nomEvenement, dateEvenement, descEvenement, heureDebutEvenement, heureFinEvenement, emplacementEvenement) VALUES ('1', 'La fête de la patate', '18-jan-2013', 'C\'est le jour où toutes les patates se retrouvent et dansent jusqu\'au bout de la nuit !', TIMESTAMP '20013-01-18 10:00:00', TIMESTAMP '20013-01-18 12:00:00', 'C251');

-- Participations
INSERT INTO PARTICIPER (idRefUtilisateur, idRefEvenement) VALUES ('1', '1');
INSERT INTO PARTICIPER (idRefUtilisateur, idRefEvenement) VALUES ('2', '1');

