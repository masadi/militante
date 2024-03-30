<!DOCTYPE html>
<html lang="en" class="loading">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <!-- <link rel="stylesheet" type="text/css" href="{{url('app-assets/fonts/feather/style.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('app-assets/css/app.css')}}">
    <meta http-equiv="refresh" content="0; url={{url('/militantevip/list')}}">-->
    <style>
        body{
            background:#fff;
            font-family: Tahoma;
        }


    </style>
   </head>
   <!-- <body onload="window.print();"> -->
   <body>

   <?php foreach ($data as $militante) { ?>

    <div class="row">
        <div class="col-md-12"><center>



        <table class="table table-striped table-bordered zero-configuration" width="100%" style="font-size:14px;" border="0">
          <tr>
            <td width="100px" align='center'><img src="{{url('app-assets/potocalegroot/ok2.png')}}" alt="logo" height="100"></td>
            <td align='center' colspan="3" width="700px"><b>FRENTE REVOLUCIONARIA DO TIMOR - LESTE INDEPENDENTE<br>
            FRETILIN<br>
            SECRETARIADO NACIONAL<br>
            Divizaun Servisu Registu no Organizasaun Militante</b>
            </td>
            <td width="100px" align='center'> <img src="{{url('app-assets/potocalegroot/fretilin2.png')}}" alt="logo" height="80"></td>
          </tr>
          <tr><td colspan="5"><hr></td></tr>
        </table>

        <table class="table table-striped table-bordered zero-configuration" width="100%" style="font-size:14px;" border="0">
          <tr><td colspan="5"><h4>HELA FATIN</h4></td></tr>

          <tr>
          <td width="15%">Distrito</td>
          <td width="30%">
            <table border="1" cellspacing="0" cellpadding="0">
              <?php
                $listkabupaten = DB::table('kabupaten')->where('idkabupaten',$militante->kabupaten_id)->get();
              ?>
              <tr><td width="250" height="28" style="padding-left:5px">
              <?php foreach ($listkabupaten as $lista) {
                echo $lista->nama_district;
              } ?>
              </td></tr>
            </table>
          </td>
          <td width="5%">&nbsp;</td>
          <td width="15%">Suco</td>
          <td width="30%">

            <?php
                $listkelurahan = DB::table('kelurahan')->where('idkelurahan',$militante->kelurahan_id)->get();
            ?>
            <table border="1" cellspacing="0" cellpadding="0">
              <tr><td width="250" height="28" style="padding-left:5px">
              <?php foreach ($listkelurahan as $listb) {
                echo $listb->nama_suco;
              } ?>
              </td></tr>
            </table>
          </td>
          </tr>

          <tr>
          <td>Subdistrito</td>
          <td>
            <?php
                $listkecamatan = DB::table('kecamatan')->where('idkecamatan',$militante->kecamatan_id)->get();
            ?>
            <table border="1" cellspacing="0" cellpadding="0">
              <tr><td width="250" height="28" style="padding-left:5px">
              <?php foreach ($listkecamatan as $listc) {
                echo $listc->nama_subdistrict;
              } ?>
              </td></tr>
            </table>
          </td>
          <td>&nbsp;</td>
          <td>Aldeia</td>
          <td>
            <?php
                $listdesa = DB::table('tps')->where('idtps',$militante->desa_id)->get();
            ?>
            <table border="1" cellspacing="0" cellpadding="0">
              <tr><td width="250" height="28" style="padding-left:5px">
              <?php foreach ($listdesa as $listd) {
                echo $listd->nama_aldeia;
              } ?>
              </td></tr>
            </table>
          </td>
          </tr>
        </table>

        <table class="table table-striped table-bordered zero-configuration" width="100%" style="font-size:14px;" border="0">
          <tr><td colspan="5"><h4>IDENTIDADE MILITANTE</h4></td></tr>
          <tr>
          <td width="30%" align='center' > <table border="1" cellspacing="0" cellpadding="0">
              <tr><td>Foto<br><img src="{{url('app-assets/img/blank.jpg')}}" width="130"></td></tr>
            </table></td>
          <td width="5%"></td>
          <td width="30%" align='center' > <table border="1" cellspacing="0" cellpadding="0">
              <tr><td>Impressaun Digital<br><img src="{{url('app-assets/img/blank.jpg')}}" width="130"></td></tr>
            </table></td>
          <td width="5%"></td>
          <td width="30%" align='center' >
            <table border="1" cellspacing="0" cellpadding="0">
              <tr><td>Assinatura<br><img src="{{url('app-assets/img/blank.jpg')}}" width="130"></td></tr>
            </table>
          </td>
          </tr>
        </table><br>

        <table class="table table-striped table-bordered zero-configuration" width="100%" style="font-size:14px;" border="0">
          <tr>
          <td width="15%">No. Militante</td>
          <td width="30%">
            <table border="1" cellspacing="0" cellpadding="0">
              <tr><td width="250" height="28" style="padding-left:5px">{{strtoupper($militante->no_militante)}}</td></tr>
            </table>
          </td>
          <td width="5%">&nbsp;</td>
          <td width="15%">Tinan tama Partido</td>
          <td width="30%">
            <table border="1" cellspacing="0" cellpadding="0">
              <tr><td width="250" height="28" style="padding-left:5px">{{strtoupper($militante->alamat)}}</td></tr>
            </table>
          </td>
          </tr>

          <tr>
          <td width="15%">No. Elector</td>
          <td width="30%">
            <table border="1" cellspacing="0" cellpadding="0">
              <tr><td width="250" height="28" style="padding-left:5px">{{strtoupper($militante->no_elektor)}}</td></tr>
            </table>
          </td>
          <td width="5%">&nbsp;</td>
          <td width="15%">Estatuto Militante</td>
          <td width="30%">
            <table border="1" cellspacing="0" cellpadding="0">
              <?php if($militante->status) $status="ATIVO";
              else  $status="NO ATIVO";?>
              <tr><td width="250" height="28" style="padding-left:5px">{{strtoupper($status)}}</td></tr>
            </table>
          </td>
          </tr>

          <tr>
          <td width="15%">Data Emissaun</td>
          <td width="30%">
            <table border="1" cellspacing="0" cellpadding="0">
              <tr><td width="250" height="28" style="padding-left:5px">{{strtoupper($militante->tgl_terbit)}}</td></tr>
            </table>
          </td>
          <td width="10%">&nbsp;&nbsp;</td>
          <td width="15%">Valido To'o</td>
          <td width="30%">
            <table border="1" cellspacing="0" cellpadding="0">
              <tr><td width="250" height="28" style="padding-left:5px">{{strtoupper($militante->valid_until)}}</td></tr>
            </table>
          </td>
          </tr>


          <tr>
          <td width="15%">Naran Kompletu</td>
          <td width="" colspan="3">
            <table border="1" cellspacing="0" cellpadding="0">
              <tr><td width="450" height="28" style="padding-left:5px">{{strtoupper($militante->nama)}}</td></tr>
            </table>
          </td>
          <td width="30%">
          </td>
          </tr>

          <tr>
          <td width="15%">Fatin Moris</td>
          <td width="30%">
            <table border="1" cellspacing="0" cellpadding="0">
              <tr><td width="250" height="28" style="padding-left:5px">{{strtoupper($militante->tempat_lahir)}}</td></tr>
            </table>
          </td>
          <td width="10%">&nbsp;&nbsp;</td>
          <td width="15%">Loron Moris</td>
          <td width="30%">
            <table border="1" cellspacing="0" cellpadding="0">
              <tr><td width="250" height="28" style="padding-left:5px">{{strtoupper($militante->tgl_lahir)}}</td></tr>
            </table>
          </td>
          </tr>

          <tr>
          <td width="15%">Generu</td>
          <td width="30%">
              <?php if($militante->jenis_kelamin=="L") $status="MANE";
              else  $jenis_kelamin="FETO";?>
            <table border="1" cellspacing="0" cellpadding="0">
              <tr><td width="250" height="28" style="padding-left:5px">{{strtoupper($militante->tgl_lahir)}}</td></tr>
            </table>
          </td>
          <td width="10%">&nbsp;&nbsp;</td>
          <td width="15%">Estado Sivil</td>
          <td width="30%">
            <table border="1" cellspacing="0" cellpadding="0">
              <tr><td width="250" height="28"></td></tr>
            </table>
          </td>
          </tr>

          <tr>
          <td width="15%">Aman</td>
          <td width="30%">
            <table border="1" cellspacing="0" cellpadding="0">
              <tr><td width="250" height="28"></td></tr>
            </table>
          </td>
          <td width="10%">&nbsp;&nbsp;</td>
          <td width="15%">Inan</td>
          <td width="30%">
            <table border="1" cellspacing="0" cellpadding="0">
              <tr><td width="250" height="28"></td></tr>
            </table>
          </td>
          </tr>

          <tr>
          <td width="15%">No. Kontaktu</td>
          <td width="30%">
            <table border="1" cellspacing="0" cellpadding="0">
              <tr><td width="250" height="28" style="padding-left:5px">{{strtoupper($militante->telepon)}}</td></tr>
            </table>
          </td>
          <td width="10%">&nbsp;&nbsp;</td>
          <td width="15%">Email</td>
          <td width="30%">
            <table border="1" cellspacing="0" cellpadding="0">
              <tr><td width="250" height="28" style="padding-left:5px">{{strtoupper($militante->email)}}</td></tr>
            </table>
          </td>
          </tr>

          <tr>
          <td width="15%">Residensia</td>
          <td width="30%">
            <table border="1" cellspacing="0" cellpadding="0">
              <tr><td width="250" height="28"></td></tr>
            </table>
          </td>
          <td width="10%">&nbsp;&nbsp;</td>
          <td width="15%">Observasaun</td>
          <td width="30%">
            <table border="1" cellspacing="0" cellpadding="0">
              <tr><td width="250" height="28"></td></tr>
            </table>
          </td>
          </tr>


          <tr><td colspan="5" align="center"><h4>COMPROMISSO</h4></td></tr>
          <tr><td colspan="5" style="text-align: justify;">
          <p>
          Ho kartaun nebée hau simu ona, hau promote hosi née ba oin kaer metin ba politika FRETILIN nian, hahi aàs ba leten emar, hametin unidade iha Partido laran, kontribui ba paz, estabilidade no desenvolvimento nasional no iha nebée la tuir interesse Partido nian.
          <br><br>
          Hau promete mos, karik aban bainrua sés an husi militante FRETILIN, hau sei hakerek carta/ surat resignasaun ba estrutra Partido iha nebée hau hela ba no entrega hikas kartaun militante.
          <br><br>
          Kaer metin ba compromisso née hau pronto submete ba processo estatutaria no legal, karik hau la kumpre iha loron ikus mai.
      </p>
          </td></tr>
        </table>
        </center>
        </div>
    </div>
    <?php } ?>
   </body>
</html>
