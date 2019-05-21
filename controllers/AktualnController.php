<?php

  class AktualneKontroler extends Controller{
    public function zpracuj($params){
      $AktualneManager = new AktualneManager();
      $this->data['minTeplota'] = $AktualneManager->getMinTemp(3710);
      $this->data['avgTeplota'] = $AktualneManager->getAvgTemp(3710);
      $this->data['maxTeplota'] = $AktualneManager->getMaxTemp(3710);
    }

  }

 ?>
