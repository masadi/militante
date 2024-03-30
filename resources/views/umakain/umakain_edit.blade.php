@extends('layoututama')
@section('content')
<?php
$username = Session::get('username');
?>


<div class="main-content"> 
  <section class="section">
    <div class='row'>
		  <div class='col-md-12'>
            <?php foreach ($query as $umakain) { ?>
						<form action="javascript:save()" id="form1" name="form1" class="form-horizontal" method='POST' enctype="multipart/form-data" >
              {{csrf_field()}}
              <input type="hidden" class="form-control" id="id"  name="id" value="{{$umakain->id}}">
              <input type="hidden" class="form-control" id="_token"  name="_token" value="{{csrf_token()}}">
              <div class='card card-primary'>
								<div class='card-body'>
                    <div class="row">
                      <div class="col-lg-4">
                        <div class="form-group  row col-md-12">
                          <h6>Residensia / Hela Fatin</h6>
                        </div>
                                                <div class="form-group  row col-md-12">
                                                    <label for="kabupatentim" class="col-sm-12 control-label">Municipio</label>
                                                    <div class="col-md-12">
                                                      <input type="text" name="kabupatentim" class="form-control" value="{{$umakain->nama_district}}" readonly> 

                                                  </div> </div>

                                                <div class="form-group  row col-md-12">
                                                  <label for="kecamatantim" class="col-sm-12 control-label">Posto</label>

                                                  <div class="col-md-12">
                                                      <input type="text" name="kecamatantim" class="form-control" value="{{$umakain->nama_subdistrict}}" readonly> 

                                          
                                                  </div>
                                                </div> 

                                                <div class="form-group  row col-md-12">
                                                  <label for="tahunlulus" class="col-sm-12 control-label">Suco</label>

                                                  <div class="col-md-12">
                                                      <input type="text" name="kelurahantim" class="form-control" value="{{$umakain->nama_suco}}" readonly> 
                                                  </div>
                                                </div>

                                                <div class="form-group  row col-md-12">
                                                  <label for="tahunlulus" class="col-sm-12 control-label">Aldeias</label>

                                                  <div class="col-md-12">
                                                      <input type="text" name="tpstim" class="form-control" value="{{$umakain->nama_aldeia}}" readonly> 

                                                  </div>
                                                </div>

                      </div>

                      <div class="col-lg-4">
                        <div class="form-group  row col-md-12">
                          <h6>Koordinat</h6>
                        </div>
                        <div class="form-group  row col-md-12">
                            <label for="tahunlulus" class="col-sm-12 control-label">Altitude</label>
                            <div class="col-md-12">
                              <input type="text" name="altitude" class="form-control" value="{{$umakain->altitude}}">
                            </div>
                        </div>

                        <div class="form-group  row col-md-12">
                          <label for="tahunlulus" class="col-sm-12 control-label">Longitude</label>

                            <div class="col-md-12">
                              <input type="text" name="longitude" class="form-control" value="{{$umakain->long_altitude}}"> 
                            </div>
                        </div>
                      </div>

                      <div class="col-lg-4">
                        <div class="form-group  row col-md-12">
                          <h6>&nbsp;</h6>
                        </div>
                        <div class="form-group  row col-md-12">
                            <label for="tahunlulus" class="col-sm-12 control-label">Nu Database /Uma Kain</label>
                            <div class="col-md-6">
                              <input type="text" name="nudatabase1" id="nudatabase1" value="{{$umakain->numeru_database}}" class="form-control" readonly required>
                            </div>
                        </div>

                        <div class="form-group  row col-md-12">
                          <label for="tahunlulus" class="col-sm-12 control-label">Numeru Sensus</label>

                            <div class="col-md-6">
                              <input type="text" id="numerusensus" name="numerusensus" value="{{$umakain->numeru_registru}}" class="form-control" readonly required> 
                            </div>
                        </div>

                        <div class="form-group  row col-md-12">
                          <label for="tahunlulus" class="col-sm-12 control-label">Data</label>

                            <div class="col-md-12">
                              <input type="date" id="dataz" name="dataz" class="form-control"  value="{{$umakain->data_assinatura}}"" required> 
                            </div>
                        </div>

                        <div class="form-group  row col-md-12">
                          <label for="tahunlulus" class="col-sm-12 control-label">Celula</label>

                            <div class="col-md-12">
                              <input type="text" name="celula"  id="celula" class="form-control" value="{{$umakain->celula}}"> 
                            </div>
                        </div>
                      </div>

                      <div class="col-lg-8">
                        
                        <div class="form-group  row col-md-12">
                          <label for="tahunlulus" class="col-sm-12 control-label">Hela Fatin</label>

                            <div class="col-md-12">
                              
                            <input type="text" name="hela"  id="hela" class="form-control"  value="{{$umakain->hela}}">
                            </div>
                        </div>

                      </div>
                    </div>
                </div>

						
						  </div>
              <div class='card card-primary'>
								<div class='card-body'>
                    <div class="row">
                      <div class="col-lg-3">
                        <div class="form-group  row col-md-12">
                            <div class="col-md-12">
                              <?php if($umakain->chefe_familia) { ?> 
                                <input type="checkbox" name="chefe"  id="chefe" value="1" checked> <b>Chefe Familia</b>
                              <?php } else { ?>
                                <input type="checkbox" name="chefe"  id="chefe" value="1" > <b>Chefe Familia</b>
                              <?php } ?>
                            </div>
                        </div>
                        <div class="form-group  row col-md-12">
                            <div class="col-md-12">
                              <?php if($umakain->militante_responsavel) { ?> 
                              <input type="checkbox" name="respon"  id="respon" value="1" checked> <b>Militante Responsavel</b>
                              <?php } else { ?>
                                <input type="checkbox" name="respon"  id="respon" value="1" > <b>Militante Responsavel</b>
                              <?php } ?>
                            </div>
                        </div>
                      </div>
                      <div class="col-lg-3">
                        <div class="form-group  row col-md-12">
                            <label for="tahunlulus" class="col-sm-12 control-label">Naran</label>
                            <div class="col-md-12">
                            <input type="text" name="naran" id="naran" class="form-control" value="{{$umakain->naran}}">   
                            </div>
                        </div>
                      </div>
                      <div class="col-lg-3">
                        <div class="form-group  row col-md-12">
                            <label for="tahunlulus" class="col-sm-12 control-label">No. Kontakku</label>
                            <div class="col-md-12">
                            <input type="text" name="kontaknaran" id="kontaknaran" class="form-control" value="{{$umakain->kontaknaran}}">   
                            </div>
                        </div>
                      </div>
                      <div class="col-lg-3">
                        <div class="form-group  row col-md-12">
                            <label for="tahunlulus" class="col-sm-12 control-label">Tanggal Cetak</label>
                            <div class="col-md-12">
                              <input type="date" id="tanggalcetak" name="tanggalcetak" class="form-control" value="{{$umakain->tgl_cetak}}"> 
                            </div>
                        </div>
                      </div>
                    </div>

                    
                    <div class="row">
                      <div class="col-lg-3">
                        <div class="form-group  row col-md-12">
                            <label for="tahunlulus" class="col-sm-12 control-label">Coordenador Aldea</label>
                            <div class="col-md-12">
                              <input type="text" name="coor"  id="coordenador" class="form-control" value="{{$umakain->coordenador}}">
                            </div>
                        </div>
                      </div>
                      <div class="col-lg-3">
                        <div class="form-group  row col-md-12">
                            <label for="tahunlulus" class="col-sm-12 control-label">No. Kontaktu</label>
                            <div class="col-md-12">
                              <input type="text" name="kontakcoor" id="kontakcoor" class="form-control" value="{{$umakain->no_kontaktu_coordenador}}">
                            </div>
                        </div>
                      </div>
                      <div class="col-lg-3">
                        <div class="form-group  row col-md-12">
                            <label for="tahunlulus" class="col-sm-12 control-label">Ajente Konfirmasaun</label>
                            <div class="col-md-12">
                              <input type="text" name="ajente" id="ajente" class="form-control" value="{{$umakain->ajente}}">
                            </div>
                        </div>
                      </div>
                      <div class="col-lg-3">
                        <div class="form-group  row col-md-12">
                            <label for="tahunlulus" class="col-sm-12 control-label">No. Kontaktu</label>
                            <div class="col-md-12">
                              <input type="text" name="kontakajente" id="kontakajente" class="form-control" value="{{$umakain->no_kontaktu_ajente}}">
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-12">
                        <p>
                        <a href="{{url('umakain/list')}}" class="btn btn-danger">BACK TO LIST</a>&nbsp;
                        <button class="btn btn-success"><span class="fa fa-save"></span> UPDATE DATA</button>&nbsp;
                        <a href="{{url('cetak/umakain')}}/{{$umakain->id}}" class="btn btn-warning"><span class="fa fa-print"></span> PRINT UMA KAIN</a></p>  
                      </div>
                    </div>  
                </div>
                
              </div>
                    

              <div class='card card-primary'>
								<div class='card-body' style="overflow-y: auto;">
                    <div class="row">
                      <p><a  href="javascript:void(0)" class="btn btn-primary"  onclick="add_umakain()"><span class="fa fa-plus"></span> TAMBAH ANGGOTA</a>&nbsp;&nbsp;
                              </p>  
                      <table border="1" >
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
                        ?>
                        <tr>
                          <td align="left">{{$no}}</td>
                          <td align="left">{{$data->data_2}}</td>
                          <td align="left">{{$data->data_3}}</td>
                          <td align="left">{{$data->data_4}}</td>
                          <td align="left">{{$data->data_5}}</td>
                          <td align="left">{{$data->data_6}}</td>
                          <td align="left">{{$data->data_7}}</td>
                          <td align="left">{{$data->data_8}}</td>
                          <td align="left">{{$data->data_9}}</td>
                          <td align="left">{{$data->data_10}}</td>
                          <td align="left">{{$data->data_11}}</td>
                          <td align="left">{{$data->data_12}}</td>
                          <td align="left">{{$data->data_13}}</td>
                          <td align="left">{{$data->data_14}}</td>
                          <td align="left">{{$data->data_15}}</td>
                          <td align="left">{{$data->data_16}}</td>
                          <td align="left">{{$data->data_17}}</td>
                        </tr>
                        <?php 
                          $no++;
                        } 
                        ?>
                        <tr>
                          <td align="left">-</td>
                          <td align="left">-</td>
                          <td align="left">-</td>
                          <td align="left">-</td>
                          <td align="left">-</td>
                          <td align="left">-</td>
                          <td align="left">-</td>
                          <td align="left">-</td>
                          <td align="left">-</td>
                          <td align="left">-</td>
                          <td align="left">-</td>
                          <td align="left">-</td>
                          <td align="left">-</td>
                          <td align="left">-</td>
                          <td align="left">-</td>
                          <td align="left">-</td>
                          <td align="left">-</td>
                        </tr><tr>
                          <td align="left">-</td>
                          <td align="left">-</td>
                          <td align="left">-</td>
                          <td align="left">-</td>
                          <td align="left">-</td>
                          <td align="left">-</td>
                          <td align="left">-</td>
                          <td align="left">-</td>
                          <td align="left">-</td>
                          <td align="left">-</td>
                          <td align="left">-</td>
                          <td align="left">-</td>
                          <td align="left">-</td>
                          <td align="left">-</td>
                          <td align="left">-</td>
                          <td align="left">-</td>
                          <td align="left">-</td>
                        </tr>
                      </table>
                    </div>
                </div>
              </div>    
						</form>
            <?php } ?>

						
				
