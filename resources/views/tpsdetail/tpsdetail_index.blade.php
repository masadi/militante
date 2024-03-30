@extends('layoututama')
@section('content')
<?php
$level = Session::get('level');
?><div class="main-content">
  <section class="section">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="row mt-3 mx-4">
            <div class="col-md-3">
            <button type="button" class="btn btn-block btn-primary" data-toggle="modal" onclick="add_tps()"> <i class="fa fa-fw fa-plus-circle"></i> Tambah TPS</button>
            <?php // $this->session->flashdata('pesan') ?>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="table" class="table table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th style="width:125px;">Action</th>
                    <th>Municipio</th>
                    <th>Posto</th>
                    <th>Suco</th>
                    <th>Kode TPS</th>
                    <th>Nama TPS</th>

                  </tr>
                </thead>
                <tbody>
                <?php
                    $query = DB::table('tps_detail')
                            ->select(['tps_detail.*','kelurahan.nama_suco as namakelurahan','kecamatan.nama_subdistrict as namakecamatan',
                            'kabupaten.nama_district as namakabupaten'])
                            ->leftJoin('kabupaten','kabupaten.kode_district','=','tps_detail.kabupatentps')
                            ->leftJoin('kecamatan','kecamatan.kode_subdistrict','=','tps_detail.kecamatantps')
                            ->leftJoin('kelurahan','kelurahan.kode_suco','=','tps_detail.kelurahantps')
                            ->orderBy('tps_detail.kode_tps','ASC')
                            ->get();

                    $no = 1;
                    foreach ($query as $tps) {
                        echo '<tr><td>'.$no.'</td>';
                        echo '<td><a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_tps(' . "'" . $tps->idtps_dt . "'" . ')"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                        <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_tps(' . "'" . $tps->idtps_dt . "'" . ')"><i class="fa fa-trash"></i></a></td>';

                        echo '<td>'.$tps->namakabupaten.'</td>';
                        echo '<td>'.$tps->namakecamatan.'</td>';
                        echo '<td>'.$tps->namakelurahan.'</td>';
                        echo '<td>'.$tps->kode_tps.'</td>';
                        echo '<td>'.$tps->nama_tps.'</td>';
                        //add html for action
                        echo '</tr>';

                        $no++;
                    }
                ?>
                </tbody>
              </table>
            </div>
          </div>

        </div>
      </div>


    </div>

  </section>
</div>
<script type="text/javascript">
  var save_method; //for save method string
  var table;
  $(document).ready(function() {
    $("#form").validate({
      rules: {

        nama_tps: {
          required: true
        },

        kode_tps: {
          required: true
        }
      }
    });

  });
  $(document).ready(function() {
    $('#table').DataTable();
    //datatables

    //set input/textarea/select event when change value, remove class error and remove text help block
    $("input").change(function() {
      $(this).parent().parent().removeClass('has-error');
      $(this).next().empty();
    });
    $("textarea").change(function() {
      $(this).parent().parent().removeClass('has-error');
      $(this).next().empty();
    });
    $("select").change(function() {
      $(this).parent().parent().removeClass('has-error');
      $(this).next().empty();
    });

  });



  function add_tps() {
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal-tps_detail').modal('show'); // show bootstrap modal
    $('.modal-title').text('Tambah Tps'); // Set Title to Bootstrap modal title
  }

  function reload_table() {
    table.ajax.reload(null, false); //reload datatable ajax
  }

  function save() {

    var form = $("#form");
    var url;
    if (!form.valid()) {
      document.getElementById('form').focus();
    } else {
      $('#btnSave').text('saving...'); //change button text
      $('#btnSave').attr('disabled', true); //set button disable
      if (save_method == 'add') {
        url = "{{url('tps_detail/ajax_add')}}";
      } else {
        url = "{{url('tps_detail/ajax_update')}}";
      }

      // ajax adding data to database
      $.ajax({
        url: url,
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data) {

          if (data.status) //if success close modal and reload ajax table
          {
            $('#modal-tps_detail').modal('hide');
          //reload_table();
          location.reload();
          } else {
            for (var i = 0; i < data.inputerror.length; i++) {
              $('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
              $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]); //select span help-block class set text error string
            }
          }
          $('#btnSave').text('save'); //change button text
          $('#btnSave').attr('disabled', false); //set button enable


        },
        error: function(jqXHR, textStatus, errorThrown) {
          alert('Error adding / update data');
          $('#btnSave').text('save'); //change button text
          $('#btnSave').attr('disabled', false); //set button enable

        }
      });
    }
  }

  function edit_tps(idtps_dt) {
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
      url: "{{url('tps_detail/ajax_edit/')}}/" + idtps_dt,
      type: "GET",
      dataType: "JSON",
      success: function(data) {

        $('[name="idtps_dt"]').val(data.idtps_dt);
        $('[name="nama_suco"]').val(data.nama_suco);
        $('[name="kabupatentps"]').val(data.kabupatentps);
        $('[name="kecamatantps"]').val(data.kecamatantps);
        // $('select[name="kecamatan"]').append('<option value="' + data.idkecamatan + '">' + data.nama_subdistrict + '</option>');
        $('[name="kelurahantps"]').val(data.kelurahantps);
        $('[name="kode_tps"]').val(data.kode_tps);
        $('[name="nama_tps"]').val(data.nama_tps);
        $('#modal-tps_detail').modal('show'); // show bootstrap modal when complete loaded
        $('.modal-title').text('Edit TPS'); // Set title to Bootstrap modal title
        kecamatantps_edit(data.kecamatantps)
        kelurahantps_edit(data.kelurahantps)
      },
      error: function(jqXHR, textStatus, errorThrown) {
        alert('Error get data from ajax');
      }
    });
  }

  function delete_tps(idtps_dt) {
    if (confirm('Are you sure delete this data?')) {
      // ajax delete data to database
      $.ajax({
        url: "{{url('tps_detail/ajax_delete')}}/" + idtps_dt,
        type: "GET",
        dataType: "JSON",
        success: function(data) {
          //if success reload ajax table
          $('#modal-tps_detail').modal('hide');
          //reload_table();
          location.reload();
        },
        error: function(jqXHR, textStatus, errorThrown) {
          alert('Error deleting data');
        }
      });

    }
  }
