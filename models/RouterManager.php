<?php
  class RouterManager {

        public function getStanice() {
          return Db::multiQuery("select id, jmeno from teplomer");
        }

        public function getLastId($staniceId) {
          return Db::singleQueryNA("select first 1 skip 0 id from teplomer_data where idcidlo = $staniceId order by datum desc");
        }


  }




?>
