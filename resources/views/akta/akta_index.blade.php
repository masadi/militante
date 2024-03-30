@extends('layoututama')
@section('content')
<?php
$level = Session::get('level');
?>
<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="row">
                        <div class="col-2 my-2 ml-4">
                            <button id="add" type="button" class="btn btn-block btn-primary" data-toggle="modal" onclick="add_dpt()"> <i class="fa fa-fw fa-plus-circle"></i> Tambah DPT </button>
                        </div>
                        <?php /*<div class="col-md-2"><a href="url() dpt/cetak" class="btn btn-block btn-danger"> <i class="fa fa-print"></i> Export DPT </a></div>*/ ?>
                        <?php if ($level == 'admin') { ?>
                            <div class="col-2 m-2"><a href="dpt/import" class="btn btn-block btn-warning"> <i class="fa fa-print"></i> Import DPT </a></div><?php } ?>
                        <div class="col-12">
                            {{csrf_field()}}
                            @if(session('pesaninfo'))
                            <div class="alert alert-success text-center" role="alert">
                              {{ session('pesaninfo') }}
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="table" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th style="width:125px;">Action</th>
                                        <th>Status</th>
                                        <th>Ditambahkan Oleh</th>
                                        <th>District</th>
                                        <th>Sub District</th>
                                        <th>Suco</th>
                                        <th>TPS</th>
                                        <th>NIK</th>
                                        <th>Nama</th>
                                        <th>Tempat Lahir</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Status Perkawinan</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Alamat</th>
                                        <!-- <th>Disabilitas</th> -->
                                        <th>Ket</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                $list = DB::table('dpt')
                                    ->leftJoin('kabupaten','kabupaten.kode_district','=','dpt.kabupatendpt')
                                    ->leftJoin('kecamatan','kecamatan.kode_subdistrict','=','dpt.kecamatandpt')
                                    ->leftJoin('kelurahan','kelurahan.kode_suco','=','dpt.kelurahandpt')
                                    ->leftJoin('tps','tps.kode_aldeia','=','dpt.tpsdpt')
                                    ->orderBy('dpt.iddpt','DESC')
                                    ->get();

                                $no = 1;
                                foreach ($list as $dpt) {
                                    echo '<tr><td>'.$no.'</td>';
                                    echo '<td>'.'<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_dpt(' . "'" . $dpt->iddpt . "'" . ')"><i class="fa fa-edit"></i> Edit</a> <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_dpt(' . "'" . $dpt->iddpt . "'" . ')"><i class="fa fa-trash"></i> Delete</a>'.'</td>';
                                    
                                    if ($dpt->statusdpt == '1') {
                                        echo '<td><span class="btn btn-sm btn-success"><i class="fa fa-check"></i> Disetujui</span></td> ';
                                    } else {
                                        echo '<td><span class="btn btn-sm btn-warning"><i class="fa fa-trash"></i> Belum Disetujui</span> </td>  ';
                                    }
                                    if ($dpt->ditambahkanoleh >= '1') {
                                        echo '<td><span class="btn btn-sm btn-success"><i class="fa fa-user"></i> ' . $dpt->ditambahkanoleh . '</span></td> ';
                                    } else {
                                        echo '<td><span class="btn btn-sm btn-warning"><i class="fa fa-trash"></i> mendaftar dari aplikasi</span> </td> ';
                                    }
                                    echo '<td>'.$dpt->nama_district.'</td>';
                                    echo '<td>'.$dpt->nama_subdistrict.'</td>';
                                    echo '<td>'.$dpt->nama_suco.'</td>';
                                    echo '<td>'.$dpt->nama_aldeia.'</td>';
                                    echo '<td>'.$dpt->nikdpt.'</td>';
                                    echo '<td>'.$dpt->namadpt.'</td>';
                                    echo '<td>'.$dpt->tempatlahirdpt.'</td>';
                                    echo '<td>'.$dpt->ttldpt.'</td>';
                                    echo '<td>'.$dpt->statusperkawinandpt.'</td>';
                                    echo '<td>'.$dpt->jkdpt.'</td>';
                                    echo '<td>'.$dpt->alamatdpt.'</td>';
                                    // $row[] = $dpt->disabilitasdpt;
                                    echo '<td>'.$dpt->ketdpt.'</td>';echo '</tr>';

                                    $no++;
                                }

                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            $jumlahhasil = DB::table('dpt')
                    ->select('ditambahkanoleh', DB::raw('COUNT(iddpt) as jumlahhasil'))
                    ->groupby('ditambahkanoleh')
                    ->get();
            ?>
            <?php foreach ($jumlahhasil as $hasil) { ?>
                <div class="col-md-4">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-info">
                            <i class="far fa-user"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4><?= $hasil->ditambahkanoleh ?> Sudah Menambahkan</h4>
                            </div>
                            <div class="card-body">
                                <h6> <?= $hasil->jumlahhasil ?> DPT</h6>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>
</div>

<script type="text/javascript">
    var save_method; //for save method string
    var table;
    var base_url = '';
    $(document).ready(function() {

        $("#table").DataTable()
        $("#form").validate({
            rules: {
                kabupatendpt: {
                    required: true
                },
                kecamatandpt: {
                    required: true
                },
                kelurahandpt: {
                    required: true
                },
                tpsdpt: {
                    required: true
                },
                nikdpt: {
                    required: true
                },
                namadpt: {
                    required: true
                },
                tempatlahirdpt: {
                    required: true
                },
                ttldpt: {
                    required: true
                },
                statusperkawinandpt: {
                    required: true
                },
                jkdpt: {
                    required: true
                },
                alamatdpt: {
                    required: true
                },
                disabilitasdpt: {
                    required: true
                },
                ketdpt: {
                    required: true
                }
            }
        });
    });

    $(document).ready(function() {
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

    function add_dpt() {
        save_method = 'add';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $('#modal-dpt').modal('show'); // show bootstrap modal
        $('.modal-title').text('Tambah DPT'); // Set Title to Bootstrap modal title
    }

    function edit_dpt(iddpt) {
        console.log(iddpt);
        save_method = 'update';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string

        //Ajax Load data from ajax
        $.ajax({
            url: "{{url('dpt/ajax_edit/')}}/" + iddpt,
            type: "GET",
            dataType: "JSON",
            success: function(data) {

                $('[name="iddpt"]').val(data.iddpt);
                $('[name="statusdpt"]').val(data.statusdpt);
                $('[name="kabupatendpt"]').val(data.kabupatendpt);
                $('[name="kecamatandpt"]').val(data.kecamatandpt);
                $('[name="kelurahandpt"]').val(data.kelurahandpt);
                $('[name="tpsdpt"]').val(data.tpsdpt);
                kecamatan_edit(data.kecamatandpt)
                kelurahan_edit(data.kelurahandpt)
                tps_edit(data.tpsdpt)

                $('[name="nikdpt"]').val(data.nikdpt);
                $('[name="namadpt"]').val(data.namadpt);
                $('[name="tempatlahirdpt"]').val(data.tempatlahirdpt);
                $('[name="ttldpt"]').val(data.ttldpt);
                $('[name="statusperkawinandpt"]').val(data.statusperkawinandpt);
                $('[name="jkdpt"]').val(data.jkdpt);
                $('[name="alamatdpt"]').val(data.alamatdpt);
                $('[name="disabilitasdpt"]').val(data.disabilitasdpt);
                $('[name="ketdpt"]').val(data.ketdpt);
                $('#modal-dpt').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit DPT'); // Set title to Bootstrap modal title
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
            url = "{{url('dpt/ajax_add')}}";
        } else {
            url = "{{url('dpt/ajax_update')}}";
        }

        // ajax adding data to database
        var formData = new FormData($('#form')[0]);
        console.log(formData);
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
                    $('#modal-dpt').modal('hide');
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

    function delete_dpt(iddpt) {
        if (confirm('Are you sure delete this data?')) {
            // ajax delete data to database
            $.ajax({
                url: "{{url('dpt/ajax_delete')}}/" + iddpt,
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    //if success reload ajax table
                    $('#modal-dpt').modal('hide');
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


<div class="modal fade" id="modal-dpt">
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
                    <input type="hidden" name="iddpt" id="iddpt" value="">
                    <?php
                    $as = array();
                    $option = array();
                    $option[''] = 'Pilih District Pemilih';

                    $listkabupaten = DB::table('kabupaten')->get();

                    foreach ($listkabupaten as $list) {
                        $option[$list->kode_district] = $list->kode_district . ' | ' . $list->nama_district;
                        $dt_option = $list->kode_district . ' | ' . $list->nama_district;
                    }
                    $ascalon = array();
                    $optioncalon = array();
                    $optioncalon[''] = 'Pilih Calon Yang ingin anda pilih';
                    $listcalon = DB::table('profil')
                    ->get();
                    foreach ($listcalon as $calon) {
                        $optioncalon[$calon->idcaleg] = $calon->namacaleg;
                    }
                    ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="kabupatendpt" class="col-sm-4 text-left">District</label>
                                <div class="col-sm-12">
                                    <?php //echo form_dropdown('kabupatendpt', $option, $as, 'id="kabupatendpt"  required="" class="form-control" title="Field Area Harus Diisi"'); ?>

                                    <select class="form-control" name="kabupatendpt" id="kabupatendpt">
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
                                <label for="kecamatandpt" class="col-sm-4 text-left">Pilih Sub District</label>
                                <div class="col-sm-12">
                                    <select name="kecamatandpt" id="kecamatandpt" value="" class="form-control kecamatandpt">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="kelurahandpt" class="col-sm-4 text-left">Pilih Suco</label>
                                <div class="col-sm-12">
                                    <select name="kelurahandpt" id="kelurahandpt" value="" class="form-control">
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tpsdpt" class="col-sm-4 text-left">Pilih Aldeia</label>
                                <div class="col-sm-12">
                                    <select name="tpsdpt" id="tpsdpt" value="" class="form-control">
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="nikdpt" class="col-sm-2 text-left">electoral</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="nikdpt" placeholder="Electoral" name="nikdpt" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="namadpt" class="col-sm-2 text-left">Nama</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="namadpt" placeholder="Nama" name="namadpt" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="tempatlahirdpt" class="col-sm-2 text-left">Tempat Lahir</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="tempatlahirdpt" placeholder="Tempat Lahir" name="tempatlahirdpt" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="ttldpt" class="col-sm-2 text-left">Tanggal Lahir</label>
                        <div class="col-sm-12">
                            <input type="date" class="form-control" id="ttldpt" placeholder="Tanggal Lahir" name="ttldpt" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="statusperkawinandpt" class="col-sm-4 text-left">Status Perkawinan</label>
                        <div class="col-sm-12">
                            <select name="statusperkawinandpt" id="statusperkawinandpt" class="form-control">
                                <option value="#">Pilih Status perkawinan</option>
                                <option value="BK">Belum Kawin</option>
                                <option value="K">Kawin</option>
                                <option value="CH">Cerai Hidup</option>
                                <option value="CM">Cerai Mati</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="jkdpt" class="col-sm-2 text-left">Jenis Kelamin</label>
                        <div class="col-sm-12">
                            <select name="jkdpt" id="jkdpt" class="form-control">
                                <option value="#">Pilih Jenis Kelamin</option>
                                <option value="L">Laki Laki</option>
                                <option value="W">Wanita</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="alamatdpt" class="col-sm-2 text-left">Alamat</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="alamatdpt" placeholder="Alamat " name="alamatdpt" required="">
                            <input type="hidden" class="form-control" id="_token"  name="_token" value="{{csrf_token()}}">
                        </div>
                    </div>

                    <!-- <div class="form-group">
            <label for="disabilitasdpt" class="col-sm-2 text-left">Disabilitas</label>
            <div class="col-sm-10">
              <select name="disabilitasdpt" id="disabilitasdpt" class="form-control">
                <option value="#">Disabilitas</option>
                <option value="T">Tidak</option>
                <option value="Y">Ya</option>
              </select>
            </div>
          </div> -->
                    <?php if ($level== 'admin') { ?>
                        <div class="form-group">
                            <label for="statusdpt" class="col-sm-2 text-left">Status DPT</label>
                            <div class="col-sm-12">
                                <select name="statusdpt" id="statusdpt" class="form-control">
                                    <option value="#">Pilih Status DPT</option>
                                    <option value="1">Setuju</option>
                                    <option value="0">Belum Setuju</option>
                                </select>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="form-group">
                        <label for="ketdpt" class="col-sm-2 text-left">keterangan</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="ketdpt" placeholder="keterangan " name="ketdpt" required="">
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
        var link = '<?php url() ?>' + 'dpt/get_kecamatan_edit/' + id;
        $.ajax({
            data: id,
            url: link
        }).done(function(data) {
            $('#kecamatandpt').html(data);
        });
    }

    function kelurahan_edit(camat) {
        var id = camat;
        var link = '<?php url() ?>' + 'dpt/get_kelurahan_edit/' + id;
        $.ajax({
            data: id,
            url: link
        }).done(function(data) {
            $('#kelurahandpt').html(data);
        });
    }

    function tps_edit(camat) {
        var id = camat;
        var link = '<?php url() ?>' + 'dpt/get_tps_edit/' + id;
        $.ajax({
            data: id,
            url: link
        }).done(function(data) {
            $('#tpsdpt').html(data);
        });
    }

    function kelurahandpt(lurah) {
        var id = lurah;
        var link = '<?php url() ?>' + 'dpt/get_kelurahan/' + id;
        $.ajax({
            data: id,
            url: link
        }).done(function(data) {
            $('#kelurahandpt').html(data);
        });
    }

    function tpsdpt(tps) {
        var id = tps;
        var link = '<?php url() ?>' + 'dpt/get_tps/' + id;
        $.ajax({
            data: id,
            url: link
        }).done(function(data) {
            $('#tpsdpt').html(data);
        });
    }

    //$('select#kabupatendpt').change(function() {
    $('#kabupatendpt').on('change',function(e){
        console.log('testytttt ');
        var id = $(this).val();
        var link = '{{url("dpt/get_kecamatan")}}/'  + id;
        console.log(link);
        $.ajax({
            data: id,
            url: link
        }).done(function(data) {
            $('#kecamatandpt').html(data);
            var value = $(data).val();
            kelurahandpt(value);
            tpsdpt(value);
        });
    });

    $('#kecamatandpt').change(function() {
        var id = $(this).val();
        var link = '{{url("dpt/get_kelurahan")}}/' + id;
        $.ajax({
            data: id,
            url: link
        }).done(function(data) {
            $('#kelurahandpt').html(data);
            var value = $(data).val();
            tpsdpt(value);
        });
    });

    $('#kelurahandpt').change(function() {
        var id = $(this).val();
        tpsdpt(id)
    });
</script>

@endsection