</section>
</div>


<div class="modal fade" id="modal-tps_detail">          
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Data Suco</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <form action="javascript:savemilitante()" id="form" name="form" class="form-horizontal" method='POST' enctype="multipart/form-data" novalidate="novalidate">
          {{csrf_field()}}
          <input type="hidden" class="form-control" id="_token"  name="_token" value="{{csrf_token()}}">
              
          <input type="hidden" name="idno" id="idno" value="{{$umakain->numeru_database}}">
                    
          <?php
          $listmilitante = DB::table('militante')
          ->where('kabupaten_id',$umakain->municipio_id)
          ->where('kecamatan_id',$umakain->posto_id)
          ->where('kelurahan_id',$umakain->suco_id)
          ->where('desa_id',$umakain->aldeia_id)
          ->get();
          ?>              

          <div class="row">
              <div class="form-group col-md-4">
                <label for="inputEmail3" class="col-sm-12 control-label">No. Militante</label>

                <div class="col-sm-12">
                  <select name="nomilitante" id="nomilitante" class="form-control">
                        <option>Select Item</option>
                        <?php foreach ($listmilitante as $list) { ?>
                        <option value="{{ $list->no_militante }}" >
                        {{ $list->no_militante }}
                        </option>
                        <?php } ?>
                  </select>
                </div>
              </div>

              <div class="form-group col-md-8">
                <label for="inputEmail3" class="col-sm-12 control-label">Naran Kompletu</label>

                <div class="col-sm-12">
                  <input type="text" class="form-control" name="nama" id="nama" value="">
                </div>
              </div>
              <div class=" col-md-12"><hr><h5>INFORMATION</h5></div>

              <div class="form-group col-md-4">
                <label for="inputEmail3" class="col-sm-12 control-label">(3) Relasaun Familia</label>

                <div class="col-sm-12">
                    <select class="form-control" name="relfamilia" id="relfamilia">
                        <option>-- Select Item --</option>
                        <?php $relfamilia=DB::table('relfamilia')->get(); ?>
                        <?php foreach ($relfamilia as $list) { ?>
                        <option value="{{ $list->value }}" >{{ $list->name }}</option>
                        <?php } ?>
                    </select>
                </div>
              </div>


              <div class="form-group col-md-4">
                <label for="inputEmail3" class="col-sm-12 control-label">(10) Tinan Tama Partido</label>

                <div class="col-sm-12">
                    <input type="number" class="form-control" name="tinan" id="tinan"> 
                </div>
              </div>


              <div class="form-group col-md-4">
                <label for="inputEmail3" class="col-sm-12 control-label">(11) Aktualizasaun Militantes</label>

                <div class="col-sm-12">
                    <select class="form-control" name="aktmilitante" id="aktmilitante">
                        <option>-- Select Item --</option>
                        <?php $aktmilitante=DB::table('aktmilitante')->get(); ?>
                        <?php foreach ($aktmilitante as $list) { ?>
                        <option value="{{ $list->value }}" >{{ $list->name }}</option>
                        <?php } ?>
                    </select>
                </div>
              </div>


              <div class="form-group col-md-4">
                <label for="inputEmail3" class="col-sm-12 control-label">(12) Kargo Atual Iha Orgaun Estrutura</label>

                <div class="col-sm-12">
                    <select class="form-control" name="kargoaktual" id="kargoaktual">
                        <option>-- Select Item --</option>
                        <?php $kargoaktual=DB::table('kargoaktual')->get(); ?>
                        <?php foreach ($kargoaktual as $list) { ?>
                        <option value="{{ $list->value }}" >{{ $list->name }}</option>
                        <?php } ?>
                    </select>
                </div>
              </div>

              <div class="form-group col-md-4">
                <label for="inputEmail3" class="col-sm-12 control-label">(13) Sector Servico</label>

                <div class="col-sm-12">
                    <select class="form-control" name="sectorservico" id="sectorservico">
                        <option>-- Select Item --</option>
                        <?php $sectorservico=DB::table('sectorservico')->get(); ?>
                        <?php foreach ($sectorservico as $list) { ?>
                        <option value="{{ $list->value }}" >{{ $list->name }}</option>
                        <?php } ?>
                    </select>
                </div>
              </div>

              <div class="form-group col-md-4">
                <label for="inputEmail3" class="col-sm-12 control-label">(14) Profisaun</label>

                <div class="col-sm-12">
                    <select class="form-control" name="profisaun" id="profisaun">
                        <option>-- Select Item --</option>
                        <?php $profisaun=DB::table('profisaun')->get(); ?>
                        <?php foreach ($profisaun as $list) { ?>
                        <option value="{{ $list->value }}" >{{ $list->name }}</option>
                        <?php } ?>
                    </select>
                </div>
              </div>

              
              <div class="form-group col-md-4">
                <label for="inputEmail3" class="col-sm-12 control-label">(15) Hab. Literaria</label>

                <div class="col-sm-12">
                    <select class="form-control" name="literaria" id="literaria">
                        <option>-- Select Item --</option>
                        <?php $literaria=DB::table('literaria')->get(); ?>
                        <?php foreach ($literaria as $list) { ?>
                        <option value="{{ $list->value }}" >{{ $list->name }}</option>
                        <?php } ?>
                    </select>
                </div>
              </div>

              <div class="form-group col-md-4">
                <label for="inputEmail3" class="col-sm-12 control-label">(16) Estatuto / Mutasaun</label>

                <div class="col-sm-12">
                    <select class="form-control" name="estatuto" id="estatuto">
                        <option>-- Select Item --</option>
                        <?php $estatuto=DB::table('estatuto')->get(); ?>
                        <?php foreach ($estatuto as $list) { ?>
                        <option value="{{ $list->value }}" >{{ $list->name }}</option>
                        <?php } ?>
                    </select>
                </div>
              </div>

              <div class="form-group col-md-4">
                <label for="inputEmail3" class="col-sm-12 control-label">(16) Membru Cooperativa</label>

                <div class="col-sm-12">
                    <select class="form-control" name="membru" id="membru">
                        <option>-- Select Item --</option>
                        <?php $membru=DB::table('membru')->get(); ?>
                        <?php foreach ($membru as $list) { ?>
                        <option value="{{ $list->value }}" >{{ $list->name }}</option>
                        <?php } ?>
                    </select>
                </div>
              </div>

          </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <input type="submit" id="btnSave" class="btn btn-primary" value="Save changes">
      </div>
        </form>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>



