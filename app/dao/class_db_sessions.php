<?php  
  class db_sessions extends PostgreConnection{

    /**
    * Methode retournant une session
    * @param $idSession id de la session
    * @return array id de de la session
    */
    public function getSession($idSession){
      $req = $this->bdd->prepare('SELECT idSession,refCreateur,nomSession,nbMaxInscritEvenement,nbMinParticipationEvenement,dateLimiteInscription,dateRappelMail FROM SESSIONS WHERE idSession= :idSession');
      $req->bindValue(':idSession', $idSession, PDO::PARAM_INT);
      $req->execute();
      return $req->fetch();
    }

    /**
    * Methode retournant toutes les sessions
    * @return array liste des session
    */
    public function getAllSession(){
      $req = $this->bdd->query('SELECT idSession,refCreateur,nomSession,nbMaxInscritEvenement,nbMinParticipationEvenement,dateLimiteInscription,dateRappelMail FROM SESSIONS');
      return $req->fetchAll();
    }

    /**
    * Methode retournant toutes les sessions et leurs créateur
    * @return liste des session
    */
    public function getAllSessionAndCreator(){
      $req = $this->bdd->query('SELECT idSession,prenomUtilisateur AS prenomCreateur,nomUtilisateur AS nomCreateur,nomSession,nbMaxInscritEvenement,nbMinParticipationEvenement,dateLimiteInscription,dateRappelMail FROM SESSIONS INNER JOIN UTILISATEURS ON refCreateur = idUtilisateur');
      return $req->fetchAll();;
    }

    /**
    * Liste des sessions crée par un utilisateur
    * @param $idUser
    * @return array liste des sessions
    */
    public function getSessionAndCreatorFromCreator($idUser){
      $req = $this->bdd->prepare('SELECT idSession,prenomUtilisateur AS prenomCreateur,nomUtilisateur AS nomCreateur,nomSession,nbMaxInscritEvenement,nbMinParticipationEvenement,dateLimiteInscription,dateRappelMail FROM SESSIONS INNER JOIN UTILISATEURS ON refCreateur = idUtilisateur WHERE refCreateur = :idUser');
      $req->bindValue(':idUser', $idUser, PDO::PARAM_INT);
      $req->execute();
      return $req->fetchAll();
    }

    /**
    * Méthode retourne la liste des sessions avec le nombre évènement auquelle l'utilisateur est incrit
    * @param $idUser id de l'utilisateur
    * @return array liste des session
    * NE MARCHE PAS !
    */
    public function getSessionPlace($id='vide'){
        $req = $this->bdd->query('SELECT idSession,nbMinParticipationEvenement,COUNT(*) FROM SESSIONS INNER JOIN EVENEMENTS ON RefSession=IdSession INNER JOIN PARTICIPER ON idEvenement=idRefEvenement WHERE PARTICIPER.IdRefUtilisateur=2 OR IdRefUtilisateur NOT IN (SELECT IdRefUtilisateur FROM PARTICIPER) GROUP BY idSession,nbMinParticipationEvenement');
        return $req->fetchAll();
    }

    /**
    * Ajoute une session
    * @param $data array info session
    * @return void
    */
    public function addSession($data){
      $req = $this->bdd->prepare('INSERT INTO SESSIONS(refCreateur, nomSession, nbMaxInscritEvenement, nbMinParticipationEvenement, dateLimiteInscription, dateRappelMail) VALUES (:idUser , :nomSession , :maxInscrit, :minParticipation , :dateLimite , :dateRappel)');
      $req->bindValue(':idUser', $data['idCreateur'], PDO::PARAM_INT);
      $req->bindValue(':nomSession', $data['nomSession'], PDO::PARAM_STR);
      $req->bindValue(':maxInscrit', $data['maxInscrit'], PDO::PARAM_INT);
      $req->bindValue(':minParticipation', $data['minParticipation'], PDO::PARAM_INT);
      $req->bindValue(':dateLimite', $data['dateLimite'], PDO::PARAM_STR);
      $req->bindValue(':dateRappel', $data['dateRappel'], PDO::PARAM_STR);
      $req->execute();
    }

    /**
    * Modifie une session
    * @param $data array info de la session mise a jour
    * @return void
    */
    public function updateSession($data){
      $req = $this->bdd->prepare('UPDATE SESSIONS SET refCreateur = :idUser, nomSession = :nomSession, nbMaxInscritEvenement = :maxInscrit, nbMinParticipationEvenement = :minParticipation, dateLimiteInscription = :dateLimite, dateRappelMail = :dateRappel WHERE idSession = :idSession');
      $req->bindValue(':idUser', $data['idCreateur'], PDO::PARAM_INT);
      $req->bindValue(':nomSession', $data['nomSession'], PDO::PARAM_STR);
      $req->bindValue(':maxInscrit', $data['maxInscrit'], PDO::PARAM_INT);
      $req->bindValue(':minParticipation', $data['minParticipation'], PDO::PARAM_INT);
      $req->bindValue(':dateLimite', $data['dateLimite'], PDO::PARAM_STR);
      $req->bindValue(':dateRappel', $data['dateRappel'], PDO::PARAM_STR);
      $req->blindValue(':idSession', $data['idSession'], PDO::PARAM_INT);
      $req->execute();
    }

    /**
    * Supprime une session
    * @param $idSession id de la session à supprimer
    * @return void
    */
    public function removeSession($idSession){
      $req = $this->bdd->prepare('DELETE FROM SESSIONS WHERE idSession = :idSession');
      $req->bindValue(':idSession', $idSession, PDO::PARAM_INT);
      $req->execute();
    }
    
  }
