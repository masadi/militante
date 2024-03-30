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
            <div class="col-md-2">
              <button type="button" class="btn btn-block btn-primary" data-toggle="modal" onclick="add_kelurahan()"> <i class="fa fa-fw fa-plus-circle"></i> Tambah Suco </button>
              <?php //$this->session->flashdata('pesan') ?>
            </div>
            <div class="col-md-2">
              <a href="kelurahan/upload" class="btn btn-block btn-warning"> <i class="fa fa-fw fa-plus-circle"></i> Import Data Suco </a>
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
                    <th>Kode Suco</th>
                    <th>Nama Suco</th>
                    <th>Urut Suco</th>
                    <th>User</th>
                  </tr>
                </thead>
                <tbody>
                    <?php
                    $list = DB::table('kelurahan')
                    ->select(['kelurahan.*','kecamatan.nama_subdistrict as namakecamatan','kabupaten.nama_district as namakabupaten'])
                    ->leftJoin('kecamatan','kecamatan.kode_subdistrict','=','kelurahan.kecamatan')
                    ->leftJoin('kabupaten','kabupaten.kode_district','=','kelurahan.kabupaten')
                    ->orderBy('kelurahan.kode_suco','ASC')->get();
                    $no = 1;
                            foreach ($list as $kelurahan) {
                                echo '<tr><td>'.$no.'</td>';
                                echo '<td><a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_kelurahan(' . "'" . $kelurahan->idkelurahan . "'" . ')"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                                      <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_kelurahan(' . "'" . $kelurahan->idkelurahan . "'" . ')"><i class="fa fa-trash"></i></a></td>';

                                echo '<td>'.$kelurahan->namakabupaten.'</td>';
                                echo '<td>'.$kelurahan->namakecamatan.'</td>';
                                echo '<td>'.$kelurahan->kode_suco.'</td>';
                                echo '<td>'.$kelurahan->nama_suco.'</td>';
                                echo '<td>'.$kelurahan->urut_suco.'</td>';
                                echo '<td>'.$kelurahan->user.'</td>';

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

        nama_suco: {
          required: true
        },
        kecamatan: {
          required: true
        },
        kabupaten: {
          required: true
        },
        kode_suco: {
          required: true
        },
        urut_suco: {
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



  function add_kelurahan() {
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal-kelurahan').modal('show'); // show bootstrap modal
    $('.modal-title').text('Tambah Suco'); // Set Title to Bootstrap modal title
  }

  function edit_kelurahan(idkelurahan) {
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
      url: "{{url('kelurahan/ajax_edit/')}}/" + idkelurahan,
      type: "GET",
      dataType: "JSON",
      success: function(data) {

        $('[name="idkelurahan"]').val(data.idkelurahan);
        $('[name="nama_suco"]').val(data.nama_suco);
        $('[name="kabupaten"]').val(data.kabupaten);
        $('[name="kecamatan"]').val(data.kecamatan);
        // $('select[name="kecamatan"]').append('<option value="' + data.idkecamatan + '">' + data.nama_subdistrict + '</option>');
        $('[name="kode_suco"]').val(data.kode_suco);
        $('[name="urut_suco"]').val(data.urut_suco);
        $('#modal-kelurahan').modal('show'); // show bootstrap modal when complete loaded
        $('.modal-title').text('Edit Suco'); // Set title to Bootstrap modal title
        kecamatan_edit(data.kecamatan);
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
        url = "{{url('kelurahan/ajax_add')}}";
      } else {
        url = "{{url('kelurahan/ajax_update')}}";
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
            $('#modal-kelurahan').modal('hide');
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

  function delete_kelurahan(idkelurahan) {
    if (confirm('Are you sure delete this data?')) {
      // ajax delete data to database
      $.ajax({
        url: "{{url('kelurahan/ajax_delete')}}/" + idkelurahan,
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
<div class="modal fade" id="modal-kelurahan">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Data Kelurahan</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <form action="#" id="form" name="form" class="form-horizontal" enctype="multipart/form-data" novalidate="novalidate">
          <input type="hidden" name="idkelurahan" id="idkelurahan" value="">

          <?php
          $listkabupaten = DB::table('kabupaten')->get();
          $option = array();
          $option[''] = 'Pilih District';
          foreach ($listkabupaten as $category) {

            $option[$category->kode_district] = $category->kode_district . ' | ' . $category->nama_district;
          }
          // print_r($option);
          ?>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-4 control-label">Kode Municipio</label>

            <div class="col-sm-12">
              <?php //echo form_dropdown('kabupaten', $option, '', 'id="kabupaten" class="form-control"') ?>
                <select class="form-control" name="kabupaten" id="kabupatentim">
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
              <select name="kecamatan" id="kecamatantim" class="form-control">
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-4 control-label">Kode Suco</label>

            <div class="col-sm-12">
              <input type="text" class="form-control" id="kode_suco" placeholder="" name="kode_suco" required="">
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-4 control-label">Nama Suco</label>

            <div class="col-sm-12">
              <input type="text" class="form-control" id="nama_suco" placeholder="" name="nama_suco" required="">
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-4 control-label">Urut Suco</label>

            <div class="col-sm-12">
              <input type="text" class="form-control" id="urut_suco" placeholder="" name="urut_suco" required="">
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
<script>
  $('#kabupaten').change(function() {
    var kecamatan = $(this).val();
    var link = "{{url('kelurahan/get_kecamatan')}}/" + kecamatan;
    $.ajax({
      data: kecamatan,
      url: link
    }).done(function(data) {
      $('#kecamatan').html(data);
    });
  });

  function kecamatan(kabupaten) {
    var kecamatan = kabupaten;
    var link = "{{url('kelurahan/get_kecamatan')}}/" + kecamatan;
    $.ajax({
      data: kecamatan,
      url: link
    }).done(function(data) {
      $('#kecamatan').html(data);
    });
  }

  function kecamatan_edit(kecamatan) {
    var id = kecamatan;
    var link = "{{url('kelurahan/get_kecamatan_edit')}}/" + id;
    $.ajax({
      data: id,
      url: link
    }).done(function(data) {
      $('#kecamatan').html(data);
    });
  }
</script>

@endsection