<script>


function add_umakain() {
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal-tps_detail').modal('show'); // show bootstrap modal
    $('.modal-title').text('Tambah Uma Kain'); // Set Title to Bootstrap modal title
  }


  
    
    function getidumakain(id) {
        var link = "{{url('umakain/searchid')}}/" + id;
        $.ajax({
            data: id,
            url: link
        }).done(function(data) {
            console.log('-');console.log(data);
            document.getElementById("nudatabase1").value=data;
            document.getElementById("numerusensus").value=data.substr(4,5);
        });
    }

    $('#nomilitante').change(function() {
        var id = $(this).val();
        getnamamilitante(id)
    });
    
    function getnamamilitante(id) {
        var link = "{{url('umakain/searchnama')}}/" + id;
        $.ajax({
            data: id,
            url: link
        }).done(function(data) {
            console.log('-');console.log(data);
            document.getElementById("nama").value=data;
        });
    }

    
    function getnoumakain(id) {
        var link = "{{url('umakain/searchno')}}/" + id;
        $.ajax({
            data: id,
            url: link
        }).done(function(data) {
            console.log('-');console.log(data);
            document.getElementById("nudatabase2").value=data;
            
        });
    }

    function kelurahantim(lurah) {
        var id = lurah;
        var link = "{{url('tim/get_kelurahan')}}/" + id;
        $.ajax({
            data: id,
            url: link
        }).done(function(data) {
            $('#kelurahantim').html(data);
            var value = $(data).val();
            tpstim(value);
        });
    }

    function kecamatantim(lurah) {
        var id = lurah;
        var link = "{{url('tim/get_kecamatan')}}/" + id;
        $.ajax({
            data: id,
            url: link
        }).done(function(data) {
            $('#kecamatan').html(data);
            kelurahantim(value);
            tpstim(value);
        });
    }

    function tpstim(tps) {
        var id = tps;
        var link = "{{url('tim/get_tps')}}/" + id;
        $.ajax({
            data: id,
            url: link
        }).done(function(data) {
            $('#tpstim').html(data);
        });
    }






    $('#kabupatentim').on('change',function(e){
        console.log('testytttt ');
        var id = $(this).val();
        var link = '{{url("tim/get_kecamatan")}}/'  + id;

        console.log(link);
        $.ajax({
            data: id,
            url: link
        }).done(function(data) {
            $('#kecamatantim').html(data);
            var value = $(data).val();
            kelurahantim(value);
            tpstim(value);
            var datax=document.getElementById("kabupatentim").value;
            getidumakain(datax);

        });
    });

    $('#kecamatantim').change(function() {
        var id = $(this).val();
        var link = '{{url("tim/get_kelurahan")}}/' + id;
        $.ajax({
            data: id,
            url: link
        }).done(function(data) {
            $('#kelurahantim').html(data);
            var value = $(data).val();
            tpstim(value);
        });
    });

    $('#kelurahantim').change(function() {
        var id = $(this).val();
        tpstim(id)
    });
