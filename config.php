<?php
	$user = array(	array('firstname' => 'Jean', 'lastname'=> 'Moulin', 'login' => 'jeanMoul'),
			array('firstname' => 'Pierre', 'lastname'=> 'Quiroule', 'login' => 'pierreQuir'),
			array('firstname' => 'Mathieu', 'lastname'=> 'De chateau', 'login' => 'mathDechate')
		);

	$rights = array(	array('add_event' => true, 'edit_event'=>true, 'delete_event'=>true, 'print_listing'=>true),
			array('add_event' => true, 'edit_event'=>true, 'delete_event'=>true, 'print_listing'=>true),
			array('add_event' => true, 'edit_event'=>true, 'delete_event'=>true, 'print_listing'=>true)
		);
		
	$event = array( array('name' => 'La fête de la patate', 'description' => 'C\'est le jour où toute des patates de retrouve et dansent jusqu\'au bout de la nuit !', 'placeLibre' => '12'),
	array('name' => 'Résolution dynamique du lien fort', 'description' => 'Gestion dun lien fort entre deux base de donnée avec mise a jour dynamique et gestion des exeptions', 'placeLibre' => '274')
				);
				
	$events = array( 'registered_count' => 2);
	
	
 ?>
