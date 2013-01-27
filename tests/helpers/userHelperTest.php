<?php

  require('app/helpers/userHelper.php');

  class userHelperTest extends PHPUnit_Framework_TestCase
  {
    public function testHasRight()
    {
      // Tests avec des variables fausses
      $right = '';
      $user  = '';
      $this->assertEquals(false, hasRight($right, $user));

      $user  = array('right' => 'UTILISATEUR');
      $this->assertEquals(false, hasRight($right, $user));

      // Tests avec un utilisateur standard
      $user  = array('right' => 'UTILISATEUR');

      $right = 'ADMIN';
      $this->assertEquals(false, hasRight($right, $user));

      $right = 'GESTIONNAIRE';
      $this->assertEquals(false, hasRight($right, $user));

      $right = 'UTILISATEUR';
      $this->assertEquals(true, hasRight($right, $user));

      // Tests avec un gestionnaire
      $user  = array('right' => 'GESTIONNAIRE');

      $right = 'ADMIN';
      $this->assertEquals(false, hasRight($right, $user));

      $right = 'GESTIONNAIRE';
      $this->assertEquals(true, hasRight($right, $user));

      $right = 'UTILISATEUR';
      $this->assertEquals(true, hasRight($right, $user));

      // Tests avec un admin
      $user  = array('right' => 'ADMIN');

      $right = 'ADMIN';
      $this->assertEquals(true, hasRight($right, $user));

      $right = 'GESTIONNAIRE';
      $this->assertEquals(true, hasRight($right, $user));

      $right = 'UTILISATEUR';
      $this->assertEquals(true, hasRight($right, $user));

    }
  }

?>
