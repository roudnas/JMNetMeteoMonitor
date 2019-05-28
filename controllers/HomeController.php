<?php
  class HomeController extends Controller {

    public function zpracuj($params) {

      if (!empty($params[0] and substr($params[0],0,10) == 'idStanice-')) {
        $this->staniceId = intval(substr($params[0],10,12));
      } else if (!empty($params[0])) {
        $this->redir("home/idStanice-3710");
      }

    $DnesManager = new HomeManager();
    try {
    $cas = $DnesManager->getCas($this->staniceId);
    $cas = $cas[0];
    $date = $DnesManager->getDate($this->staniceId);
    $date = $date[0];
    $this->data['id'] = $this->staniceId;
    $this->data['getTimeAndTemp'] = $DnesManager->getTimeAndTemp($this->staniceId,1);
    $this->data['getHumidity'] = $DnesManager->getHumidity($this->staniceId,1);
    $this->data['getLast3DaysTimeTemp'] = $DnesManager->getTimeAndTemp($this->staniceId,3);
    $this->data['getLast3DaysHumidity'] = $DnesManager->getHumidity($this->staniceId,3);
    $this->data['mesicniSouhrn'] = $DnesManager->getMesicniSouhrn($this->staniceId);
    $this->data['mesicniSouhrnVlhkost'] = $DnesManager->getMesicniSouhrnVlhkost($this->staniceId);
    $this->data['rocniSouhrn'] = $DnesManager->getRocniSouhrn($this->staniceId, 1);
    $this->data['getRocniSouhrnVlhkost'] = $DnesManager->getRocniSouhrnVlhkost($this->staniceId, 1);
    $this->data['rocniSouhrn5'] = $DnesManager->getRocniSouhrn($this->staniceId, 5);
    $this->data['getRocniSouhrnVlhkost5'] = $DnesManager->getRocniSouhrnVlhkost($this->staniceId, 5);
    $_SESSION['staniceID'] = $this->staniceId;


    $this->pohled = 'uvod';

  } catch (UserError $e) {
    $this->addMessage($e->getMessage());
  }
  }

  public static function getCurrentTeplota() {
    return self::data['currData'];
  }

  public function showSpecificView($view) {
    require("views/home/" . $view . ".phtml");
  }

  }



 ?>
