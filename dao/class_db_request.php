<?php
  require('class_pg_connect.php');
  
  class db_request extends PostgreConnection{
    
    /* --- Utilisateurs --- */    
    /* Renvoie un/des utilisateur(s) */
    public function getUser($id=''){
      
      /** Code de la methode final
          $donnees;

          if(!empty($id)){
            $req = $this->bdd->prepare('SELECT * FROM UTILISATEURS WHERE idUtilisateur = :idUser');
            $req->bindValue(':idUser', $id, PDO::PARAM_INT);
            $req->execute();
            $donnees = $req->fetch();
          }

          else{
            $req = $this->bdd->query('SELECT * FROM UTILISATEURS');
            while($champs = $req->fetch()){
            array_push($donnees, $champs);
            }
          }

        return $donnees;
      */

      /* Sample */
      $user0 = array('id' => 0, 'firstname' => 'Jean', 'lastname'=> 'Moulin', 'login' => 'jeanMoul', 'mail' => 'jeanMoul@chut.com', 'right' => $this->getRight(1));
      $user1 = array('id' => 1, 'firstname' => 'Pierre', 'lastname'=> 'Quiroule', 'login' => 'pierreQuir', 'mail' => 'pierreQuir@chut.com', 'right' => $this->getRight(2));
      $user2 = array('id' => 2, 'firstname' => 'Mathieu', 'lastname'=> 'De chateau', 'login' => 'mathDechate', 'mail' => 'mathDechate@chut.com', 'right' => $this->getRight(3));
      $user3 = array('id' => 3, 'firstname' => 'Yvan', 'lastname' => 'Deschapeau', 'login' => 'yvanDeschap', 'mail' => 'yvanDeschap@chut.com', 'right' => $this->getRight(4));
      $users = array($user0, $user1, $user2, $user3);
      /* Logique */
      if(!empty($id)){
        return $users[$id];
      }
      else{
        return $users;
      }
    }

    /* Ajoute, modifie, ou supprime un utilisateur */
    public function setUser($id){
      /* code SQL */
    }

    /* Renvoie le hash du password et l'id de l'email passé en argument */
    public function getPassword($email){
      /** Code de la methode final
        $req = $this->bdd->prepare('SELECT idUtilisateur, mdpUtilisateur FROM UTILISATEURS where mailUtilisateur = :email');
        $req->bindValue(':email', $email, PDO::PARAM_STR);
        $req->execute();

        return $req->fetch();
      */
      return array('id' => 1,
                   'password' => '81dc9bdb52d04dc20036dbd8313ed055'); /* le password est 1234 */
    }   

    /* --- Evènements --- */
    /* Renvoie un/des évenement(s) */
    public function getEvent($id='vide'){
      /** Code de la methode final
          $donnees;

          if(!empty($id)){
            $req = $this->bdd->prepare('SELECT * FROM EVENEMENTS WHERE idEvenement = :idEvent');
            $req->bindValue(':idEvent', $id, PDO::PARAM_INT);
            $req->execute();
            $donnees = $req->fetch();
          }

          else{
            $req = $this->bdd->query('SELECT * FROM EVENEMENTS');
            while($champs = $req->fetch()){
            array_push($donnees, $champs);
            }
          }

        return $donnees;
      */

      /* Sample */
      $event0 = array('id'=>0, 'name' => 'La fête de la patate', 'description' => 'C\'est le jour où toutes des patates de retrouvent et dansent jusqu\'au bout de la nuit !', 'placeLibre' => '12', 'creator' => $this->getUser(1), 'admin' =>  array( $this->getUser(1), $this->getUser(1)));
      $event1 = array('id'=>1, 'name' => 'Résolution dynamique du lien fort', 'description' => 'Gestion d\'un lien fort entre deux base de donnée avec mise à jour dynamique et gestion des exeptions', 'placeLibre' => '274', 'creator' => $this->getUser(1), 'admin' =>  array($this->getUser(1)));
      $event2 = array('id'=>2, 'name' => 'Parallélisme dans les clusters de calcule virtuels', 'description' => 'Etude les mouvements de données dans les clusters de calcule virtualisé a l\'aide d\'un agent hyperviseur', 'placeLibre' => '1045', 'creator' => $this->getUser(1), 'admin' =>  array($this->getUser(1)));
      $event3 = array('id'=>3, 'name' => 'Exploration d\'espace hostils par robots autonome', 'description' => 'Programation de robots permettant de cartographier en toute autonomie des milieux hostils. Récuperation des données sur grande distance (~100 km) via une technologie sans-fil', 'placeLibre' => '5', 'creator' => $this->getUser(1), 'admin' =>  array($this->getUser(1)));
      $events = array($event0, $event1, $event2, $event3);
      /* Logique */
      if($id != 'vide'){
        return $events[$id];
      }
      else{
        return $events;
      }
    }

    /* Ajoute, modifie, ou supprime un evenement */
    public function setEvent($id){
      /* code SQL */
    }

    /* Renvoie une/des collection(s) d'évenements */
    public function getSession($id='vide'){
      /** Code de la methode final
          $donnees;

          if(!empty($id)){
            $req = $this->bdd->prepare('SELECT * FROM SESSIONS WHERE idSession= :idSession');
            $req->bindValue(':idSession', $id, PDO::PARAM_INT);
            $req->execute();
            $donnees = $req->fetch();
          }

          else{
            $req = $this->bdd->query('SELECT * FROM SESSIONS');
            while($champs = $req->fetch()){
            array_push($donnees, $champs);
            }
          }

        return $donnees;
      */


      /* Sample */
      $session0 = array('id'=>0, 'name' => 'Soutenances RT1', 'description' => '...', 'events' => array($this->getEvent('0'), $this->getEvent(1)), 'nbMinParticipationEvenement' => 2, 'nbMaxInscritEvenement' => 10, 'dateLimiteInscription' => '20-jan-2013', 'dateRappelMail' => '18-jan-2013');
      $session1 = array('id'=>1, 'name' => 'Soutenances RT2', 'description' => '...', 'events' => array($this->getEvent(2), $this->getEvent(3)), 'nbMinParticipationEvenement' => 3, 'nbMaxInscritEvenement' => 10, 'dateLimiteInscription' => '20-jan-2013', 'dateRappelMail' => '18-jan-2013');
      $sessions = array($session0, $session1);
      /* Logique */
      if($id != 'vide'){
        return $sessions[$id];
      }
      else{
        return $sessions;
      }
    }

    /* Ajoute, modifie, ou supprime une collection d'évenements */
    public function setSession($id){
      /* code SQL */
    }
    
    /* --- Sécurité --- */
    /* Renvoie le statut d'un utilisateur */
    public function getRight($id){      
      /** Code de la methode final
          $donnees;
            
            $req = $this->bdd->prepare('SELECT nomDroit FROM DROITS INNER JOIN UTILISATEURS ON refDroit=idDroit WHERE idUtilisateur = :idDroit');
            $req->bindValue(':idDroit', $id, PDO::PARAM_INT);
            $req->execute();
            $donnees = $req->fetch();

        return $donnees;
      */

      /* Sample */
      $right = 'admin';
      /* Logique */
      return $right;
    }

    public function setRight($id){
      /* code SQL */
    }

    public function getNbEventRegtered($id){
      /** Code de la methode final
          $donnees;
            
            $req = $this->bdd->prepare('SELECT COUNT(*) FROM PARTICIPER WHERE idRefUtilisateur = :idUser');
            $req->bindValue(':idUser', $id, PDO::PARAM_INT);
            $req->execute();
            $donnees = $req->fetch();

        return $donnees;
      */
        return 69; 
    }
  }
