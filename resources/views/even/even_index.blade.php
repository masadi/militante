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
          <form>
          <div class="row mt-3 mx-4">
            <button type="button" class="btn btn-block btn-primary" data-toggle="modal" onclick="tambah_even()"> <i class="fa fa-fw fa-plus-circle"></i> Tambah Event </button>
            <?php // $this->session->flashdata('pesan') ?>
          </div>
          <div class="card-body">
            {{csrf_field()}}

            <div class="table-responsive">
            <table id="example1" class="table table-striped" style="width:100%">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Aksi</th>
                  <th>Penyelenggara</th>
                  <th>Lokasi</th>
                  <th>Kontak</th>
                  <th>Tanggal</th>
                  <th>Topik</th>
                  <th>Deskripsi</th>
                  <th>Narasumber</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1;
                $evenlist =  DB::table('even')->orderBy('ideven','DESC')->get();
                ?>
                <?php foreach ($evenlist as $list) : ?>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td>
                      <button class="btn btn-primary" onclick="edit_even(<?= $list->ideven; ?>)"><i class="fa fa-fw fa-edit"></i>Edit</button>
                      <button class="btn btn-danger" onclick="delete_even(<?= $list->ideven; ?>)">
                        <i class="fa fa-fw fa-trash"></i> Hapus
                      </button>
                    </td>
                    <td><?= $list->penyelenggara ?></td>
                    <td><?= $list->lokasi ?></td>
                    <td><?= $list->kontak ?></td>
                    <td><?= $list->tanggal ?></td>
                    <td><?= $list->topik ?></td>
                    <td><?= $list->deskripsi ?></td>
                    <td><?= $list->narasumber ?></td>

                  </tr>
                <?php endforeach; ?>
              </tbody>

            </table>
            </div>
          </div>
          </form>
        </div>
      </div>


    </div>

  </section>
</div>

<div class="modal fade" id="modal-even">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="#" id="form" name="form" class="form-horizontal" enctype="multipart/form-data" novalidate="novalidate">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Data Daerah</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
          <input type="hidden" name="ideven" id="ideven" value="">

          <div class="form-group">
            <label for="inputEmail3" class="col-sm-4 control-label">Penyelenggara</label>

            <div class="col-sm-12">
              <input type="text" class="form-control" id="penyelenggara" placeholder="penyelenggara" name="penyelenggara" required="">
            </div>
          </div>

          <div class="form-group">
            <label for="inputEmail3" class="col-sm-4 control-label">Lokasi</label>

            <div class="col-sm-12">
              <input type="text" class="form-control" id="lokasi" placeholder="lokasi" name="lokasi" required="">
            </div>
          </div>

          <div class="form-group">
            <label for="inputEmail3" class="col-sm-4 control-label">kontak</label>

            <div class="col-sm-12">
              <input type="text" class="form-control" id="kontak" placeholder="kontak" name="kontak" required="">
            </div>
          </div>

          <div class="form-group">
            <label for="inputEmail3" class="col-sm-4 control-label">Tanggal </label>

            <div class="col-sm-12">
              <input type="date" class="form-control" id="tanggal" placeholder="Tanggal" name="tanggal" required="">
            </div>
          </div>

          <div class="form-group">
            <label for="inputEmail3" class="col-sm-4 control-label">topik</label>

            <div class="col-sm-12">
              <input type="text" class="form-control" id="topik" placeholder="topik" name="topik" required="">
            </div>
          </div>



          <div class="form-group">
            <label for="inputEmail3" class="col-sm-4 control-label">Deskripsi</label>
            <div class="col-sm-12">
              <textarea class="form-control" placeholder="Deskripsi" id="deskripsi" name="deskripsi" required=""></textarea>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-4 control-label">Narasumber</label>

            <div class="col-sm-12">
              <input type="text" class="form-control" id="narasumber" placeholder="narasumber" name="narasumber" required="">
            </div>
          </div>

      </div>
      <div class="modal-footer">
          <div class="form-actions">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" id="btnSave" class="btn btn-primary">Save changes</button>
          </div>
      </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<script type="text/javascript">
  var save_method; //for save method string
  var table;

  function tambah_even() {
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('#modal-even').modal('show'); // show bootstrap modal
    $('.modal-title').text('Tambah Event '); // Set Title to Bootstrap modal title
  }
  $(document).ready(function() {
    $("#example1").DataTable()
    $("#form").validate({
      rules: {

        penyelenggara: {
          required: true
        },
        lokasi: {
          required: true
        },
        kontak: {
          required: true
        },
        tanggal: {
          required: true
        },
        topik: {
          required: true
        },
        deskripsi: {
          required: true
        },
        narasumber: {
          required: true
        }
      }
    });

  });



  $('#btnSave').on('click',function(){
    var form = $("#form");
    var url;
    var ideven = $('#ideven').val();
    var penyelenggara = $('#penyelenggara').val();
    var lokasi = $('#lokasi').val();
    var kontak = $('#kontak').val();
    var hp = $('#hp').val();
    var tanggal = $('#tanggal').val();
    var topik = $('#topik').val();
    var deskripsi = $('#deskripsi').val();
    var narasumber = $('#narasumber').val();
    var token = '{{csrf_token()}}';

    if (!form.valid()) {
      document.getElementById('form').focus();
    } else {
      if (save_method == 'add') {
        url = '{{url("even/save")}}';
        console.log(url);
      } else {
        url = "{{url('even/updateaction')}}";
      }
      $.ajax({
        url: url,
        type: 'POST',
        data: 'ideven='+ideven+'&penyelenggara='+penyelenggara+'&lokasi='+lokasi+'&kontak='+kontak+'&hp='+hp+'&tanggal='+tanggal+'&topik='+topik+'&deskripsi='+deskripsi+'&narasumber='+narasumber+'&_token='+token,
        success: function(data) {
          $('#modal-even').modal('hide');
          alert('SUKSES\n\nData berhasil tersimpan ke database.');
          location.reload();
        },
        error: function() {
         alert('Terdapat Kesalahan');
        }
      });
    }
  });

  function edit_even(ideven) {
    save_method = 'update';
    $('#form')[0].reset();
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $.ajax({
      url: "{{url('even/update')}}/" + ideven,
      type: "GET",
      dataType: "JSON",
      success: function(data) {
        $('[name="ideven"]').val(data.ideven);
        $('[name="penyelenggara"]').val(data.penyelenggara);
        $('[name="lokasi"]').val(data.lokasi);
        $('[name="kontak"]').val(data.kontak);
        $('[name="hp"]').val(data.hp);
        $('[name="tanggal"]').val(data.tanggal);
        $('[name="topik"]').val(data.topik);
        $('[name="deskripsi"]').val(data.deskripsi);
        $('[name="narasumber"]').val(data.narasumber);
        $('#modal-even').modal('show');
        $('.modal-title').text('Edit Event');
      },
      error: function(jqXHR, textStatus, errorThrown) {
        alert('Gagal dalam pengambilan data');
      }
    });
  }

  function delete_even(ideven) {
    if (confirm('Anda Yakin Menghapus Event ini?')) {
      $.ajax({
        url: "{{url('even/delete')}}/" + ideven,
        success: function(data) {
            alert('SUKSES\n\nData berhasil terhapus dari database.');
            location.reload();
        },
        error: function(jqXHR, textStatus, errorThrown) {
          alert('Terdapat Kesalahan Dalam Menghapus Data');
        }
      });
    }
  }
</script>
@endsection
