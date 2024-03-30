<div class="table-responsive">
<?php
$ambilcalon = DB::table('profil')->get();
$ambilkabupaten = DB::table('kabupaten')->get();
$ambilkecamatan = DB::table('kecamatan')->get();
$ambilkelurahan = DB::table('kelurahan')->get();
$ambiltps = DB::table('tps')->get();
?>

{{csrf_field()}}
<table id="table" class="table">
  <thead>
    <tr>
      <th scope="col">No</th><th scope="col">Suco</th>
      <?php
      $i=0;
      $idparacalon = array();
      foreach ($ambilcalon as $kepala) {
        array_push($idparacalon, $kepala->idcaleg);
        echo "<th scope=\"col\">" . $kepala->namacaleg . "</th>";
        $i++;
      }
      ?>
    </tr>
  </thead>
  <tbody>
  <?php
  $row = "";$no=1;
  foreach ($ambiltps as $tps) {
    $row .= "<tr><td>".$no."</td><td>" . $tps->nama_aldeia . "</td>";
    for ($n = 0; $n < count($idparacalon); $n++) {


        $querysaya = DB::table('hitung')
            ->leftjoin('saksi','hitung.saksihitung','saksi.idsaksi')
            ->leftjoin('tps','saksi.tpssaksi','tps.idtps')
            ->leftjoin('profil','saksi.saksiuntuk','profil.idcaleg')
            ->where('profil.idcaleg','=',$idparacalon[$n])
            ->where('tps.idtps','=',$tps->idtps)
            ->groupby('profil.idcaleg')
            ->groupby('tps.idtps')
            ->get();

        $i=0;

        foreach ($querysaya as $hasil) {
            if ($hasil->jumlah>0) {
                $row .= "<td><b>" . $hasil->jumlah . "</b></td>";
            } else {
                $row .= "<td>0</td>";
            }
            $i=1;
        }
        if($i<1) $row .= "<td>0</td>";
    }
    $row .= "</tr>";$no++;
  }
  echo $row;
  ?>
  </tbody>
</table>
</div>
