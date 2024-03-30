@extends('layoututama')
@section('content')
<?php
$username = Session::get('username');
?>


<div class="main-content">
  <section class="section">
    <div class='row'>

            <div class='col-md-4'>
              <div class='card card-primary'>
                  <div class='card-header with-border'>
                    <h4 class='card-title'><i class="fas fa-address-book"></i> Municipio</h4>
                  </div><!-- /.card-header -->
                  <div class='card-body'>
                            <div class="table-responsive">
                                <table id="tablem" name="tablem"  class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Municipio</th>
                                            <th>Nama</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $list = DB::table('kabupaten')->orderBy('urut_no_distrik','ASC')->get();
                                        $no = 1;
                                        foreach ($list as $kabupaten) {
                                            if($kabupaten->urut_no_distrik<10) $kabupaten->urut_no_distrik="0".$kabupaten->urut_no_distrik;
                                            echo '<tr><td>'.$kabupaten->urut_district.'</td>';
                                            echo '<td>'.$kabupaten->urut_no_distrik.'</td>';
                                            echo '<td>'.$kabupaten->nama_district.'</td>';
                                            echo '</tr>';

                                            $no++;
                                        }
                                    ?>
                                    </tbody>

                                </table>
                            </div>

                  </div>
              </div>
            </div>

						<div class='col-md-8'>

						<form action="javascript:save()" id="form1" name="form1" class="form-horizontal" method='POST' enctype="multipart/form-data" >
                                        {{csrf_field()}}
                                        <input type="hidden" class="form-control" id="_token"  name="_token" value="{{csrf_token()}}">
              <div class='card card-primary'>
								<div class='card-header with-border'>
									<h4 class='card-title'><i class="fas fa-address-book"></i> Configuration</h4>
								</div><!-- /.card-header -->
								<div class='card-body'>
									<div>
                                              <div class="row">
                                                <div class="form-group  row col-md-6">
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

                                                <div class="form-group  row col-md-6">
                                                  <label for="kecamatantim" class="col-sm-12 control-label">Posto</label>

                                                  <div class="col-md-12">
                                                  <select name="kecamatantim" id="kecamatantim" value="" class="form-control" required>

                                                  </select>
                                                  </div>
                                                </div>
                                                <?php
                                                  $characters_on_image = 8;
                                                  $possible_letters = '234567890ABCDEFGHIJKLMNPQRSTUVWXYZ';

                                                  $code = '';
                                                  $i = 0;
                                                  while ($i < $characters_on_image) { 
                                                    $code .= substr($possible_letters, mt_rand(0, strlen($possible_letters)-1), 1);
                                                    $i++;
                                                  }
                                                ?>
                                                <div class="form-group  row col-md-6">
                                                  <label for="kecamatantim" class="col-sm-12 control-label">No Bukti</label>

                                                  <div class="col-md-12">
                                                  <input type="text" class="form-control" id="nobukti"  name="nobukti" value="{{$code }}" readonly>

                                                  </select>
                                                  </div>
                                                </div>

                                                <div class="form-group  row col-md-6">
                                                  <label for="kecamatantim" class="col-sm-12 control-label">Tanggal </label>

                                                  <div class="col-md-12">
                                                  <input type="date" class="form-control" name="tanggal" value="<?php echo date('Y-m-d');?>"  required>

                                                  </select>
                                                  </div>
                                                </div>

                                                <div class="form-group  row col-md-6">
                                                  <label for="kecamatantim" class="col-sm-12 control-label">VIP </label>

                                                  <div class="col-md-12">
                                                  <select name="vip" class="form-control" required>

                                                  <option value="1">TIDAK</option>
                                                  <option value="2">YA</option>

                                                  </select>
                                                  </div>
                                                </div>

                                                <div class="form-group  row col-md-12">
                                                  <label for="kecamatantim" class="col-sm-12 control-label">No Buletin </label>

                                                  <div class="col-md-4">
                                                  <input type="number" class="form-control" name="buletin1" value=""  required>
                                                  </div>

                                                  <div class="col-md-1">
                                                    s/d
                                                  </div>
                                                  <div class="col-md-4">
                                                  <input type="number" class="form-control" name="buletin2" value=""  required>
                                                  </div>

                                                </div>

                                                
                                                <div class="form-group  row col-md-12">
                                                  <label for="kecamatantim" class="col-sm-12 control-label">Keterangan </label>

                                                  <div class="col-md-12">
                                                      <textarea name="keterangan" rows="5" class="form-control"></textarea>
                                                  </div>
                                                </div>
                                                
                                                <div class="form-group  row col-md-12">
                                                  <label for="kecamatantim" class="col-sm-12 control-label">Password </label>

                                                  <div class="col-md-6">
                                                  <input type="password" class="form-control" name="passw" value=""  required>
                                                  </div>

                                                </div>
                                              </div>

									</div>
								</div>
                                              <!-- /.card-body -->
                                              <div class="card-footer">
                                                <a href="{{url('militante/listregister')}}" class="btn btn-danger">Back to List</a>
                                                <button type="submit" name="btnupload" class="btn btn-success ">SAVE REGISTER MILITANTE</button>
                                              </div>
							</div>

							

						
						</form>
					</div>
</section>
</div>


<script>
    var baseUrl = "{{url('militante')}}/";

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

        function save() {
            var form = $('#form1')[0];
            var formData = new FormData(form);

            //btnLoader(true);

            $.ajax({
                url: baseUrl + 'saveregister',
                dataType: 'json',
                method: 'post',
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.status) {
                            document.getElementById("form1").reset();
                            select_box = document.getElementById("kabupatentim");
                            select_box.selectedIndex = -1;
                            select_box = document.getElementById("kecamatantim");
                            select_box.selectedIndex = -1;
                            
                            <?php
                                $characters_on_image = 8;
                                $possible_letters = '234567890ABCDEFGHIJKLMNPQRSTUVWXYZ';

                                $code = '';
                                $i = 0;
                                while ($i < $characters_on_image) { 
                                    $code .= substr($possible_letters, mt_rand(0, strlen($possible_letters)-1), 1);
                                    $i++;
                                }
                            ?>
                            document.getElementById("nobukti").value = "<?php echo $code;?>";
                            call_alert('success', 'Success', 'Data saved successfully.');
                    } else {
                        call_alert('error', 'Warning', 'Failed to save data..');
                    }
                },
                error: function() {
                    call_alert('error', 'Warning', 'Failed to save data.');
                }
            });
        }

</script>

<script>

    function kelurahantim(lurah) {
        var id = lurah;
        var link = "{{url('tim/get_kelurahan')}}/" + id;
        $.ajax({
            data: id,
            url: link
        }).done(function(data) {
            $('#kelurahantim').html(data);
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
            kelurahantim(value);
            tpstim(value);
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
            tpstim(value);
        });
    });

    $('#kelurahantim').change(function() {
        var id = $(this).val();
        tpstim(id)
    });
</script>
<script type="text/javascript">
        $(document).ready(function() {
            $("#number").keypress(function (e) {
                if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                    $('#number-message').addClass('d-block').removeClass('d-none');
                    return false;
                } else {
                    $('#number-message').addClass('d-none').removeClass('d-block');
                }
            });
        });
</script>



<script type="text/javascript">



        window.onload=function(){

            $('#tgllahir').on('change', function() {

                var dob = new Date(this.value);

                var today = new Date();

var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));

                $('#usia').val(age);

            });

        }

          </script>
@endsection
