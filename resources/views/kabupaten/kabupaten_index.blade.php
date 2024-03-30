@extends('layoututama')
@section('content')
<?php
$level = Session::get('level');
?><div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="box box-warning">
                        <div class="row mt-3 mx-2">
                            <div class="col-md-2">
                                <?php //$this->session->flashdata('pesan') ?>
                                <button type="button" class="btn btn-block btn-primary" data-toggle="modal" onclick="add_kabupaten()"> <i class="fa fa-plus-circle"></i> Tambah Municipio </button>
                            </div>
                            <div class="col-md-3">
                                <a href="kabupaten/upload" class="btn btn-block btn-warning"> <i class="fa  fa-plus-circle"></i> Import Data Municipio </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="table" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th style="width:125px;">Action</th>
                                            <th>Kelompok Municipio</th>
                                            <th>Kode Municipio</th>
                                            <th>Nama Municipio</th>
                                            <th>Urut Municipio</th>
                                            <th>User</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $list = DB::table('kabupaten')->orderBy('urut_district','ASC')->get();
                                        $no = 1;
                                        foreach ($list as $kabupaten) {
                                            echo '<tr><td>'.$no.'</td>';
                                            echo '<td><a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_kabupaten(' . "'" . $kabupaten->idkabupaten . "'" . ')"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                                                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_kabupaten(' . "'" . $kabupaten->idkabupaten . "'" . ')"><i class="fa fa-trash"></i></a></td>';

                                            echo '<td>'.$kabupaten->kelompok_district.'</td>';
                                            echo '<td>'.$kabupaten->kode_district.'</td>';
                                            echo '<td>'.$kabupaten->nama_district.'</td>';
                                            echo '<td>'.$kabupaten->urut_district.'</td>';
                                            echo '<td>'.$kabupaten->user.'</td>';
                                            //add html for action
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
        </div>
    </section>
</div>

<script type="text/javascript">
    var save_method; //for save method string
    var table;
    $(document).ready(function() {
        $("#form").validate({
            rules: {

                kelompok_district: {
                    required: true
                },
                kode_district: {
                    required: true
                },
                nama_district: {
                    required: true
                },
                urut_district: {
                    required: true
                }
            }
        });

    });
    $(document).ready(function() {

        $("#table").DataTable();
        //datatables
        table = $('#tablexx').DataTable({

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
                "url": "<?php echo url('kabupaten/ajax_list') ?>",
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



    function add_kabupaten() {
        save_method = 'add';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $('#modal-kabupaten').modal('show'); // show bootstrap modal
        $('.modal-title').text('Tambah Municipio'); // Set Title to Bootstrap modal title
    }

    function edit_kabupaten(idkabupaten) {
        save_method = 'update';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo url('kabupaten/ajax_edit/') ?>/" + idkabupaten,
            type: "GET",
            dataType: "JSON",
            success: function(data) {

                $('[name="idkabupaten"]').val(data.idkabupaten);
                $('[name="kelompok_district"]').val(data.kelompok_district);
                $('[name="kode_district"]').val(data.kode_district);
                $('[name="nama_district"]').val(data.nama_district);
                $('[name="urut_district"]').val(data.urut_district);
                $('#modal-kabupaten').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Municipio'); // Set title to Bootstrap modal title

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

        var form = $("#form");
        var url;
        if (!form.valid()) {
            document.getElementById('form').focus();
        } else {
            $('#btnSave').text('saving...'); //change button text
            $('#btnSave').attr('disabled', true); //set button disable
            if (save_method == 'add') {
                url = "{{url('kabupaten/ajax_add')}}";
            } else {
                url = "{{url('kabupaten/ajax_update')}}";
            }

            // ajax adding data to database
            $.ajax({
                url: url,
                type: "POST",
                data: $('#form').serialize(),
                dataType: "JSON",
                success: function(data) {

                    if (data.status) //if success close modal and reload ajax table
                    {
                        $('#modal-kabupaten').modal('hide');
                        location.reload();
                    } else {
                        for (var i = 0; i < data.inputerror.length; i++) {
                            $('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                            $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]); //select span help-block class set text error string
                        }
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
    }

    function delete_kabupaten(idkabupaten) {
        if (confirm('Are you sure delete this data?')) {
            // ajax delete data to database
            $.ajax({
                url: "{{url('kabupaten/ajax_delete')}}/" + idkabupaten,
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    //if success reload ajax table
                    $('#modal-kabupaten').modal('hide');
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


<div class="modal fade" id="modal-kabupaten">
    <div class="modal-dialog" style="width:600px">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Municipio</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="#" id="form" name="form" class="form-horizontal" enctype="multipart/form-data" novalidate="novalidate">
                    <input type="hidden" name="idkabupaten" id="idkabupaten" value="">

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-6 control-label">Kelompok Municipio</label>

                        <div class="col-sm-12">
                            <select class="form-control" id="kelompok_district" placeholder="" name="kelompok_district" required="">
                                <option value="DALAM NEGERI">DALAM NEGERI</option>
                                <option value="LUAR NEGERI">LUAR NEGERI</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-6 control-label">Kode Municipio</label>

                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="kode_district" placeholder="" name="kode_district" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-4 control-label">Nama Municipio</label>

                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="nama_district" placeholder="" name="nama_district" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-4 control-label">Urut Municipio</label>

                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="urut_district" placeholder="" name="urut_district" required="">
                            <input type="hidden" class="form-control" id="_token"  name="_token" value="{{csrf_token()}}">
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
