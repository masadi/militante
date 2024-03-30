@extends('layoututama')
@section('content')
<?php
$level = Session::get('level');
?><style type="text/css">
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
              <button type="button" class="btn btn-block btn-primary" data-toggle="modal" onclick="add_pemilih()"> <i class="fa fa-fw fa-plus-circle"></i> Tambah Pemilih </button>
            </div>
            <div class="col-md-2"><a href="pemilih/cetak" class="btn btn-block btn-danger"><i class="fa fa-print"></i> Cetak Pemilih </a></div>
            <?php //// $this->session->flashdata('pesan') ?>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="table" class="table table-striped">
                <thead>
                  <tr>
                    <th>Nama</th>
                    <th>HP</th>
                    <th>Foto KTP</th>
                    <th style="width:125px;">Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                $list = DB::table('pemilih')
                    ->leftJoin('dpt','dpt.iddpt','=','pemilih.iddptpemilih')
                    ->leftJoin('kabupaten','kabupaten.kode_district','=','dpt.kabupatendpt')
                    ->leftJoin('kecamatan','kecamatan.kode_subdistrict','=','dpt.kecamatandpt')
                    ->leftJoin('kelurahan','kelurahan.kode_suco','=','dpt.kelurahandpt')
                    ->leftJoin('tps','tps.kode_aldeia','=','dpt.tpsdpt')
                    ->leftJoin('profil','profil.idcaleg','=','pemilih.calonyangdipilih')
                    ->get();
                $no=1;
				foreach ($list as $pemilih) {
                    echo '<tr><td>'.$no.'</td>';
					$row[] = $pemilih->namadpt.'</td>';
					$row[] = $pemilih->tlppemilih.'</td>';
					//$row[] = $pemilih->namaprovinsi;
					//if ($pemilih->ktppemilih)
					//	$row[] = '<a href="app-assets/ktppemilihupload/'.$pemilih->ktppemilih.'" target="_blank"><img src="app-assets/ktppemilihupload/'.$pemilih->ktppemilih.'" class="profile-user-img img-responsive img-circle " /></a>';
					//else
						$row[] = '(No photo)';
					$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_pemilih(' . "'" . $pemilih->idpemilih . "'" . ')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_pemilih(' . "'" . $pemilih->idpemilih . "'" . ')"><i class="glyphicon glyphicon-trash"></i> Delete</a></td>';

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
        //    provinsipemilih:{required:true},
        namapemilih: {
          required: true
        },
        email: {
          required: true
        },
        calonyangdipilih: {
          required: true
        },
        nikpemilih: {
          required: true
        },
        hp: {
          required: true
        },
        ttl: {
          required: true
        },
        kabupatenpemilih: {
          required: true
        },
        kecamatanpemilih: {
          required: true
        },
        kelurahanpemilih: {
          required: true
        },
        ktpaja: {
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
        "url": "<?php echo url('pemilih/ajax_list') ?>",
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


  function add_pemilih() {
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal-pemilih').modal('show'); // show bootstrap modal
    $('.modal-title').text('Tambah Pemilih'); // Set Title to Bootstrap modal title
    $('#photo-preview').hide(); // hide photo preview modal
    $('#label-photo').text('Foto KTP'); // label photo upload
  }

  function edit_pemilih(idpemilih) {
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
      url: "{{url('pemilih/ajax_edit')}}/" + idpemilih,
      type: "GET",
      dataType: "JSON",
      success: function(data) {
        console.log(data.nikdpt);
        $('[name="idpemilih"]').val(data.idpemilih);
        $('[name="iddptpemilih"]').val(data.iddpt);
        $('[name="kabupatenpemilih"]').val(data.nama_district);
        $('[name="kecamatanpemilih"]').val(data.nama_subdistrict);
        $('[name="kelurahanpemilih"]').val(data.nama_suco);
        $('[name="tpspemilih"]').val(data.nama_aldeia);
        $('[name="namapemilih"]').val(data.namadpt);
        $('[name="calonyangdipilih"]').val(data.calonyangdipilih);
        $('[name="emailpemilih"]').val(data.emailpemilih);
        $('[name="nikpemilih"]').val(data.nikdpt);
        $('[name="tlppemilih"]').val(data.tlppemilih);
        $('[name="ttl"]').val(data.ttl);
        $('[name="fbpemilih"]').val(data.fbpemilih);
        $('[name="igpemilih"]').val(data.igpemilih);
        $('#modal-pemilih').modal('show'); // show bootstrap modal when complete loaded
        $('.modal-title').text('Edit Pemilih'); // Set title to Bootstrap modal title
        $('#photo-preview').show(); // show photo preview modal
        if (data.ktppemilih) {
          $('#label-photo').text('Change Photo'); // label photo upload
          $('#photo-preview div').html('<img src="app-assets/ktppemilihupload/' + data.ktppemilih + '" class="img-responsive">'); // show photo
          $('#photo-preview div').append('<input type="checkbox" name="remove_photo" value="' + data.ktppemilih + '"/> Remove photo when saving'); // remove photo
        } else {
          $('#label-photo').text('Upload Photo'); // label photo upload
          $('#photo-preview div').html('<img src="app-assets/ktppemilihupload/' + data.ktppemilih + '" class="img-responsive">'); // show photo
        }
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
      url = "{{url('pemilih/ajax_add')}}";
    } else {
      url = "{{url('pemilih/ajax_update')}}";
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
          $('#modal-pemilih').modal('hide');
          //reload_table();
          location.reload();
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

  function delete_pemilih(idpemilih) {
    if (confirm('Are you sure delete this data?')) {
      // ajax delete data to database
      $.ajax({
        url: "{{url('pemilih/ajax_delete')}}/" + idpemilih,
        type: "GET",
        dataType: "JSON",
        success: function(data) {
          //if success reload ajax table
          $('#modal-pemilih').modal('hide');
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

<script type='text/javascript'>
  var site = "{{url('/pemilih/search')}}";
  $(function() {
    $('.autocomplete').autocomplete({
      serviceUrl: site,
      onSelect: function(suggestion) {
        $('#namapemilih').val('' + suggestion.namadpt);
        //   $('#iddpt').val(''+suggestion.iddpt);
        //  $('#provinsipemilih').val(''+suggestion.provinsipemilih);
        $('#kabupatenpemilih').val('' + suggestion.kabupatenpemilih);
        $('#kecamatanpemilih').val('' + suggestion.kecamatanpemilih);
        $('#kelurahanpemilih').val('' + suggestion.kelurahanpemilih);
        $('#tpspemilih').val('' + suggestion.tpspemilih);
        $('#iddptpemilih').val('' + suggestion.iddptpemilih);
      }
    });
  });
</script>


<div class="modal fade" id="modal-pemilih">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Data Daerah</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <div class="alert alert-danger" style="display:none"></div>
        <form action="#" id="form" name="form" class="form-horizontal" enctype="multipart/form-data" novalidate="novalidate">
          <input type="hidden" name="idpemilih" id="idpemilih" value="">
          <input type="hidden" name="iddptpemilih" id="iddptpemilih" value="">

          <?php
          $listcalon = DB::table('profil')->get();
          $ascalon = array();
          $optioncalon = array();
          $optioncalon[''] = 'Pilih Calon Yang ingin anda pilih';
          foreach ($listcalon as $calon) {
            $optioncalon[$calon->idcaleg] = $calon->namacaleg;
          }
          ?>
          <div class="col-sm-12">
            <div class="form-group">
              <label for="nikpemilih" class="col-sm-4 text-left">Electoral</label>
              <div class="col-sm-12">
                <input type="search" class="form-control autocomplete electoral" name="nikpemilih" id="nikpemilih" value="">
              </div>
            </div>
          </div>

          <div class="col-sm-12">
            <div class="form-group">
              <label for="namapemilih" class="col-sm-4 text-left">Nama</label>
              <div class="col-sm-12">
                <input type="text" name="namapemilih" id="namapemilih" value="" class="form-control autocomplete" >
              </div>
            </div>
          </div>

          <div class="col-sm-12">
            <div class="form-group">
              <label for="kabupatenpemilih" class="col-sm-4 text-left">District</label>
              <div class="col-sm-12">
                <input type="text" name="kabupatenpemilih" id="kabupatenpemilih" value="" class="form-control autocomplete">
              </div>
            </div>
          </div>

          <div class="col-sm-12">
            <div class="form-group">
              <label for="kecamatanpemilih" class="col-sm-4 text-left">Sub District</label>
              <div class="col-sm-12">
                <input type="text" name="kecamatanpemilih" id="kecamatanpemilih" value="" class="form-control autocomplete">
              </div>
            </div>
          </div>

          <div class="col-sm-12">
            <div class="form-group">
              <label for="kelurahanpemilih" class="col-sm-4 text-left">Suco</label>
              <div class="col-sm-12">
                <input type="text" name="kelurahanpemilih" id="kelurahanpemilih" value="" class="form-control autocomplete">
              </div>
            </div>
          </div>

          <div class="col-sm-12">
            <div class="form-group">
              <label for="tpspemilih" class="col-sm-4 text-left">Aldeia</label>
              <div class="col-sm-12">
                <input type="text" name="tpspemilih" id="tpspemilih" value="" class="form-control autocomplete">
              </div>
            </div>
          </div>

          <div class="col-sm-12">
            <CENTER><label for="inputEmail3" class="col-sm-12"><i>DATA PEMILIH</i></label></CENTER>
          </div>

          <?php
          $listprofil = DB::table('profil')->get();
          ?>
          <div class="col-sm-12">
            <div class="form-group">
              <label for="calonyangdipilih" class="col-sm-4 text-left">Calon Yang Dipilih</label>
              <div class="col-sm-12">
                <?php //echo form_dropdown('calonyangdipilih', $optioncalon, $ascalon, 'id="calonyangdipilih"  required="" class="form-control" title="Pilih Calon Harus Diisi"'); ?>
                <select class="form-control" name="kabupatentps" id="kabupatentps">
                    <option>Pilih Calon yang Ingin Anda Pilih</option>
                    <?php foreach ($listprofil as $calon) { ?>
                    <option value="{{ $calon->idcaleg }}" >
                    {{ $calon->namacaleg }}
                    </option>
                    <?php } ?>
                </select>
              </div>
            </div>
          </div>

          <div class="col-sm-12">
            <div class="form-group">
              <label for="emailpemilih" class="col-sm-4 text-left">Email</label>
              <div class="col-sm-12">
                <input type="text" class="form-control" id="emailpemilih" placeholder="Email Pemilih " name="emailpemilih" required="">
              </div>
            </div>
          </div>

          <div class="col-sm-12">
            <div class="form-group">
              <label for="tlppemilih" class="col-sm-4 text-left">Nomor Telepon</label>
              <div class="col-sm-12">
                <input type="text" class="form-control" id="tlppemilih" placeholder="Telepon Pemilih " name="tlppemilih" required="">
              </div>
            </div>
          </div>

          <div class="col-sm-12">
            <div class="form-group">
              <label for="fbpemilih" class="col-sm-4 text-left">Facebook</label>
              <div class="col-sm-12">
                <input type="text" class="form-control" id="fbpemilih" placeholder="Facebook Pemilih " name="fbpemilih" required="">
              </div>
            </div>
          </div>

          <div class="col-sm-12">
            <div class="form-group">
              <label for="igpemilih" class="col-sm-4 text-left">Instagram</label>
              <div class="col-sm-12">
                <input type="text" class="form-control" id="igpemilih" placeholder="Instagram Pemilih " name="igpemilih" required="">
              </div>
            </div>
          </div>

          <div class="col-sm-12">
            <div class="form-group">
              <label for="ktpaja" class="col-sm-4 text-left" id="label-photo">Poto Calon</label>
              <div class="col-sm-12">
                <input type="file" class="form-control" id="ktpaja" name="ktpaja" required="" onchange="loadFile(event)">
                <span class="help-block"></span>
              </div>
            </div>
          </div>

          <div class="col-sm-12">
            <div class="form-group" id="photo-preview">
              <label class="control-label col-md-3">Photo</label>
              <div class="col-md-9">
                (No photo)
                <span class="help-block"></span>
              </div>
            </div>
          </div>

          <div class="col-sm-12">
            <img id="output" class="profile-user-img img-responsive ">
          </div>

          <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
              <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
<script>
    function kecamatan_edit(camat) {
        var id = camat;
        var link = '<?php url() ?>' + 'tps/get_kecamatan_edit/' + id;
        $.ajax({
            data: id,
            url: link
        }).done(function(data) {
            $('#kecamatantps').html(data);
        });
    }

    function kelurahan_edit(camat) {
        var id = camat;
        var link = '<?php url() ?>' + 'tps/get_kelurahan_edit/' + id;
        $.ajax({
            data: id,
            url: link
        }).done(function(data) {
            $('#kelurahantps').html(data);
        });
    }

    function tps_edit(camat) {
        var id = camat;
        var link = '<?php url() ?>' + 'tps/get_tps_edit/' + id;
        $.ajax({
            data: id,
            url: link
        }).done(function(data) {
            $('#tpstps').html(data);
        });
    }

    function kelurahantps(lurah) {
        var id = lurah;
        var link = '<?php url() ?>' + 'tps/get_kelurahan/' + id;
        $.ajax({
            data: id,
            url: link
        }).done(function(data) {
            $('#kelurahantps').html(data);
        });
    }

    function tpstps(tps) {
        var id = tps;
        var link = '<?php url() ?>' + 'dpt/get_tps/' + id;
        $.ajax({
            data: id,
            url: link
        }).done(function(data) {
            $('#tpstps').html(data);
        });
    }

    //$('select#kabupatendpt').change(function() {
    $('#kabupatentps').on('change',function(e){
        console.log('testytttt ');
        var id = $(this).val();
        var link = '{{url("tps/get_kecamatan")}}/'  + id;
        console.log(link);
        $.ajax({
            data: id,
            url: link
        }).done(function(data) {
            $('#kecamatantps').html(data);
            var value = $(data).val();
            kelurahantps(value);
            tpstps(value);
        });
    });

    $('#kecamatantps').change(function() {
        var id = $(this).val();
        var link = '{{url("tps/get_kelurahan")}}/' + id;
        $.ajax({
            data: id,
            url: link
        }).done(function(data) {
            $('#kelurahantps').html(data);
            var value = $(data).val();
            tpstps(value);
        });
    });

    $('#kelurahantps').change(function() {
        var id = $(this).val();
        tpstps(id)
    });
</script>

@endsection
