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
    * Methode retournant tous les évènement d'une session et les inscrit a chaque évènement
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
      $req = $this->bdd->prepare('INSERT INTO EVENEMENTS(refSession, nomEvenement, descEvenement, datedebutevenement, datefinevenement, emplacementEvenement) VALUES (:idSession, :titre, :description, :dateDebut, :dateFin, :emplacement)  RETURNING idEvenement');
      $req->bindValue(':idSession', $data['idSession'], PDO::PARAM_INT);
      $req->bindValue(':titre', $data['titre'], PDO::PARAM_STR);
      $req->bindValue(':description', $data['description'], PDO::PARAM_STR);
      $req->bindValue(':dateDebut', $data['dateDebut'], PDO::PARAM_STR);
      $req->bindValue(':dateFin', $data['dateFin'], PDO::PARAM_STR);
      $req->bindValue(':emplacement', $data['emplacement'], PDO::PARAM_STR);
      $req->execute();
      return $req->fetch();

      /*$req1 = $this->bdd->prepare('SELECT idEvenement FROM EVENEMENTS WHERE refSession = :idSession AND nomEvenement = :titre AND descEvenement = :description AND datedebutevenement = :dateDebut AND datefinevenement = :dateFin AND emplacementEvenement = :emplacement');
      $req1->bindValue(':idSession', $data['idSession'], PDO::PARAM_INT);
      $req1->bindValue(':titre', $data['titre'], PDO::PARAM_STR);
      $req1->bindValue(':description', $data['description'], PDO::PARAM_STR);
      $req1->bindValue(':dateDebut', $data['dateDebut'], PDO::PARAM_STR);
      $req1->bindValue(':dateFin', $data['dateFin'], PDO::PARAM_STR);
      $req1->bindValue(':emplacement', $data['emplacement'], PDO::PARAM_STR);
      $req1->execute();
      return $req1->fetch();
      echo serialize($tmp);
      return $tmp['idevenement'];*/
    }

    /**
    * Modifiquation d'un évènement
    * @param array info évènement mise a jour
    * @return void
    */
    public function updateEvent($data){
      $req = $this->bdd->prepare('UPDATE EVENEMENTS SET refSession = :idSession, nomEvenement = :titre, descEvenement = :description, datedebutevenement = :dateDebut, datefinevenement = :dateFin, emplacementEvenement = :emplacement WHERE idEvenement = :idEvent');
      $req->bindValue(':idSession', $data['idSession'], PDO::PARAM_INT);
      $req->bindValue(':titre', $data['titre'], PDO::PARAM_STR);
      $req->bindValue(':description', $data['description'], PDO::PARAM_STR);
      $req->bindValue(':dateDebut', $data['dateDebut'], PDO::PARAM_STR);
      $req->bindValue(':dateFin', $data['dateFin'], PDO::PARAM_STR);
      $req->bindValue(':emplacement', $data['emplacement'], PDO::PARAM_STR);
      $req->blindValue(':idEvent', $data['idEvenement'], PDO::PARAM_INT);
      $req->execute();
    }

    /**
    * Supprime un évènement
    * @param $idEvent
    * @return void
    */
    public function removeEvent($idEvent){
      $req = $this->bdd->prepare('DELETE FROM EVENEMENT WHERE idEvenement = :idEvent');
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
    * Nombre d'évènement pour une session définie auqelle une personne est inscrite
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
    * Est-on inscrit a un évènement
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
      $req = $this->bdd->prepare('SELECT EVENEMENTS.NomEvenement, EVENEMENTS.descEvenement, SESSIONS.nbMaxInscritEvenement, count(PARTICIPER.idRefUtilisateur) FROM EVENEMENTS INNER JOIN PARTICIPER ON idEvenement = idRefEvenement INNER JOIN SESSIONS ON refSession = idSession WHERE EVENEMENTS.nomEvenement LIKE :search OR EVENEMENTS.descEvenement LIKE :search GROUP BY EVENEMENTS.NomEvenement, EVENEMENTS.descEvenement, SESSIONS.nbMaxInscritEvenement, dateDebutEvenement ORDER BY dateDebutEvenement LIMIT 5');
      $req->bindValue(':search', '%'.$search.'%', PDO::PARAM_STR);
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
