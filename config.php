<?php
	$user = array(	array('firstname' => 'Jean', 'lastname'=> 'Moulin', 'login' => 'jeanMoul'),
			array('firstname' => 'Pierre', 'lastname'=> 'Quiroule', 'login' => 'pierreQuir'),
			array('firstname' => 'Mathieu', 'lastname'=> 'De chateau', 'login' => 'mathDechate')
		);

	$rights = array(	array('add_event' => true, 'edit_event'=>true, 'delete_event'=>true, 'print_listing'=>true),
			array('add_event' => true, 'edit_event'=>true, 'delete_event'=>true, 'print_listing'=>true),
			array('add_event' => true, 'edit_event'=>true, 'delete_event'=>true, 'print_listing'=>true)
		);
		
	$event = array( array('name' => 'La f�te de la patate', 'description' => 'C\'est le jour o� toute des patates de retrouve et dansent jusqu\'au bout de la nuit !', 'placeLibre' => '12'),
	array('name' => 'R�solution dynamique du lien fort', 'description' => 'Gestion dun lien fort entre deux base de donn�e avec mise a jour dynamique et gestion des exeptions', 'placeLibre' => '274')
				);
				
	$events = array( 'registered_count' => 2);
	
	
 ?>
