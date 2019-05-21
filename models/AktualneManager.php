<?php

  class AktualneManager(){

    public fuction getMinTemp($id){
      Db::singleQuery("select min(teplota) from teplomer_data where datum like 'CURRENT_DATE, %' and id = $id group by id;");
    }

    public function getAvgTemp($id){
      Db::singleQuery("select avg(teplota) from teplomer_data where datum like 'CURRENT_DATE, %' and id = $id group by id;");
    }

    public function getMaxTemp($id){
      Db::singleQuery("select max(teplota) from teplomer_data where datum like 'CURRENT_DATE, %' and id = $id group by id;");
    }

  }

 ?>
