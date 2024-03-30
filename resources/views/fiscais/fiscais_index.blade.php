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
          <div class="col-12 px-4 pt-2">
            <button type="button" class="btn btn-block btn-primary" data-toggle="modal" onclick="tambah_saksi()"> <i class="fa fa-fw fa-plus-circle"></i> Add Fiscais </button>
            <?php //$this->session->flashdata('pesan') ?>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="table" class="table table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Action</th>
                    <th>Nama</th>
                    <!-- <th>Fiscais untuk</th> -->
                    <th>No HP</th>
                    <th>Electoral</th>
                    <th>Munisipiu</th>
                    <th>Posto</th>
                    <th>Suco</th>
                    <th>Aldeia</th>
                    <th>Status</th>
                    <!-- <th>TPS</th> -->
                    <!-- <th>Deskripsi</th> -->
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 1; ?>
                  <?php foreach ($query as $list) : ?>
                    <tr>
                      <td><?= $no++ ?></td>
                      <td><?= $list->status == 1 ? '<button class="btn btn-warning" onclick="verify_saksi(' . $list->idsaksi . ')"><i class="fa fa-check"></i> Already Verified</button>' : '<button class="btn btn-danger" onclick="verify_saksi(' . $list->idsaksi . ')"><i class="fa fa-exclamation"></i> Need Action</button>' ?></td>
                      
                      <td><?= $list->namasaksi ?></td>
                      <?php /*<td><?= $list->namacaleg ?> // <?= $list->wakilcaleg ?> </td> */?>
                      <td><?= $list->hpsaksi ?></td>
                      <td><?= $list->electoralsaksi ?></td>
                      <td><?= $list->nama_district ?></td>
                      <td><?= $list->nama_subdistrict ?></td>
                      <td><?= $list->nama_suco ?></td>
                      <td><?= $list->nama_aldeia ?></td><!-- <td><?= $list->no_tps ?></td> -->
                      <!-- <td><?= $list->deskripsisaksi ?></td> -->
                      <td>
                        <button class="btn btn-primary" onclick="edit_saksi(<?= $list->idsaksi; ?>)"><i class="fa fa-edit"></i> Edit </button>
                        <button class="btn btn-danger" onclick="delete_saksi(<?= $list->idsaksi; ?>)">
                          <i class="fa fa-trash"></i> Delete
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

  function tambah_saksi() {
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('#modal-saksi').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add Fiscais '); // Set Title to Bootstrap modal title
  }

  function verify_saksi(id) {
    if (confirm('Are you sure to do this action?')) {
      $.ajax({
        url: "{{url('saksi/verify_saksi')}}/" + id,
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

  $(document).ready(function() {
    $("#table").dataTable();
    $("#form").validate({
      rules: {
        namasaksi: {
          required: true
        },
        saksiuntuk: {
          required: true
        },
        kabupatensaksi: {
          required: true
        },
        kecamatansaksi: {
          required: true
        },
        hpsaksi: {
          required: true
        },
        electoralsaksi: {
          required: true
        },
        username: {
          required: true
        },
        password: {
          required: true
        },
        kelurahansaksi: {
          required: true
        },
        tpssaksi: {
          required: true
        },
        deskripsisaksi: {
          required: true
        }
      }
    });

  });

  function save() {
    var url;
    var formData = new FormData($('#form')[0]);
    //if (!form.valid()) {
    //  document.getElementById('form').focus();
    //} else {
      if (save_method == 'add') {
        url = "{{url('saksi/save')}}";
      } else {
        url = "{{url('saksi/updateaction')}}";
      }
      console.log(url);
      $.ajax({
        url: url,
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function(data) {
          $('#modal-saksi').modal('hide');
          location.reload();
        }
        //error: function() {
        //  alert('Terdapat Kesalahan');
        //}
      });
    //}
  }

  function edit_saksi(idsaksi) {
    save_method = 'update';
    $('#form')[0].reset();
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $.ajax({
      url: "{{url('saksi/update')}}/" + idsaksi,
      type: "GET",
      dataType: "JSON",
      success: function(data) {
        $('[name="idsaksi"]').val(data.idsaksi);
        $('[name="namasaksi"]').val(data.namasaksi);
        $('[name="saksiuntuk"]').val(data.saksiuntuk);
        $('[name="kabupatensaksi"]').val(data.kabupatensaksi);

        // $('select[name="kecamatansaksi"]').append('<option value="' + data.kecamatansaksi + '">' + data.nama_subdistrict + '</option>');
        // $('select[name="kelurahansaksi"]').append('<option value="' + data.kelurahansaksi + '">' + data.nama_suco + '</option>');
        // $('select[name="tpssaksi"]').append('<option value="' + data.tpssaksi + '">' + data.nama_aldeia + '</option>');
        kecamatan_edit(data.kecamatansaksi)
        kelurahan_edit(data.kelurahansaksi)
        tps_edit(data.tpssaksi)
        $('[name="hpsaksi"]').val(data.hpsaksi);
        $('[name="electoralsaksi"]').val(data.electoralsaksi);
        $('[name="deskripsisaksi"]').val(data.deskripsisaksi);
        $('#modal-saksi').modal('show');
        $('.modal-title').text('Edit Fiscais');
      },
      error: function(jqXHR, textStatus, errorThrown) {
        alert('Gagal dalam pengambilan data');
      }
    });
  }

  function delete_saksi(idsaksi) {
    if (confirm('Are you sure for delete this Fiscais?')) {
      $.ajax({
        url: "{{url('saksi/delete')}}/" + idsaksi,
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
<div class="modal fade" id="modal-saksi">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Data Kelurahan</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <form action="#" id="form" name="form" class="form-horizontal" enctype="multipart/form-data" novalidate="novalidate">
          <input type="hidden" name="idsaksi" id="idsaksi" value="">
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-4 text-left">Electoral Fiscais</label>
            <div class="col-sm-12">
              <input type="text" class="form-control" id="electoralsaksi" placeholder="Electoral Fiscais" name="electoralsaksi" required="">
            </div>
          </div>
          <div class="form-group">
            <label for="namasaksi" class="col-sm-4 text-left">Nama</label>

            <div class="col-sm-12">
              <input type="text" class="form-control" id="namasaksi" placeholder="Name Fiscais" name="namasaksi" required="">
            </div>
          </div>
          <?php
          // $optioncalon = array();
          // $optioncalon[''] = 'Pilih Calon';

          // foreach ($listcalon as $namacalon) {

          //   $optioncalon[$namacalon->idcaleg] = $namacalon->namacaleg . ' // ' . $namacalon->wakilcaleg;
          // }
          ?>
          <!-- <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 text-left">Pilih Calon</label>

            <div class="col-sm-10">
              <?php //echo form_dropdown('saksiuntuk', $optioncalon, '', 'id="saksiuntuk" class="form-control"') ?>
            </div>
          </div> -->

          <div class="form-group">
            <label for="inputEmail3" class="col-sm-4 text-left">Phone No Fiscais</label>

            <div class="col-sm-12">
              <input type="text" class="form-control" id="hpsaksi" placeholder="Phone No Fiscais" name="hpsaksi" required="">
            </div>
          </div>

          <?php
          $option = array();
          $option[''] = 'Pilih Munisipiu';
          $listkabupaten = DB::table('kabupaten')->get();
          foreach ($listkabupaten as $category) {
            $option[$category->kode_district] = $category->kode_district . ' | ' . $category->nama_district;
          }
          ?>
          <div class="form-group">
            <label for="kabupatensaksi" class="col-sm-4 text-left">Munisipiu</label>
            <div class="col-sm-12">
              <?php //echo form_dropdown('kabupatensaksi', $option, '', 'id="kabupatensaksi" class="form-control"') ?>

                <select class="form-control" name="kabupatensaksi" id="kabupatentim">
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
            <label for="kecamatansaksi" class="col-sm-4 text-left">Posto</label>
            <div class="col-sm-12">
              <select name="kecamatansaksi" id="kecamatantim" class="form-control">
                <option>Pilih Posto</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="kelurahansaksi" class="col-sm-4 text-left">Suco</label>
            <div class="col-sm-12">
              <select name="kelurahansaksi" id="kelurahantim" class="form-control">
                <option>Pilih Suco</option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label for="tpssaksi" class="col-sm-4 text-left">Aldeia</label>
            <div class="col-sm-12">
              <select name="tpssaksi" id="tpstim" class="form-control">
                <option>Pilih Aldeia</option>
              </select>
            </div>
          </div>

          <!-- <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 text-left">Nomor TPS</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" placeholder="TPS" id="no_tps" name="no_tps" required="">
            </div>
          </div> -->

          <!-- <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 text-left">Username</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="username" placeholder="username Saksi" name="username" required="">
            </div>
          </div> -->

          <div class="form-group">
            <label for="password" class="col-sm-4 text-left">Password</label>
            <div class="col-sm-12">
              <input type="password" class="form-control" id="password" placeholder="Password Fiscais" name="password" required="">
              <input type="hidden" class="form-control" id="_token"  name="_token" value="{{csrf_token()}}">
            </div>
          </div>

          <!-- <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 text-left">Deskripsi</label>
            <div class="col-sm-10">
              <textarea class="form-control" placeholder="Deskripsi" id="deskripsisaksi" name="deskripsisaksi" required=""></textarea>
            </div>
          </div> -->

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button type="submit" id="btnSave" onclick="save()" class="btn btn-primary">Save changes</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<script>
    function kecamatan_edit(camat) {
        var id = camat;
        var link = "{{url('saksi/get_kecamatan_edit')}}/" + id;
        $.ajax({
            data: id,
            url: link
        }).done(function(data) {
            $('#kecamatansaksi').html(data);
        });
    }

    function kelurahan_edit(camat) {
        var id = camat;
        var link = "{{url('saksi/get_kelurahan_edit')}}/" + id;
        $.ajax({
            data: id,
            url: link
        }).done(function(data) {
            $('#kelurahansaksi').html(data);
        });
    }

    function tps_edit(camat) {
        var id = camat;
        var link = "{{url('saksi/get_tps_edit')}}/" + id;
        $.ajax({
            data: id,
            url: link
        }).done(function(data) {
            $('#tpssaksi').html(data);
        });
    }

    function kelurahansaksi(lurah) {
        var id = lurah;
        var link = "{{url('saksi/get_kelurahan')}}/" + id;
        $.ajax({
            data: id,
            url: link
        }).done(function(data) {
            $('#kelurahansaksi').html(data);
        });
    }

    function tpssaksi(tps) {
        var id = tps;
        var link = "{{url('saksi/get_tps')}}/" + id;
        $.ajax({
            data: id,
            url: link
        }).done(function(data) {
            $('#tpssaksi').html(data);
        });
    }

    $('#kabupatensaksi').change(function() {
        var id = $(this).val();
        var link = "{{url('saksi/get_kecamatan')}}/" + id;
        $.ajax({
            data: id,
            url: link
        }).done(function(data) {
            $('#kecamatansaksi').html(data);
            var value = $(data).val();
            kelurahansaksi(value);
            tpssaksi(value);
        });
    });

    $('#kecamatansaksi').change(function() {
        var id = $(this).val();
        var link = "{{url('saksi/get_kelurahan')}}/" + id;
        $.ajax({
            data: id,
            url: link
        }).done(function(data) {
            $('#kelurahansaksi').html(data);
            var value = $(data).val();
            tpssaksi(value);
        });
    });

    $('#kelurahansaksi').change(function() {
        var id = $(this).val();
        tpssaksi(id)
    });
</script>

@endsection
