<?php
  abstract class Controller {
    protected $data = array();
    protected $pohled = "";
    protected $hlavicka = array('titulek' => '', 'klicova_slova' => '', 'popis' => '');

    abstract function zpracuj($params);

    private function sanitize($x = null) {
      if (!isset($x)) {
        return null;
      } elseif(is_string($x)) {
        return htmlspecialchars($x, ENT_QUOTES);
      } elseif(is_array($x)) {
        foreach ($x as $key => $v) {
          $x[$key] = $this->sanitize($v);
        }
        return $x;
      } else {
        return $x;
      }
    }

    public function showView() {
      if ($this->pohled) {
        extract($this->sanitize($this->data));
        extract($this->data, EXTR_PREFIX_ALL, "");
        require("views/" . $this->pohled . ".phtml");
      }
    }

    public function redir($where) {
      header("Location: /$where");
      header("Connection: close");
      exit;
    }

    public static function returnMessages() {
      if (isset($_SESSION['zpravy'])) {
        $zpravy = $_SESSION['zpravy'];
        unset($_SESSION['zpravy']);
        return $zpravy;
      } else {
        return array();
      }
    }



  }


















?>
