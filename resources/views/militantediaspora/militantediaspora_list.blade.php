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
                <a href='{{url("militantediaspora")}}' class="btn btn-block btn-primary"><i class="fa fa-fw fa-plus-circle"></i> Add Militante Diaspora</a>
              </div>
              <div class="col-lg-3 pull-right">
                <a href='{{url("militantediaspora/download")}}' class="btn btn-block btn-success">Download XLS</a>
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
                                            <th>Action&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                            <th>Naran Militante</th>
                                            <th>No Militante</th>
                                            <th>No Eleitoral</th>
                                            <th>Loron Moris</th>
                                            <th>Sexu</th>
                                            <th>Tinan</th>
                                            <th>Observasaun</th>
                                            

                                        </tr>
                                    </thead>
                                    <tbody>

                                        
                                        <?php
                                        $no = 1;
                                        foreach ($query as $militante) {
                                            if($militante->status) $status="<span class='btn btn-success btn-sm'>Active</span>";
                                            else $status="<span class='btn btn-danger btn-sm'>Not Active</span>";
                                            
                                            if($militante->jenis_kelamin=='L') $jk="Mane";
                                            else $jk="Feto";

                                            echo '<tr><td align="center">'.$no.'</td>';
                                            echo '<td align="center">
                                            <a class="" href="/militantediaspora/edit/'.$militante->id.'" title="Edit" >
                                            <i data-feather="edit-2" class="fa fa-edit"></i></a>&nbsp;
                                            <a class="" href="/cetak/militantediaspora/'.$militante->id.'" title="Cetak Surat" ><i data-feather="print"  class="fa fa-print"></i></a>&nbsp;
                                            <a class="" href="javascript:void(0)" title="Delete" onclick="delete_user(' . "'" . $militante->id . "'" . ')">
                                            <i data-feather="trash" class="fa fa-trash"></i></a></td>';


                                            echo '<td align="left">'.$militante->nama.'</td>';
                                            echo '<td align="left">'.$militante->no_militante.'</td>';
                                            echo '<td align="left">'.$militante->no_elektor.'</td>';
                                            echo '<td align="left">'.$militante->tgl_lahir.'</td>';
                                            echo '<td align="left">'.$jk.'</td>';
                                            echo '<td align="left">'.$militante->usia.'</td>';
                                            echo '<td align="left">'.$militante->observasaun.'</td>';

                                            //add html for action


                                            echo '</tr>';

                                            $no++;
                                        }?> 
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

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

  function call_alert(type, title, content, timer = '') {
      if (timer == '') {
        timer = 3000;
      }
      Swal.fire({
                allowOutsideClick: false,
                icon: type,
                title: title,
                timer: timer,
                text: content,
      }).then(() => {

    });
  }

  function reload_table() {
    ('#table').ajax.reload(null, false); //reload datatable ajax
  }

  function delete_user(iduser) {
    if (confirm('Are you sure delete this data?')) {
      // ajax delete data to database
      $.ajax({
        url: "{{url('militantediaspora/delete')}}/" + iduser,
        type: "GET",
        dataType: "JSON",
        success: function(data) {

            call_alert('success', 'Success', 'Delete Data OK.');
            //if success reload ajax table
            //reload_table();
            location.reload();
        },
        error: function(jqXHR, textStatus, errorThrown) {
          call_alert('error', 'Warning', 'Failed to delete data.');
        }
      });

    }
  }

  function edit_user(iduser) {
      // ajax delete data to database
      $.ajax({
        url: "{{url('company/edit')}}/" + iduser,
        type: "GET",
        dataType: "JSON",
        success: function(data) {

            call_alert('success', 'Success', 'Delete edit OK.');
            //if success reload ajax table
            //reload_table();
            //location.reload();
        },
        error: function(jqXHR, textStatus, errorThrown) {
          call_alert('error', 'Warning', 'Failed to edit data.');
        }
      });

  }
</script>

@endsection
