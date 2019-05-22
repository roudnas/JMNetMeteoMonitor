<?php
  class Db {

      private static $connection;

      public static function connect($host, $user, $pw) {
        if (!isset(self::$connection)) {
          self::$connection = ibase_connect($host,$user, $pw);
        }
      }

      public static function singleQuery($query) {
        $prep = ibase_prepare(self::$connection, $query);
        $return = ibase_execute($prep);
        $row = ibase_fetch_assoc($return);
        return $row;
        ibase_close(self::$connection);
      }

      public static function singleQueryNA($query) {
        $prep = ibase_prepare(self::$connection, $query);
        $return = ibase_execute($prep);
        $row = ibase_fetch_row($return);
        return $row;
        ibase_close(self::$connection);
      }


      public static function multiQuery($query) {
        $prep = ibase_prepare(self::$connection, $query);
        $return = ibase_execute($prep);
        return $return;
        ibase_close(self::$connection);
      }
  }







?>
