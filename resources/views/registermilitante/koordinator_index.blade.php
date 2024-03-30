@extends('layoututama')
@section('content')
<?php
$level = Session::get('level');
?>


<style type="text/css">
  /* .modal-dialog {
    width: 100%;
    height: auto;
    padding: 0;
    margin: 0;
  } */

  .modal-content {
    height: auto;
    border-radius: 0;
    color: #333;
    overflow: auto;
  }

  hr.dashed {
    border-top: 10px dashed #999;
  }
</style>

<div class="main-content">
  <section class="section">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="row mt-3 mx-2">
            <!-- <h3 class="box-title">master pemilih</h3> -->
            <div class="col-md-2">
              <button type="button" class="btn btn-block btn-primary" data-toggle="modal" onclick="add_koordinator()"> <i class="fa fa-fw fa-plus-circle"></i> Tambah Koordinator </button>
            </div>
            <div class="col-md-2"><a href="koordinator/cetak" class="btn btn-block btn-danger"> <i class="fa fa-print"></i> Cetak Koordinator </a></div>
            <?php // $this->session->flashdata('pesan') ?>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="table" class="table table-striped">
                <thead>
                  <tr>
                    <th>Nama</th>
                    <th>Status</th>
                    <th style="width:125px;">Action</th>
                  </tr>
                </thead>
                <tbody>

                </tbody>
                <tfoot>
                  <tr>
                    <th>Nama</th>
                    <th>Status</th>
                    <th style="width:125px;">Action</th>
              </table>
            </div>
          </div>
        </div>
      </div>


    </div>



  </section>
</div>

