@extends('layoututama')
@section('content')
<?php
$username = Session::get('username');
?>


<div class="main-content">
  <section class="section">
    <div class='row'>
		  <div class='col-md-12'>
						<form action="javascript:save()" id="form1" name="form1" class="form-horizontal" method='POST' enctype="multipart/form-data" >
              {{csrf_field()}}
              <input type="hidden" class="form-control" id="_token"  name="_token" value="{{csrf_token()}}">
              <div class='card'>
                <div class="card-header">
                        <h5 class="card-title">Registrasi Uma Kain</h5>
                </div>
								<div class='card-body'>
                    <div class="row">
                      <div class="col-lg-4">
                        <div class="form-group  row col-md-12">
                          <h6>Residensia / Hela Fatin</h6>
                        </div>
                                                <div class="form-group  row col-md-12">
                                                    <label for="kabupatentim" class="col-sm-12 control-label">Municipio</label>
                                                    <div class="col-md-12">
                                                    <select name="kabupatentim" id="kabupatentim" class="form-control" required>
                                                        
                                                      <?php
                                                      $listkabupaten = DB::table('kabupaten')->get();
                                                      ?>
                                                      <?php foreach ($listkabupaten as $list) { $dt_option = $list->kode_district . ' | ' . $list->nama_district; ?>
                                                      <option value="{{ $list->kode_district }}" >
                                                          {{ $dt_option }}
                                                      </option>
                                                      <?php } ?>
                                                    </select>

                                                  </div> </div>

                                                <div class="form-group  row col-md-12">
                                                  <label for="kecamatantim" class="col-sm-12 control-label">Posto</label>

                                                  <div class="col-md-12">
                                                  <select name="kecamatantim" id="kecamatantim" value="" class="form-control" required>

                                          
                                                  </select>
                                                  </div>
                                                </div>

                                                <div class="form-group  row col-md-12">
                                                  <label for="tahunlulus" class="col-sm-12 control-label">Suco</label>

                                                  <div class="col-md-12">
                                                    <select name="kelurahantim" id="kelurahantim" value="" class="form-control" required>

                                                    </select>
                                                  </div>
                                                </div>

                                                <div class="form-group  row col-md-12">
                                                  <label for="tahunlulus" class="col-sm-12 control-label">Aldeias</label>

                                                  <div class="col-md-12">
                                                    <select name="tpstim" id="tpstim" value="" class="form-control" required>

                                                    </select>

                                                  </div>
                                                </div>

                      </div>

                      <div class="col-lg-4">
                        <div class="form-group  row col-md-12">
                          <h6>Koordinat</h6>
                        </div>
                        <div class="form-group  row col-md-12">
                            <label for="tahunlulus" class="col-sm-12 control-label">Latitude</label>
                            <div class="col-md-12">
                              <input type="text" name="altitude" class="form-control">
                            </div>
                        </div>

                        <div class="form-group  row col-md-12">
                          <label for="tahunlulus" class="col-sm-12 control-label">Longitude</label>

                            <div class="col-md-12">
                              <input type="text" name="longitude" class="form-control"> 
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
                              <input type="text" name="nudatabase1" id="nudatabase1" class="form-control" readonly required>
                            </div>
                            <div class="col-md-4">
                              <input type="text" id="nudatabase2" name="nudatabase2" maxlength="1" class="form-control" required> 
                            </div>
                        </div>

                        <div class="form-group  row col-md-12">
                          <label for="tahunlulus" class="col-sm-12 control-label">Numeru Sensus</label>

                            <div class="col-md-6">
                              <input type="text" id="numerusensus" name="numerusensus" class="form-control" readonly required> 
                            </div>
                            <div class="col-md-4">
                              <input type="hidden" id="numerusensus2" name="numerusensus2" maxlength="1" class="form-control"> 
                            </div>
                        </div>

                        <div class="form-group  row col-md-12">
                          <label for="tahunlulus" class="col-sm-12 control-label">Data</label>

                            <div class="col-md-12">
                              <input type="date" id="dataz" name="dataz" class="form-control" value="{{Date('Y-m-d')}}" required> 
                            </div>
                        </div>

                        <div class="form-group  row col-md-12">
                          <label for="tahunlulus" class="col-sm-12 control-label">Celula</label>

                            <div class="col-md-12">
                              <input type="text" name="celula"  id="celula" class="form-control"> 
                            </div>
                        </div>
                      </div>

                      <div class="col-lg-8">
                        
                        <div class="form-group  row col-md-12">
                          <label for="tahunlulus" class="col-sm-12 control-label">Hela Fatin</label>

                            <div class="col-md-12">
                              
                            <input type="text" name="hela"  id="hela" class="form-control">
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
                              <input type="checkbox" class="" name="chefe"  id="chefe" value="1"> <b class="control-label">Chefe Familia</b>
                            </div>
                        </div>
                        <div class="form-group  row col-md-12">
                            <div class="col-md-12">
                              <input type="checkbox" name="respon"  id="respon" value="1" > <b class="control-label">Militante Responsavel</b>
                            </div>
                        </div>
                      </div>
                      <div class="col-lg-3">
                        <div class="form-group  row col-md-12">
                            <label for="tahunlulus" class="col-sm-12 control-label">Naran</label>
                            <div class="col-md-12">
                            <input type="text" name="naran" id="naran" class="form-control">   
                            </div>
                        </div>
                      </div>
                      <div class="col-lg-3">
                        <div class="form-group  row col-md-12">
                            <label for="tahunlulus" class="col-sm-12 control-label">No. Kontakku</label>
                            <div class="col-md-12">
                            <input type="text" name="kontaknaran" id="kontaknaran" class="form-control">   
                            </div>
                        </div>
                      </div>
                      <div class="col-lg-3">
                        <div class="form-group  row col-md-12">
                            <label for="tahunlulus" class="col-sm-12 control-label">Tanggal Cetak</label>
                            <div class="col-md-12">
                              <input type="date" id="tanggalcetak" name="tanggalcetak" class="form-control" value="{{Date('Y-m-d')}}"> 
                            </div>
                        </div>
                      </div>
                    </div>

                    
                    <div class="row">
                      <div class="col-lg-3">
                        <div class="form-group  row col-md-12">
                            <label for="tahunlulus" class="col-sm-12 control-label">Coordenador Aldea</label>
                            <div class="col-md-12">
                              <input type="text" name="coor"  id="coordenador" class="form-control">
                            </div>
                        </div>
                      </div>
                      <div class="col-lg-3">
                        <div class="form-group  row col-md-12">
                            <label for="tahunlulus" class="col-sm-12 control-label">No. Kontaktu</label>
                            <div class="col-md-12">
                              <input type="text" name="kontakcoor" id="kontakcoor" class="form-control">
                            </div>
                        </div>
                      </div>
                      <div class="col-lg-3">
                        <div class="form-group  row col-md-12">
                            <label for="tahunlulus" class="col-sm-12 control-label">Ajente Konfirmasaun</label>
                            <div class="col-md-12">
                              <input type="text" name="ajente" id="ajente" class="form-control">
                            </div>
                        </div>
                      </div>
                      <div class="col-lg-3">
                        <div class="form-group  row col-md-12">
                            <label for="tahunlulus" class="col-sm-12 control-label">No. Kontaktu</label>
                            <div class="col-md-12">
                              <input type="text" name="kontakajente" id="kontakajente" class="form-control">
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-12">
                        <p align="center">
                        <button class="btn btn-success">SAVE DATA</button>&nbsp;<button class="btn btn-danger">CANCEL</button></p>  
                      </div>
                    </div>  
                </div>
                
              </div>
                    
						</form>

						
				
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
        <form action="#" id="form" name="form" class="form-horizontal" enctype="multipart/form-data" novalidate="novalidate">
          <input type="hidden" name="idtps_dt" id="idtps_dt" value="">

          <?php
          $listkabupaten = DB::table('kabupaten')->get();
          $option = array();
          $option[''] = 'Pilih Municipio';
          foreach ($listkabupaten as $category) {
            $option[$category->kode_district] = $category->kode_district . ' | ' . $category->nama_district;
          }
          ?>
          <div class="row">
              <div class="form-group col-md-4">
                <label for="inputEmail3" class="col-sm-12 control-label">Municipio</label>

                <div class="col-sm-12">
                  <?php //echo form_dropdown('kabupatentps', $option, '', 'id="kabupatentps" class="form-control"') ?>
                    <select class="form-control" name="kabupatentps" id="kabupatentps">
                        <option>Select Item</option>
                        <?php foreach ($listkabupaten as $list) { $dt_option = $list->kode_district . ' | ' . $list->nama_district; ?>
                        <option value="{{ $list->kode_district }}" >
                        {{ $dt_option }}
                        </option>
                        <?php } ?>
                    </select>
                </div>
              </div>

              <div class="form-group col-md-4">
                <label for="inputEmail3" class="col-sm-12 control-label">Militante</label>

                <div class="col-sm-12">
                  <select name="militante" id="militante" class="form-control">
                    <option value="">-- Select Group --</option>
                    <option value="militante">Militante</option>
                    <option value="militantevip">Militante VIP</option>
                    <option value="militantediaspora">Militante Diaspora</option>
                  </select>
                </div>
              </div>


              <div class="form-group col-md-4">
                <label for="inputEmail3" class="col-sm-12 control-label">No. Militante</label>

                <div class="col-sm-12">
                  <select name="nomilitante" id="nomilitante" class="form-control">
                  </select>
                </div>
              </div>

              <div class="form-group col-md-6">
                <label for="inputEmail3" class="col-sm-4 control-label">Nama</label>

                <div class="col-sm-12">
                  <input type="text" class="form-control" name="nama" id="nama" value="">
                </div>
              </div>


              <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 control-label">Relasaun Familia</label>

                <div class="col-sm-12">
                    <select class="form-control" name="relfamilia" id="relfamilia">
                        <option>Select Item</option>
                        <?php $relfamilia=DB::table('relfamilia')->get(); ?>
                        <?php foreach ($relfamilia as $list) { ?>
                        <option value="{{ $list->value }}" >{{ $list->name }}</option>
                        <?php } ?>
                    </select>
                </div>
              </div>

              <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 control-label">Kode TPS</label>

                <div class="col-sm-12">
                  <input type="text" name="kode_tps" id="kode_tps" value="" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 control-label">Nama TPS</label>

                <div class="col-sm-12">
                  <input type="text" name="nama_tps" id="nama_tps" value="" class="form-control">
                  <input type="hidden" class="form-control" id="_token"  name="_token" value="{{csrf_token()}}">
                </div>
              </div>
              <!-- <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 control-label">urut Tps</label>

                <div class="col-sm-12">
                  <input type="text" name="urut_tps" id="urut_tps" value="" class="form-control">
                </div>
              </div> -->
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save changes</button>
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
                url: baseUrl + 'save',
                dataType: 'json',
                method: 'post',
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.status) {
                            console.log(data);
                            document.getElementById("form1").reset();
                            call_alert('success', 'Success', 'Data saved successfully.');
                            window.location.href = "{{url('umakain/edit')}}/"+data.id;
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
