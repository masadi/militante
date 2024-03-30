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
                <a href="{{url('militante/listregister')}}" class="btn btn-block btn-danger"> <i class="fa fa-fw fa-arrow-left"></i> Back to List Register</a>
                
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
                  <th>VIP</th>
                  <th>Kode Militante</th>
                  <th>Naran</th>
                  <th>Eleitoral</th>
                  <th>No. Segel</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1;?>
                <?php foreach ($query as $list) : 
                  if($list->vip==1) $list->vip="TIDAK";
                  else  $list->vip="YA";

                  
                  ?>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td>
                      <button class="btn btn-sm btn-danger" onclick="delete_even({{$list->id}})" title="Delete">
                        <i class="fa fa-fw fa-trash"></i>
                      </button>
                    </td>
                    <td><?= $list->vip ?></td>
                    <td><?= $list->kode_militante ?></td>
                    <td><?php 
                    if(!empty($list->nama1)) echo $list->nama1;
                    else if(!empty($list->nama2)) echo $list->nama2;
                    else if(!empty($list->nama3)) echo $list->nama3;
                      
                    ?>
                    </td>
                    <td><?php 
                    if(!empty($list->elektor1)) echo $list->elektor1;
                    else if(!empty($list->elektor2)) echo $list->elektor2;
                    else if(!empty($list->elektor3)) echo $list->elektor3;
                      
                    ?></td>
                    <td><?= $list->no_segel ?></td>
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


<script type="text/javascript">
  var save_method; //for save method string
  var table;

  function tambah_even() {
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('#modal-even').modal('show'); // show bootstrap modal
    $('.modal-title').text('Tambah {{$judulhalaman}}'); // Set Title to Bootstrap modal title
  }
  $(document).ready(function() {
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

  });




  function delete_even(ideven) {
    if (confirm('Anda Yakin Menghapus data yang dipilih?')) {
      $.ajax({
        url: "{{url('militante/listbuletin/delete')}}/" + ideven,
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
