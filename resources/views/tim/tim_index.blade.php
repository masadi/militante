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
            <button type="button" class="btn btn-block btn-primary" data-toggle="modal" onclick="tambah_tim()"> <i class="fa fa-fw fa-plus-circle"></i> Tambah Tim </button>
            <?php //$this->session->flashdata('pesan') ?>

          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="table" class="table table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Aksi</th>
                    <th>Kabupaten</th>
                    <th>Kecamatan</th>
                    <th>Kelurahan</th>
                    <th>Nama Tim</th>
                    <th>Anggota</th>

                    <th>Tugas</th>


                  </tr>
                </thead>
                <tbody>
                  <?php $no = 1;

                  ?>
                  <?php foreach ($query as $list) : ?>
                    <tr>
                      <td><?= $no++ ?></td>
                      <td>
                        <button class="btn btn-primary" onclick="edit_tim(<?= $list->idtim; ?>)"><i class="fa fa-fw fa-edit"></i></button>
                        <button class="btn btn-danger" onclick="delete_tim(<?= $list->idtim; ?>)">
                          <i class="fa fa-fw fa-trash"></i>
                        </button>
                        <a class="btn btn-info" href="tim/detail/<?php echo $list->idtim ?>">
                          <i class="fa fa-fw fa-eye"></i>
                        </a>
                      </td>
                      <td><?= $list->nama_district ?></td>
                      <td><?= $list->nama_subdistrict ?></td>
                      <td><?= $list->nama_suco ?></td>
                      <td><?= $list->namatim ?></td>
                      <td>
                        <?php
                        if (!empty($list->anggota)) {
                          $members = explode(',', $list->anggota);
                          foreach ($members as $member) {
                            if (is_numeric($member)) {
                              $listr = DB::table('relawan')
                                    ->select('namadpt')
                                    ->join('pemilih','pemilih.idpemilih','=','relawan.idpemilihrelawan')
                                    ->join('dpt','dpt.iddpt','=','pemilih.iddptpemilih')
                                    ->where('relawan.idrelawan','=',$member)
                                    ->get();
                               foreach ($listr as $listnama) echo '<strong>'.$listnama->namadpt.'</strong>, ';
                            } else {
                              echo '';
                            }
                          }
                        }
                        ?>

                      </td>
                      <td><?= $list->tugas ?></td>

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

  function tambah_tim() {
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('#modal-tim').modal('show'); // show bootstrap modal
    $('.modal-title').text('Tambah Tim '); // Set Title to Bootstrap modal title
  }
  $(document).ready(function() {
    $('#table').DataTable()
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
        kecamatantim: {
          required: true
        },
        kelurahantim: {
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
    //if (!form.valid()) {
    //  document.getElementById('form').focus();
    //} else {
      if (save_method == 'add') {
        url = "<?= url('tim/save') ?>";
      } else {
        url = "<?= url('tim/updateaction') ?>";
      }
        var formData = new FormData($('#form')[0]);
      $.ajax({
        url: url,
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function(data) {
          $('#modal-tim').modal('hide');
          console.log(data);
          location.reload();
        },
        error: function() {
          $(".alert-danger").css('display', 'block');
          $(".alert-danger").html(data.error);
        }
      });
    //}
  }

  function edit_tim(idtim) {
    save_method = 'update';
    $('#form')[0].reset();
    console.log(idtim);
    $.ajax({
      url: "{{url('tim/update')}}/" + idtim,
      type: "GET",
      dataType: "JSON",
      success: function(data) {
        $('[name="idtim"]').val(data.idtim);
        $('[name="namatim"]').val(data.namatim);
        $('[name="kabupatentim"]').val(data.kabupatentim);

        $('select[name="kecamatantim"]').append('<option value="' + data.kode_subdistrict + '">' + data.kode_subdistrict + ' | ' + data.nama_subdistrict + '</option>');
        $('select[name="kelurahantim"]').append('<option value="' + data.kode_suco + '">' + data.kode_suco + '|' + data.nama_suco + '</option>');
        $('[name="anggota"]').val(data.anggota);
        $('[name="tugas"]').val(data.tugas);
        $('#modal-tim').modal('show');
        $('.modal-title').text('Edit Tim');
      }
      // error: function(jqXHR, textStatus, errorThrown) {
      //   alert('Gagal dalam pengambilan data');
      // }
    });
  }

  function delete_tim(idtim) {
    if (confirm('Anda Yakin Menghapus Tim ini?')) {
      $.ajax({
        url: "<?= url('tim/delete') ?>/" + idtim,
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
            <label for="inputEmail3" class="col-sm-4 text-left">Nama Tim</label>

            <input type="hidden" class="form-control" id="_token"  name="_token" value="{{csrf_token()}}">
            <div class="col-sm-12">
              <input type="text" class="form-control" id="namatim" placeholder="nama Tim" name="namatim" required="">
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-4 text-left">District</label>

            <div class="col-sm-12">
              <?php //echo form_dropdown('kabupatentim', $option, $as, 'id="kabupatentim"  required="" class="form-control" title="Field District Harus Diisi"'); ?>

              <select name="kabupatentim" id="kabupatentim" class="form-control">
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
            <label for="inputEmail3" class="col-sm-4 text-left">Sub District</label>

            <div class="col-sm-12">
              <select name="kecamatantim" id="kecamatantim" value="" class="form-control">

              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-4 text-left">Suco</label>

            <div class="col-sm-12">
              <select name="kelurahantim" id="kelurahantim" value="" class="form-control">

              </select>
            </div>
          </div>


          <div class="form-group">
            <label for="inputEmail3" class="col-sm-4 text-left">Anggota</label>
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
            <label for="inputEmail3" class="col-sm-4 text-left">Tugas</label>
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

    function kelurahantim(lurah) {
        var id = lurah;
        var link = "{{url('tim/get_kelurahan')}}/" + id;
        $.ajax({
            data: id,
            url: link
        }).done(function(data) {
            $('#kelurahantim').html(data);
        });
    }

    function tpstim(tps) {
        var id = tps;
        var link = "{{url('tim/get_tps')}}/" + id;
        $.ajax({
            data: id,
            url: link
        }).done(function(data) {
            $('#tpstim').html(data);
        });
    }

    $('#kabupatentim').on('change',function(e){
        console.log('testytttt ');
        var id = $(this).val();
        var link = '{{url("tim/get_kecamatan")}}/'  + id;
        console.log(link);
        $.ajax({
            data: id,
            url: link
        }).done(function(data) {
            $('#kecamatantim').html(data);
            var value = $(data).val();
            kelurahantim(value);
            tpstim(value);
        });
    });

    $('#kecamatantim').change(function() {
        var id = $(this).val();
        var link = '{{url("tim/get_kelurahan")}}/' + id;
        $.ajax({
            data: id,
            url: link
        }).done(function(data) {
            $('#kelurahantim').html(data);
            var value = $(data).val();
            tpstim(value);
        });
    });

    $('#kelurahantim').change(function() {
        var id = $(this).val();
        tpstim(id)
    });
</script>
@endsection
