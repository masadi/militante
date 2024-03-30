@extends('layoututama')
@section('content')
<?php
$level = Session::get('level');

$list = DB::table('pengaturan')->get();
?>
<div class="main-content">
  <section class="section">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <?php // $this->session->flashdata('pesan') ?>
            <form class="form-horizontal" action="{{url('pengaturan/simpan')}}" name="basic_validate" id="basic_validate" novalidate="novalidate" method="post">
              {{csrf_field()}}
              <?php foreach ($list as $listpengaturan) : ?>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 control-label">Nama Aplikasi</label>
                <div class="col-sm-12">
                  <input type="text" name="namaaplikasi" id="namaaplikasi" class="form-control" value="{{ $listpengaturan->namaaplikasi }}" required><br>

                </div>



              </div>

              <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 control-label">Deskripsi Aplikasi</label>
                <div class="col-sm-12">
                  <textarea name="deskripsiaplikasi" id="deskripsiaplikasi" class="form-control">{{ $listpengaturan->deskripsiaplikasi }}</textarea><br>

                </div>



              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 control-label">Nomor HP Posko Pusat</label>
                <div class="col-sm-12">
                  <input type="text" name="hpaplikasi" id="hpaplikasi" class="form-control" value="{{ $listpengaturan->hpaplikasi }}"><br>

                </div>



              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 control-label">Copyright</label>
                <div class="col-sm-12">
                  <input type="text" name="footeraplikasi" id="footeraplikasi" class="form-control" value="{{ $listpengaturan->footeraplikasi }}"><br>

                </div>



              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 control-label">Alamat Posko</label>
                <div class="col-sm-12">
                  <textarea name="alamataplikasi" id="alamataplikasi" class="form-control">{{ $listpengaturan->alamataplikasi }}</textarea><br>

                </div>



              </div>
              <div class="form-actions">
                <button type="button" class="btn btn-success" id="simpan">
                  <i class="fa fa-save"></i> Simpan
                </button>
                <button type="button" id="btnSave" class="btn btn-primary">Save changes</button>
              </div>
              <?php endforeach; ?>
            </form>

          </div>
        </div>
      </div>



    </div>

  </section>


<script>

  $('#btnSave').on('click',function(){
    var form = $("#form");
    var url;
    var namaaplikasi = $('#namaaplikasi').val();
    var deskripsiaplikasi = $('#deskripsiaplikasi').val();
    var hpaplikasi = $('#hpaplikasi').val();
    var alamataplikasi = $('#alamataplikasi').val();
    var token = '{{csrf_token()}}'

    /*if (!form.valid()) {
      document.getElementById('form').focus();
    } else {
      if (save_method == 'add') {
        url = '{{url("even/save")}}';
        console.log(url);
      } else {
        url = "{{url('even/updateaction')}}";
      }*/
      $.ajax({
        url: '{{url("pengaturan/simpan")}}',
        type: 'POST',
        data: 'namaaplikasi='+namaaplikasi+'&deskripsiaplikasi='+deskripsiaplikasi+'&hpaplikasi='+hpaplikasi+'&alamataplikasi='+alamataplikasi+'&_token='+token,
        success: function(data) {
          //$('#modal-even').modal('hide');
          //location.reload();
        },
        error: function() {
         alert('Terdapat Kesalahan');
        }
      });
    //}
  });


    $(function(){
        $('#simpan').on('click', function(){
            $('#basic_validate').submit();
        });

        $('#batal').on('click', function(){
            window.location.href="{{url('/')}}";
        });
    });
</script>

</div>

@endsection
