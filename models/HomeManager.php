<?php
  class HomeManager {

    protected $id;

    public function getCidlo(){
      return Db::singleQuery("select distinct jmeno from teplomer;");
    }

    public function getCurrentData($id) {
    return  Db::singleQuery("select first 1 skip 0 teplota, substr(datum,9,10) || '.' ||substr(datum,7,7) || '.' || substr(datum,1,4) || ' ' || substr(datum,12,19) DATUM, relvlhkost, rosnybod, rychlost, tlak  from teplomer_data where idcidlo = $id order by id desc;");
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

    public function getExtremeByDay($id) {
      return Db::singleQueryNA("select max(teplota)||'°C'maxTemp, min(teplota)||'°C'minTemp, avg(teplota)||'°C'avgTemp,
                                max(relvlhkost)||'%'maxHum, min(relvlhkost)||'%'minHum, avg(relvlhkost)||'%'avgHum
                                from (
                                select * from teplomer_data
                                where idcidlo = $id
                                and datum like '' || (select first 1
                                skip 0 substr(datum,1,11) from TEPLOMER_DATA
                                order by datum desc) ||'%'
                                order by datum desc )
                                ");
    }

    public function getPosledniDobou($id, $cas) {
    return Db::multiQuery("select first 5 skip 0 substr(datum,9,10) || '.' ||substr(datum,6,7) || '.' || substr(datum,1,4) as CAS, TEPLOTA, relvlhkost  from teplomer_data
                            where idcidlo = $id
                            and datum like '%$cas%'
                            order by datum desc");
    }

    public function getTodaysTempAndTime($id){
      return Db::multiQuery("select first 5 skip 0 substr(datum,12,13) CAS, TEPLOTA from teplomer_data where idcidlo = $id order by id desc;");
    }

    public function getCas($id) {
        return Db::singleQueryNA("select first 1 skip 0 substr(datum,12,16) from teplomer_data where idcidlo = $id order by datum desc");
    }

    public function getDate($id){
      return Db::singleQueryNA("select first 1 skip 0 substr(datum,1,11) from teplomer_data where idcidlo = $id order by datum desc");
    }


    public function getTimeAndTemp($id){
      return Db::multiQuery("select '['||substr(datum,12,13)||','||teplota ||','|| rychlost ||','|| rosnybod ||']' as DATA from teplomer_data
                                where idcidlo = $id
                                and datum like '' || (select first 1
                                skip 0 substr(datum,1,11) from TEPLOMER_DATA
                                order by datum desc) ||'%'
                                order by datum asc;");
    }

    public function getHumidity($id){
      return Db::multiQuery("select '['||substr(datum,12,13)||','|| relvlhkost ||']' as DATA from teplomer_data
                                where idcidlo = $id
                                and datum like '' || (select first 1
                                skip 0 substr(datum,1,11) from TEPLOMER_DATA
                                order by datum desc) ||'%'
                                order by datum asc;");
    }

    public function getLast3DaysTimeTemp($id){
      return Db::multiQuery("select substr(datum, 1,4)ROK, substr(datum, 6,7)MESIC,substr(datum, 9,10)DEN, substr(datum, 12,13)HODINA, substr(datum, 15,16)MINUTA, TEPLOTA, RYCHLOST, ROSNYBOD
                             from teplomer_data where
                            datum > dateadd(-3 day to current_date) and idcidlo = $id
                            order by datum asc;");
    }

    public function getLast3DaysHumidity($id){
      return Db::multiQuery("select substr(datum, 1,4)ROK, substr(datum, 6,7)MESIC,substr(datum, 9,10)DEN, substr(datum, 12,13)HODINA, substr(datum, 15,16)MINUTA, RELVLHKOST
                             from teplomer_data where
                            datum > dateadd(-3 day to current_date) and idcidlo = $id
                            order by datum asc;");
    }

    public function getMesicniSouhrn($id) {
      return Db::multiQuery("select distinct substr(datum,1,11) datum, avg(teplota)AVGTEMP,avg(rychlost)AVGRYCHLOST, avg(rosnybod)AVGRB, avg(relvlhkost)AVGVLHKOST   from teplomer_data
                              where datum  > dateadd(-1 month to current_date)
                              and idcidlo = $id
                              group by datum
                              order by datum asc");
    }

  }

?>
