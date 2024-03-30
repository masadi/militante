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
      <th scope="col">No</th><th scope="col">District</th>
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
  $no=1;$row="";
  foreach ($ambilkabupaten as $kabupaten) {
    $row .= "<tr><td>".$no."</td><td>" . $kabupaten->nama_district . "</td>";
    for ($n = 0; $n < count($idparacalon); $n++) {
        $querysaya = DB::table('hitung')
            ->leftjoin('saksi','hitung.saksihitung','saksi.idsaksi')
            ->leftjoin('kabupaten','saksi.kabupatensaksi','kabupaten.idkabupaten')
            ->leftjoin('profil','saksi.saksiuntuk','profil.idcaleg')
            ->where('profil.idcaleg','=',$idparacalon[$n])
            ->where('kabupaten.idkabupaten','=',$kabupaten->idkabupaten)
            ->groupby('profil.idcaleg')
            ->groupby('kabupaten.idkabupaten')
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
