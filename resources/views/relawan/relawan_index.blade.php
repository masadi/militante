@extends('layoututama')
@section('content')
<?php
$level = Session::get('level');
?><style type="text/css">
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
                        <div class="col-md-2">
                            <button type="button" class="btn btn-block btn-primary" data-toggle="modal" onclick="add_relawan()"> <i class="fa fa-fw fa-plus-circle"></i> Tambah Relawan </button>
                        </div>
                        <?php // $this->session->flashdata('pesan') ?>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="table" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>HP</th>
                                        <th style="width:125px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Nama</th>
                                        <th>HP</th>
                                        <th style="width:125px;">Action</th>
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
    var base_url = '';
    $(document).ready(function() {
        $("#form").validate({
            rules: {
                idpemilihrelawan: {
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
                "url": "<?php echo url('relawan/ajax_list') ?>",
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

    function add_relawan() {
        save_method = 'add';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $("#nikrelawan").removeAttr("disabled");
        $('.help-block').empty(); // clear error string
        $('#modal-relawan').modal('show'); // show bootstrap modal
        $('.modal-title').text('Tambah Relawan'); // Set Title to Bootstrap modal title
    }

    function edit_relawan(idrelawan) {
        save_method = 'update';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo url('relawan/ajax_edit/') ?>/" + idrelawan,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('[name="idrelawan"]').val(data.idrelawan);
                $('[name="idpemilihrelawan"]').val(data.idpemilihrelawan);
                $('[name="nikrelawan"]').val(data.nikdpt);
                $('[name="namarelawan"]').val(data.namadpt);
                $('[name="tlppemilih"]').val(data.tlppemilih);
                $('[name="district"]').val(data.kode_district);
                $('[name="subdistrict"]').val(data.kode_subdistrict);
                $('[name="suco"]').val(data.kode_suco);
                $('[name="aldeia"]').val(data.kode_aldeia);
                $('#modal-relawan').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Relawan'); // Set title to Bootstrap modal title
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
            url = "<?php echo url('relawan/ajax_add') ?>";
        } else {
            url = "<?php echo url('relawan/ajax_update') ?>";
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
                    $('#modal-relawan').modal('hide');
                    reload_table();
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

    function delete_relawan(idrelawan) {
        if (confirm('Are you sure delete this data?')) {
            // ajax delete data to database
            $.ajax({
                url: "<?php echo url('relawan/ajax_delete') ?>/" + idrelawan,
                type: "POST",
                dataType: "JSON",
                success: function(data) {
                    //if success reload ajax table
                    swal("Berhasil", "Data Relawan berhasil dihapus", "error");
                    $('#modal-koordinator').modal('hide');
                    reload_table();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error deleting data');
                }
            });
        }
    }
</script>

<?php /*
<script type='text/javascript'>
    var site = "<?php echo url(); ?>";
    $(function() {
        $('.autocomplete').autocomplete({
            serviceUrl: site + '/relawan/search',
            onSelect: function(suggestion) {
                $('#namarelawan').val('' + suggestion.namadpt);
                $('#tlppemilih').val('' + suggestion.tlppemilih);
                $('#idpemilihrelawan').val('' + suggestion.idpemilih);
                $('#district').val('' + suggestion.kode_district);
                $('#subdistrict').val('' + suggestion.kode_subdistrict);
                $('#suco').val('' + suggestion.kode_suco);
                $('#aldeia').val('' + suggestion.kode_aldeia);
            }
        });
    });
</script> */ ?>

<div class="modal fade" id="modal-relawan">
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
                    <input type="hidden" name="idrelawan" id="idrelawan" value="">
                    <input type="hidden" name="idpemilihrelawan" id="idpemilihrelawan" value="">

                    <div class="form-group">
                        <label for="nikrelawan" class="col-sm-4 text-left">Electoral</label>
                        <div class="col-sm-12">
                            <input type="search" class="form-control autocomplete " name="nikrelawan" id="nikrelawan" value="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="namarelawan" class="col-sm-4 text-left">Nama</label>
                        <div class="col-sm-12">
                            <input type="text" name="namarelawan" id="namarelawan" value="" class="form-control autocomplete" readonly="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tlppemilih" class="col-sm-4 text-left">HP</label>
                        <div class="col-sm-12">
                            <input type="text" name="tlppemilih" id="tlppemilih" value="" class="form-control autocomplete" readonly="">
                        </div>
                    </div>
                    <?php
                    $district = array();
                    $district[''] = 'Pilih District';
                    $subdistrict = array();
                    $subdistrict[''] = 'Pilih Sub District';
                    $suco = array();
                    $suco[''] = 'Pilih Suco';
                    $aldeia = array();
                    $aldeia[''] = 'Pilih Aldeia';

                    $listkabupaten = DB::table('kabupaten')->get();
                    foreach ($listkabupaten as $d) {
                        $district[$d->kode_district] = $d->kode_district . ' | ' . $d->nama_district;
                    }
                    $listkecamatan = DB::table('kecamatan')->get();
                    foreach ($listkecamatan as $sd) {
                        $subdistrict[$sd->kode_subdistrict] = $sd->kode_subdistrict . ' | ' . $sd->nama_subdistrict;
                    }
                    $listkelurahan = DB::table('kelurahan')->get();
                    foreach ($listkelurahan as $sc) {
                        $suco[$sc->kode_suco] = $sc->kode_suco . ' | ' . $sc->nama_suco;
                    }
                    $listtps = DB::table('tps')->get();
                    foreach ($listtps as $ad) {
                        $aldeia[$ad->kode_aldeia] = $ad->kode_aldeia . ' | ' . $ad->nama_aldeia;
                    }
                    ?>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="district" class="col-sm-4 text-left">District</label>
                                <div class="col-sm-12">
                                    <?php //echo form_dropdown('district', $district, '', 'id="district" value="" class="form-control" disabled') ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="subdistrict" class="col-sm-4 text-left">Sub District</label>
                                <div class="col-sm-12">
                                    <?php //echo form_dropdown('subdistrict', $subdistrict, '', 'id="subdistrict" value="" class="form-control" disabled') ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="suco" class="col-sm-4 text-left">Suco</label>
                                <div class="col-sm-12">
                                    <?php //echo form_dropdown('suco', $suco, '', 'id="suco" value="" class="form-control" disabled') ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="aldeia" class="col-sm-4 text-left">Aldeia</label>
                                <div class="col-sm-12">
                                    <?php //echo form_dropdown('aldeia', $aldeia, '', 'id="aldeia" value="" class="form-control" disabled') ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
@endsection
