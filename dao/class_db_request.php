<?php
	require('class_pg_connect.php');
	
	class db_request{

		public function getRights($id){
			
			/* code SQL */
			return array('add_event' => true, 'edit_event'=>true, 'delete_event'=>true, 'print_listing'=>true, 'add_user'=>true, 'edit_user'=>true, 'delete_user'=>true, 'manage_rights'=>true, 'add_grp' => true, 'edit_grp' => true, 'delete_grp' => true);
		}
		
		public function getUser($id){
			
			/* code SQL*/
			return array('firstname' => 'Pierre',
                   'lastname'=> 'Quiroule',
                   'login' => 'pierreQuir',
                   'mail' => 'pierreQuir@chut.com',
                   'grp_irl' => 'A2',
                   'grp_right' => 1,
                   'rights' => getRights($id));
		}
		
		public function getAllUsers(){
			
			/* code SQL */
			$user1 = array('id' => 0, 'firstname' => 'Jean', 'lastname'=> 'Moulin', 'login' => 'jeanMoul', 'mail' => 'jeanMoul@chut.com', 'grp_irl' => 'A1', 'grp_right' => 5);
			$user2 = array('id' => 1, 'firstname' => 'Pierre', 'lastname'=> 'Quiroule', 'login' => 'pierreQuir', 'mail' => 'pierreQuir@chut.com', 'grp_irl' => 'A2', 'grp_right' => 1);
			$user3 = array('id' => 2, 'firstname' => 'Mathieu', 'lastname'=> 'De chateau', 'login' => 'mathDechate', 'mail' => 'mathDechate@chut.com', 'grp_irl' => 'A1', 'grp_right' => 12);
			$user4 = array('id' => 3, 'firstname' => 'Yvan', 'lastname' => 'Deschapeau', 'login' => 'yvanDeschap', 'mail' => 'yvanDeschap@chut.com', 'grp_irl' => 'C1', 'grp_right' => 0);

			return $user = array( $user1, $user2, $user3, $user4);
		}
		
		public function getEvent($id){
		
			/* code SQL */
			
			return array('id'=>3, 'name' => 'Exploration d\'espace hostils par robots autonome', 'description' => 'Programation de robots permettant de cartographier en toute autonomie des milieux hostils. Récuperation des données sur grande distance (~100 km) via une technologie sans-fil', 'placeLibre' => '5', 'creator' => $user, 'admin' =>  array($user));
		}
		public function getAllEvents(){
			
			/* code SQL */
			
			$user = array('firstname' => 'Jean', 'lastname'=> 'Moulin', 'login' => 'jeanMoul', 'mail' => 'jeanMoul@chut.com', 'grp_irl' => 'A1', 'grp_right' => 5);
			
			$event0 = array('id'=>0, 'name' => 'La fête de la patate', 'description' => 'C\'est le jour où toutes des patates de retrouvent et dansent jusqu\'au bout de la nuit !', 'placeLibre' => '12', 'creator' => $user, 'admin' =>  array( $user, $user));
			$event1 = array('id'=>1, 'name' => 'Résolution dynamique du lien fort', 'description' => 'Gestion d\'un lien fort entre deux base de donnée avec mise à jour dynamique et gestion des exeptions', 'placeLibre' => '274', 'creator' => $user, 'admin' =>  array($user));
			$event2 = array('id'=>2, 'name' => 'Parallélisme dans les clusters de calcule virtuels', 'description' => 'Etude les mouvements de données dans les clusters de calcule virtualisé a l\'aide d\'un agent hyperviseur', 'placeLibre' => '1045', 'creator' => $user, 'admin' =>  array($user));
			$event3 = array('id'=>3, 'name' => 'Exploration d\'espace hostils par robots autonome', 'description' => 'Programation de robots permettant de cartographier en toute autonomie des milieux hostils. Récuperation des données sur grande distance (~100 km) via une technologie sans-fil', 'placeLibre' => '5', 'creator' => $user, 'admin' =>  array($user));
			return array($event0, $event1, $event2, $event3);
		}
		
		public function getRegisteredCount($id){
		
			/* code SQL */ 
			return 69;
		}	
	}
