@extends('layoututama')
@section('content')
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>SMS Semua Pemilih</h1>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <?php // $this->session->flashdata('pesan') ?>
          <div class="card-body">
            <form class="form-horizontal" method="post" action="sms/aksipemilih" name="basic_validate" id="basic_validate" novalidate="novalidate" method="POST">
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 control-label">Isi Pesan</label>
                <div class="col-sm-12">
                  <textarea class="form-control" name="isi" id="isi"> ISI Pesan yang akan dikirim ke semua relawan</textarea>

                </div>

                <label for="inputEmail3" class="col-sm-12 control-label">gunakan "{nama}" untuk penyebutan nama, ex : halo {nama} </label>

              </div>
              <div class="form-actions mx-3">
                <input type="submit" value="Kirim Pesan" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>


    </div>

  </section>
</div>
@endsection
