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
          <form>
          <div class="card-body">
            <div class="row">
              <div class="col-lg-3 pull-right">
                <button type="button" class="btn btn-block btn-primary" data-toggle="modal" onclick="tambah_even()"> <i class="fa fa-fw fa-plus-circle"></i> Tambah {{$judulhalaman}} </button>
                
              </div>
              <div class="col-lg-3 pull-right">
                <a href='{{url("literaria/download")}}' class="btn btn-block btn-success">Download XLS</a>
              </div>

            </div>
            <br>
            {{csrf_field()}}
            <div class="row">
              <div class="col-lg-12">
            <div class="table-responsive">
            <table id="example1" class="table table-striped" style="width:100%">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Action</th>
                  <th>Name</th>
                  <th>Value</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1;?>
                <?php foreach ($data as $list) : ?>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td>
                    <a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_even('{{$list->id}}')"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                      <button class="btn btn-sm btn-danger" onclick="delete_even({{$list->id}})" title="Delete">
                        <i class="fa fa-fw fa-trash"></i>
                      </button>
                    </td>
                    <td><?= $list->name ?></td>
                    <td><?= $list->value ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>

            </table>
            </div>
            </div>
            </div>
          </div>
          </form>
        </div>
      </div>


    </div>

  </section>
</div>

<div class="modal fade" id="modal-even">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="#" id="form" name="form" class="form-horizontal" enctype="multipart/form-data" novalidate="novalidate">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Data {{$judulhalaman}}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
          <input type="hidden" name="id" id="id" value="">

          <div class="form-group">
            <label for="inputEmail3" class="col-sm-4 control-label">Name</label>

            <div class="col-sm-12">
              <input type="text" class="form-control" id="name" placeholder="Name" name="name" required="">
            </div>
          </div>

          <div class="form-group">
            <label for="inputEmail3" class="col-sm-4 control-label">Value</label>

            <div class="col-sm-12">
              <input type="text" class="form-control" id="value" placeholder="Value" name="value" required="">
            </div>
          </div>
      </div>
      <div class="modal-footer">
          <div class="form-actions">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" id="btnSave" class="btn btn-primary">Save changes</button>
          </div>
      </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<script type="text/javascript">
  var save_method; //for save method string
  var table;

  function tambah_even() {
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('#modal-even').modal('show'); // show bootstrap modal
    $('.modal-title').text('Tambah {{$judulhalaman}}'); // Set Title to Bootstrap modal title
  }
  /*$(document).ready(function() {
    $("#example1").DataTable()
    $("#form").validate({
      rules: {

        name: {
          required: true
        },
        value: {
          required: true
        }
      }
    });

  });*/



  $('#btnSave').on('click',function(){
    var form = $("#form");
    var url;
    var id = $('#id').val();
    var name = $('#name').val();
    var value = $('#value').val();
    var token = '{{csrf_token()}}';

    if (!form.valid()) {
      document.getElementById('form').focus();
    } else {
      if (save_method == 'add') {
        url = '{{url("literaria/save")}}';
        console.log(url);
      } else {
        url = "{{url('literaria/updateaction')}}";
      }
      $.ajax({
        url: url,
        type: 'POST',
        data: 'id='+id+'&name='+name+'&value='+value+'&_token='+token,
        success: function(data) {
          $('#modal-even').modal('hide');
          //alert('SUKSES\n\nData berhasil tersimpan ke database.');
          location.reload();
        },
        error: function() {
         alert('Terdapat Kesalahan');
        }
      });
    }
  });

  function edit_even(id) {
    var save_method = 'update';
    $('#form')[0].reset();
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $.ajax({
      url: "{{url('literaria/update')}}/" + id,
      type: "GET",
      dataType: "JSON",
      success: function(data) {
        console.log(data);
        $('[name="id"]').val(data.id);
        $('[name="name"]').val(data.name);
        $('[name="value"]').val(data.value);
        $('#modal-even').modal('show');
        $('.modal-title').text('Edit {{$judulhalaman}}');

      },
      error: function(jqXHR, textStatus, errorThrown) {
        alert('Gagal dalam pengambilan data');
      }
    });
  }



  function delete_even(ideven) {
    if (confirm('Anda Yakin Menghapus data yang dipilih?')) {
      $.ajax({
        url: "{{url('literaria/delete')}}/" + ideven,
        success: function(data) {
            alert('SUKSES\n\nData berhasil terhapus dari database.');
            location.reload();
        },
        error: function(jqXHR, textStatus, errorThrown) {
          alert('Terdapat Kesalahan Dalam Menghapus Data');
        }
      });
    }
  }
</script>
@endsection
