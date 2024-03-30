@extends('layoututama')
@section('content')
<?php
$level = Session::get('level');
?>
<div class="main-content">
  <section class="section">
    <div class="section-header">
        <h1>
            <small>Data Kegiatan Calon</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Kegiatan Calon</li>
        </ol>
    </div>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <div class="col-md-6">
                            <?php //$this->session->flashdata('pesan')?>
                            <button type="button" class="btn btn-block btn-primary" data-toggle="modal" onclick="add_kegiatan()"> <i class="fa fa-fw fa-plus-circle"></i> Tambah Kegiatan </button>
                        </div>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <div class="box-body">
                        <table id="table" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nama Kegiatan</th>
                                <th>Tanggal Kegiatan </th>
                                <th>Deskripsi Kegiatan</th>
                                <th style="width:125px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Nama Kegiatan</th>
                                <th>Tanggal Kegiatan </th>
                                <th>Deskripsi Kegiatan</th>
                                <th style="width:125px;">Action</th>
                            </tr>
                        </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script type="text/javascript">

var save_method; //for save method string
var table;
 $(document).ready(function(){
          $("#form").validate({
            rules:{

              tanggalkegiatan:{required:true},
              namakegiatan:{required:true},
              deksripsikegiatan:{required:true}
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
         columnDefs: [ {
            className: 'control',
            orderable: false,
            targets:   0
        } ],

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo url('kegiatan/ajax_list')?>",
            "type": "GET"
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        {
            "targets": [ -1 ], //last column
            "orderable": false, //set not orderable
        },
        ],

    });



    //set input/textarea/select event when change value, remove class error and remove text help block
    $("input").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
    $("textarea").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
    $("select").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });

});



function add_kegiatan()
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal-kegiatan').modal('show'); // show bootstrap modal
    $('.modal-title').text('Tambah Kegiatan'); // Set Title to Bootstrap modal title
}

function edit_kegiatan(idkegiatan)
{
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo url('kegiatan/ajax_edit/')?>/" + idkegiatan,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="idkegiatan"]').val(data.idkegiatan);
            $('[name="namakegiatan"]').val(data.namakegiatan);
            $('[name="deskripsikegiatan"]').val(data.deskripsikegiatan);
            $('[name="tanggalkegiatan"]').val(data.tanggalkegiatan);
            $('#modal-kegiatan').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Kegiatan'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax
}

function save()
{

    var form = $("#form");
    var url;
 if (!form.valid())
            {
              document.getElementById('form').focus();
            }
            else{
              $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable
    if(save_method == 'add') {
        url = "<?php echo url('kegiatan/ajax_add')?>";
    } else {
        url = "<?php echo url('kegiatan/ajax_update')?>";
    }

    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {
                $('#modal-kegiatan').modal('hide');
                reload_table();
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++)
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                }
            }
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable

        }
    });
}}

function delete_kegiatan(idkegiatan)
{
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo url('kegiatan/delete')?>/"+idkegiatan,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                $('#modal-kegiatan').modal('hide');
                reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });

    }
}

</script>

 <div class="modal fade" id="modal-kegiatan">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Data Kecamatan</h4>
              </div>
              <div class="modal-body">
               <form action="#" id="form" name="form" class="form-horizontal" enctype="multipart/form-data" novalidate="novalidate">
                  <input type="hidden" name="idkegiatan" id="idkegiatan" value="">

                  <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nama Kegiatan</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="namakegiatan" placeholder="Nama Kegiatan" name="namakegiatan" required="">
                    <span class="help-block"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Deskripsi Kegiatan</label>
                   <div class="col-sm-10">
                  <textarea class="form-control" placeholder="Deskripsi" id="deskripsikegiatan" name="deskripsikegiatan" required=""></textarea>
                  <span class="help-block"></span>
                </div>
                </div>
                 <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Tanggal Kegiatan</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="tanggalkegiatan" placeholder="Tanggal Kegiatan" name="tanggalkegiatan" required="">
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
