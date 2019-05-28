<?php
require "konfigurace/config.php";



session_start();
mb_internal_encoding("UTF-8");
function autoLoadFunkce($cls) {
  if (preg_match('/Kontroler$/', $cls) or preg_match('/Controller$/', $cls)) {
    require('controllers/' . $cls . '.php');
  } else {
    require('models/' . $cls . '.php');
  }
}
spl_autoload_register("autoLoadFunkce");
Db::connect($dbAdr, $dbUsr, $dbPw);
$router = new RouterController();
$router->zpracuj(array($_SERVER['REQUEST_URI']));
$router->showView();




?>
