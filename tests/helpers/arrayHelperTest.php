<?php

  require('app/helpers/arrayHelper.php');

  class arrayHelperTest extends PHPUnit_Framework_TestCase
  {
    public function testThisArrayIsNotEmpty()
    {
      $array = array();
      $this->assertEquals(false, thisArrayIsNotEmpty($array));

      $array['keyA'] = 'valueA';
      $this->assertEquals(true, thisArrayIsNotEmpty($array));
    }

    public function testTheseKeysExistsAndAreNotEmpty()
    {
      $array = array();
      $keys  = array();
      $this->assertEquals(false, theseKeysExistsAndAreNotEmpty($array, $keys));

      array_push($keys, 'keyA');
      $this->assertEquals(false, theseKeysExistsAndAreNotEmpty($array, $keys));

      array_push($keys, 'keyB');
      $this->assertEquals(false, theseKeysExistsAndAreNotEmpty($array, $keys));


      $array['keyA'] = '';
      $array['keyB'] = '';
      $this->assertEquals(false, theseKeysExistsAndAreNotEmpty($array, $keys));

      $array['keyA'] = 'valueA';
      $array['keyB'] = '';
      $this->assertEquals(false, theseKeysExistsAndAreNotEmpty($array, $keys));

      $array['keyA'] = 'valueA';
      $array['keyB'] = 'valueB';
      $this->assertEquals(true, theseKeysExistsAndAreNotEmpty($array, $keys));
    }

    public function testArrayEventInArrayEvents(){
      $array1 = array(
        array("nomevenement" => "Résolution dynamique du lien fort",                  "idevenement" => 0),
        array("nomevenement" => "Parallélisme dans les clusters de calcule virtuels", "idevenement" => 1),
        array("nomevenement" => "La fête de la patate",                               "idevenement" => 2),
        array("nomevenement" => "Exploration despace hostils par robots autonome",    "idevenement" => 3)
      );

      $array2 = array("nomevenement" => "La fête de la patate", "idevenement" => 2);
      $this->assertEquals(true, ArrayEventInArrayEvents($array2, $array1));

      $array3 = array("nomevenement" => "Cantate ", "idevenement" => 4);
      $this->assertEquals(false, ArrayEventInArrayEvents($array3, $array1));
    }
  }

?>
