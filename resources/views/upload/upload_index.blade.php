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
          <div class="row mt-3 mx-4">
            <a href="upload/add" class="btn btn-block btn-primary"> <i class="fa fa-fw fa-plus-circle"></i> Upload Bukti </a>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="example1" class="table table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Bukti</th>
                    <th>Saksi</th>
                    <th>District</th>
                    <th>Sub District</th>
                    <th>Suco</th>
                    <th>Aldeia</th>


                  </tr>
                </thead>
                <tbody>
                  <?php $no = 1;
                  //$id = $this->session->userdata('nama');


                    $provinsilist = DB::table('bukti')
                        ->leftJoin('kecamatan','kecamatan.idkecamatan','=','bukti.kecamatan')
                        ->leftJoin('kelurahan','kelurahan.idkelurahan','=','bukti.kelurahan')
                        ->leftJoin('kabupaten','kabupaten.idkabupaten','=','bukti.kabupaten')
                        ->leftJoin('tps','tps.idtps','=','bukti.tps')
                        ->get();
                  ?>
                  <?php foreach ($provinsilist as $list) : ?>
                    <tr>
                      <td><?= $no++ ?></td>
                      <td>
                        <div class="col-md-6">
                          <img src="app-assets/bukti/<?php echo $list->namabukti; ?>" class="img-responsive" alt="">
                        </div>
                      </td>
                      <td><?= $list->saksi ?></td>
                      <td><?= $list->nama_district ?></td>
                      <td><?= $list->nama_subdistrict ?></td>
                      <td><?= $list->nama_suco ?></td>
                      <td><?= $list->nama_aldeia ?></td>

                    </tr>
                  <?php endforeach; ?>
                </tbody>

              </table>
            </div>
          </div>
        </div>
      </div>


    </div>

  </section>
</div>

<script>
  $(function(){
    $("#example1").DataTable()
  })
</script>

@endsection
