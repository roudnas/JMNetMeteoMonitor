<?php
  class HomeManager {

    protected $id;

    public function getCidlo(){
      return Db::singleQuery("select distinct jmeno from teplomer;");
    }

    public function getCurrentTemp($id) {
    return  Db::singleQueryNA("select teplota, substr(datum,9,10) || '.' ||substr(datum,7,7) || '.' || substr(datum,1,4) || ' ' || substr(datum,12,19)  from teplomer_data where idcidlo = $id order by id desc;");
    }

    public function getPocetMereni($id) {
      return Db::singleQueryNA("select count(*) from teplomer_data where idcidlo = $id");
    }

    public function getPrvniMereni($id) {
      return Db::singleQueryNA("select first 1 skip 0 substr(datum,9,10) || '.' ||substr(datum,6,7) || '.' || substr(datum,1,4)
      from teplomer_data where idcidlo = $id order by datum asc");
    }

    public function getExtremTeploty($extrem, $id) {
      return Db::singleQuery("select datum, teplota from teplomer_data where idcidlo = $id and teplota = (select $extrem(teplota) from teplomer_data where idcidlo = $id)");
    }

    public function getCidloNameById($id) {
      return Db::singleQuery("select jmeno from teplomer where id = $id");
    }

    public function getCurrentVlhkost($id) {
      return Db::singleQuery("select first 1 skip 0 absvlhkost, rosnybod from teplomer_data where idcidlo = $id order by id desc");
    }

    public function getMinTemp($id){
      return Db::singleQuery("select min(teplota) from teplomer_data where datum like 'CURRENT_DATE, %' and id = $id group by id;");
    }

    public function getAvgTemp($id){
      return Db::singleQuery("select avg(teplota) from teplomer_data where datum like 'CURRENT_DATE, %' and id = $id group by id;");
    }

    public function getMaxTemp($id){
      return Db::singleQuery("select max(teplota) from teplomer_data where datum like 'CURRENT_DATE, %' and id = $id group by id;");
    }



  }

?>
