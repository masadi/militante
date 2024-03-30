@extends('layoututama')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <small>Kirim SMS ke semua koordinator berdasarkan Provinsi</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Kirim SMS ke semua koordinator berdasarkan Provinsi</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title">Kirim SMS ke semua koordinator berdasarkan Provinsi</h3>
                        <?php //$this->session->flashdata('pesan')?>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <div class="box-body">
                        <form class="form-horizontal" method="post" action="<?=site_url()?>sms/sendgroupkoordinator" name="basic_validate" id="basic_validate" novalidate="novalidate" method="POST">
                            <?php
                                $as=array();
                                $option=array();
                                $option['']='Pilih Provinsi';

                                $listprovinsi = DB::table('provinsi')->get();
                                foreach ($listprovinsi as $list){
                                    $option[$list->idprovinsi]=$list->namaprovinsi;
                                }

                            ?>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Provinsi koordinator</label>
                                <div class="col-sm-10">
                                    <?php echo form_dropdown('daerah',$option,$as,'id="daerah"  required="" class="form-control" title="Field Area Harus Diisi"'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Isi Pesan</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="isi" id="isi"> ISI Pesan yang akan dikirim ke semua koordinator</textarea>
                                </div>
                                <label for="inputEmail3" class="col-sm-12 control-label">gunakan "{nama}" untuk penyebutan nama, ex : halo {nama} </label>
                            </div>
                            <div class="form-actions">
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
