<?php
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
Db::connect('1.2.3.123:/var/lib/czf/jmnet.gdb','teplomer','remolpet');
$router = new RouterController();
$router->zpracuj(array($_SERVER['REQUEST_URI']));
$router->showView();




?>
