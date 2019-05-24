<?php
  class HomeManager {

    protected $id;

    public function getCidlo(){
      return Db::singleQuery("select distinct jmeno from teplomer;");
    }

    public function getCidloNameById($id) {
      return Db::singleQuery("select jmeno from teplomer where id = $id");
    }

    public function getCas($id) {
        return Db::singleQueryNA("select first 1 skip 0 substr(datum,12,16) from teplomer_data where idcidlo = $id order by datum desc");
    }

    public function getDate($id){
      return Db::singleQueryNA("select first 1 skip 0 substr(datum,1,11) from teplomer_data where idcidlo = $id order by datum desc");
    }


    public function getTimeAndTemp($id){
      return Db::multiQuery("select '['||substr(datum,12,13)||','||teplota ||','|| rychlost ||','|| narazy ||','|| rosnybod ||']' as DATA from teplomer_data
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
      return Db::multiQuery("select substr(datum, 1,4)ROK, substr(datum, 6,7)MESIC,substr(datum, 9,10)DEN, substr(datum, 12,13)HODINA, substr(datum, 15,16)MINUTA, TEPLOTA, RYCHLOST,NARAZY, ROSNYBOD
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
      return Db::multiQuery("select distinct substr(datum,1,11) datum, avg(teplota)AVGTEMP,avg(rychlost)AVGRYCHLOST,avg(NARAZY)AVGNARAZY, avg(rosnybod)AVGRB from teplomer_data
                              where datum  > dateadd(-1 month to current_date)
                              and idcidlo = $id
                              group by datum
                              order by datum asc");
    }

    public function getMesicniSouhrnVlhkost($id) {
      return Db::multiQuery("select distinct substr(datum,1,11) DATUM, avg(relvlhkost) VLHKOST from teplomer_data
                              where datum  > dateadd(-1 month to current_date)
                              and idcidlo = $id
                              group by datum
                              order by datum asc");
    }

    public function getRocniSouhrn($id){
      return Db::multiQuery("select distinct substr(datum,1,7) DATUM, avg(teplota) TEPLOTA,
                            avg(rychlost) RYCHLOST,
                            avg(narazy) NARAZ
                            from teplomer_data
                            where datum  > dateadd(-1 year to current_date)
                            and idcidlo = $id
                            group by datum
                            order by datum asc;");
    }

    public function getRocniSouhrnVlhkost($id){
      return Db::multiQuery("select distinct substr(datum,1,7) DATUM, avg(relvlhkost) VLHKOST
                            from teplomer_data
                            where datum  > dateadd(-1 year to current_date)
                            and idcidlo = $id
                            group by datum
                            order by datum asc;");
    }

  }

?>
