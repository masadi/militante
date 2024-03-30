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
            <button type="button" class="btn btn-block btn-primary" data-toggle="modal" onclick="tambah_analisa()"> <i class="fa fa-fw fa-plus-circle"></i> Tambah Analisa </button>
            <div class="col-12">
              <?php // $this->session->flashdata('pesan') ?>
            </div>
          </div>
          <div class="card-body">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item"><a class="nav-link active" href="#kekuatan" data-toggle="tab">Kekuatan( <b><i>Strenght</i></b>)</a></li>
              <li class="nav-item"><a class="nav-link" href="#kelemahan" data-toggle="tab">Kelemahan (<b><i>Weakness</i></b>)</a></li>
              <li class="nav-item"><a class="nav-link" href="#kesempatan" data-toggle="tab">Kesempatan(<b><i>Opportunities</i></b>)</a></li>
              <li class="nav-item"><a class="nav-link" href="#ancaman" data-toggle="tab">Ancaman(<b> <i>Threats</i></b>)</a></li>

            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="kekuatan">
                <div class="table-responsive">
                  <table id="example1" class="table table-striped">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Provinsi</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no = 1;



                    $analisalist = DB::table('analisa')
                        ->leftJoin('kecamatan','kecamatan.idkecamatan','=','analisa.kecamatananalisa')
                        ->leftJoin('kelurahan','kelurahan.idkelurahan','=','analisa.kelurahananalisa')
                        ->leftJoin('kabupaten','kabupaten.idkabupaten','=','analisa.kabupatenanalisa')
                        ->get();

                      ?>
                      <?php foreach ($analisalist as $list) :
                        if ($list->jenis == 'kekuatan') { ?>
                          <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $list->namaprovinsi ?>(<b>Kab :<?= $list->namakabupaten ?>|Kec: <?= $list->namakecamatan ?>|Kel:<?= $list->namakelurahan ?></b>)</td>
                            <td><?= $list->deskripsi_analisa ?></td>
                            <td>
                              <button class="btn btn-primary" onclick="edit_analisa(<?= $list->idanalisa; ?>)"><i class="fa fa-fw fa-edit"></i>Edit</button>
                              <button class="btn btn-danger" onclick="delete_analisa(<?= $list->idanalisa; ?>)">
                                <i class="fa fa-fw fa-trash-o"></i> Hapus
                              </button>
                            </td>
                          </tr>
                      <?php }
                      endforeach; ?>
                    </tbody>

                  </table>
                </div>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="kelemahan">
                <div class="table-responsive">
                  <table id="example2" class="table table-striped">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Provinsi</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>

                      </tr>
                    </thead>
                    <tbody>
                      <?php $no = 1;
                    $analisalist = DB::table('analisa')
                        ->leftJoin('kecamatan','kecamatan.idkecamatan','=','analisa.kecamatananalisa')
                        ->leftJoin('kelurahan','kelurahan.idkelurahan','=','analisa.kelurahananalisa')
                        ->leftJoin('kabupaten','kabupaten.idkabupaten','=','analisa.kabupatenanalisa')
                        ->get();
                        ?>
                      <?php foreach ($analisalist as $list) :
                        if ($list->jenis == 'kelemahan') { ?>
                          <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $list->namaprovinsi ?>(<b>Kab :<?= $list->namakabupaten ?>|Kec: <?= $list->namakecamatan ?>|Kel:<?= $list->namakelurahan ?></b>)</td>
                            <td><?= $list->deskripsi_analisa ?></td>
                            <td>
                              <button class="btn btn-primary" onclick="edit_analisa(<?= $list->idanalisa; ?>)"><i class="fa fa-fw fa-edit"></i>Edit</button>
                              <button class="btn btn-danger" onclick="delete_analisa(<?= $list->idanalisa; ?>)">
                                <i class="fa fa-fw fa-trash"></i> Hapus
                              </button>
                            </td>
                          </tr>
                      <?php }
                      endforeach; ?>
                    </tbody>

                  </table>
                </div>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="kesempatan">
                <div class="table-responsive">
                  <table id="example3" class="table table-striped">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Provinsi</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>

                      </tr>
                    </thead>
                    <tbody>
                      <?php $no = 1;
                    $analisalist = DB::table('analisa')
                        ->leftJoin('kecamatan','kecamatan.idkecamatan','=','analisa.kecamatananalisa')
                        ->leftJoin('kelurahan','kelurahan.idkelurahan','=','analisa.kelurahananalisa')
                        ->leftJoin('kabupaten','kabupaten.idkabupaten','=','analisa.kabupatenanalisa')
                        ->get();
                        ?>
                      <?php foreach ($analisalist as $list) :
                        if ($list->jenis == 'kesempatan') { ?>
                          <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $list->namaprovinsi ?>(<b>Kab :<?= $list->namakabupaten ?>|Kec: <?= $list->namakecamatan ?>|Kel:<?= $list->namakelurahan ?></b>)</td>
                            <td><?= $list->deskripsi_analisa ?></td>
                            <td>
                              <button class="btn btn-primary" onclick="edit_analisa(<?= $list->idanalisa; ?>)"><i class="fa fa-fw fa-edit"></i>Edit</button>
                              <button class="btn btn-danger" onclick="delete_analisa(<?= $list->idanalisa; ?>)">
                                <i class="fa fa-fw fa-trash-o"></i> Hapus
                              </button>
                            </td>
                          </tr>
                      <?php }
                      endforeach; ?>
                    </tbody>

                  </table>
                </div>
              </div>
              <div class="tab-pane" id="ancaman">
                <div class="table-responsive">
                  <table id="example4" class="table table-striped">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Provinsi</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>

                      </tr>
                    </thead>
                    <tbody>
                      <?php $no = 1;
                    $analisalist = DB::table('analisa')
                        ->leftJoin('kecamatan','kecamatan.idkecamatan','=','analisa.kecamatananalisa')
                        ->leftJoin('kelurahan','kelurahan.idkelurahan','=','analisa.kelurahananalisa')
                        ->leftJoin('kabupaten','kabupaten.idkabupaten','=','analisa.kabupatenanalisa')
                        ->get();
                        ?>
                      <?php foreach ($analisalist as $list) :
                        if ($list->jenis == 'ancaman') { ?>
                          <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $list->namaprovinsi ?>(<b>Kab :<?= $list->namakabupaten ?>|Kec: <?= $list->namakecamatan ?>|Kel:<?= $list->namakelurahan ?></b>)</td>
                            <td><?= $list->deskripsi_analisa ?></td>
                            <td>
                              <button class="btn btn-primary" onclick="edit_analisa(<?= $list->idanalisa; ?>)"><i class="fa fa-fw fa-edit"></i>Edit</button>
                              <button class="btn btn-danger" onclick="delete_analisa(<?= $list->idanalisa; ?>)">
                                <i class="fa fa-fw fa-trash-o"></i> Hapus
                              </button>
                            </td>
                          </tr>
                      <?php }
                      endforeach; ?>
                    </tbody>

                  </table>
                </div>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
        </div>
      </div>


    </div>

  </section>
