@extends('layoututama')
@section('content')
<?php
$level = Session::get('level');
$kredit=0;
?>
<div class="main-content">
  <section class="section">
    <div class="row">
      <div class="col-md-4">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Kredit SMS</h3>
          </div>
          <div class="card-body">
            <?php
            if ($kredit != 5) {
              echo "Sisa SMS anda adalah <span class='label label-danger'>$kredit</span><br>Silahkan Melakukan Pembelian Kredit";
            } else {
              echo "Sisa SMS anda adalah <span class='label label-success'>$kredit</span><br>";
            }

            ?></b><br>
          </div>
        </div>
      </div>
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Panduan</h3>

          </div>
          <div class="card-body">
            <p>Untuk Pembelian Kredit Silahkan Menghubungi <b>081364456585 // Anton (WhatsApp)<br>
                antondev92@gmail.com (Email)</p>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection
