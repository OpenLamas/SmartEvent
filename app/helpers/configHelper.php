<?php

  function generateDefinesFromArray($array) {
    $defines = array();

    foreach($array as $key => $value) {
      $define = 'define("'.$key.'", "'.$value.'");';
      array_push($defines, $define);
    }

    return $defines;
  }

  function writeDefinesToFile($defines, $file) {
    file_put_contents($file, "<?php\n");

    foreach($defines as $define) {
      file_put_contents($file, $define."\n", FILE_APPEND);
    }

    file_put_contents($file, '?>', FILE_APPEND);
  }

  function writeConfArrayToFile($array, $file) {
    writeDefinesToFile(generateDefinesFromArray($array), $file);
  }

?>
