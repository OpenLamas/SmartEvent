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
  }

?>
