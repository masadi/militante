<!DOCTYPE html>
<html lang="en" class="loading">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <!-- <link rel="stylesheet" type="text/css" href="{{url('app-assets/fonts/feather/style.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('app-assets/css/app.css')}}">
    <meta http-equiv="refresh" content="0; url={{url('/umakain/list')}}">-->
    <style>
        body{
            background:#fff;
            font-family: Tahoma;
        }


    </style>
   </head>
   <?php // <body onload="window.print();"> ?>
<body>
   <?php foreach ($query as $militante) { ?>

    <div class="row">
        <div class="col-md-12"><center>



        <table class="table table-striped table-bordered zero-configuration" width="100%" style="font-size:14px;" border="0">
          <tr>
            <td width="100px" align='center'>&nbsp;</td>
            <td width="100px" align='center'><img src="{{url('app-assets/potocalegroot/ok2.png')}}" alt="logo" height="100"></td>
            <td align='center' colspan="3" width="700px"><b>FRENTE REVOLUCIONARIA DO TIMOR - LESTE INDEPENDENTE<br>
            FRETILIN<br>
            SECRETARIADO NACIONAL<br>
            Servisu Registu no Organizasaun Militante</b>
            </td>          
            <td width="100px" align='center'> <img src="{{url('app-assets/potocalegroot/fretilin2.png')}}" alt="logo" height="80"></td>
                   
            <td width="100px" align='center' valign="top">
              <table cellspacing="0" cellpadding="0" border="1">
                <tr><td style="padding-top:10px;padding-bottom:10px;padding-left:10px;padding-right:10px;font-size:1.3em"><b>F1</b></td></tr>
              </table>
            </td>
          </tr>
          <tr><td colspan="7"><hr></td></tr>
          <tr><td colspan="7" align="center">FICHA UMA KAIN MILITANTE FRETILIN</td></tr>
          
          <tr>
            <td colspan="3">
              <table border="0" style="font-size:0.9em">
                <tr colspan="3" ><td><b>RESIDENSIA / HELA FATIN</b></td></tr>
                <tr><td>Municipio</td><td>:</td><td>{{$militante->nama_district}}</td></tr>
                <tr><td>Posto Adm.</td><td>:</td><td>{{$militante->nama_subdistrict}}</td></tr>
                <tr><td>Suco</td><td>:</td><td>{{$militante->nama_suco}}</td></tr>
                <tr><td>Aldeia</td><td>:</td><td>{{$militante->nama_aldeia}}</td></tr>
                <tr><td>Celula</td><td>:</td><td>{{$militante->nama_district}}</td></tr>
                <tr><td><b>Atitude</b></td><td>:</td><td></td><td><b>Long Atitude</b></td><td>:</td><td></td></tr>
              </table>
            </td>
            <td width="150">              </td>
            <td colspan="2">
              <table border="0" style="font-size:0.9em">
                <tr><td>Numeru Database</td><td>:</td>
                <td>
                  <table cellspacing="0" cellpadding="0" border="1">
                    <tr><td style="padding-top:5px;padding-bottom:5px;padding-left:5px;padding-right:5px;font-size:1.1em">
                    <b>{{$militante->numeru_database}}</b></td></tr>
                  </table>
                </td></tr>
                <tr><td>Numeru Registu</td><td>:</td>
                <td>
                <table cellspacing="0" cellpadding="0" border="1">
                    <tr><td style="padding-top:5px;padding-bottom:5px;padding-left:5px;padding-right:5px;font-size:1.1em">
                    <b>{{$militante->numeru_registru}}</b></td></tr>
                  </table>
                </td></tr>
                <tr><td>Data</td><td></td><td>{{$militante->data_assinatura}}</td></tr>
                <tr><td>Assinatura</td><td></td><td></td></tr>
                <tr><td>Chefe Familia</td><td>:</td><td>{{$militante->chefe_familia}}</td></tr>
                <tr><td>Militante Responsavel</td><td>:</td><td>{{$militante->militante_responsavel}}</td></tr>
                <tr><td>Nu. Komtaktu</td><td>:</td><td>{{$militante->militante_responsavel}}</td></tr>
              </table>
            </td>
            <td valign="top">
            <img src="https://chart.googleapis.com/chart?cht=qr&chl=<?php echo $militante->numeru_database;?>&chs=260x260&chld=L|0"  class="qr-code img-thumbnail img-responsive" width="100%"/>
            </td>
          </tr>
        </table>  
          
          
        


        <table border="1" width='100%' style="font-size:0.6em"  cellspacing="0" cellpadding="0">
                        <tr bgcolor="#DDD" style="font-weight:bold">
                          <td rowspan="2" align="center">No.</td>
                          <td rowspan="2" align="center">Naran Kompletu (Hanesan iha Kartaun Eleitoral)</td>
                          <td rowspan="2" align="center">Rel. Familia</td>
                          <td rowspan="2" align="center">Generu<br>1.Mane<br>2.Feto</td>
                          <td rowspan="2" align="center">Loron/ Fulan/ Tinan Moris</td>
                          <td colspan="2" align="center">Kartaun Eleitoral</td>
                          <td rowspan="2" align="center">No Kontaktu</td>
                          <td rowspan="2" align="center">No Kartasun Militante</td>
                          <td rowspan="2" align="center">Tinan Tama Partido</td>
                          <td rowspan="2" align="center">Akt. Militante</td>
                          <td rowspan="2" align="center">Kargo Atual iha Orgaun Estrutura</td>
                          <td rowspan="2" colspan="2" align="center">Sector Servico No Profisaun</td>
                          <td rowspan="2" align="center">Hab. Literaria</td>
                          <td rowspan="2" align="center">Estatutu Mutasaun Militante</td>
                          <td rowspan="2" align="center">Mmembru Cooperativa</td>
                        </tr>   
                        <tr bgcolor="#DDD" style="font-weight:bold">
                          <td  align="center">Numeru</td>
                          <td  align="center">Husi Aldeida Nebe</td>
                        </tr>          
                        <tr style="height: 35px;white-space: nowrap;" bgcolor="#DDD">
                          <td align="center"><small>(1)</small></td>
                          <td align="center"><small>(2)</small></td>
                          <td align="center"><small>(3)</small></td>
                          <td align="center"><small>(4)</small></td>
                          <td align="center"><small>(5)</small></td>
                          <td align="center"><small>(6)</small></td>
                          <td align="center"><small>(7)</small></td>
                          <td align="center"><small>(8)</small></td>
                          <td align="center"><small>(9)</small></td>
                          <td align="center"><small>(10)</small></td>
                          <td align="center"><small>(11)</small></td>
                          <td align="center"><small>(12)</small></td>
                          <td align="center"><small>(13)</small></td>
                          <td align="center"><small>(14)</small></td>
                          <td align="center"><small>(15)</small></td>
                          <td align="center"><small>(16)</small></td>
                          <td align="center"><small>(17)</small></td>
                        </tr>
                        
                        <?php 
                        $no=1;
                        foreach ($detail as $data) { 
                          if($data->data_11==0) $data->data_11="";
                          if($data->data_12==0) $data->data_12="";
                          if($data->data_13==0) $data->data_13="";
                          if($data->data_14==0) $data->data_14="";
                          if($data->data_15==0) $data->data_15="";
                          if($data->data_16==0) $data->data_16="";
                          if($data->data_17==0) $data->data_17="";
                          
                        ?>
                        <tr>
                          <td align="left">{{$no}}</td>
                          <td align="left">{{$data->data_2}}</td>
                          <td align="center">{{$data->data_3}}</td>
                          <td align="center">{{$data->data_4}}</td>
                          <td align="center">{{$data->data_5}}</td>
                          <td align="center">{{$data->data_6}}</td>
                          <td align="center">{{$data->data_7}}</td>
                          <td align="center">{{$data->data_8}}</td>
                          <td align="center">{{$data->data_9}}</td>
                          <td align="center">{{$data->data_10}}</td>
                          <td align="center">{{$data->data_11}}</td>
                          <td align="center">{{$data->data_12}}</td>
                          <td align="center">{{$data->data_13}}</td>
                          <td align="center">{{$data->data_14}}</td>
                          <td align="center">{{$data->data_15}}</td>
                          <td align="center">{{$data->data_16}}</td>
                          <td align="center">{{$data->data_17}}</td>
                        </tr>
                        <?php 
                          $no++;
                        } 
                        ?>
                        <?php if($no<11) { 
                        for($i=$no;$i<=11;$i++) {
                        ?>
                        <tr>
                          <td align="left">{{$i}}</td>
                          <td align="left"></td>
                          <td align="left"></td>
                          <td align="left"></td>
                          <td align="left"></td>
                          <td align="left"></td>
                          <td align="left"></td>
                          <td align="left"></td>
                          <td align="left"></td>
                          <td align="left"></td>
                          <td align="left"></td>
                          <td align="left"></td>
                          <td align="left"></td>
                          <td align="left"></td>
                          <td align="left"></td>
                          <td align="left"></td>
                          <td align="left"></td>
                        </tr>
                        <?php }} ?>
                        
                      </table>
                      <br>
                      
                      <table border="0" width='100%' style="font-size:0.55em"  cellspacing="0" cellpadding="0">
                        <tr valign="top">
                          <td>
                            <table border="1" cellspacing="0" cellpadding="0">
                              <tr><td colspan="2">Kodigu (3) : Relasaun Familia ho<br>
                                  Chefi Familia / Responsavel
                              </td></tr>
                                <?php 
                                  $i=0;$no=1;$val=array();$name=array();
                                  $data=DB::table('relfamilia')->orderBy('value','ASC')->get();
                                  foreach ($data as $dt) {
                                      $val[$i]=$dt->value;
                                      $name[$i]=$dt->name;
                                      $i++;$no++;
                                  }
                                ?>
                              <tr><td>
                                <?php 
                                  for($j=0;$j<$i;$j++) {
                                    echo $name[$j].'<br>';
                                  }
                                ?>
                              </td>
                              <td align="center"><b>
                                <?php 
                                  for($j=0;$j<$i;$j++) {
                                    echo $val[$j].'<br>';
                                  }
                                ?></b>
                              </td></tr>
                            </table>
                          </td>

                          <td>
                          <table border="1" cellspacing="0" cellpadding="0">
                              <tr><td colspan="2">Kodigu (11) : Aktualizasaun Militantes
                              </td></tr>
                                <?php 
                                  $i=0;$no=1;$val=array();$name=array();
                                  $data=DB::table('aktmilitante')->orderBy('value','ASC')->get();
                                  foreach ($data as $dt) {
                                      $val[$i]=$dt->value;
                                      $name[$i]=$dt->name;
                                      $i++;$no++;
                                  }
                                ?>
                              <tr><td>
                                <?php 
                                  for($j=0;$j<$i;$j++) {
                                    echo $name[$j].'<br>';
                                  }
                                ?>
                              </td>
                              <td align="center"><b>
                                <?php 
                                  for($j=0;$j<$i;$j++) {
                                    echo $val[$j].'<br>';
                                  }
                                ?></b>
                              </td></tr>
                            </table>
                          </td>
                          <td rowspan="2">

                            <table border="1" cellspacing="0" cellpadding="0">
                              <tr><td colspan="2">Kodigu (12) : Kargo atual iha Orgaun Estrutura
                              </td></tr>
                                <?php 
                                  $i=0;$no=1;$val=array();$name=array();
                                  $data=DB::table('kargoaktual')->orderBy('value','ASC')->get();
                                  foreach ($data as $dt) {
                                      $val[$i]=$dt->value;
                                      $name[$i]=$dt->name;
                                      $i++;$no++;
                                  }
                                ?>
                              <tr><td>
                                <?php 
                                  for($j=0;$j<$i;$j++) {
                                    echo $name[$j].'<br>';
                                  }
                                ?>
                              </td>
                              <td align="center"><b>
                                <?php 
                                  for($j=0;$j<$i;$j++) {
                                    echo $val[$j].'<br>';
                                  }
                                ?></b>
                              </td></tr>
                            </table>
                          </td>
                          <td rowspan="2">

                          <table border="1" cellspacing="0" cellpadding="0">
                              <tr><td colspan="2">Kodigu (13) : Sector Servico
                              </td></tr>
                                <?php 
                                  $i=0;$no=1;$val=array();$name=array();
                                  $data=DB::table('sectorservico')->orderBy('value','ASC')->get();
                                  foreach ($data as $dt) {
                                      $val[$i]=$dt->value;
                                      $name[$i]=$dt->name;
                                      $i++;$no++;
                                  }
                                ?>
                              <tr><td>
                                <?php 
                                  for($j=0;$j<$i;$j++) {
                                    echo $name[$j].'<br>';
                                  }
                                ?>
                              </td>
                              <td align="center"><b>
                                <?php 
                                  for($j=0;$j<$i;$j++) {
                                    echo $val[$j].'<br>';
                                  }
                                ?></b>
                              </td></tr>
                            </table>
                            <br>
                            
                            <table border="1" cellspacing="0" cellpadding="0">
                              <tr><td colspan="2">Kodigu (14) : Profisaun
                              </td></tr>
                                <?php 
                                  $i=0;$no=1;$val=array();$name=array();
                                  $data=DB::table('profisaun')->orderBy('value','ASC')->get();
                                  foreach ($data as $dt) {
                                      $val[$i]=$dt->value;
                                      $name[$i]=$dt->name;
                                      $i++;$no++;
                                  }
                                ?>
                              <tr><td>
                                <?php 
                                  for($j=0;$j<$i;$j++) {
                                    echo $name[$j].'<br>';
                                  }
                                ?>
                              </td>
                              <td align="center"><b>
                                <?php 
                                  for($j=0;$j<$i;$j++) {
                                    echo $val[$j].'<br>';
                                  }
                                ?></b>
                              </td></tr>
                            </table>
                          </td>
                          <td rowspan="2" align="right">

                          <table border="1" cellspacing="0" cellpadding="0">
                              <tr><td colspan="2">Kodigu (15) : Habilitasaun Literaria
                              </td></tr>
                                <?php 
                                  $i=0;$no=1;$val=array();$name=array();
                                  $data=DB::table('literaria')->orderBy('value','ASC')->get();
                                  foreach ($data as $dt) {
                                      $val[$i]=$dt->value;
                                      $name[$i]=$dt->name;
                                      $i++;$no++;
                                  }
                                ?>
                              <tr><td>
                                <?php 
                                  for($j=0;$j<$i;$j++) {
                                    echo $name[$j].'<br>';
                                  }
                                ?>
                              </td>
                              <td align="center"><b>
                                <?php 
                                  for($j=0;$j<$i;$j++) {
                                    echo $val[$j].'<br>';
                                  }
                                ?></b>
                              </td></tr>
                            </table>
                          </td>
                          <td>

                          <table border="1" cellspacing="0" cellpadding="0">
                              <tr><td colspan="2">Kodigu (16) : Estatuto / Mutasaun
                              </td></tr>
                                <?php 
                                  $i=0;$no=1;$val=array();$name=array();
                                  $data=DB::table('estatuto')->orderBy('value','ASC')->get();
                                  foreach ($data as $dt) {
                                      $val[$i]=$dt->value;
                                      $name[$i]=$dt->name;
                                      $i++;$no++;
                                  }
                                ?>
                              <tr><td>
                                <?php 
                                  for($j=0;$j<$i;$j++) {
                                    echo $name[$j].'<br>';
                                  }
                                ?>
                              </td>
                              <td align="center"><b>
                                <?php 
                                  for($j=0;$j<$i;$j++) {
                                    echo $val[$j].'<br>';
                                  }
                                ?></b>
                              </td></tr>
                            </table>
                          </td>
                          <td >

                          <table border="1" cellspacing="0" cellpadding="0">
                              <tr><td colspan="2">Kodigu (17) : Membru Cooperativa
                              </td></tr>
                                <?php 
                                  $i=0;$no=1;$val=array();$name=array();
                                  $data=DB::table('membru')->orderBy('value','ASC')->get();
                                  foreach ($data as $dt) {
                                      $val[$i]=$dt->value;
                                      $name[$i]=$dt->name;
                                      $i++;$no++;
                                  }
                                ?>
                              <tr><td>
                                <?php 
                                  for($j=0;$j<$i;$j++) {
                                    echo $name[$j].'<br>';
                                  }
                                ?>
                              </td>
                              <td align="center"><b>
                                <?php 
                                  for($j=0;$j<$i;$j++) {
                                    echo $val[$j].'<br>';
                                  }
                                ?></b>
                              </td></tr>
                            </table>
                          </td>
                        </tr>
                        <tr>
                          <td colspan=2><br><br><br><br><br><br><br><br><br><br>
                                <table border="0" cellspacing="0" cellpadding="0">
                                <tr align="center">
                                  <td>
                                    ( Hanesan iha Kartaun Eleitoral ) 
                                  </td>
                                </tr>
                                <tr align="center">
                                  <td><br><br><br><br><br>
                                  __________________________________________
                                  </td>
                                </tr>
                                <tr align="center">
                                  <td>
                                  Coordenador Aldea
                                  </td>
                                </tr>
                                <tr>
                                  <td><br>
                                  No. Kontaktu  :
                                  <br>
                                  Data imprimi  : <?php echo date('Y-m-d H:m:i'); ?> 
                                </td>
                                </tr>

                                </table>
                           </td>
                           
                          <td colspan=2><br><br><br><br><br><br><br><br><br><br><br>
                                <table border="0" cellspacing="0" cellpadding="0">
                                
                                <tr align="center">
                                  <td><br><br><br><br><br>
                                  __________________________________________
                                  </td>
                                </tr>
                                <tr align="center">
                                  <td>
                                  Ajente Konfirsaun
                                  </td>
                                </tr>
                                <tr>
                                  <td><br>
                                  No. Kontaktu  :
                                </td>
                                </tr>

                                </table>


                           </td>

                        </tr>
                      </table>
        </center>
        </div>
    </div>
    <?php } ?>
   </body>
</html>