</div>
<script type="text/javascript">
  var save_method; //for save method string
  var table;

  function tambah_analisa() {
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('#modal-analisa').modal('show'); // show bootstrap modal
    $('.modal-title').text('Tambah Analisa '); // Set Title to Bootstrap modal title
  }
  $(document).ready(function() {
    $("#example1").DataTable()
    $("#example2").DataTable()
    $("#example3").DataTable()
    $("#example4").DataTable()
    $("#form").validate({
      rules: {

        provinsianalisa: {
          required: true
        },
        kabupatenanalisa: {
          required: true
        },
        kecamatananalisa: {
          required: true
        },
        kelurahananalisa: {
          required: true
        },
        deskripsi_analisa: {
          required: true
        },
        jenis: {
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
        url = "<?= url('analisa/save') ?>";
      } else {
        url = "<?= url('analisa/updateaction') ?>";
      }
      $.ajax({
        url: url,
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data) {
          $('#modal-analisa').modal('hide');
          location.reload();
        },
        error: function() {
          alert('Terdapat Kesalahan');
        }
      });
    }
  }

  function edit_analisa(idanalisa) {
    save_method = 'update';
    $('#form')[0].reset();
    $.ajax({
      url: "<?= url('analisa/update') ?>/" + idanalisa,
      type: "GET",
      dataType: "JSON",
      success: function(data) {
        $('[name="idanalisa"]').val(data.idanalisa);
        $('[name="provinsianalisa"]').val(data.provinsianalisa);
        $('select[name="kabupatenanalisa"]').append('<option value="' + data.idkabupaten + '">' + data.namakabupaten + '</option>');
        $('select[name="kecamatananalisa"]').append('<option value="' + data.idkecamatan + '">' + data.namakecamatan + '</option>');
        $('select[name="kelurahananalisa"]').append('<option value="' + data.idkelurahan + '">' + data.namakelurahan + '</option>');
        $('[name="jenis"]').val(data.jenis);
        $('[name="deskripsi_analisa"]').val(data.deskripsi_analisa);
        $('#modal-analisa').modal('show');
        $('.modal-title').text('Edit Analisa');
      },
      error: function(jqXHR, textStatus, errorThrown) {
        alert('Gagal dalam pengambilan data');
      }
    });
  }

  function delete_analisa(idanalisa) {
    if (confirm('Anda Yakin Menghapus Analisa ini?')) {
      $.ajax({
        url: "<?= url('analisa/delete') ?>/" + idanalisa,
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
<div class="modal fade" id="modal-analisa">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Data Daerah</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <form action="#" id="form" name="form" class="form-horizontal" enctype="multipart/form-data" novalidate="novalidate">
          <input type="hidden" name="idanalisa" id="idanalisa" value="">

          <div class="form-group">
            <label for="inputEmail3" class="col-sm-4 control-label">Daerah koordinator</label>

            <input type="hidden" class="form-control" id="_token"  name="_token" value="{{csrf_token()}}">
            <div class="col-sm-12">
              <?php //echo form_dropdown('provinsianalisa', $option, $as, 'id="provinsianalisa"  required="" class="form-control" title="Field Provinsi Harus Diisi"'); ?>

              <select class="form-control" name="provinsianalisa" id="provinsianalisa">
                <option>Pilih Provinsi</option>
              </select>

            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-4 control-label">Kabupaten</label>

            <div class="col-sm-12">
              <select name="kabupatenanalisa" id="kabupatenanalisa" class="form-control">
                <?php
                $listkabupaten = DB::table('kabupaten')->get();
                ?>
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
            <label for="inputEmail3" class="col-sm-4 control-label">Pilih Kecamatan</label>

            <div class="col-sm-12">
              <select name="kecamatananalisa" id="kecamatananalisa" class="form-control">

              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-4 control-label">Pilih Kelurahan</label>

            <div class="col-sm-12">
              <select name="kelurahananalisa" id="kelurahananalisa" class="form-control">

              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-4 control-label">Jenis Analisa</label>

            <div class="col-sm-12">
              <select name="jenis" class="form-control" required="" id="jenis">
                <option value="kekuatan">Kekuatan &nbsp;( <b><i>Strenght</i></b>)</option>
                <option value="kelemahan">Kelemahan&nbsp;(<b><i>Weakness</i></b>)</option>
                <option value="kesempatan">Kesempatan&nbsp;(<b><i>Opportunities</i></b>)</option>
                <option value="ancaman">Ancaman&nbsp;(<b> <i>Threats</i></b>)</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-4 control-label">Deskripsi</label>
            <div class="col-sm-12">
              <textarea class="form-control" placeholder="Deskripsi" id="deskripsi_analisa" name="deskripsi_analisa" required=""></textarea>
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

    function kelurahananalisa(lurah) {
        var id = lurah;
        var link = "{{url('analisa/get_kelurahan')}}/" + id;
        $.ajax({
            data: id,
            url: link
        }).done(function(data) {
            $('#kelurahananalisa').html(data);
        });
    }

    function tpsanalisa(tps) {
        var id = tps;
        var link = "{{url('analisa/get_tps')}}/" + id;
        $.ajax({
            data: id,
            url: link
        }).done(function(data) {
            $('#tpsanalisa').html(data);
        });
    }

    $('#kabupatenanalisa').on('change',function(e){
        console.log('testytttt ');
        var id = $(this).val();
        var link = '{{url("analisa/get_kecamatan")}}/'  + id;
        console.log(link);
        $.ajax({
            data: id,
            url: link
        }).done(function(data) {
            $('#kecamatananalisa').html(data);
            var value = $(data).val();
            kelurahananalisa(value);
            tpsanalisa(value);
        });
    });

    $('#kecamatananalisa').change(function() {
        var id = $(this).val();
        var link = '{{url("analisa/get_kelurahan")}}/' + id;
        $.ajax({
            data: id,
            url: link
        }).done(function(data) {
            $('#kelurahananalisa').html(data);
            var value = $(data).val();
            tpsanalisa(value);
        });
    });

    $('#kelurahananalisa').change(function() {
        var id = $(this).val();
        tpsanalisa(id)
    });
</script>

@endsection