</script>
<div class="modal fade" id="modal-tps_detail">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Data TPS</h4>
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
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-4 control-label">Municipio</label>

            <div class="col-sm-12">
              <?php //echo form_dropdown('kabupatentps', $option, '', 'id="kabupatentps" class="form-control"') ?>
                <select class="form-control" name="kabupatentps" id="kabupatentim">
                    <option>Select Item</option>
                    <?php foreach ($listkabupaten as $list) { $dt_option = $list->kode_district . ' | ' . $list->nama_district; ?>
                    <option value="{{ $list->kode_district }}" >
                    {{ $dt_option }}
                    </option>
                    <?php } ?>
                </select>
            </div>
          </div>

          <div class="form-group">
            <label for="inputEmail3" class="col-sm-4 control-label">Pilih Posto</label>

            <div class="col-sm-12">
              <select name="kecamatantps" id="kecamatantim" class="form-control">
              </select>
            </div>
          </div>

          <div class="form-group">
            <label for="inputEmail3" class="col-sm-4 control-label">Pilih Suco</label>

            <div class="col-sm-12">
              <select name="kelurahantps" id="kelurahantim" class="form-control">
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
    function kecamatan_edit(camat) {
        var id = camat;
        var link = '<?php url() ?>' + 'tps/get_kecamatan_edit/' + id;
        $.ajax({
            data: id,
            url: link
        }).done(function(data) {
            $('#kecamatantps').html(data);
        });
    }

    function kelurahan_edit(camat) {
        var id = camat;
        var link = '<?php url() ?>' + 'tps/get_kelurahan_edit/' + id;
        $.ajax({
            data: id,
            url: link
        }).done(function(data) {
            $('#kelurahantps').html(data);
        });
    }

    function tps_edit(camat) {
        var id = camat;
        var link = '<?php url() ?>' + 'tps/get_tps_edit/' + id;
        $.ajax({
            data: id,
            url: link
        }).done(function(data) {
            $('#tpstps').html(data);
        });
    }

    function kelurahantps(lurah) {
        var id = lurah;
        var link = '<?php url() ?>' + 'tps/get_kelurahan/' + id;
        $.ajax({
            data: id,
            url: link
        }).done(function(data) {
            $('#kelurahantps').html(data);
        });
    }

    function tpstps(tps) {
        var id = tps;
        var link = '<?php url() ?>' + 'dpt/get_tps/' + id;
        $.ajax({
            data: id,
            url: link
        }).done(function(data) {
            $('#tpstps').html(data);
        });
    }

    //$('select#kabupatendpt').change(function() {
    $('#kabupatentps').on('change',function(e){
        console.log('testytttt ');
        var id = $(this).val();
        var link = '{{url("tps/get_kecamatan")}}/'  + id;
        console.log(link);
        $.ajax({
            data: id,
            url: link
        }).done(function(data) {
            $('#kecamatantps').html(data);
            var value = $(data).val();
            kelurahantps(value);
            tpstps(value);
        });
    });

    $('#kecamatantps').change(function() {
        var id = $(this).val();
        var link = '{{url("tps/get_kelurahan")}}/' + id;
        $.ajax({
            data: id,
            url: link
        }).done(function(data) {
            $('#kelurahantps').html(data);
            var value = $(data).val();
            tpstps(value);
        });
    });

    $('#kelurahantps').change(function() {
        var id = $(this).val();
        tpstps(id)
    });
</script>
@endsection
