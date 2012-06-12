<?php 
echo 'plo';/*
function rewiteDate($date, $heure, $minute){
  $listMois = array('','Janvier','Février','Mars','Avril','Mai','Juin',
  'Juillet','Août','Septembre','Octobre','Novembre','Décembre');

  $dateCasse = explode(' ', $date);
  Echo '<pre>';
  Print_r($dateCasse);
  Echo '</pre>';
  $dateOutput = $dateCasse[3].'-'.$dateCasse[1].'-';

  foreach($listMois as $key => $mois){
    echo $key.' => '.$mois.'<br />';

    if($mois == $dateCasse[2]){
      return $dateCasse[3].'-'.$dateCasse[1].'-'.$key.' '.$heure.':'.$minute;
    }
  }

  //throw new Exception("Error Processing Request", 1);
}

echo rewiteDate('Vendredi 22 Juin 2012', '12', '30');
*/ ?>

<form action="http://localhost/smartevent/app/delete-session" method="POST">
  <input type="text" name="tabSessions" />
  <input type="submit"/>
</form>