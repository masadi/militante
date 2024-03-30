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
          <div class="card-body">
            <form class="form-horizontal" method="post" action="{{url('profil/save')}}" name="basic_validate" id="basic_validate" novalidate="novalidate" method="POST">

              <input type="hidden" name="id" id="id" value="<?= $profillist->id ?>">

              <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 control-label">Nama</label>
                <div class="col-sm-6">
                  <input type="text" name="nama" class="form-control" value="<?= $profillist->nama ?>"><br>
                </div>

              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 control-label">username</label>
                <div class="col-sm-6">
                    <input type="text" name="username" class="form-control" value="<?= $profillist->username ?>"><br>

                    <input type="hidden" class="form-control" id="_token"  name="_token" value="{{csrf_token()}}">
                </div>



              </div>

              <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 control-label">New Password</label>
                <div class="col-sm-6">
                  <input type="text" name="password" class="form-control" value=""><br>
                </div>

              </div>

              <div class="form-actions mx-3">
                <input type="submit" value="Simpan" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>


    </div>

  </section>
</div>
@endsection
