<?php
	
	$user1 = array('firstname' => 'Jean', 'lastname'=> 'Moulin', 'login' => 'jeanMoul', 'mail' => 'jmoulin@etu.univ-savoie.fr');
	$user2 = array('firstname' => 'Pierre', 'lastname'=> 'Quiroule', 'login' => 'pierreQuir', 'mail' => 'pierre.quiroule@hotmail.fr');
	$user3 = array('firstname' => 'Mathieu', 'lastname'=> 'De chateau', 'login' => 'mathDechate', 'mail' => 'matchateau@gmail.com');
	$user4 = array('firstname' => 'Yvan', 'lastname' => 'Deschapeau', 'login' => 'yvanDeschap', 'mail' => 'ydechap@mit.edu');
	$user = array( $user1, $user2, $user3, $user4);

	$allRight = array('add_event' => true, 'edit_event'=>true, 'delete_event'=>true, 'print_listing'=>true, 'add_user'=>true, 'edit_user'=>true, 'delete_user'=>true, 'manage_rights'=>true);
	$rights = array($allRight, $allRight, $allRight);

	$event0 = array('id'=>0, 'name' => 'La fête de la patate', 'description' => 'C\'est le jour où toutes des patates de retrouvent et dansent jusqu\'au bout de la nuit !', 'placeLibre' => '12', 'creator' => $user4, 'admin' =>  array( $user1, $user3));
	$event1 = array('id'=>1, 'name' => 'Résolution dynamique du lien fort', 'description' => 'Gestion d\'un lien fort entre deux base de donnée avec mise à jour dynamique et gestion des exeptions', 'placeLibre' => '274', 'creator' => $user1, 'admin' =>  array($user4));
	$event2 = array('id'=>2, 'name' => 'Parallélisme dans les clusters de calcule virtuels', 'description' => 'Etude les mouvements de données dans les clusters de calcule virtualisé a l\'aide d\'un agent hyperviseur', 'placeLibre' => '1045', 'creator' => $user1, 'admin' =>  array($user4));
	$event3 = array('id'=>3, 'name' => 'Exploration d\'espace hostils par robots autonome', 'description' => 'Programation de robots permettant de cartographier en toute autonomie des milieux hostils. Récuperation des données sur grande distance (~100 km) via une technologie sans-fil', 'placeLibre' => '5', 'creator' => $user1, 'admin' =>  array($user4));

	$events = array($event0, $event1, $event2, $event3);

	$registered_count = 69;
	
 ?>
