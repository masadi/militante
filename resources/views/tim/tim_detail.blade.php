@extends('layoututama')
@section('content')
<?php
$level = Session::get('level');
?>
<div class="main-content">
  <section class="section">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="row mt-4 mx-4">
            <button type="button" class="btn btn-block btn-primary" data-toggle="modal" onclick="tambah_tim()"> <i class="fa fa-fw fa-plus-circle"></i> Tambah Tim </button>
            <?php // $this->session->flashdata('pesan') ?>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="table" class="table table-striped">
                <thead>
                  <tr>
                    <th>Anggota</th>
                    <th>HP</th>
                    <th>nik</th>
                    <th>Options</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $teammembers = DB::table('relawan')
                                ->leftjoin('pemilih','pemilih.idpemilih','=','relawan.idpemilihrelawan')
                                ->leftjoin('dpt','dpt.iddpt','=','pemilih.iddptpemilih')
                                ->where('idrelawan','=', $idtim)
                                ->get();
                  foreach ($teammembers as $teammember) {

                    $teammember = explode(',', $teammember->anggota);
                    if (is_numeric($teammember)) {



                  ?>
                      <tr class="">
                        <td><?php echo $teammember->namadpt; ?></td>
                        <td><?php echo $teammember->tlppemilih; ?></td>
                        <td><?php echo $teammember->nikdpt; ?></td>
                        <td>
                          <a class="btn btn-danger" href="tim/deletedetail?idtim=<?php echo $timdetailist->idtim; ?>&idrelawan=<?php echo $teammember->idrelawan; ?>" onclick="return confirm('hapus Anggota ini Dari Tim?');"><i class="fa fa-trash"></i></a>
                        </td>
                      </tr>
                  <?php
                    }
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

  function tambah_tim() {
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('#modal-tim').modal('show'); // show bootstrap modal
    $('.modal-title').text('Tambah Tim '); // Set Title to Bootstrap modal title
  }
  $(document).ready(function() {
    $("#table").DataTable()
    $("#form").validate({
      rules: {

        namatim: {
          required: true
        },
        email: {
          required: true
        },
        kabupatentim: {
          required: true
        },
        anggota: {
          required: true
        },
        tugas: {
          required: true
        }
      }
    });

  });

  function save() {
    var form = $("#form");
    var url;
    if (!form.valid()) {
      document.getElementById('form').focus();
    } else {
      if (save_method == 'add') {
        url = "<?= url('tim/save') ?>";
      } else {
        url = "<?= url('tim/updateaction') ?>";
      }
      $.ajax({
        url: url,
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data) {
          $('#modal-tim').modal('hide');
          location.reload();
        },
        error: function() {
          alert('Terdapat Kesalahan');
        }
      });
    }
  }

  function edit_tim(idtim) {
    save_method = 'update';
    $('#form')[0].reset();
    $.ajax({
      url: "<?= url('tim/update') ?>/" + idtim,
      type: "GET",
      dataType: "JSON",
      success: function(data) {
        $('[name="idtim"]').val(data.idtim);
        $('[name="namatim"]').val(data.namatim);
        $('[name="kabupatentim"]').val(data.kabupatentim);
        $('[name="anggota"]').val(data.anggota);
        $('[name="tugas"]').val(data.tugas);
        $('#modal-tim').modal('show');
        $('.modal-title').text('Edit Tim');
      },
      error: function(jqXHR, textStatus, errorThrown) {
        alert('Gagal dalam pengambilan data');
      }
    });
  }

  function delete_tim(idtim) {
    if (confirm('Anda Yakin Menghapus Tim ini?')) {
      $.ajax({
        url: "<?= url('tim/delete') ?>/" + idtim,
        type: "POST",
        dataType: "JSON",
        success: function(data) {
          location.reload();
        },
        error: function(jqXHR, textStatus, errorThrown) {
          alert('Terdapat Kesalahan Dalam Menghapus Data');
        }
      });
    }
  }
</script>

<div class="modal fade" id="modal-tim">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Data Daerah</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <div class="alert alert-danger" style="display:none"></div>
        <form action="#" id="form" name="form" class="form-horizontal" enctype="multipart/form-data" novalidate="novalidate">
          <input type="hidden" name="idtim" id="idtim" value="">
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-4 control-label">Nama Tim</label>

            <div class="col-sm-12">
              <input type="text" class="form-control" id="namatim" placeholder="nama Tim" name="namatim" required="">
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-4 control-label">Pilih Kabupaten</label>

            <div class="col-sm-12">
              <?php //echo form_dropdown('kabupatentim', $option, $as, 'id="kabupatentim"  required="" class="form-control" title="Field kabupaten Harus Diisi"'); ?>
            </div>
          </div>

          <div class="form-group">
            <label for="inputEmail3" class="col-sm-4 control-label">Pilih Kecamatan</label>

            <div class="col-sm-12">
              <select name="kecamatantim" id="kecamatantim" value="" class="form-control">

              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-4 control-label">Pilih Kelurahan</label>

            <div class="col-sm-12">
              <select name="kelurahantim" id="kelurahantim" value="" class="form-control">

              </select>
            </div>
          </div>


          <div class="form-group">
            <label for="inputEmail3" class="col-sm-4 control-label">Anggota</label>
            <div class="col-sm-12">
              <select multiple class="form-control" name="anggota" id="anggota">
                <?php

                $listrelawan = DB::table('relawan')
                                ->leftjoin('pemilih', 'pemilih.idpemilih','=','relawan.idpemilihrelawan')
                                ->leftjoin('dpt', 'dpt.iddpt','=','pemilih.iddptpemilih')
                                ->get();
                foreach ($listrelawan as $list) : ?>
                  <option value="<?= $list->idrelawan ?>"><?= $list->namadpt ?>&nbsp;//<?=  $list->nikdpt ?></option>
                <?php endforeach; ?>

              </select>
            </div>
          </div>





          <div class="form-group">
            <label for="inputEmail3" class="col-sm-4 control-label">Tugas</label>
            <div class="col-sm-12">
              <textarea class="form-control" placeholder="Tugas" id="tugas" name="tugas" required=""></textarea>
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
  $('#kabupatentim').change(function() {

    var kecamatantim = $(this).val();
  var link = "url('kabupaten/get_subcategories_ajax')}}/" + kecamatantim;
    $.ajax({
      data: kecamatantim,
      url: link
    }).done(function(subcategories) {

      console.log(subcategories);
      $('#kecamatantim').html(subcategories);
    });
  });
  $('#kecamatantim').change(function() {

    var kelurahantim = $(this).val();
    var link = "url('kelurahan/get_subcategories_ajax1')}}/" + kelurahantim;
    $.ajax({
      data: kelurahantim,
      url: link
    }).done(function(subcategories) {

      console.log(subcategories);
      $('#kelurahantim').html(subcategories);
    });
  });
</script>
@endsection
