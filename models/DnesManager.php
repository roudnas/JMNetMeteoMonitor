<?php
  class DnesManager {

    public function getCurrentTemp($cidlo) {
    return  Db::singleQueryNA("select teplota, substr(datum,9,10) || '.' ||substr(datum,7,7) || '.' || substr(datum,1,4) || ' ' || substr(datum,12,19)  from teplomer_data where idcidlo = $cidlo order by id desc;");
    }

    public function getPocetMereni() {
      return Db::singleQueryNA("select count(*) from teplomer_data");
    }

    public function getPrvniMereni() {
      return Db::singleQueryNA("select first 1 skip 0 substr(datum,9,10) || '.' ||substr(datum,7,7) || '.' || substr(datum,1,4)
      from teplomer_data order by datum asc");
    }

    public function getExtremTeploty($extrem) {
      return Db::singleQuery("select datum, teplota from teplomer_data where teplota = (select $extrem(teplota) from teplomer_data)");
    }

    public function getCidloNameById($id) {
      return Db::singleQuery("select jmeno from teplomer where id = $id");
    }

    public function getCurrentVlhkost($id) {
      return Db::singleQuery("select first 1 skip 0 absvlhkost, rosnybod from teplomer_data where idcidlo = $id order by id desc");
    }




  }

?>
