<?php
  session_start();
  ibase_connect('1.2.3.123:/var/lib/czf/jmnet.gdb', 'teplomer', 'remolpet');
  $stanId = $_SESSION['staniceID'];
  $prep = ibase_prepare("select first 1 skip 0 teplota, substr(datum,9,10) || '.' ||substr(datum,7,7) || '.' || substr(datum,1,4) || ' ' || substr(datum,12,19) DATUM, relvlhkost, rosnybod, rychlost, tlak  from teplomer_data where idcidlo = $stanId order by id desc;");
  $res = ibase_execute($prep);
  $currData = ibase_fetch_assoc($res);

  $casPrep = ibase_prepare("select first 1 skip 0 substr(datum,12,16) from teplomer_data where idcidlo = $stanId order by datum desc");
  $casRes = ibase_execute($casPrep);
  $casData = ibase_fetch_row($casRes);
  $casRed = $casData[0];
  
  $prep1 = ibase_prepare("select first 5 skip 0 substr(datum,9,10) || '.' ||substr(datum,6,7) || '.' || substr(datum,1,4) as CAS, TEPLOTA, relvlhkost  from teplomer_data
                          where idcidlo = $stanId
                          and datum like '%$casRed%'
                          order by datum desc");
  $posledniDobou = ibase_execute($prep1);

  $prepJmCid = ibase_prepare("select jmeno from teplomer where id = $stanId");
  $JmCidEx = ibase_execute($prepJmCid);
  $jmenoCidla = ibase_fetch_assoc($JmCidEx);

  $prepPocMer = ibase_prepare("select count(*) from teplomer_data where idcidlo = $stanId");
  $pocMerEx = ibase_execute($prepPocMer);
  $pocetMereni = ibase_fetch_row($pocMerEx);

  $prepPrvMer = ibase_prepare("select first 1 skip 0 substr(datum,9,10) || '.' ||substr(datum,6,7) || '.' || substr(datum,1,4)
  from teplomer_data where idcidlo = $stanId order by datum asc");
  $prvMerEx = ibase_execute($prepPrvMer);
  $prvniMer = ibase_fetch_row($prvMerEx);

  $prepMaxTemp = ibase_prepare("select datum, teplota from teplomer_data where idcidlo = $stanId and teplota = (select max(teplota) from teplomer_data where idcidlo = $stanId)");
  $maxTempEx = ibase_execute($prepMaxTemp);
  $maxTeplota = ibase_fetch_assoc($maxTempEx);

  $prepMinTemp = ibase_prepare("select datum, teplota from teplomer_data where idcidlo = $stanId and teplota = (select min(teplota) from teplomer_data where idcidlo = $stanId)");
  $minTempEx = ibase_execute($prepMinTemp);
  $minTeplota = ibase_fetch_assoc($minTempEx);
?>

<div class="infobox AktualniTeplota text-center  col-xl-3 col-lg-3 col-md-12">
  <h3 class="p-1 blueRow">Dříve touto dobou</h3>
  <?php while($row = ibase_fetch_object($posledniDobou)) : ?>
      <p class="statistika"><?= $row->CAS ?> <?= $row->TEPLOTA?>&deg;C <?= $row->RELVLHKOST ?>%</p>
  <?php endwhile  ?>

</div>

<div class="infobox AktualniTeplota p-5 text-center col-xl-5 col-lg-5 col-md-12" id="infoB-Aktual">
  <div class="teplota">
    <h2>Aktuální teplota: <?= $currData['TEPLOTA'] ?>&deg;C</h2>
    <h4><?= $currData['DATUM'] ?></h4>
  </div>
  <div class="row justify-content-center pt-3">
    <div class="vlhkost d-flex align-items-center justify-content-center text-center blueRow col-5 mx-1">
      <h2>Vlhkost: <?= $currData['RELVLHKOST'] ?>%</h2>
    </div>
    <div class="rosnybod d-flex align-items-center justify-content-center text-center redRow col-5">
      <h2>Rosný bod: <?= $currData['ROSNYBOD'] ?>&deg;C</h2>
    </div>
  </div>
  <div class="row justify-content-center pt-3">
    <div class="Vitr d-flex align-items-center justify-content-center text-center greenRow col-5 mx-1">
      <h2>Vítr: <?= $currData['RYCHLOST'] ?>km/h</h2>
    </div>
    <div class="Tlak d-flex align-items-center justify-content-center text-center orangeRow col-5">
      <h2>Tlak: <?= $currData['TLAK'] ?>hPa</h2>
    </div>
  </div>
</div>

<div class="infobox AktualniTeplota text-center col-xl-3 col-lg-3 col-md-12">
        <h3 class="p-1 blueRow">Statistiky</h3>
        <p class="statistika">Název čidla: <?= $jmenoCidla['JMENO'] ?></p>
        <p class="statistika">Počet měření: <?= $pocetMereni[0] ?></p>
        <p class="statistika">První měření: <?= $prvniMer[0] ?></p>
        <p class="statistika">Maximální teplota: <?= $maxTeplota['TEPLOTA'] ?>&deg;C</p>
        <p class="statistika">Minimální teplota: <?= $minTeplota['TEPLOTA'] ?>&deg;C</p>
</div>
