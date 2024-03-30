@extends('layoututama')
@section('content')
<?php
$level = Session::get('level');
?>
<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <?php // $this->session->flashdata('pesan') ?>
                        <form class="form-horizontal" method="post" action="api/simpan" name="basic_validate" id="basic_validate" novalidate="novalidate" method="POST">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Userkey</label>
                                <div class="col-sm-10">
                                    <input type="text" name="userkey" class="form-control" value="<?php // $phonebooklist->userkey ?>"><br>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Passkey</label>
                                <div class="col-sm-10">
                                    <input type="text" name="passkey" class="form-control" value="<?php // $phonebooklist->passkey ?>"><br>
                                </div>
                            </div>
                            <div class="form-actions">
                                <input type="submit" value="Simpan" class="btn btn-success">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title">Keterangan</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <div class="box-body">
                        <p>sdasd</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
