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
            <button type="button" class="btn btn-block btn-primary" data-toggle="modal" onclick="tambah_target()"> <i class="fa fa-fw fa-plus-circle"></i> Tambah Target </button>
            <?php  //$this->session->flashdata('pesan') ?>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="table" class="table table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>JUmlah Suara</th>
                    <th>District</th>
                    <th>Sub District</th>
                    <th>Suco</th>
                    <th>Aldeia</th>
                    <th>Aksi</th>

                  </tr>
                </thead>
                <tbody>
                  <?php
                  $targetlist = DB::table('target')
                    ->leftJoin('kabupaten','kabupaten.kode_district','=','target.kabupatentarget')
                    ->leftJoin('kecamatan','kecamatan.kode_subdistrict','=','target.kecamatantarget')
                    ->leftJoin('kelurahan','kelurahan.kode_suco','=','target.kelurahantarget')
                    ->leftJoin('tps','tps.kode_aldeia','=','target.tpstarget')
                    ->get();

                  $no = 1; ?>
                  <?php foreach ($targetlist as $list) : ?>
                    <tr>
                      <td><?= $no++ ?></td>
                      <td><?= $list->jumlahsuara ?></td>
                      <td><?= $list->nama_district ?></td>
                      <td><?= $list->nama_subdistrict ?></td>
                      <td><?= $list->nama_suco ?></td>
                      <td><?= $list->nama_aldeia ?></td>
                      <td>
                        <button class="btn btn-primary" onclick="edit_target(<?= $list->idtarget; ?>)"><i class="fa fa-fw fa-edit"></i>Edit</button>
                        <button class="btn btn-danger" onclick="delete_target(<?= $list->idtarget; ?>)">
                          <i class="fa fa-fw fa-trash"></i> Hapus
                        </button>
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

  function tambah_target() {
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('#modal-target').modal('show'); // show bootstrap modal
    $('.modal-title').text('Tambah Target Suara '); // Set Title to Bootstrap modal title
  }

  function edit_target(idtarget) {
    save_method = 'update';
    $('#form')[0].reset();
    $.ajax({
      url: "<?php echo url('target/update/') ?>/" + idtarget,
      type: "GET",
      dataType: "JSON",
      success: function(data) {
        $('[name="idtarget"]').val(data.idtarget);
        $('[name="jumlahsuara"]').val(data.jumlahsuara);
        $('[name="kabupatentarget"]').val(data.kabupatentarget);

        // $('select[name="kabupatentarget"]').append('<option value="'+ data.idkabupaten +'">'+ data.nama_district +'</option>');
        $('select[name="kecamatantarget"]').append('<option value="' + data.idkecamatan + '">' + data.nama_subdistrict + '</option>');
        $('select[name="kelurahantarget"]').append('<option value="' + data.idkelurahan + '">' + data.nama_subdistrict + '</option>');
        $('select[name="tpstarget"]').append('<option value="' + data.idtps + '">' + data.nama_aldeia + '</option>');
        $('#modal-target').modal('show');
        $('.modal-title').text('Edit Target Suara');
      },
      error: function(jqXHR, textStatus, errorThrown) {
        alert('Gagal dalam pengambilan data');
      }
    });
  }
  $(document).ready(function() {
    $("#table").DataTable()
    $("#form").validate({
      rules: {

        jumlahsuara: {
          required: true
        },

        kabupatentarget: {
          required: true
        },
        kecamatantarget: {
          required: true
        },
        kelurahantarget: {
          required: true
        },
        tpstarget: {
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
        url = "<?= url('target/save') ?>";
      } else {
        url = "<?= url('target/updateaction') ?>";
      }
      $.ajax({
        url: url,
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data) {
          $('#modal-target').modal('hide');
          location.reload();
        },
        error: function() {
          alert('Terdapat Kesalahan');
        }
      });
    }
  }

  function delete_target(idtarget) {
    if (confirm('Anda Yakin Menghapus Target suara ini?')) {
      $.ajax({
        url: "<?= url('target/delete') ?>/" + idtarget,
        type: "GET",
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
<div class="modal fade" id="modal-target">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Data Kelurahan</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <form action="#" id="form" name="form" class="form-horizontal" enctype="multipart/form-data" novalidate="novalidate">
          <input type="hidden" name="idtarget" id="idtarget" value="">
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-4 control-label">Jumlah Suara</label>

            <div class="col-sm-12">
              <input type="text" class="form-control" id="jumlahsuara" placeholder="jumlahsuara" name="jumlahsuara" required="">
            </div>
          </div>

          <?php
          $listkabupaten = DB::table('kabupaten')->get();
          ?>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-4 control-label">DIStrict</label>
            <input type="hidden" class="form-control" id="_token"  name="_token" value="{{csrf_token()}}">
            <div class="col-sm-12">
              <?php //echo form_dropdown('kabupatentarget', $option, '', 'id="kabupatentarget" class="form-control"') ?>
              <select class="form-control" name="kabupatentarget" id="kabupatentarget">
                <option>Pilih District</option>
                <?php foreach ($listkabupaten as $list) { $dt_option = $list->kode_district . ' | ' . $list->nama_district; ?>
                <option value="{{ $list->kode_district }}" >
                    {{ $dt_option }}
                </option>
                <?php } ?>
              </select>
            </div>
          </div>



          <div class="form-group">
            <label for="inputEmail3" class="col-sm-4 control-label">Sub District</label>

            <div class="col-sm-12">
              <select name="kecamatantarget" id="kecamatantarget" class="form-control">
                <option>Pilih Sub District</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-4 control-label">Suco</label>

            <div class="col-sm-12">
              <select name="kelurahantarget" id="kelurahantarget" class="form-control">
                <option>Pilih Suco</option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label for="inputEmail3" class="col-sm-4 control-label">Aldeia</label>

            <div class="col-sm-12">
              <select name="tpstarget" id="tpstarget" class="form-control">
                <option>Pilih Aldeia</option>
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

<script>
    function kecamatan_edit(camat) {
        var id = camat;
        var link = "{{url('target/get_kecamatan_edit')}}/" + id;
        $.ajax({
            data: id,
            url: link
        }).done(function(data) {
            $('#kecamatantarget').html(data);
        });
    }

    function kelurahan_edit(camat) {
        var id = camat;
        var link = "{{url('target/get_kelurahan_edit')}}/" + id;
        $.ajax({
            data: id,
            url: link
        }).done(function(data) {
            $('#kelurahantarget').html(data);
        });
    }

    function tps_edit(camat) {
        var id = camat;
        var link = "{{url('target/get_tps_edit')}}/" + id;
        $.ajax({
            data: id,
            url: link
        }).done(function(data) {
            $('#tpstarget').html(data);
        });
    }

    function kelurahantarget(lurah) {
        var id = lurah;
        var link = "{{url('target/get_kelurahan')}}/" + id;
        $.ajax({
            data: id,
            url: link
        }).done(function(data) {
            $('#kelurahantarget').html(data);
        });
    }

    function tpstarget(tps) {
        var id = tps;
        var link = "{{url('target/get_tps')}}/" + id;
        $.ajax({
            data: id,
            url: link
        }).done(function(data) {
            $('#tpstarget').html(data);
        });
    }

    //$('select#kabupatendpt').change(function() {
    $('#kabupatentarget').on('change',function(e){
        console.log('testytttt ');
        var id = $(this).val();
        var link = '{{url("target/get_kecamatan")}}/'  + id;
        console.log(link);
        $.ajax({
            data: id,
            url: link
        }).done(function(data) {
            $('#kecamatantarget').html(data);
            var value = $(data).val();
            kelurahantarget(value);
            tpstarget(value);
        });
    });

    $('#kecamatantarget').change(function() {
        var id = $(this).val();
        var link = '{{url("target/get_kelurahan")}}/' + id;
        $.ajax({
            data: id,
            url: link
        }).done(function(data) {
            $('#kelurahantarget').html(data);
            var value = $(data).val();
            tpstarget(value);
        });
    });

    $('#kelurahantarget').change(function() {
        var id = $(this).val();
        tpstarget(id)
    });
</script>


@endsection
