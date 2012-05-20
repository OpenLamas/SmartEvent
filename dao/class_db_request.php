<?php
	require('class_pg_connect.php');
	
	class db_request{

    /* Renvoie uniquement les droits d'un utilisateur en particulier */
		public function getRights($id){
			
			/* code SQL */
			return array('superadmin' => true, 'add_event' => true, 'edit_event'=>true, 'delete_event'=>true, 'print_listing'=>true, 'add_user'=>true, 'edit_user'=>true, 'delete_user'=>true, 'manage_rights'=>true, 'add_grp' => true, 'edit_grp' => true, 'delete_grp' => true);
		}
		
    /* Renvoie un utilisateur (y compris ses droits)*/
		public function getUser($id){
			
			/* code SQL*/
			return array('firstname' => 'Pierre',
                   'lastname'=> 'Quiroule',
                   'login' => 'pierreQuir',
                   'mail' => 'pierreQuir@chut.com',
                   'grp_irl' => 'A2',
                   'grp_right' => 1,
                   'registered_count' => 69,
                   'rights' => $this->getRights($id));
		}
    
    public function deleteUser($id){      
      /* code SQL */
    }
		
		/* Renvoie le hash du password et l'id de l'email passé en argument */
		public function getPassword($email){
      
      /* code SQL */
      return array('id' => 1,
                   'password' => '81dc9bdb52d04dc20036dbd8313ed055'); /* le password est 1234 */
		}
		
    /* Renvoie tout les utilisateurs */
		public function getAllUsers(){
			
			/* code SQL */
			$user1 = array('id' => 0, 'firstname' => 'Jean', 'lastname'=> 'Moulin', 'login' => 'jeanMoul', 'mail' => 'jeanMoul@chut.com', 'grp_irl' => 'A1', 'grp_right' => 5,'registered_count' => 69, 'rights' => $this->getRights(1));
			$user2 = array('id' => 1, 'firstname' => 'Pierre', 'lastname'=> 'Quiroule', 'login' => 'pierreQuir', 'mail' => 'pierreQuir@chut.com', 'grp_irl' => 'A2', 'grp_right' => 1,'registered_count' => 69, 'rights' => $this->getRights(2));
			$user3 = array('id' => 2, 'firstname' => 'Mathieu', 'lastname'=> 'De chateau', 'login' => 'mathDechate', 'mail' => 'mathDechate@chut.com', 'grp_irl' => 'A1', 'grp_right' => 12,'registered_count' => 69, 'rights' => $this->getRights(3));
			$user4 = array('id' => 3, 'firstname' => 'Yvan', 'lastname' => 'Deschapeau', 'login' => 'yvanDeschap', 'mail' => 'yvanDeschap@chut.com', 'grp_irl' => 'C1', 'grp_right' => 0,'registered_count' => 69, 'rights' => $this->getRights(4));

			return $users = array( $user1, $user2, $user3, $user4);
		}
		
    /* Renvoie un évenement */
		public function getEvent($id){
		
			/* code SQL */
			$event0 = array('id'=>0, 'name' => 'La fête de la patate', 'description' => 'C\'est le jour où toutes des patates de retrouvent et dansent jusqu\'au bout de la nuit !', 'placeLibre' => '12', 'creator' => $this->getUser(1), 'admin' =>  array( $this->getUser(1), $this->getUser(1)));
			$event1 = array('id'=>1, 'name' => 'Résolution dynamique du lien fort', 'description' => 'Gestion d\'un lien fort entre deux base de donnée avec mise à jour dynamique et gestion des exeptions', 'placeLibre' => '274', 'creator' => $this->getUser(1), 'admin' =>  array($this->getUser(1)));
			$event2 = array('id'=>2, 'name' => 'Parallélisme dans les clusters de calcule virtuels', 'description' => 'Etude les mouvements de données dans les clusters de calcule virtualisé a l\'aide d\'un agent hyperviseur', 'placeLibre' => '1045', 'creator' => $this->getUser(1), 'admin' =>  array($this->getUser(1)));
			$event3 = array('id'=>3, 'name' => 'Exploration d\'espace hostils par robots autonome', 'description' => 'Programation de robots permettant de cartographier en toute autonomie des milieux hostils. Récuperation des données sur grande distance (~100 km) via une technologie sans-fil', 'placeLibre' => '5', 'creator' => $this->getUser(1), 'admin' =>  array($this->getUser(1)));
			$events = array($event0, $event1, $event2, $event3);
			
      return $events[$id];
		}
    
    /* Renvoie tout les évenements */
		public function getAllEvents(){
			
			/* code SQL */
						
			$event0 = array('id'=>0, 'name' => 'La fête de la patate', 'description' => 'C\'est le jour où toutes des patates de retrouvent et dansent jusqu\'au bout de la nuit !', 'placeLibre' => '12', 'creator' => $this->getUser(1), 'admin' =>  array( $this->getUser(1), $this->getUser(1)));
			$event1 = array('id'=>1, 'name' => 'Résolution dynamique du lien fort', 'description' => 'Gestion d\'un lien fort entre deux base de donnée avec mise à jour dynamique et gestion des exeptions', 'placeLibre' => '274', 'creator' => $this->getUser(1), 'admin' =>  array($this->getUser(1)));
			$event2 = array('id'=>2, 'name' => 'Parallélisme dans les clusters de calcule virtuels', 'description' => 'Etude les mouvements de données dans les clusters de calcule virtualisé a l\'aide d\'un agent hyperviseur', 'placeLibre' => '1045', 'creator' => $this->getUser(1), 'admin' =>  array($this->getUser(1)));
			$event3 = array('id'=>3, 'name' => 'Exploration d\'espace hostils par robots autonome', 'description' => 'Programation de robots permettant de cartographier en toute autonomie des milieux hostils. Récuperation des données sur grande distance (~100 km) via une technologie sans-fil', 'placeLibre' => '5', 'creator' => $this->getUser(1), 'admin' =>  array($this->getUser(1)));
			return array($event0, $event1, $event2, $event3);
		}
    
    /* Renvoie tout les groupes de droit */
    public function getAllRightGroups(){
      
      /* code SQL */
      
      $rightgroup1 = array('id' => 0, 'name' => 'eleves1', 'rights' => array('add_event' => true, 'edit_event'=>true, 'delete_event'=>false, 'print_listing'=>false, 'add_user'=>true, 'edit_user'=>true, 'delete_user'=>true, 'manage_rights'=>false, 'add_grp' => true, 'edit_grp' => false, 'delete_grp' => false));
      $rightgroup2 = array('id' => 1, 'name' => 'profIUT', 'rights' => array('add_event' => true, 'edit_event'=>true, 'delete_event'=>true, 'print_listing'=>true, 'add_user'=>true, 'edit_user'=>true, 'delete_user'=>true, 'manage_rights'=>true, 'add_grp' => true, 'edit_grp' => true, 'delete_grp' => true));
      
      return $rightgroups = array ($rightgroup1, $rightgroup2);
    }
	}
