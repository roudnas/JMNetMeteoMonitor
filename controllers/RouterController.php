<?php
    class RouterController extends Controller {
      protected $controller;

      public function zpracuj($params) {
          $parsedU = $this->parseURL($params[0]);
          if (empty($parsedU[0])) {
            $this->redir('home/idStanice-3710');
          }
          $controllerClass = $this->toCamelCase(array_shift($parsedU)) . 'Controller';
          if (file_exists('controllers/'. $controllerClass . '.php')) {
            $this->controller = new $controllerClass;
          }else{
            $this->redir('error');
          }
          $this->controller->zpracuj($parsedU);
          $this->data['titulek'] = $this->controller->hlavicka['titulek'];
          $this->data['popis'] = $this->controller->hlavicka['popis'];
          $this->data['klicova_slova'] = $this->controller->hlavicka['klicova_slova'];
          $this->data['zpravy'] = $this->returnMessages();
          $this->pohled = 'layout';

      }

      private function parseURL($url) {
          $prsU = parse_url($url);
          $prsU['path'] = trim(ltrim($prsU['path'], "/"));
          $divPath = explode("/", $prsU['path']);
          return $divPath;
      }

      private function toCamelCase($txt) {
        $sent = str_replace('-', ' ', $txt);
        $sent = ucwords($sent);
        $sent = str_replace(' ', '', $sent);
        return $sent;
      }
    }








 ?>
