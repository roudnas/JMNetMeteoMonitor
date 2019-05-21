<?php
  class Db {

      private static $connection;

      public static function connect($host, $user, $pw) {
        if (!isset(self::$connection)) {
          self::$connection = ibase_connect($host,$user, $pw);
        }
      }
















  }







?>
