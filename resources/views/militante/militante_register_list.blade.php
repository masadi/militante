
@extends('layoututama')
@section('content')
<?php
$level = Session::get('level');
if(!Session::get('username')){
  redirect('/');
} else {
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
                <a href="{{url('militante/register')}}" class="btn btn-block btn-primary"> <i class="fa fa-fw fa-plus-circle"></i> Register No. Militante</a>
                
              </div>

            </div>
            
            <br>
                                              <div class="row">
                                                <div class="form-group  row col-md-3">
                                                  <label for="tahunlulus" class="col-sm-12 control-label labelbold">Municipio</label>

                                                  <div class="col-md-12">
                                                    <select name="kabupatentim" id="kabupatentim" class="form-control" required>
                                                      <?php
                                                      $listkabupaten = DB::table('kabupaten')->get();
                                                      ?>
                                                      <option>-- Select Municipio --</option>
                                                      <?php foreach ($listkabupaten as $list) { $dt_option = $list->kode_district . ' | ' . $list->nama_district; ?>
                                                      <option value="{{ $list->kode_district }}" >
                                                          {{ $dt_option }}
                                                      </option>
                                                      <?php } ?>
                                                    </select>

                                                  </div>
                                                </div>

                                                <div class="form-group  row col-md-3">
                                                  <label for="kecamatantim" class="col-sm-12 control-label">Posto</label>

                                                  <div class="col-md-12">
                                                  <select name="kecamatantim" id="kecamatantim" value="" class="form-control" required>

                                                  </select>
                                                  </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <button type="submit" class="btn btn-dark"><span class="fa fa-search"></span> Search</button>      
                                                </div>
                                              </div><br>
            {{csrf_field()}}
            <div class="row">
              <div class="col-lg-12">
            <div class="table-responsive">
            <table id="example1" class="table table-striped" style="width:100%">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Action &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                  <th>Tanggal</th>
                  <th>VIP</th>
                  <th>Awal</th>
                  <th>Akhir</th>
                  <th>Municipio</th>
                  <th>Posto</th>
                  <th>Keterangan</th>
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
                    <a href="{{url('militante/register_edit')}}/{{$list->id}}" class="btn btn-sm btn-primary" title="Edit"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;&nbsp;
                    <a href="{{url('militante/register_buletin')}}/{{$list->id}}" class="btn btn-sm btn-success" title="List Buletin"><i class="fa fa-list"></i></a>&nbsp;&nbsp;&nbsp;
                    <button class="btn btn-sm btn-danger" onclick="delete_even({{$list->id}})" title="Delete">
                        <i class="fa fa-fw fa-trash"></i>
                      </button>
                    </td>
                    <td><?= $list->tanggal ?></td>
                    <td><?= $list->vip ?></td>
                    <td><?= $list->no_buletin1 ?></td>
                    <td><?= $list->no_buletin2 ?></td>
                    <td><?= $list->kabupaten_name ?></td>
                    <td><?= $list->kecamatan_name ?></td>
                    <td><?= $list->keterangan ?></td>
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

<script>

function kelurahantim(lurah) {
    var id = lurah;
    var link = "{{url('tim/get_kelurahan')}}/" + id;
    $.ajax({
        data: id,
        url: link
    }).done(function(data) {
        $('#kelurahantim').html(data);
        var value = $(data).val();
        tpstim(value);
    });
}

function kecamatantim(lurah) {
    var id = lurah;
    var link = "{{url('tim/get_kecamatan')}}/" + id;
    $.ajax({
        data: id,
        url: link
    }).done(function(data) {
        $('#kecamatan').html(data);
        kelurahantim(value);
        tpstim(value);
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


function nomil(id) {
    var link = "{{url('militante/searchno')}}/" + id;
    $.ajax({
        data: id,
        url: link
    }).done(function(data) {
      console.log('-');console.log(data);
        //$('#tpstim').html(data);
        //$('#nomilitante').value(data);
        document.getElementById("nomilitante").value=data;
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
        
        console.log(value);
        kelurahantim(value);
        tpstim(value);
        nomil(value);
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
        console.log(value);
        tpstim(value);
        /*console.log(value);*/
        nomil(value);
        
    });
});

$('#kelurahantim').change(function() {
    var id = $(this).val();
    tpstim(id)
});
</script>

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
        url: "{{url('militante/registerdelete')}}/" + ideven,
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
<?php } ?>
@endsection
