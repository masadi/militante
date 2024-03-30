@extends('layoututama')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>SMS Koordinator Kelurahan</h1>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                <?php // $this->session->flashdata('pesan') ?>
                    <div class="card-body">
                        <form class="form-horizontal" method="post" action="sms/sendgroupkoordinatorkelurahan" name="basic_validate" id="basic_validate" novalidate="novalidate" method="POST">
                            <?php
                            $as = array();
                            $option = array();
                            $option[''] = 'Pilih Kelurahan';
                            $listkelurahan = DB::table('kelurahan')->get();
                            foreach ($listkelurahan as $list) {
                                $option[$list->idkelurahan] = $list->nama_suco;
                            }
                            ?>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-4 control-label">Kelurahan koordinator</label>
                                <div class="col-sm-12">
                                    <?php //echo form_dropdown('daerah', $option, $as, 'id="daerah"  required="" class="form-control" title="Field Area Harus Diisi"'); ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-4 control-label">Isi Pesan</label>
                                <div class="col-sm-12">
                                    <textarea class="form-control" name="isi" id="isi"> ISI Pesan yang akan dikirim ke semua koordinator</textarea>
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
