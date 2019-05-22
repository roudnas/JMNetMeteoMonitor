<?php
  class HomeController extends Controller {

    protected $staniceId = 0;

    public function zpracuj($params) {

      if (!empty($params[0] and substr($params[0],0,10) == 'idStanice-')) {
        $this->staniceId = intval(substr($params[0],10,12));
      } else if (!empty($params[0])) {
        $this->redir("home/idStanice-3710");
      }

    $DnesManager = new HomeManager();
    $this->data['teplota'] = $DnesManager->getCurrentTemp($this->staniceId);
    $this->data['pocetMereni'] = $DnesManager->getPocetMereni($this->staniceId);
    $this->data['prvniMer'] = $DnesManager->getPrvniMereni($this->staniceId);
    $this->data['maxTeplota'] = $DnesManager->getExtremTeploty('max',$this->staniceId);
    $this->data['minTeplota'] = $DnesManager->getExtremTeploty('min',$this->staniceId);
    $this->data['jmenoCidla'] = $DnesManager->getCidloNameById($this->staniceId);
    $this->data['Vlhkost'] = $DnesManager->getCurrentVlhkost($this->staniceId);
    $this->data['id'] = $this->staniceId;
    $this->pohled = 'uvod';
  }

  public function showSpecificView($view) {
    require("views/home/" . $view . ".phtml");
  }

  }



 ?>
