<?php
class ErrorController extends Controller {
  public function zpracuj($params)
   {
       header("HTTP/1.0 404 Not Found");
       $this->hlavicka['titulek'] = 'Chyba 404';
       $this->pohled = 'errorpage';
   }
}

?>
