<?php

  /**
  * Verifie que toutes les valeurs du tableau soient remplies
  * @param $array le tableau à vérifier
  */
  function thisArrayIsNotEmpty($array) {
      if(empty($array)) { return false; }
      foreach($array as $key => $value) {
        if(empty($key)) { return false; }
      }
      return true;
    }

  /**
  * Verifie que les clés spécifiées existent et que leur valeur ne soient pas
  * nulles
  * @param $array le tableau à vérifier
  * @param $keys les clés à vérifier
  */
  function theseKeysExistsAndAreNotEmpty($array, $keys) {
      if(empty($array) || empty($keys)) { return false; }
      foreach($keys as $key) {
        if(!isset($array[$key])) { return false; }
        else { if(empty($array[$key])) { return false; } }
      }
      return true;
    }

?>