<?php  
  class db_users extends PostgreConnection{
    
    /**
    * Methode retournant tous les utilisateurs
    * @return array Liste des utilisateurs et de leurs droits
    */
    public function getAllUsers(){
      $req = $this->bdd->query('SELECT idUtilisateur,refDroit,nomUtilisateur,prenomUtilisateur,mailUtilisateur,mdpUtilisateur,nomDroit AS right FROM UTILISATEURS INNER JOIN DROITS ON RefDroit=IdDroit ORDER BY nomUtilisateur ASC');
      return $req->fetchAll();
    }
    
    /**
    * Methode retournant un utilisateur
    * @param $idUser L'utilisateur a cherché
    * @return array les info de l'utilisateur et son status (utilisateur, gestionnaire, admin)
    */

    public function getUser($idUser){
      $req = $this->bdd->prepare('SELECT idUtilisateur,nomUtilisateur,prenomUtilisateur,mailUtilisateur,mailUtilisateur AS login,nomDroit AS right FROM UTILISATEURS INNER JOIN DROITS ON RefDroit=IdDroit WHERE idUtilisateur = :idUser');
      $req->bindValue(':idUser', $idUser, PDO::PARAM_INT);
      $req->execute();
      return $req->fetch();
    }

    /**
    * Ajoute un utilisateur
    * @param $data array des info du l'utilisateur
    * @return void
    */
    public function addUser($data){
      $req = $this->bdd->prepare('INSERT INTO UTILISATEURS (nomUtilisateur, prenomUtilisateur, mailUtilisateur, mdputilisateur) VALUES (:nomUtilisateur, :prenomUtilisateur, :mailUtilisateur, :mdpUtilisateur) RETURNING codeconfirmationutilisateur');
      $req->bindValue(':nomUtilisateur', $data['nomUtilisateur'], PDO::PARAM_STR);  
      $req->bindValue(':prenomUtilisateur', $data['prenomUtilisateur'], PDO::PARAM_STR);  
      $req->bindValue(':mailUtilisateur', $data['mailUtilisateur'], PDO::PARAM_STR);    
      $req->bindValue(':mdpUtilisateur', $data['mdpUtilisateur'], PDO::PARAM_STR);    
      $req->execute();
      return $req->fetchColumn();
    }

    /**
    * Methode qui supprime un utilisateur
    * @param $idUser l'utilisateur a supprimé
    * @return void
    */
    public function removeUser($idUser){
      $req = $this->bdd->prepare('DELETE FROM UTILISATEURS WHERE idUtilisateur = :idUser');
      $req->bindValue(':idUser', $idUser, PDO::PARAM_INT);
      $req->execute();
    }

    /**
    * Modifie les info d'un utilisateur
    * @param $data array des info du l'utilisateur mise a jour
    * @return void
    */
    public function updateUser($data){
      $req = $this->bdd->prepare('UPDATE UTILISATEURS SET nomUtilisateur = :nomUtilisateur, prenomUtilisateur = :prenomUtilisateur, mailUtilisateur = :mailUtilisateur WHERE idUtilisateur=:idUtilisateur');
      $req->bindValue(':nomUtilisateur', $data['nomUtilisateur'], PDO::PARAM_STR);  
      $req->bindValue(':prenomUtilisateur', $data['prenomUtilisateur'], PDO::PARAM_STR);  
      $req->bindValue(':mailUtilisateur', $data['mailUtilisateur'], PDO::PARAM_STR);  
      $req->bindValue(':idUtilisateur', $data['idUtilisateur'], PDO::PARAM_INT);  
      $req->execute();
    }

    /**
    * Methode retournant le hash du password et l'idUtilisateur de l'email passé en argument
    * @param $email Adresse mail de l'utilisateur
    * @return array (idUtilisateur|hash mot de passe)
    */
    public function getPassword($email){
      $req = $this->bdd->prepare('SELECT idUtilisateur, mdpUtilisateur FROM UTILISATEURS where mailUtilisateur = :email');
      $req->bindValue(':email', $email, PDO::PARAM_STR);
      $req->execute();
      return $req->fetch();
    }   

    /**
    * Methode retournant les droit d'un utilisateur
    * @param $idUtilisateur l'id de l'utilisateur
    * @return array nome du droit de l'utilisateur
    */
    public function getRight($idUser){      
      $req = $this->bdd->prepare('SELECT nomDroit FROM DROITS INNER JOIN UTILISATEURS ON refDroit=idDroit WHERE idUtilisateur = :idUser');
      $req->bindValue(':idUser', $idUser, PDO::PARAM_INT);
      $req->execute();
      return $req->fetch();
    }

    /**
    * Confirme un utilisateur
    * @param $confirmCode code de confirmation
    * @return text
    */
    public function confirmUser($confirmCode){      
      $req = $this->bdd->prepare("UPDATE UTILISATEURS SET estvalideutilisateur = 'TRUE' WHERE codeconfirmationutilisateur = :codeconfirmation RETURNING idUtilisateur");
      $req->bindValue(':codeconfirmation', $confirmCode, PDO::PARAM_INT);
      $req->execute();
      return $req->fetchColumn();
    }

    /**
    * Modifie le droit d'un utilisateur
    * @param $idUser id de l'utilisateur a modifier
    * @param $refDroit
    * @return void
    */
    public function updateUserRight($idUser, $refDroit){
      $req = $this->bdd->prepare('UPDATE UTILISATEURS SET refDroit = :refDroit WHERE idUtilisateur = :idUser');
      $req->bindValue(':refDroit', $refDroit, PDO::PARAM_INT);
      $req->bindValue(':idUser', $idUser, PDO::PARAM_INT);
      $req->execute();
    }

    /**
    * Methode retournant le nom, le prenom et le nombre d'inscription manquante pour une session
    * @param $idSession
    * @return array
    */
    public function getRedUser($idSession){
      $req = $this->bdd->prepare('SELECT nomUtilisateur, prenomUtilisateur, nbminparticipationevenement-COUNT(idRefUtilisateur) as nbmanquante FROM UTILISATEURS LEFT OUTER JOIN PARTICIPER ON idRefUtilisateur = idUtilisateur  LEFT OUTER JOIN EVENEMENTS ON idRefEvenement = idEvenement LEFT OUTER JOIN SESSIONS ON refSession = idSession WHERE refSession = :idSession OR idUtilisateur NOT IN  (SELECT idRefUtilisateur FROM PARTICIPER  INNER JOIN EVENEMENTS ON idRefEvenement = idEvenement WHERE refSession = :idSession GROUP BY idRefUtilisateur) GROUP BY nomUtilisateur, prenomUtilisateur, nbminparticipationevenement HAVING (COUNT(idRefUtilisateur)-nbminparticipationevenement) < 0 OR COUNT(idRefUtilisateur) = 0 ORDER BY nomUtilisateur');
      $req->bindValue(':idSession', $idSession, PDO::PARAM_INT);
      $req->execute();
      return $req->fetchAll();
    }
  }
