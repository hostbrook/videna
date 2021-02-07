<?php
// Videna Framework
// File: /Videna/Core/Singleton.php
// Desc: provides support single object for each class

namespace Videna\Core;

trait Singleton {
  
  private static $instance = null;

  private function __construct() {
    // Protection from the creating via 'new Singleton'
  }

  private function __clone() {
    // Protection from the creating via cloning object
  }

  private function __wakeup() {
    // Protection from the creating via unserialize
  }  

  // 'getInstance' method:
  public static function gi() {

    return self::$instance === null    // If $instance equal to 'null'
      ? self::$instance = new static() // create new self() object
        : self::$instance;             // otherwise return the existing object

  }
  
} // END trait Singleton