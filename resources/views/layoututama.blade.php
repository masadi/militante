<!DOCTYPE html>

<?php $username = Session::get('username'); 

date_default_timezone_set("Asia/Jakarta");?>
<html lang="en" class="loading">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">

        <title>{{$judulhalaman}}</title>
        <link rel="shortcut icon" type="image/x-icon" href="{{url('app-assets/potocalegroot/ok3.png')}}">
        <link rel="shortcut icon" type="image/png" href="{{url('app-assets/potocalegroot/ok3.png')}}">
    <?php /*<link href="{{url('app-assets/admin/css/user.min.css')}}" rel="stylesheet" id="user-style-default">

        <!-- General CSS Files -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

        <!-- CSS Libraries -->
        <link rel="stylesheet" href="{{url('app-assets/stisla/node_modules/jqvmap/dist/jqvmap.min.css')}}">
        <link rel="stylesheet" href="{{url('app-assets/stisla/node_modules/summernote/dist/summernote-bs4.css')}}">
        <link rel="stylesheet" href="{{url('app-assets/stisla/node_modules/owl.carousel/dist/assets/owl.carousel.min.css')}}">
        <link rel="stylesheet" href="{{url('app-assets/stisla/node_modules/owl.carousel/dist/assets/owl.theme.default.min.css')}}">

        <link rel="stylesheet" href="{{url('app-assets/stisla/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}">
        <link rel="stylesheet" href="{{url('app-assets/stisla/node_modules/datatables.net-select-bs4/css/select.bootstrap4.min.css')}}">

        <!-- Template CSS -->
        <link rel="stylesheet" href="{{url('app-assets/stisla/assets/css/style.css')}}">
        <link rel="stylesheet" href="{{url('app-assets/stisla/assets/css/custom.css')}}">
        <link rel="stylesheet" href="{{url('app-assets/stisla/assets/css/components.css')}}"> 


        <!-- JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <script src="{{url('app-assets/stisla/assets/js/scripts.js')}}"></script>
        <script src="{{url('app-assets/stisla/node_modules/datatables/media/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{url('app-assets/stisla/node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
        <script src="{{url('app-assets/stisla/node_modules/datatables.net-select-bs4/js/select.bootstrap4.min.js')}}"></script>
        <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
*/?>

        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{url('app-assets/admin/plugins/fontawesome-free/css/all.min.css')}}">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{url('app-assets/admin/dist/css/adminlte.min.css')}}">
        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
        <!-- DataTables -->
        <link rel="stylesheet" href="{{url('app-assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">



			<script type="text/javascript">
			  var detik = <?php echo date('s'); ?>;
			  var menit = <?php echo date('i'); ?>;
			  var jam = <?php echo date('H'); ?>;
		
			  function clock(){
			    if (detik!=0 && detik%60==0) {
			      menit++;detik=0;
			    }
			    second = detik;
			
			    if (menit!=0 && menit%60==0) {
			      jam++;menit=0;
			    }
			    minute = menit;
			
			    if (jam!=0 && jam%24==0) {
			      jam=0;
		      }
		      hour = jam;
			
			    if (detik<10){
			      second='0'+detik;
			    }
			    if (menit<10){
			      minute='0'+menit;
			    }
			
			    if (jam<10){
			      hour='0'+jam;
			    }
			    waktu = hour+':'+minute+':'+second;
			
			    document.getElementById("clock").innerHTML = waktu;
			      detik++;
			    }
			
			  setInterval(clock,1000);
			</script>	

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>



  <link href="{{url('app-assets/css/phoenix.min.css')}}" rel="stylesheet" id="style-default">
   <!--  <link href="{{url('app-assets/css/user.min.css')}}" rel="stylesheet" id="user-style-default"> -->

    </head>
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <body class="hold-transition sidebar-mini sidebar-collapse">
        <div class="wrapper">

            @include('layoutmenu')
            <?php //$judulhalaman="";?>
            <div class="content-wrapper"><!--Statistics cards Starts-->
                <!-- Content Header (Page header) -->
                <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{$judulmodul}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">{{$judulmodul}}</li>
                        </ol>
                    </div>
                    </div>
                </div><!-- /.container-fluid -->
                </section>
                <section class="content">
                    <div class="container-fluid">
                        @yield('content')
                    </div>
                </section>
            </div>
<?php /*
            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; 2022
                    <div class="bullet"></div>
                    <a href="#">{{ Session::get('namaaplikasi') }}</a>
                </div>
            </footer>*/?>
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.0.2-pre
    </div>
    <strong>Copyright &copy; 2022<a href="#">{{ Session::get('namaaplikasi') }}</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
        </div>
