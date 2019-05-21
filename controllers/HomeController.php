<?php
  class HomeController extends Controller {
    public function zpracuj($params) {
    $DnesManager = new HomeManager();
    $this->data['teplota'] = $DnesManager->getCurrentTemp(3710);
    $this->data['pocetMereni'] = $DnesManager->getPocetMereni(3710);
    $this->data['prvniMer'] = $DnesManager->getPrvniMereni(3710);
    $this->data['maxTeplota'] = $DnesManager->getExtremTeploty('max',3710);
    $this->data['minTeplota'] = $DnesManager->getExtremTeploty('min',3710);
    $this->data['jmenoCidla'] = $DnesManager->getCidloNameById(3710);
    $this->data['Vlhkost'] = $DnesManager->getCurrentVlhkost(3710);
    $this->pohled = 'uvod';
  }
  }





 ?>
