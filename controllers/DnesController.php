<?php
  class DnesController extends Controller {
    public function zpracuj($params) {
    $DnesManager = new DnesManager();
    $this->data['teplota'] = $DnesManager->getCurrentTemp(3710);
    $this->data['pocetMereni'] = $DnesManager->getPocetMereni();
    $this->data['prvniMer'] = $DnesManager->getPrvniMereni();
    $this->data['maxTeplota'] = $DnesManager->getExtremTeploty('max');
    $this->data['minTeplota'] = $DnesManager->getExtremTeploty('min');
    $this->data['jmenoCidla'] = $DnesManager->getCidloNameById(3710);
    $this->data['Vlhkost'] = $DnesManager->getCurrentVlhkost(3710);
    $this->pohled = 'uvod';
  }
  }





 ?>
