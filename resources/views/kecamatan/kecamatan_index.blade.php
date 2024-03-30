@extends('layoututama')
@section('content')
<?php
$level = Session::get('level');
?><div class="main-content">
  <section class="section">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="row mt-3 mx-2">
            <div class="col-md-3">
              <button type="button" class="btn btn-block btn-primary" data-toggle="modal" onclick="add_kecamatan()"> <i class="fa fa-fw fa-plus-circle"></i> Tambah Posto</button>
              <?php //$this->session->flashdata('pesan') ?>
            </div>
            <div class="col-md-3">
              <a href="kecamatan/upload" class="btn btn-block btn-warning"> <i class="fa fa-fw fa-plus-circle"></i> Import Data Posto </a>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
            <table id="table" class="table table-striped" style="width:100%">
              <thead>
                <tr>

                  <th>No</th>
                  <th style="width:125px;">Action</th>
                  <th>Kode Municipio</th>
                  <th>Kode Posto</th>
                  <th>Nama Posto</th>
                  <th>Urut Posto</th>
                  <th>User</th>

                </tr>
              </thead>
              <tbody>
                <?php
                    $list = DB::table('kecamatan')
                    ->select(['kecamatan.*','kabupaten.nama_district as nama_district'])
                    ->leftJoin('kabupaten','kabupaten.kode_district','=','kecamatan.kabupaten')
                    ->orderBy('kode_subdistrict','ASC')->get();
                    $no = 1;
                    foreach ($list as $kecamatan) {
                        echo '<tr><td>'.$no.'</td>';
                        //add html for action
                        echo '<td><a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_kecamatan(' . "'" . $kecamatan->idkecamatan . "'" . ')"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                              <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_kecamatan(' . "'" . $kecamatan->idkecamatan . "'" . ')"><i class="fa fa-trash"></i></a></td>';

                        echo '<td>'.$kecamatan->nama_district.'</td>';
                        echo '<td>'.$kecamatan->kode_subdistrict.'</td>';

                        echo '<td>'.$kecamatan->nama_subdistrict.'</td>';
                        echo '<td>'.$kecamatan->urut_subdistrict.'</td>';
                        echo '<td>'.$kecamatan->user.'</td>';

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

        kode_subdistrict: {
          required: true
        },
        kabupaten: {
          required: true
        },
        nama_subdistrict: {
          required: true
        },
        urut_subdistrict: {
          required: true
        }
      }
    });

  });
  $(document).ready(function() {

    $("#table").DataTable();
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



  function add_kecamatan() {
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal-kecamatan').modal('show'); // show bootstrap modal
    $('.modal-title').text('Tambah Posto'); // Set Title to Bootstrap modal title
  }

  function edit_kecamatan(idkecamatan) {
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $.ajax({

      url: "{{url('kecamatan/ajax_edit/')}}/" + idkecamatan,
      type: "GET",
      dataType: "JSON",

      success: function(data) {

        $('[name="idkecamatan"]').val(data.idkecamatan);
        $('[name="nama_subdistrict"]').val(data.nama_subdistrict);
        $('[name="kabupaten"]').val(data.kabupaten);
        //$('select[name="provinsi"]').append('<option value="'+ data.idprovinsi +'">'+ data.namaprovinsi +'</option>');
        // $('[name="kabupaten"]').val(data.kabupaten);
        //$('select[name="kabupaten"]').append('<option value="'+ data.idkabupaten +'">'+ data.namakabupaten +'</option>');

        $('[name="kode_subdistrict"]').val(data.kode_subdistrict);
        $('[name="urut_subdistrict"]').val(data.urut_subdistrict);
        $('#modal-kecamatan').modal('show'); // show bootstrap modal when complete loaded
        $('.modal-title').text('Edit Posto'); // Set title to Bootstrap modal title
        //console.log(data);

      },
      error: function(jqXHR, textStatus, errorThrown) {
        alert('Error get data from ajax');
      }
    });
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
        url = "{{url('kecamatan/ajax_add')}}";
      } else {
        url = "{{url('kecamatan/ajax_update')}}";
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
            $('#modal-kecamatan').modal('hide');
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

  function delete_kecamatan(idkecamatan) {
    if (confirm('Are you sure delete this data?')) {
      // ajax delete data to database
      $.ajax({
        url: "{{url('kecamatan/ajax_delete')}}/" + idkecamatan,
        type: "GET",
        dataType: "JSON",
        success: function(data) {
          //if success reload ajax table
          $('#modal-kecamatan').modal('hide');
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
<div class="modal fade" id="modal-kecamatan">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Posto</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <form action="#" id="form" name="form" class="form-horizontal" enctype="multipart/form-data" novalidate="novalidate">
          <input type="hidden" name="idkecamatan" id="idkecamatan" value="">

          <?php
          $listkabupaten = DB::table('kabupaten')->get();
          $option = array();
          $option[''] = 'Pilih District';
          foreach ($listkabupaten as $category) {
            $option[$category->kode_district] = $category->kode_district . ' | ' . $category->nama_district;
          }
          ?>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-4 control-label"> Municipio</label>

            <div class="col-sm-12">
              <?php //echo form_dropdown('kabupaten', $option, '', 'id="kabupaten" class="form-control"') ?>
                <select class="form-control" name="kabupaten" id="kabupaten">
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
            <label for="inputEmail3" class="col-sm-4 control-label">Kode Posto</label>
            <div class="col-sm-12">
              <input type="text" name="kode_subdistrict" id="kode_subdistrict" class="form-control">

            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-4 control-label">Nama Posto</label>
            <div class="col-sm-12">
              <input type="text" name="nama_subdistrict" id="nama_subdistrict" class="form-control">

            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-4 control-label">Urut Posto</label>
            <div class="col-sm-12">
              <input type="text" name="urut_subdistrict" id="urut_subdistrict" class="form-control">
              <input type="hidden" class="form-control" id="_token"  name="_token" value="{{csrf_token()}}">

            </div>
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

@endsection