</script>
<script>
    var baseUrl = "{{url('umakain')}}/";

        function call_alert(type, title, content, timer = '') {
            if (timer == '') {
                timer = 3000;
            }
            Swal.fire({
                allowOutsideClick: false,
                icon: type,
                title: title,
                timer: timer,
                text: content,
            }).then(() => {

            });
        }

        function save() {
            var form = $('#form1')[0];
            var formData = new FormData(form);

            //btnLoader(true);

            $.ajax({
                url: baseUrl + 'update',
                dataType: 'json',
                method: 'post',
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.status) {
                            document.getElementById("form1").reset();
                            call_alert('success', 'Success', 'Data saved successfully.');
                    } else {
                        call_alert('error', 'Warning', 'Failed to save data..');
                    }
                },
                error: function() {
                    call_alert('error', 'Warning', 'Failed to save data.');
                }
            });
        }

        
        function savemilitante() {
            var form = $('#form')[0];
            var formData = new FormData(form);

            //btnLoader(true);

            $.ajax({
                url: baseUrl + 'savemilitante',
                dataType: 'json',
                method: 'post',
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.status) {
                            document.getElementById("form").reset();
                            call_alert('success', 'Success', 'Data saved successfully.');
                            location.reload();
                    } else {
                        call_alert('error', 'Warning', 'Failed to save data..');
                    }
                },
                error: function() {
                    call_alert('error', 'Warning', 'Failed to save data.');
                }
            });
        }

</script>
@endsection