<!-- ////////////////////////////////////////////////////////////////////////////-->



<!-- jQuery -->
<script src="{{url('app-assets/admin/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{url('app-assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{url('app-assets/admin/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{url('app-assets/admin/dist/js/demo.js')}}"></script>


<script src="{{url('app-assets/js/phoenix.js')}}"></script>
<script src="{{url('app-assets/js/ecommerce-dashboard.js')}}"></script>

<!--    <script src="{{url('app-assets/admin/map/mapdata.js')}}"></script>
    <script src="{{url('app-assets/admin/map/countrymap.js')}}"></script>
        -->
<!-- Bootstrap 4 -->
<script src="{{url('app-assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{url('app-assets/admin/plugins/chart.js/Chart.min.js')}}"></script>


    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="{{url('app-assets/js/sweetalert2.all.min.js')}}"></script>
<!-- DataTables -->
<script src="{{url('app-assets/admin/plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{url('app-assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
<!--------------------------------------------->


<script type="text/javascript">

        $('#divkabupaten').load('{{url("tablekabupaten")}}');
        //$('#divkecamatan').load('{{url("tablekecamatan")}}');
        //$('#divkelurahan').load('{{url("tablekelurahan")}}');
        //$('#divtps').load('{{url("tabletps")}}');
</script>
<?php /*
<script>
  $(function () {
    $('#table').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>
*/?>
<script>
  $(function () {
    $('#example1').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>

<script>

    
function getidumakain(id) {
        var link = "{{url('umakain/searchid')}}/" + id;
        $.ajax({
            data: id,
            url: link
        }).done(function(data) {
            console.log('-');console.log(data);
            document.getElementById("nudatabase1").value=data;
            document.getElementById("numerusensus").value=data.substr(4,5);
        });
    }

    
    function getnoumakain(id) {
        var link = "{{url('umakain/searchno')}}/" + id;
        $.ajax({
            data: id,
            url: link
        }).done(function(data) {
            console.log('-');console.log(data);
            document.getElementById("nudatabase2").value=data;
            
        });
    }

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
            var datax=document.getElementById("kabupatentim").value;
            getidumakain(datax);

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





<?php //if($judulmodul=='Dashboard') { ?>

<script type="text/javascript">


    //--------------
    //- AREA CHART -
    //--------------


    var areaChartData = {
      labels  : ['Dili', 'Baucau', 'Ermera', 'Oe-Cusse', 'Lautém', 'Manatuto', 'Atauro'],
      datasets: [
        {
          label               : 'Mane',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [28, 48, 40, 19, 86, 27, 90]
        },
        {
          label               : 'Feto',
          backgroundColor     : 'rgba(210, 214, 222, 1)',
          borderColor         : 'rgba(210, 214, 222, 1)',
          pointRadius         : false,
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [65, 59, 80, 81, 56, 55, 40]
        },
      ]
    }

    var areaChartOptions = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: false
      },
      scales: {
        xAxes: [{
          gridLines : {
            display : false,
          }
        }],
        yAxes: [{
          gridLines : {
            display : false,
          }
        }]
      }
    }



    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChartData = jQuery.extend(true, {}, areaChartData)
    var temp0 = areaChartData.datasets[0]
    var temp1 = areaChartData.datasets[1]
    barChartData.datasets[0] = temp1
    barChartData.datasets[1] = temp0

    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false
    }

    var barChart = new Chart(barChartCanvas, {
      type: 'bar', 
      data: barChartData,
      options: barChartOptions
    })

    //var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
    var donutData        = {
      labels: [
          'Aileu Vila', 
          'Laulara',
          'Baucau', 
          'Vemasse', 
          'Zumalai', 
          'Oesilo', 
      ],
      datasets: [
        {
          data: [700,500,400,600,300,100],
          backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
        }
      ]
    }
    var donutData2        = {
      labels: [
          'Aileu Vila', 
          'Laulara',
          'Baucau', 
          'Vemasse', 
          'Zumalai', 
          'Oesilo', 
      ],
      datasets: [
        {
          data: [700,500,400,600,300,100],
          backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
        }
      ]
    }
    var donutOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
//-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieData        = donutData;
    var pieOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var pieChart = new Chart(pieChartCanvas, {
      type: 'pie',
      data: pieData,
      options: pieOptions      
    })

    
//-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas2 = $('#pieChart2').get(0).getContext('2d')
    var pieData2        = donutData2;
    var pieOptions2     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var pieChart2 = new Chart(pieChartCanvas2, {
      type: 'pie',
      data: pieData2,
      options: pieOptions2      
    })
