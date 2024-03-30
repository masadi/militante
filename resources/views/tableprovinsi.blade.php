<?php
        $ambilcalon=$this->Hitung_m->ambilcalon();
        $ambilprovinsi=$this->Hitung_m->ambilprovinsi();
        $ambilkabupaten=$this->Hitung_m->ambilkabupaten();
        $ambilkecamatan=$this->Hitung_m->ambilkecamatan();
        $ambilkelurahan=$this->Hitung_m->ambilkelurahan();
        $ambiltps=$this->Hitung_m->ambiltps();
        ?>
 <table id="table" class="display nowrap" style="width:100%">
  <tr>
    <th>&nbsp;</th>
    <?php 
    $idparacalon=array();
    foreach($ambilcalon as $kepala){
      array_push($idparacalon,$kepala['idcaleg']);
      echo "<th>".$kepala['namacaleg']."</th>";
    }
    ?>
  </tr>
<?php 
$row="";
foreach($ambilprovinsi as $provinsi){
  $row.="<tr><td>".$provinsi['namaprovinsi']."</td>";
    for($n=0;$n<count($idparacalon);$n++){

        $queryprovinsi=$this->db->query("SELECT ht.saksihitung, 
namaprovinsi,namacaleg,idcaleg,idprovinsi,SUM(jumlah) as jumlahprov
FROM hitung ht
JOIN saksi sk ON ht.saksihitung = sk.idsaksi
JOIN provinsi prov on sk.provinsisaksi=prov.idprovinsi
JOIN profil pr on sk.saksiuntuk=pr.idcaleg
WHERE idcaleg=$idparacalon[$n]
AND idprovinsi=$provinsi[idprovinsi]
GROUP BY idcaleg,idprovinsi");

      if($hasil= $queryprovinsi->row_array()){
      $row.="<td ><b>".$hasil['jumlahprov']."</b></td>";
    }else{
      $row.="<td>0</td>";
    }

  }
  $row.="</tr>";
}
echo $row;
?>
</table>