<script type="text/javascript">
  var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
  };

  var save_method; //for save method string
  var table;
  var base_url = '';

  $(document).ready(function() {
    $("#form").validate({
      rules: {
        idpemilihkoordinator: {
          required: true
        },
        jabatan: {
          required: true
        },
        lokasijabatan: {
          required: true
        },
        kecamatandijabat: {
          required: true
        },
        kelurahandijabat: {
          required: true
        }
      }
    });

  });
  $(document).ready(function() {

    //datatables
    table = $('#table').DataTable({

      "processing": true, //Feature control the processing indicator.
      "serverSide": true, //Feature control DataTables' server-side processing mode.
      "order": [], //Initial no order.
      responsive: {
        details: {
          type: 'column',
          target: 'tr'
        }
      },
      language: {
        "processing": "<i class='fa fa-spin fa-refresh'></i><br> Silahkan Tunggu"
      },
      columnDefs: [{
        className: 'control',
        orderable: false,
        targets: 0
      }],

      // Load data for the table's content from an Ajax source
      "ajax": {
        "url": "<?php echo url('koordinator/ajax_list') ?>",
        "type": "GET"
      },

      //Set column definition initialisation properties.
      "columnDefs": [{
        "targets": [-1], //last column
        "orderable": false, //set not orderable
      }, ],

    });



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



  function add_koordinator() {
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $("#nikkoordinator").removeAttr("disabled");
    $('.help-block').empty(); // clear error string
    $('#modal-koordinator').modal('show'); // show bootstrap modal
    $('.modal-title').text('Tambah Koordinator'); // Set Title to Bootstrap modal title
  }

  function edit_koordinator(idkoordinator) {
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
      url: "<?php echo url('koordinator/ajax_edit/') ?>/" + idkoordinator,
      type: "GET",
      dataType: "JSON",
      success: function(data) {

        $('[name="idkoordinator"]').val(data.idkoordinator);
        $('[name="idpemilihkoordinator"]').val(data.idpemilihkoordinator);
        $('[name="lokasijabatan"]').val(data.lokasijabatan);
        $('[name="nikkoordinator"]').val(data.nikdpt);
        $('[name="namakoordinator"]').val(data.namadpt);
        $("#nikkoordinator").attr("disabled", "disabled");
        if (data.kecamatandijabat === '') {
          $('#kecamatanpilih').hide();
          $('#kelurahanpemilih').show();
          $('#jabatandipilih').show();
        } else {
          $('#kecamatanpilih').show();
          $('#kelurahanpemilih').hide();
          $('#jabatandipilih').show();
        }
        $('[name="kecamatandijabat"]').val(data.kecamatandijabat);
        $('[name="kelurahandijabat"]').val(data.kelurahandijabat);
        $('[name="jabatan"]').val(data.jabatan);
        $('#modal-koordinator').modal('show'); // show bootstrap modal when complete loaded
        $('.modal-title').text('Edit Koordinator'); // Set title to Bootstrap modal title

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
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled', true); //set button disable
    var url;

    if (save_method == 'add') {
      url = "<?php echo url('koordinator/ajax_add') ?>";
    } else {
      url = "<?php echo url('koordinator/ajax_update') ?>";
    }

    // ajax adding data to database

    var formData = new FormData($('#form')[0]);
    $.ajax({
      url: url,
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      dataType: "JSON",
      success: function(data) {

        if (data.status) //if success close modal and reload ajax table
        {
          $('#modal-koordinator').modal('hide');
          reload_table();
        } else {

          $(".alert-danger").css('display', 'block');
          $(".alert-danger").html(data.error);
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

  function delete_koordinator(idkoordinator) {
    if (confirm('Are you sure delete this data?')) {
      // ajax delete data to database
      $.ajax({
        url: "<?php echo url('koordinator/ajax_delete') ?>/" + idkoordinator,
        type: "POST",
        dataType: "JSON",
        success: function(data) {
          //if success reload ajax table
          swal("Berhasil", "Data koordinator berhasil dihapus", "error");
          $('#modal-koordinator').modal('hide');
          reload_table();
        },
        error: function(jqXHR, textStatus, errorThrown) {
          alert('Error deleting data');
        }
      });

    }
  }
</script>
<?php /*
<script type='text/javascript'>
  var site = "<?php echo url(); ?>";
  $(function() {
    $('.autocomplete').autocomplete({

      serviceUrl: site + '/koordinator/search',

      onSelect: function(suggestion) {
        $('#namakoordinator').val('' + suggestion.namadpt);
        $('#idpemilihkoordinator').val('' + suggestion.idpemilih);
        $('#tlppemilihkoordinator').val('' + suggestion.tlppemilih);
      }
    });
  });
</script>
*/?>

<div class="modal fade" id="modal-koordinator">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Data Daerah</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <div class="alert alert-danger" style="display:none"></div>
        <form action="#" id="form" name="form" class="form-horizontal" enctype="multipart/form-data" novalidate="novalidate">
          <input type="hidden" name="idkoordinator" id="idkoordinator" value="">
          <input type="hidden" name="idpemilihkoordinator" id="idpemilihkoordinator" value="">
          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 text-left">Electoral</label>
                <div class="col-sm-12">
                  <input type="search" class="form-control autocomplete nikkoordinator" name="nikkoordinator" id="nikkoordinator" value="">
                </div>
              </div>
            </div>
            <div class="col-sm-12">
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 text-left">Nama</label>
                <div class="col-sm-12">
                  <input type="text" name="namakoordinator" id="namakoordinator" value="" class="form-control autocomplete" readonly="">
                </div>
              </div>
            </div>
            <div class="col-sm-12">
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 text-left">No Telp</label>
                <div class="col-sm-12">
                  <input type="text" name="tlppemilihkoordinator" id="tlppemilihkoordinator" value="" class="form-control autocomplete" readonly="">
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <hr>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 text-left">Lokasi Di</label>
                <div class="col-sm-12">
                  <select id="lokasijabatan" name="lokasijabatan" onchange="changeFunc();" class="form-control">
                    <option value="#">Pilih Lokasi Jabatan</option>
                    <option value="kecamatan">Sub District</option>
                    <option value="kelurahan">Suco</option>
                  </select>
                </div>
              </div>
            </div>
          </div>

          <script type="text/javascript">
            function changeFunc() {
              var lokasijabatan = document.getElementById("lokasijabatan");
              var selectedValue = lokasijabatan.options[lokasijabatan.selectedIndex].value;
              if (selectedValue == "kecamatan") {
                $('#kecamatanpilih').show();
                $('#jabatandipilih').show();
                $('#kelurahanpemilih').hide();
                $('#kecamatandijabat').val('')
                $('#kelurahandijabat').val('')
              } else if (selectedValue == "kelurahan") {
                $('#kelurahanpemilih').show();
                $('#jabatandipilih').show();
                $('#kecamatanpilih').hide();
                $('#kecamatandijabat').val('')
                $('#kelurahandijabat').val('')
              } else {
                $('#kecamatanpilih').hide();
                $('#kelurahanpemilih').hide();
                $('#jabatandipilih').hide();
                $('#kecamatandijabat').val('')
                $('#kelurahandijabat').val('')
              }
            }
          </script>
          <?php
          $listkecamatan = DB::table('kecamatan')->get();
          $option = array();
          $option[''] = 'Pilih Kecamatan';
          foreach ($listkecamatan as $category) {
            $option[$category->kode_subdistrict] = $category->kode_subdistrict . ' | ' . $category->nama_subdistrict;
          }
          ?>
          <div class="row">
            <div class="col-sm-12" id="kecamatanpilih" style="display: none">
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 text-left">Sub District</label>

                <div class="col-sm-10">
                  <?php //echo form_dropdown('kecamatandijabat', $option, '', 'id="kecamatandijabat" value="" class="form-control"') ?>
                </div>
              </div>
            </div>
          </div>
          <?php
          $listkelurahan = DB::table('kelurahan')->get();
          $option1 = array();
          $option1[''] = 'Pilih Kelurahan';
          foreach ($listkelurahan as $categorykelurahan) {
            $option1[$categorykelurahan->kode_suco] = $categorykelurahan->kode_suco . ' | ' . $categorykelurahan->nama_suco;
          }
          ?>
          <div class="row">
            <div class="col-sm-12" id="kelurahanpemilih" style="display: none">
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 text-left">Suco</label>

                <div class="col-sm-10">
                  <?php //echo form_dropdown('kelurahandijabat', $option1, '', 'id="kelurahandijabat" class="form-control"') ?>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12" id="jabatandipilih" style="display: none">
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 text-left">Jabatan</label>
                <div class="col-sm-10">
                  <select name="jabatan" id="jabatan" class="form-control">
                    <option value="#">Pilih Jabatan</option>
                    <option value="Ketua">Ketua</option>
                    <option value="Anggota">Anggota</option>
                  </select>
                </div>
              </div>
            </div>
          </div>

        </form>
      </div>
      <div class="col-sm-12">
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
  <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->

@endsection
