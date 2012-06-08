<?php
  require('class_PostgreConnection.php');
  
  class db_request extends PostgreConnection{
    
    /* --- Utilisateurs --- */    
    /* Renvoie un/des utilisateur(s) */
    public function getUser($id=''){
      // Code de la methode final
          $donnees;

          if(!empty($id)){
            $req = $this->bdd->prepare('SELECT idUtilisateur,nomUtilisateur,prenomUtilisateur,mailUtilisateur,mailUtilisateur AS login,nomDroit AS right FROM UTILISATEURS INNER JOIN DROITS ON RefDroit=IdDroit WHERE idUtilisateur = :idUser');
            $req->bindValue(':idUser', $id, PDO::PARAM_INT);
            $req->execute();
            $donnees = $req->fetch();
          }

          else{
            $req = $this->bdd->query('SELECT idUtilisateur,refDroit,nomUtilisateur,prenomUtilisateur,mailUtilisateur,mdpUtilisateur,nomDroit AS right FROM UTILISATEURS INNER JOIN DROITS ON RefDroit=IdDroit');
            $donnees = $req->fetchAll();
          }

        return $donnees;
    }

    /* Ajoute, modifie, ou supprime un utilisateur */
    public function setUser($id){
      /* code SQL */
    }

    /* Renvoie le hash du password et l'id de l'email passé en argument */
    public function getPassword($email){
      // Code de la methode final
        $req = $this->bdd->prepare('SELECT idUtilisateur, mdpUtilisateur FROM UTILISATEURS where mailUtilisateur = :email');
        $req->bindValue(':email', $email, PDO::PARAM_STR);
        $req->execute();

        return $req->fetch();
    }   

    /* --- Evènements --- */
    /* Renvoie un/des évenement(s) */
    public function getEvent($id='vide'){
      // Code de la methode final
          $donnees;

          if($id != 'vide'){
            $req = $this->bdd->prepare('SELECT idEvenement,refSession,nomEvenement,descEvenement,dateDebutEvenement,dateFinEvenement,emplacementEvenement FROM EVENEMENTS WHERE idEvenement = :idEvent');
            $req->bindValue(':idEvent', $id, PDO::PARAM_INT);
            $req->execute();
            $donnees = $req->fetch();
          }

          else{
            $req = $this->bdd->query('SELECT idEvenement,refSession,nomEvenement,descEvenement,dateDebutEvenement,dateFinEvenement,emplacementEvenement FROM EVENEMENTS');
            $donnees = $req->fetchAll();
          }
        return $donnees;
    }

    /* Renvoie un/des évenement(s) avec leur nombre d'inscrits */
    public function getEventWithNbInscrit($id='vide'){
      // Code de la methode final
          $donnees;

          if($id != 'vide'){
            $req = $this->bdd->prepare('SELECT idEvenement,refSession,nomEvenement,descEvenement,dateDebutEvenement,dateFinEvenement,emplacementEvenement, COUNT(*) AS nbInscrit FROM EVENEMENTS INNER JOIN PARTICIPER ON PARTICIPER.idRefEvenement = EVENEMENTS.idEvenement WHERE idEvenement= :idEvent GROUP BY idEvenement,refSession,nomEvenement,descEvenement,dateDebutEvenement,dateFinEvenement,emplacementEvenement;');
            $req->bindValue(':idEvent', $id, PDO::PARAM_INT);
            $req->execute();
            $donnees = $req->fetch();
          }

          else{
            $req = $this->bdd->query('SELECT idEvenement,refSession,nomEvenement,descEvenement,dateDebutEvenement,dateFinEvenement,emplacementEvenement, COUNT(*) AS nbInscrit FROM EVENEMENTS INNER JOIN PARTICIPER ON PARTICIPER.idRefEvenement = EVENEMENTS.idEvenement GROUP BY idEvenement,refSession,nomEvenement,descEvenement,dateDebutEvenement,dateFinEvenement,emplacementEvenement');
            $donnees = $req->fetchAll();
          }

        return $donnees;
    }

    /* Renvoie tout les évènements d'une session */
    public function getEventsFromSession($id){
      // Code de la methode final
          $donnees;

          $req = $this->bdd->prepare('SELECT idEvenement,refSession,nomEvenement,descEvenement,dateDebutEvenement,dateFinEvenement,emplacementEvenement FROM EVENEMENTS WHERE refSession = :idSession');
          $req->bindValue(':idSession', $id, PDO::PARAM_INT);
          $req->execute();
          $donnees = $req->fetchAll();

        return $donnees;
    }

    /* Renvoie tout les évènements d'une session avec leur nombre d'inscrits */
    public function getEventsFromSessionWithNbInscrit($idSession){
      // Code de la methode final
          $donnees;

          $req = $this->bdd->prepare('SELECT idEvenement,refSession,nomEvenement,descEvenement,dateDebutEvenement,dateFinEvenement,emplacementEvenement, COUNT(*) AS nbInscrit FROM EVENEMENTS LEFT OUTER JOIN PARTICIPER ON EVENEMENTS.idEvenement = PARTICIPER.idRefEvenement WHERE refSession = :idSession GROUP BY idEvenement,refSession,nomEvenement,descEvenement,dateDebutEvenement,dateFinEvenement,emplacementEvenement');
          $req->bindValue(':idSession', $idSession, PDO::PARAM_INT);
          $req->execute();
          $donnees = $req->fetchAll();

        return $donnees;
    }

    /* Ajoute, modifie, ou supprime un evenement */
    public function setEvent($id){
      /* code SQL */
    }

    /* Renvoie une/des collection(s) d'évenements */
    public function getSession($id='vide'){
      // Code de la methode final
          $donnees;

          if($id != 'vide'){
            $req = $this->bdd->prepare('SELECT idSession,refCreateur,nomSession,nbMaxInscritEvenement,nbMinParticipationEvenement,dateLimiteInscription,dateRappelMail FROM SESSIONS WHERE idSession= :idSession');
            $req->bindValue(':idSession', $id, PDO::PARAM_INT);
            $req->execute();
            $donnees = $req->fetch();
          }

          else{
            $req = $this->bdd->query('SELECT idSession,refCreateur,nomSession,nbMaxInscritEvenement,nbMinParticipationEvenement,dateLimiteInscription,dateRappelMail FROM SESSIONS');
            $donnees = $req->fetchAll();
          }

        return $donnees;
    }

    public function getSessionAndCreator(){
      $req = $this->bdd->query('SELECT idSession,prenomUtilisateur AS prenomCreateur,nomUtilisateur AS nomCreateur,nomSession,nbMaxInscritEvenement,nbMinParticipationEvenement,dateLimiteInscription,dateRappelMail FROM SESSIONS INNER JOIN UTILISATEURS ON refCreateur = idUtilisateur');
      
      $donnees = $req->fetchAll();

      return $donnees;
    }

    public function getSessionAndCreatorFromCreator($id){
      $req = $this->bdd->prepare('SELECT idSession,prenomUtilisateur AS prenomCreateur,nomUtilisateur AS nomCreateur,nomSession,nbMaxInscritEvenement,nbMinParticipationEvenement,dateLimiteInscription,dateRappelMail FROM SESSIONS INNER JOIN UTILISATEURS ON refCreateur = idUtilisateur WHERE refCreateur = :idUser');
      $req->bindValue(':idUser', $id, PDO::PARAM_INT);
      $req->execute();
      $donnees = $req->fetchAll();
      return $donnees;
    }

    public function getSessionPlace($id='vide'){
      $donnees;
      if($id != 'vide'){

      }

      else{
        $req = $this->bdd->query('SELECT idSession,nbMinParticipationEvenement,COUNT(*) FROM SESSIONS INNER JOIN EVENEMENTS ON RefSession=IdSession INNER JOIN PARTICIPER ON idEvenement=idRefEvenement WHERE PARTICIPER.IdRefUtilisateur=2 OR IdRefUtilisateur NOT IN (SELECT IdRefUtilisateur FROM PARTICIPER) GROUP BY idSession,nbMinParticipationEvenement');
        $donnees = $req->fetchAll();
      }

    }
    /* Ajoute, modifie, ou supprime une collection d'évenements */
    public function setSession($id){
      /* code SQL */
    }
    
    /* --- Sécurité --- */
    /* Renvoie le statut d'un utilisateur */
    public function getRight($id){      
      // Code de la methode final
          $donnees;
            
            $req = $this->bdd->prepare('SELECT nomDroit FROM DROITS INNER JOIN UTILISATEURS ON refDroit=idDroit WHERE idUtilisateur = :idUser');
            $req->bindValue(':idUser', $id, PDO::PARAM_INT);
            $req->execute();
            $donnees = $req->fetch();

        return $donnees;
    }

    public function setRight($id){
      /* code SQL */
    }

    public function getNbEventRegistered($id){
      // Code de la methode final
          $donnees;
            
            $req = $this->bdd->prepare('SELECT COUNT(*) FROM PARTICIPER WHERE idRefUtilisateur = :idUser');
            $req->bindValue(':idUser', $id, PDO::PARAM_INT);
            $req->execute();
            $donnees = $req->fetch();

        return $donnees;
    }

    public function getLastEvents($id){
      // Code de la methode final
          $donnees;

            $req = $this->bdd->prepare('SELECT NomEvenement, dateDebutEvenement, emplacementEvenement FROM EVENEMENTS INNER JOIN PARTICIPER ON idEvenement=idRefEvenement WHERE idRefUtilisateur = :idUser ORDER BY dateDebutEvenement LIMIT 3');
            $req->bindValue(':idUser', $id, PDO::PARAM_INT);
            $req->execute();
            $donnees = $req->fetchAll();

        return $donnees;
    }

    public function getEventsFromUser($id){
      // Code de la methode final
          $donnees;

            $req = $this->bdd->prepare('SELECT NomEvenement, dateDebutEvenement, emplacementEvenement FROM EVENEMENTS INNER JOIN PARTICIPER ON idEvenement=idRefEvenement WHERE idRefUtilisateur = :idUser ORDER BY dateDebutEvenement');
            $req->bindValue(':idUser', $id, PDO::PARAM_INT);
            $req->execute();
            $donnees = $req->fetchAll();

        return $donnees;
    }

    public function addEvent($valeur){
      $req = $this->bdd->prepare('INSERT INTO EVENEMENTS(refSession, nomEvenement, descEvenement, datedebutevenement, datefinevenement, emplacementEvenement) VALUES (:idSession, :titre, :description, :dateDebut, :dateFin, :emplacement)');
      $req->bindValue(':idSession', $valeur['idSession'], PDO::PARAM_INT);
      $req->bindValue(':titre', $valeur['titre'], PDO::PARAM_STR);
      $req->bindValue(':description', $valeur['description'], PDO::PARAM_STR);
      $req->bindValue(':dateDebut', $valeur['dateDebut'], PDO::PARAM_STR);
      $req->bindValue(':dateFin', $valeur['dateFin'], PDO::PARAM_STR);
      $req->bindValue(':emplacement', $valeur['emplacement'], PDO::PARAM_STR);
      $req->execute();
    }

    public function getRegisteredEventPerSession($idUser, $idSession){
      $donnees;
      $req = $this->bdd->prepare('SELECT COUNT(*) FROM EVENEMENTS INNER JOIN SESSIONS ON IdSession = RefSession INNER JOIN PARTICIPER ON idEvenement=idRefEvenement WHERE idRefUtilisateur = :idUser AND idSession = :idSession');
      $req->bindValue(':idUser', $idUser, PDO::PARAM_INT);
      $req->bindValue(':idSession', $idSession, PDO::PARAM_INT);
      $req->execute();
      $donnees = $req->fetch();
      return $donnees;
    }

    public function getRegisteredFromEvent($idUser, $idEvent){
      $donnees;
      $req = $this->bdd->prepare('SELECT COUNT(*) FROM PARTICIPER WHERE idRefEvenement = :idEvent AND idRefUtilisateur = :idUser');
      $req->bindValue(':idUser', $idUser, PDO::PARAM_INT);
      $req->bindValue(':idEvent', $idEvent, PDO::PARAM_INT);
      $req->execute();
      $donnees = $req->fetch();
      return $donnees;
    }

    public function addRegisteredFromEvent($idUser, $idEvent){
      
      $req = $this->bdd->prepare('INSERT INTO PARTICIPER (idRefEvenement, idRefUtilisateur) VALUES (:idEvent,:idUser)');
      $req->bindValue(':idUser', $idUser, PDO::PARAM_INT);
      $req->bindValue(':idEvent', $idEvent, PDO::PARAM_INT);
      $req->execute();
    }

    public function removeRegisteredFromEvent($idUser, $idEvent){
      $req = $this->bdd->prepare('DELETE FROM PARTICIPER WHERE idRefEvenement = :idEvent AND idRefUtilisateur = :idUser');
      $req->bindValue(':idUser', $idUser, PDO::PARAM_INT);
      $req->bindValue(':idEvent', $idEvent, PDO::PARAM_INT);
      $req->execute();
    }
  }
