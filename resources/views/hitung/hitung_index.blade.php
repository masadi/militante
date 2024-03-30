@extends('layoututama')
@section('content')
<?php
$level = Session::get('level');
$saksi = Session::get('saksikode');
?>
<div class="main-content">
  <section class="section">
    <div class="row">
      <?php if ($level == 'admin') { ?>
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <div class="table-responsive">
                <table id="tabledpt" class="table table-striped">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama</th>
                      <th>Lokasi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;


                    $informasisaksiuntukadmin = DB::table('hitung')
                        ->leftJoin('saksi','saksi.idsaksi','=','hitung.saksihitung')
                        ->leftJoin('kabupaten','kabupaten.idkabupaten','=','saksi.kabupatensaksi')
                        ->leftJoin('kecamatan','kecamatan.idkecamatan','=','saksi.kabupatensaksi')
                        ->leftJoin('kelurahan','kelurahan.idkelurahan','=','saksi.kelurahansaksi')
                        ->leftJoin('tps','tps.idtps','=','saksi.tpssaksi')
                        ->leftJoin('user','saksi.idsaksi','=','user.saksikode')
                        ->leftJoin('profil','profil.idcaleg','=','saksi.saksiuntuk')
                        ->get();
                    ?>
                    <?php foreach ($informasisaksiuntukadmin as $listsaksi) : ?>
                      <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $listsaksi->namasaksi ?> saksi untuk <?= $listsaksi->namacaleg ?></td>
                        <td><?= $listsaksi->nama_district ?> // <?= $listsaksi->nama_subdistrict ?> // <?= $listsaksi->nama_suco ?> /<?= $listsaksi->nama_aldeia ?></td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      <?php } else { ?>

        <div class="col-md-12">
        <?php

                    $xinformasisaksi = DB::table('saksi')
                        ->leftJoin('user','user.saksikode','=','saksi.idsaksi')
                        ->leftJoin('kabupaten','kabupaten.idkabupaten','=','saksi.kabupatensaksi')
                        ->leftJoin('kecamatan','kecamatan.idkecamatan','=','saksi.kabupatensaksi')
                        ->leftJoin('kelurahan','kelurahan.idkelurahan','=','saksi.kelurahansaksi')
                        ->leftJoin('tps','tps.idtps','=','saksi.tpssaksi')
                        ->leftJoin('profil','profil.idcaleg','=','saksi.saksiuntuk')
                        ->where('user.saksikode','=',$saksi)
                        ->get();

        ?>
        <?php foreach ($xinformasisaksi as $informasisaksi) : ?>
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Informasi Saksi untuk calon : <STRONG><?= $informasisaksi->namasaksi ?></STRONG></h4>
            </div>
            <!-- /.box-header -->
            <div class="card-body">
              <strong><i class="fa fa-book margin-r-5"></i>Nama : <?=  $informasisaksi->namasaksi ?></strong><br>
              <strong><i class="fa fa-map-marker margin-r-5"></i> Saksi DI : District: <?=  $informasisaksi->nama_district ?> Sub District: <?php //  $informasisaksi->nama_subdistrict ?> Suco: <?php //  $informasisaksi->nama_suco ?> Aldeia: <?php //  $informasisaksi->nama_aldeia ?></strong>


              <hr>

              <strong><i class="fa fa-file-text-o margin-r-5"></i> Catatan</strong>

              <p>Semua Hasil Suara di <b>District: <?=  $informasisaksi->nama_district ?> Sub District: <?=  $informasisaksi->nama_subdistrict ?> Suco: <?=  $informasisaksi->nama_suco ?> Aldeia: <?=  $informasisaksi->nama_aldeia ?> </b> adalah tangung jawab saudara</p>
            </div>
            <!-- /.box-body -->
          </div>
        <?php endforeach; ?>
        </div>

      <?php } ?>

      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Master Hitung</h4>
          </div>
          <div class="card-body">
            <?php //if ($level != 'admin') { ?>
                <button type="button" class="btn btn-block btn-primary" data-toggle="modal" onclick="tambah_hitung()"> <i class="fa fa-fw fa-plus-circle"></i> Tambah Hitung Cepat </button>
                <br>
            <?php //} ?>
            <?php // $this->session->flashdata('pesan') ?>
            <div class="table-responsive">
              <table id="example1" class="table table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Aksi</th>

                    <th>District</th>
                    <th>SUb District</th>
                    <th>Suco</th>
                    <th>Aldeia</th>
                    <th>Saksi</th>
                    <th>Jumlah</th>
                    <th>User</th>

                  </tr>
                </thead>
                <tbody>
                  <?php $no = 1;


                    $hitunglist = DB::table('hitung')
                        ->leftJoin('saksi','saksi.idsaksi','=','hitung.saksihitung')
                        ->leftJoin('kabupaten','kabupaten.idkabupaten','=','saksi.kabupatensaksi')
                        ->leftJoin('kecamatan','kecamatan.idkecamatan','=','saksi.kabupatensaksi')
                        ->leftJoin('kelurahan','kelurahan.idkelurahan','=','saksi.kelurahansaksi')
                        ->leftJoin('tps','tps.idtps','=','saksi.tpssaksi')
                        ->leftJoin('user','saksi.idsaksi','=','user.saksikode')
                        ->get();
                        ?>
                  <?php foreach ($hitunglist as $list) : ?>
                    <tr>
                      <td><?= $no++ ?></td>
                      <td>

                        <?php if ($level != 'admin') { ?>
                          <?php
                          if (Session::get('saksikode') == $list->saksihitung) { ?>
                            <button class="btn btn-xs btn-primary" onclick="edit_hitung(<?= $list->id_hitung; ?>)"><i class="fa fa-fw fa-edit"></i></button>
                          <?php } else {
                            echo "anda tidak bisa mengubah ini";
                          } ?>
                        <?php }
                        if ($level== 'admin') { ?>
                          <button class="btn btn-xs btn-danger" onclick="delete_hitung(<?= $list->id_hitung; ?>)">
                            <i class="fa fa-fw fa-trash"></i>
                          </button>
                        <?php } ?>
                      </td>
                      <td><?= $list->nama_district ?></td>
                      <td><?= $list->nama_subdistrict ?></td>
                      <td><?= $list->nama_suco ?></td>
                      <td><?= $list->nama_aldeia ?></td>
                      <td><?= $list->namasaksi ?></td>
                      <td><?= $list->jumlah ?></td>
                      <td><?= $list->nama ?></td>

                    </tr>
                  <?php endforeach; ?>
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

  function tambah_hitung() {
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('#modal-hitung').modal('show'); // show bootstrap modal
    $('.modal-title').text('Tambah Hitungan Cepat '); // Set Title to Bootstrap modal title
  }
  $(document).ready(function() {
    $("#tabledpt").DataTable()
    $("#example1").DataTable()
    $("#form").validate({
      rules: {

        jumlah: {
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
        url = "{{url('hitung/save')}}";
      } else {
        url = "{{url('hitung/updateaction')}}";
      }
      $.ajax({
        url: url,
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data) {
          $('#modal-hitung').modal('hide');
          location.reload();
        },
        error: function() {
          alert('Terdapat Kesalahan');
        }
      });
    }
  }

  function edit_hitung(id_hitung) {
    save_method = 'update';
    $('#form')[0].reset();
    $.ajax({
      url: "<?= url('hitung/update') ?>/" + id_hitung,
      type: "GET",
      dataType: "JSON",
      success: function(data) {
        $('[name="id_hitung"]').val(data.id_hitung);
        $('[name="jumlah"]').val(data.jumlah);

        $('#modal-hitung').modal('show');
        $('.modal-title').text('Edit Form Hitung Cepat');
      },
      error: function(jqXHR, textStatus, errorThrown) {
        alert('Gagal dalam pengambilan data');
      }
    });
  }

  function delete_hitung(id_hitung) {
    if (confirm('Anda Yakin Menghapus Data ini?')) {
      $.ajax({
        url: "<?= url('hitung/delete') ?>/" + id_hitung,
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

<div class="modal fade" id="modal-hitung">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Tambah Data Hitung Cepat</h4>
      </div>
      <div class="modal-body">
        <form action="#" id="form" name="form" class="form-horizontal" enctype="multipart/form-data" novalidate="novalidate">
          <input type="hidden" name="id_hitung" id="id_hitung" value="">

          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Jumlah</label>

            <div class="col-sm-10">
              <input type="text" class="form-control" id="jumlah" placeholder="Jumlah" name="jumlah" required="">
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
<!-- modal SMS -->

@endsection