</script>
<?php //} ?>

<?php /*

<script type="text/javascript">
    $(function() {
        var districtContext = document
            .getElementById("targetSuaraDistrictChart")
            .getContext("2d");
        var dynamicColors = function() {
            var r = Math.floor(Math.random() * 255);
            var g = Math.floor(Math.random() * 255);
            var b = Math.floor(Math.random() * 255);
            return "rgb(" + r + "," + g + "," + b + ")";
        };
        var chartDistrict = new Chart(districtContext, {
            type: "pie",
            data: {
                datasets: [{
                    data: [{{$totaltarget }}],
                    backgroundColor: ['#F12'],
                    label: "Dataset 1",
                }],
                labels: ["Test"],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                   legend: {
                        position: "bottom",
                    },
                    datalabels: {
                        formatter: (value, context) => {
                            const datapoints = context.chart.data.datasets[0].data;

                            function totalSum(total, datapoint) {
                                return total + datapoint;
                            }
                            const totalValue = datapoints.reduce(totalSum, 0);
                            const percentageValue = ((value / totalValue) * 100).toFixed(1);
                            return percentageValue + " %";
                        },
                        color: '#FFF'
                    },
                },
            },
            plugins: [ChartDataLabels],
        });


        var subDistrictContext = document
            .getElementById("targetSuaraSubDistrictChart")
            .getContext("2d");
        var chartSubDistrict = new Chart(subDistrictContext, {
            type: "pie",
            data: {
                datasets: [{
                    data: [<?php

                            $targetsuaradikecamatan = DB::table('target')
                                            ->selectRaw('kecamatan.nama_subdistrict as val,sum(jumlahsuara) as jum')
                                            ->leftjoin('kecamatan','kecamatan.kode_subdistrict','=','target.kecamatantarget')
                                            ->groupby('target.kecamatantarget')
                                            ->get();
                            //if (count($targetsuaradikecamatan) > 0) {
                                foreach ($targetsuaradikecamatan as $data) {
                                    echo $data->jum . ",";
                                }
                            //}

                            ?>],
                    backgroundColor: ['#F12','#51a','#1e3','#6af','#c45','ea1','42a'],
                    label: "Dataset 1",
                }],
                labels: [<?php

                            $targetsuaradikecamatan = DB::table('target')
                                            ->selectRaw('kecamatan.nama_subdistrict as val,sum(jumlahsuara) as jum,kecamatantarget')
                                            ->leftjoin('kecamatan','kecamatan.kode_subdistrict','=','target.kecamatantarget')
                                            ->groupby('target.kecamatantarget')
                                            ->get();
                            foreach ($targetsuaradikecamatan as $data) {
                                    echo "'".$data->val . "',";
                                }
                        ?>],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: "bottom",
                    },
                    datalabels: {
                        formatter: (value, context) => {
                            const datapoints = context.chart.data.datasets[0].data;

                            function totalSum(total, datapoint) {
                                return total + datapoint;
                            }
                            const totalValue = datapoints.reduce(totalSum, 0);
                            const percentageValue = ((value / totalValue) * 100).toFixed(1);
                            return percentageValue + " %";
                        },
                        color: '#FFF'
                    },
                },
            },
            plugins: [ChartDataLabels],
        });

        var sucoContext = document
            .getElementById("targetSuaraSucoChart")
            .getContext("2d");
        var chartSuco = new Chart(sucoContext, {
            type: "bar",
            data: {
                datasets: [{
                    data: [<?php
                            $targetsuaradikelurahan = DB::table('target')
                                            ->selectRaw('kelurahan.kode_suco as val,sum(jumlahsuara) as jum,kelurahantarget')
                                            ->leftjoin('kelurahan','kode_suco','=','target.kelurahantarget')
                                            ->groupby('target.kelurahantarget')
                                            ->get();
                            foreach ($targetsuaradikecamatan as $data) {
                                    echo $data->jum . ",";
                            }?>],
                    backgroundColor: ['#F12'],
                }, ],
                labels:[<?php

                            $targetsuaradikelurahan = DB::table('target')
                                            ->selectRaw('kelurahan.nama_suco as val,sum(jumlahsuara) as jum,kelurahantarget')
                                            ->leftjoin('kelurahan','kelurahan.kode_suco','=','target.kelurahantarget')
                                            ->groupby('target.kelurahantarget')
                                            ->get();
                            foreach ($targetsuaradikelurahan as $data) {
                                    echo "'".$data->val . "',";
                                }
                        ?>],
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
            },
        });

    });

</script>
*/?>

  </body>
</html>
