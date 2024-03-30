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
                    <div class="row mx-2 mt-2">
                        <div class="col-12">
                            <button type="button" class="btn btn-block btn-primary" data-toggle="modal" onclick="add_calon()"> <i class="fa fa-fw fa-plus-circle"></i> Tambah Calon </button>

                            <?php //$this->session->flashdata('pesan') ?>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="table" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Calon</th>
                                        <th>Wakil Calon</th>
                                        <th>HP Calon</th>
                                        <th>HP wakil Calon</th>
                                        <th>Visi</th>
                                        <th>Misi</th>
                                        <th>Foto</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                $list = DB::table('profil')->orderBy('idcaleg','ASC')->get();
                                $no = 1;
                                foreach ($list as $calon) {
                                    echo '<tr><td>'.$no.'</td>';
                                    echo '<td>'.$calon->namacaleg.'</td>';
                                    echo '<td>'.$calon->wakilcaleg.'</td>';
                                    echo '<td>'.$calon->hpcalon.'</td>';
                                    echo '<td>'.$calon->hpwakilcalon.'</td>';
                                    echo '<td>'.$calon->visi.'</td>';

                                    echo '<td>'."<ol>".$calon->misi1."</ol>".
                                    "<ol>".$calon->misi2."</ol>".
                                    "<ol>".$calon->misi3."</ol>".
                                    "<ol>".$calon->misi4."</ol>".'</td>';

                                    if($calon->potocaleg)
                                        echo '<td><a href="app-assets/potocalegroot/'.$calon->potocaleg.'" target="_blank"><img src="app-assets/potocalegroot/'.$calon->potocaleg.'" width="60%" class="img-fluid" /></a></td>';
                                    else
                                        echo '<td>(No photo)</td>';

                                    //add html for action
                                    echo '<td><a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_calon('."'".$calon->idcaleg."'".')"><i class="fa fa-edit"></i> Edit</a>
                                    <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_calon('."'".$calon->idcaleg."'".')"><i class="fa fa-trash"></i> Hapus</a>
                                    </td>';
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
    var save_method; //for save method string
    var table;
    var base_url = '';

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
                "url": "<?php echo url('calon/ajax_list') ?>",
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



    function add_calon() {
        save_method = 'add';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $('#modal-calon').modal('show'); // show bootstrap modal
        $('.modal-title').text('Tambah Calon'); // Set Title to Bootstrap modal title

        $('#photo-preview').hide(); // hide photo preview modal

        $('#label-photo').text('Upload Photo'); // label photo upload
    }

    function edit_calon(idcaleg) {
        save_method = 'update';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // cleasr error string


        //Ajax Load data from ajax
        $.ajax({
            url: "{{url('calon/ajax_edit')}}/" + idcaleg,
            type: "GET",
            dataType: "JSON",
            success: function(data) {

                $('[name="idcaleg"]').val(data.idcaleg);
                $('[name="namacaleg"]').val(data.namacaleg);
                $('[name="wakilcaleg"]').val(data.wakilcaleg);
                $('[name="biodatacaleg"]').val(data.biodatacaleg);
                $('[name="defaultcalon"]').val(data.defaultcalon);
                $('[name="biodatawakilcaleg"]').val(data.biodatawakilcaleg);
                $('[name="visi"]').val(data.visi);
                $('[name="misi1"]').val(data.misi1);
                $('[name="misi2"]').val(data.misi2);
                $('[name="misi3"]').val(data.misi3);
                $('[name="misi4"]').val(data.misi4);


                $('[name="hpcalon"]').val(data.hpcalon);
                $('[name="hpwakilcalon"]').val(data.hpwakilcalon);
                $('#modal-calon').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Calon'); // Set title to Bootstrap modal title

                $('#photo-preview').show(); // show photo preview modal

                if (data.potocaleg) {
                    $('#label-photo').text('Change Photo'); // label photo upload
                    $('#photo-preview div').html('<img src="' + base_url + 'assets/potocalegroot/' + data.potocaleg + '" class="img-responsive">'); // show photo
                    $('#photo-preview div').append('<input type="checkbox" name="remove_photo" value="' + data.potocaleg + '"/> Remove photo when saving'); // remove photo

                } else {
                    $('#label-photo').text('Upload Photo'); // label photo upload
                    $('#photo-preview div').text('(No photo)');
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
        url = "{{url('calon/ajax_add')}}";
        } else {
            url = "{{url('calon/ajax_update')}}";
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
                    $('#modal-calon').modal('hide');
                    //reload_table();
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

    function delete_calon(idcaleg) {
        if (confirm('Are you sure delete this data?')) {
            // ajax delete data to database
            $.ajax({
                url: "{{url('calon/ajax_delete')}}/" + idcaleg,
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    //if success reload ajax table
                    $('#modal-calon').modal('hide');
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
<div class="modal fade" id="modal-calon">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Kecamatan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="#" id="form" name="form" class="form-horizontal" enctype="multipart/form-data" novalidate="novalidate">
                    <input type="hidden" name="idcaleg" id="idcaleg" value="">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">Nama Calon</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="namacaleg" placeholder="Nama Caleg" name="namacaleg" required="">
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">Nama Wakil Calon</label>

                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="wakilcaleg" placeholder="Nama Wakil Caleg" name="wakilcaleg" required="">
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">Visi</label>
                            <div class="col-sm-12">
                                <textarea class="form-control" placeholder="Visi" id="visi" name="visi" required=""></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">Misi</label>

                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="misi1" placeholder="Misi" name="misi1" required="">
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label"></label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="misi2" placeholder="Misi" name="misi2" required="">
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label"></label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="misi3" placeholder="Misi" name="misi3" required="">
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label"></label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="misi4" placeholder="Misi" name="misi4" required="">
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>



                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">Biodata Calon</label>
                            <div class="col-sm-12">
                                <textarea id="biodatacaleg" name="biodatacaleg" placeholder="Biodata SIngkat" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">Biodata Wakil Calon</label>
                            <div class="col-sm-12">
                                <textarea id="biodatawakilcaleg" name="biodatawakilcaleg" placeholder="Biodata SIngkat" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">HP Calon</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="hpcalon" placeholder="Nomor HP Calon" name="hpcalon" required="">
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">HP Wakil Calon</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="hpwakilcalon" placeholder="Nomor HP Wakil Calon" name="hpwakilcalon" required="">
                                <span class="help-block"></span>
                                <input type="hidden" class="form-control" id="_token"  name="_token" value="{{csrf_token()}}">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">Default</label>
                            <div class="col-sm-12">
                                <select name="defaultcalon" class="form-control">
                                    <option value="#">Setting Default ?</option>
                                    <option value="1">Ya</option>
                                    <option value="0">Tidak</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group" id="photo-preview">
                            <label class="control-label col-md-4">Photo</label>
                            <div class="col-md-12">
                                (No photo)
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label" id="label-photo">Poto Calon</label>
                            <div class="col-sm-12">
                                <input type="file" class="form-control" id="potocaleg" name="potocaleg" required="">
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-sm-12">
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

@endsection
