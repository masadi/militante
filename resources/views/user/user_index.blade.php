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
          <div class="row mt-3 mx-4">
            <button type="button" class="btn btn-block btn-primary" data-toggle="modal" onclick="tambah_user()"> <i class="fa fa-fw fa-plus-circle"></i> Tambah User </button>
            <div class="col-12">
              <?php // $this->session->flashdata('pesan') ?>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="example1" class="table table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>nama</th>
                    <th>Level</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 1;
                    $userlist = DB::table('user')->get(); ?>
                  <?php foreach ($userlist as $list) : ?>
                    <tr>
                      <td><?= $no++ ?></td>
                      <td><?= $list->username ?></td>
                      <td><?= $list->nama ?></td>
                      <td><?= $list->level ?></td>
                      <td>
                        <?php if ($level == 'admin') {?>
                          <button class="btn btn-primary" onclick="edit_user(<?= $list->id; ?>)"><i class="fa fa-fw fa-edit"></i>Edit</button>
                          <button class="btn btn-danger" onclick="delete_user(<?= $list->id; ?>)">
                            <i class="fa fa-fw fa-trash"></i> Hapus
                          </button>
                        <?php } ?>
                      </td>

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

  function tambah_user() {
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('#modal-user').modal('show'); // show bootstrap modal
    $('.modal-title').text('Tambah User '); // Set Title to Bootstrap modal title
  }
  $(document).ready(function() {
    $("#example1").DataTable()
    $("#form").validate({
      rules: {

        username: {
          required: true
        },
        password: {
          required: true
        },
        nama: {
          required: true
        },
        level: {
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
        url = "{{url('user/save')}}";
      } else {
        url = "{{url('user/updateaction')}}";
      }
      $.ajax({
        url: url,
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data) {
          $('#modal-user').modal('hide');
          alert('SUKSES\n\nData berhasil disimpan ke database.');
          location.reload();
        },
        error: function() {
          alert('Terdapat Kesalahan');
        }
      });
    }
  }

  function edit_user(id) {
    save_method = 'update';
    $('#form')[0].reset();
    $.ajax({
      url: "{{url('user/update')}}/" + id,
      type: "GET",
      dataType: "JSON",
      success: function(data) {
        $('[name="id"]').val(data.id);
        $('[name="nama"]').val(data.nama);
        $('[name="username"]').val(data.username);
        //$('[name="password"]').val(data.password);
        $('[name="level"]').val(data.level);
        $('#modal-user').modal('show');
        $('.modal-title').text('Edit User');
      },
      error: function(jqXHR, textStatus, errorThrown) {
        alert('Gagal dalam pengambilan data');
      }
    });
  }

  function delete_user(id) {
    if (confirm('Anda Yakin Menghapus user ini?')) {
      $.ajax({
        url: "{{url('user/delete')}}/" + id,
        type: "GET",
        dataType: "JSON",
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
<div class="modal fade" id="modal-user">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Data Kecamatan</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <form action="#" id="form" name="form" class="form-horizontal" enctype="multipart/form-data" novalidate="novalidate">
          <input type="hidden" name="id" id="id" value="">

          <div class="form-group">
            <label for="inputEmail3" class="col-sm-4 control-label">Nama</label>

            <div class="col-sm-12">
              <input type="text" class="form-control" id="nama" placeholder="nama" name="nama" required="">
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-4 control-label">Username</label>

            <div class="col-sm-12">
              <input type="text" class="form-control" id="username" placeholder="username" name="username" required="">
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-4 control-label">Password</label>

            <div class="col-sm-12">
              <input type="password" class="form-control" id="password" placeholder="password" name="password" required="">
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-4 control-label">Level</label>
            <input type="hidden" class="form-control" id="_token"  name="_token" value="{{csrf_token()}}">

            <div class="col-sm-12">
              <select name="level" id="level" class="form-control" required="">
                <option value="">Pilih Level User</option>
                <option value="koordinator">koordinator</option>
                <option value="caleg">caleg</option>
                <option value="relawan">relawan</option>
              </select>
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
