<?php  
  class db_events extends PostgreConnection{
    
    /**
    * Methode retournant un evenement
    * @param $idEvent
    * @return array
    */
    public function getEvent($idEvent){
      $req = $this->bdd->prepare('SELECT idEvenement,refSession,nomEvenement,descEvenement,dateDebutEvenement,dateFinEvenement,emplacementEvenement FROM EVENEMENTS WHERE idEvenement = :idEvent');
      $req->bindValue(':idEvent', $idEvent, PDO::PARAM_INT);
      $req->execute();
      return $req->fetch();
    }

    /**
    * Methode retournant un évènement avec le nombre d'inscrit
    * @param $idEvent
    * @return array
    */
    public function getEventWithNbInscrit($idEvent){
      $req = $this->bdd->prepare('SELECT idEvenement,refSession,nomEvenement,descEvenement,dateDebutEvenement,dateFinEvenement,emplacementEvenement, COUNT(idRefUtilisateur) AS nbInscrit FROM EVENEMENTS LEFT OUTER JOIN PARTICIPER ON PARTICIPER.idRefEvenement = EVENEMENTS.idEvenement WHERE idEvenement = :idEvent GROUP BY idEvenement,refSession,nomEvenement,descEvenement,dateDebutEvenement,dateFinEvenement,emplacementEvenement');
      $req->bindValue(':idEvent', $idEvent, PDO::PARAM_INT);
      $req->execute();
      return $req->fetch();
    }

    /**
    * Methode retournant le nom et le prénom de tous les inscrits a un évènement pour une session donné
    * @param $idSession
    * @return array
    */
    public function getInfoInscritFromSession($idSession){
      $req = $this->bdd->prepare('SELECT idEvenement, nomUtilisateur, prenomUtilisateur FROM UTILISATEURS INNER JOIN PARTICIPER ON idRefUtilisateur = idUtilisateur INNER JOIN EVENEMENTS ON idRefEvenement = idEvenement WHERE refSession = :idSession');
      $req->bindValue(':idSession', $idSession, PDO::PARAM_INT);
      $req->execute();
      return $req->fetchAll();
    }

    /**
    * Methode retournant le nom et les heures d'un event et le nom de sa session
    * @param $idSession
    * @return array
    */
    public function getEventAndNomSession($idSession){
      $req = $this->bdd->prepare('SELECT idEvenement, nomEvenement, datedebutevenement, datefinevenement ,nomSession FROM EVENEMENTS INNER JOIN SESSIONS ON refSession = idSession WHERE idSession=:idSession');
      $req->bindValue(':idSession', $idSession, PDO::PARAM_INT);
      $req->execute();
      return $req->fetchAll();
    }

    /**
    * Methode retournant tous les évènement d'une session
    * @param $idSession
    * @return array
    */
    public function getEventsFromSession($idSession){
      $req = $this->bdd->prepare('SELECT idEvenement,refSession,nomEvenement,descEvenement,dateDebutEvenement,dateFinEvenement,emplacementEvenement FROM EVENEMENTS WHERE refSession = :idSession ORDER BY nomEvenement ASC');
      $req->bindValue(':idSession', $idSession, PDO::PARAM_INT);
      $req->execute();
      return $req->fetchAll();
    }

    /**
    * Methode retournant la date limite d'incription a un évènement
    * @param $idSession
    * @return array
    */
    public function getDateLimiteInscriptionFromSession($idSession){
      $req = $this->bdd->prepare('SELECT dateLimiteInscription FROM SESSIONS WHERE idSession = :idSession');
      $req->bindValue(':idSession', $idSession, PDO::PARAM_INT);
      $req->execute();
      return $req->fetch();
    }

    /**
    * Methode retournant tous les évènement d'une session et le nombre d'inscrit à chaque évènement
    * @param $idSession
    * @return array
    */
    public function getEventsFromSessionWithNbInscrit($idSession){
      $req = $this->bdd->prepare('SELECT idEvenement,refSession,nomEvenement,descEvenement,dateDebutEvenement,dateFinEvenement,emplacementEvenement, COUNT(idRefUtilisateur) AS nbInscrit FROM EVENEMENTS LEFT OUTER JOIN PARTICIPER ON PARTICIPER.idRefEvenement = EVENEMENTS.idEvenement WHERE refSession= :idSession GROUP BY idEvenement,refSession,nomEvenement,descEvenement,dateDebutEvenement,dateFinEvenement,emplacementEvenement ORDER BY nomEvenement ASC');
      $req->bindValue(':idSession', $idSession, PDO::PARAM_INT);
      $req->execute();
      return $req->fetchAll();
    }

    /**
    * Ajoute un évènement
    * @param array info de l'évènement
    * @return id de l'évènement ajouté
    */
    public function addEvent($data){
      $req = $this->bdd->prepare('INSERT INTO EVENEMENTS(refSession, nomEvenement, descEvenement, datedebutevenement, datefinevenement, emplacementEvenement) VALUES (:idSession, :titre, :description, :dateDebut, :dateFin, :emplacement) RETURNING idEvenement');
      $req->bindValue(':idSession', $data['idSession'], PDO::PARAM_INT);
      $req->bindValue(':titre', $data['titre'], PDO::PARAM_STR);
      $req->bindValue(':description', $data['description'], PDO::PARAM_STR);
      $req->bindValue(':dateDebut', $data['dateDebut'], PDO::PARAM_STR);
      $req->bindValue(':dateFin', $data['dateFin'], PDO::PARAM_STR);
      $req->bindValue(':emplacement', $data['emplacement'], PDO::PARAM_STR);
      $req->execute();
      return $req->fetch();
    }

    /**
    * Modifiquation d'un évènement
    * @param array info évènement mise a jour
    * @return void
    */
    public function updateEvent($data){
      $req = $this->bdd->prepare('UPDATE EVENEMENTS SET nomEvenement = :titre, descEvenement = :description, datedebutevenement = :dateDebut, datefinevenement = :dateFin, emplacementEvenement = :emplacement WHERE idEvenement = :idEvent');
      $req->bindValue(':titre', $data['titre'], PDO::PARAM_STR);
      $req->bindValue(':description', $data['description'], PDO::PARAM_STR);
      $req->bindValue(':dateDebut', $data['dateDebut'], PDO::PARAM_STR);
      $req->bindValue(':dateFin', $data['dateFin'], PDO::PARAM_STR);
      $req->bindValue(':emplacement', $data['emplacement'], PDO::PARAM_STR);
      $req->bindValue(':idEvent', $data['idEvenement'], PDO::PARAM_INT);
      $req->execute();
    }

    /**
    * Supprime un évènement
    * @param $idEvent
    * @return void
    */
    public function removeEvent($idEvent){
      $req = $this->bdd->prepare('DELETE FROM EVENEMENTS WHERE idEvenement = :idEvent');
      $req->bindValue(':idEvent', $idEvent, PDO::PARAM_INT);
      $req->execute();
    }

    /**
    * Methode retournant le nombre d'évènement auquelle l'utilisateur est inscrit
    * @param $idUser utilisateur a cherché
    * @return array
    */
    public function getNbEventRegistered($idUser){
      $req = $this->bdd->prepare('SELECT COUNT(*) FROM PARTICIPER WHERE idRefUtilisateur = :idUser');
      $req->bindValue(':idUser', $idUser, PDO::PARAM_INT);
      $req->execute();
      return $req->fetch();
    }

    /**
    * Methode retournant le nombre d'évènement auquelle l'utilisateur est inscrit et n'est pas encore passé
    * @param $idUser utilisateur a cherché
    * @return array
    */
    public function getNbEventRegisteredLast($idUser){
      $req = $this->bdd->prepare('SELECT COUNT(*) FROM PARTICIPER INNER JOIN EVENEMENTS ON idRefEvenement = idEvenement WHERE idRefUtilisateur = :idUser AND dateDebutEvenement >= NOW()');
      $req->bindValue(':idUser', $idUser, PDO::PARAM_INT);
      $req->execute();
      return $req->fetch();
    }

    /**
    * Methode retournant les trois prochain évènement trier par ordre chronologique
    * @param $idUser
    * @return array
    */
    public function getLastEvents($idUser){
      $req = $this->bdd->prepare('SELECT NomEvenement, dateDebutEvenement, emplacementEvenement FROM EVENEMENTS INNER JOIN PARTICIPER ON idEvenement=idRefEvenement WHERE idRefUtilisateur = :idUser AND dateDebutEvenement >= NOW() ORDER BY dateDebutEvenement LIMIT 3');
      $req->bindValue(':idUser', $idUser, PDO::PARAM_INT);
      $req->execute();
      return $req->fetchAll();
    }

    /**
    * Liste des évènements auquelle l'utilisateur est inscrit
    * @param $idUser id de l'utilisateur
    * @return array
    */
    public function getEventsFromUser($idUser){
      $req = $this->bdd->prepare('SELECT NomEvenement, dateDebutEvenement, emplacementEvenement FROM EVENEMENTS INNER JOIN PARTICIPER ON idEvenement=idRefEvenement WHERE idRefUtilisateur = :idUser ORDER BY dateDebutEvenement');
      $req->bindValue(':idUser', $idUser, PDO::PARAM_INT);
      $req->execute();
      return $req->fetchAll();
    }

    /**
    * Nombre d'évènement pour une session définie auquelle une personne est inscrite
    * @param $idUser id de l'utilisateur 
    * @param $idSession id de la session
    * @return array
    */
    public function getRegisteredEventPerSession($idUser, $idSession){
      $req = $this->bdd->prepare('SELECT COUNT(*) FROM EVENEMENTS INNER JOIN SESSIONS ON IdSession = RefSession INNER JOIN PARTICIPER ON idEvenement=idRefEvenement WHERE idRefUtilisateur = :idUser AND idSession = :idSession');
      $req->bindValue(':idUser', $idUser, PDO::PARAM_INT);
      $req->bindValue(':idSession', $idSession, PDO::PARAM_INT);
      $req->execute();
      return $req->fetch();
    }

    /**
    * Est-on inscrit a un évènement ?
    * @param $idUser id utilisateur
    * @param $idEvent id de l'évènement
    * @return array (bool 0:non ; 1:oui)
    */
    public function getRegisteredFromEvent($idUser, $idEvent){
      $req = $this->bdd->prepare('SELECT COUNT(*) FROM PARTICIPER WHERE idRefEvenement = :idEvent AND idRefUtilisateur = :idUser');
      $req->bindValue(':idUser', $idUser, PDO::PARAM_INT);
      $req->bindValue(':idEvent', $idEvent, PDO::PARAM_INT);
      $req->execute();
      return $req->fetch();
    }

    /**
    * Inscription à un évènement 
    * @param $idUser id de l'utilisateur
    * @param $idEvent id de l'évènement
    * @return void
    */
    public function addRegisteredFromEvent($idUser, $idEvent){
      $req = $this->bdd->prepare('INSERT INTO PARTICIPER (idRefEvenement, idRefUtilisateur) VALUES (:idEvent,:idUser)');
      $req->bindValue(':idUser', $idUser, PDO::PARAM_INT);
      $req->bindValue(':idEvent', $idEvent, PDO::PARAM_INT);
      $req->execute();
    }

    /**
    * Déinscription à un évènement
    * @param $idUser id de l'utilisateur
    * @param $idEvent id de l'évènement
    * @return void
    */
    public function removeRegisteredFromEvent($idUser, $idEvent){
      $req = $this->bdd->prepare('DELETE FROM PARTICIPER WHERE idRefEvenement = :idEvent AND idRefUtilisateur = :idUser');
      $req->bindValue(':idUser', $idUser, PDO::PARAM_INT);
      $req->bindValue(':idEvent', $idEvent, PDO::PARAM_INT);
      $req->execute();
    }

    /**
    * Methode retournant le résultat de la recherche
    * @param $search mots recherchés
    * @return array
    */
    public function searchEvents($search){

      $req = $this->bdd->prepare('SELECT NomEvenement, descEvenement, nbMaxInscritEvenement, count(idRefUtilisateur), idevenement, idSession FROM EVENEMENTS INNER JOIN PARTICIPER ON idEvenement = idRefEvenement INNER JOIN SESSIONS ON refSession = idSession WHERE lower(EVENEMENTS.nomEvenement) LIKE :search OR lower(EVENEMENTS.descEvenement) LIKE :search GROUP BY EVENEMENTS.idevenement, EVENEMENTS.NomEvenement, EVENEMENTS.descEvenement, SESSIONS.idSession, SESSIONS.nbMaxInscritEvenement, dateDebutEvenement ORDER BY dateDebutEvenement');
      $req->bindValue(':search', '%'.strtolower($search).'%', PDO::PARAM_STR);
      $req->execute();
      return $req->fetchAll();
    }

    /**
    * Methode retournant tous les events auquel un user a participé ou est inscrit
    * @param $user id de l'utilisateur
    * @return array
    */
    public function getParticipation($user){
      $req = $this->bdd->prepare('SELECT nomEvenement, nomSession, dateDebutEvenement FROM PARTICIPER INNER JOIN EVENEMENTS ON idRefEvenement = idEvenement INNER JOIN SESSIONS ON refSession = idSession WHERE idRefUtilisateur = :user');
      $req->bindValue(':user', $user, PDO::PARAM_STR);
      $req->execute();
      return $req->fetchAll();
    }
  }
