<?php
	
	$user1 = array('firstname' => 'Jean', 'lastname'=> 'Moulin', 'login' => 'jeanMoul');
	$user2 = array('firstname' => 'Pierre', 'lastname'=> 'Quiroule', 'login' => 'pierreQuir');
	$user3 = array('firstname' => 'Mathieu', 'lastname'=> 'De chateau', 'login' => 'mathDechate');
	$user4 = array('firstname' => 'Yvan', 'lastname' => 'Deschapeau', 'login' => 'yvanDeschap');
	
	$user = array( $user1, $user2, $user3, $user4);

	$allRight = array('add_event' => true, 'edit_event'=>true, 'delete_event'=>true, 'print_listing'=>true, 'add_user'=>true, 'edit_user'=>true, 'delete_user'=>true, 'manage_rights'=>true);
	$rights = array($allRight, $allRight, $allRight);
		
	$event1 = array('id'=>0, 'name' => 'La fête de la patate', 'description' => 'C\'est le jour où toute des patates de retrouve et dansent jusqu\'au bout de la nuit !', 'placeLibre' => '12', 'creator' => $user4, 'admin' =>  array( $user1, $user3));
	$event2 = array('id'=>1, 'name' => 'Résolution dynamique du lien fort', 'description' => 'Gestion d\'un lien fort entre deux base de donnée avec mise a jour dynamique et gestion des exeptions', 'placeLibre' => '274', 'creator' => $user1, 'admin' =>  array($user4));
	
	$events = array($event1, $event2);
	
	$registered_count = 69;
	
	
 ?>
