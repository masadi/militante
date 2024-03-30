<div class="content-wrapper">
  <section class="content-header">
      <h1>
        
        <small>Data Pemilih</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=site_url()?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Pemilih</li>
      </ol>
    </section>
    <section class="content">
     

    <div class="row">
         <div class="col-md-12">
  <a href="<?=site_url()?>pemilih/sort" class="btn btn-block btn-primary"onclick="add_pemilih()"> <i class="fa fa-fw fa-plus-circle"></i> Sortir Grafik</a></div>
  <div class="box box-warning"></div>
        <div class="col-md-6">
          <div class="box box-warning">
             <div class="box-header with-border">
              <h3 class="box-title">Grafik Pemilih</h3>
  
 
              
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
             <div class="box-body">
                <?php 
                //$namaprovinsix[]=array();
                foreach($provinsigrafiklist as $resultprovinsi){
                    
                  $namaprovinsi[]=$resultprovinsi->pemilihuser;
                   $namaprovinsix[] =$resultprovinsi->namaprovinsi;
                  $valueprovinsi[]=(float)$resultprovinsi->jumlah;
                  
                }
              ?>
             
          
             <div id="reportprovinsi">
            
             </div>
             <script type="text/javascript">
              function getRandomColor() {
    var letters = '0123456789ABCDEF'.split(''),
        color = '#';
    for (var i = 0; i < 6; ++i) {
        color += letters[Math.round(Math.random() * 15)];
    }
    return color;
};
$(function () {
    $('#reportprovinsi').highcharts({

        chart: {

                type: 'column'
            },
        title: {
            text: 'Grafik Jumlah Pemilih Per Provinsi',
            style: {
                    fontSize: '18px',
                    fontFamily: 'Verdana, sans-serif'
            }
        },
        subtitle: {
           text: 'Yang telah ditambahkan oleh masing koordinator atau mendaftar langsung dari Aplikasi ',
           style: {
                    fontSize: '15px',
                    fontFamily: 'Verdana, sans-serif'
            }
        },

        plotOptions: {
            column: {
                depth: 25
                
            }
        },
        credits: {
            enabled: false
        },
        xAxis: [
            {
                categories:<?php echo json_encode($namaprovinsi) ;?>,
                tickmarkPlacement: 'on',
            },
            {
                linkedTo: 0,
                 categories:<?php echo json_encode($namaprovinsix) ;?>,
                 labels: {
                    //y:20,
                style: {
                    fontWeight: 'bold'
                }
             
            }
            }
        ],
        exporting: { 
            enabled: true 
        },
        yAxis: {
            title: {
                text: 'Jumlah Pemilih'
            },
        },
        tooltip: {
             formatter: function() {
                 return 'Untuk koordinator  <b>' + this.x + '</b> Jumlah pemilih terdaftar <b>' + Highcharts.numberFormat(this.y,0)+ '</b>';
             }
          },

        series: [{
            name: 'Nama koordinator / Langsung dari Aplikasi ',
            data: <?php echo json_encode($valueprovinsi);?>,
            shadow : true,
            colorByPoint: true,
            
            dataLabels: {
                enabled: true,
                //color: '#045396',
                align: 'center',
                formatter: function() {
                     return Highcharts.numberFormat(this.y, 0);
                }, // one decimal
                y: 0, // 10 pixels down from the top
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        },

        ]
    });
});
        </script>
            </div>
          </div>
        </div>
        
           <div class="col-md-6">
          <div class="box box-warning">
             <div class="box-header with-border">
              <h3 class="box-title">Grafik Pemilih</h3>
  
 
              
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
             <div class="box-body">
                <?php 
                foreach($kabupatengrafiklist as $resultkabupaten){
                  $namakabupaten[]=$resultkabupaten->pemilihuser;
                  $valuekabupaten[]=(float)$resultkabupaten->jumlahkabupaten;
                   $namakabupatenx[] =$resultkabupaten->namakabupaten;
                }
              ?>
             
          
             <div id="reportkabupaten">
            
             </div>
             <script type="text/javascript">
              function getRandomColor() {
    var letters = '0123456789ABCDEF'.split(''),
        color = '#';
    for (var i = 0; i < 6; ++i) {
        color += letters[Math.round(Math.random() * 15)];
    }
    return color;
};
$(function () {
    $('#reportkabupaten').highcharts({

        chart: {

                type: 'column'
            },
        title: {
            text: 'Grafik Jumlah Pemilih Per kabupaten',
            style: {
                    fontSize: '18px',
                    fontFamily: 'Verdana, sans-serif'
            }
        },
        subtitle: {
           text: 'Yang telah ditambahkan oleh masing koordinator atau mendaftar langsung dari Aplikasi ',
           style: {
                    fontSize: '15px',
                    fontFamily: 'Verdana, sans-serif'
            }
        },

        plotOptions: {
            column: {
                depth: 25
                
            }
        },
        credits: {
            enabled: false
        },
       xAxis: [
            {
                categories:<?php echo json_encode($namakabupaten) ;?>,
                tickmarkPlacement: 'on',
            },
            {
                linkedTo: 0,
                 categories:<?php echo json_encode($namakabupatenx) ;?>,
                 labels: {
                    //y:20,
                style: {
                    fontWeight: 'bold'
                }
             
            }
            }
        ],
        exporting: { 
            enabled: true 
        },
        yAxis: {
            title: {
                text: 'Jumlah Pemilih'
            },
        },
        tooltip: {
             formatter: function() {
                 return 'Untuk koordinator  <b>' + this.x + '</b> Jumlah pemilih terdaftar <b>' + Highcharts.numberFormat(this.y,0)+  '</b>';
             }
          },

        series: [{
            name: 'Nama koordinator / Langsung dari Aplikasi ',
            data: <?php echo json_encode($valuekabupaten);?>,
            shadow : true,
            colorByPoint: true,
            
            dataLabels: {
                enabled: true,
                //color: '#045396',
                align: 'center',
                formatter: function() {
                     return Highcharts.numberFormat(this.y, 0);
                }, // one decimal
                y: 0, // 10 pixels down from the top
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        },

        ]
    });
});
        </script>
            </div>
          </div>
        </div>
      </div>
    <div class="row">
        <div class="col-md-6">
          <div class="box box-warning">
             <div class="box-header with-border">
              <h3 class="box-title">Grafik Pemilih</h3>
  
 
              
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
             <div class="box-body">
                <?php 
                //$namaprovinsix[]=array();
                foreach($kecamatangrafiklist as $resultkecamatan){
                    
                  $namakecamatan[]=$resultkecamatan->pemilihuser;
                   $namakecamatanx[] =$resultkecamatan->namakecamatan;
                  $valuekecamatan[]=(float)$resultkecamatan->jumlahkecamatan;
                  
                }
              ?>
             
          
             <div id="reportkecamatan">
            
             </div>
             <script type="text/javascript">
              function getRandomColor() {
    var letters = '0123456789ABCDEF'.split(''),
        color = '#';
    for (var i = 0; i < 6; ++i) {
        color += letters[Math.round(Math.random() * 15)];
    }
    return color;
};
$(function () {
    $('#reportkecamatan').highcharts({

        chart: {

                type: 'column'
            },
        title: {
            text: 'Grafik Jumlah Pemilih Per Kecamatan',
            style: {
                    fontSize: '18px',
                    fontFamily: 'Verdana, sans-serif'
            }
        },
        subtitle: {
           text: 'Yang telah ditambahkan oleh masing koordinator atau mendaftar langsung dari Aplikasi ',
           style: {
                    fontSize: '15px',
                    fontFamily: 'Verdana, sans-serif'
            }
        },

        plotOptions: {
            column: {
                depth: 25
                
            }
        },
        credits: {
            enabled: false
        },
        xAxis: [
            {
                categories:<?php echo json_encode($namakecamatan) ;?>,
                tickmarkPlacement: 'on',
            },
            {
                linkedTo: 0,
                 categories:<?php echo json_encode($namakecamatanx) ;?>,
                 labels: {
                    //y:20,
                style: {
                    fontWeight: 'bold'
                }
             
            }
            }
        ],
        exporting: { 
            enabled: true 
        },
        yAxis: {
            title: {
                text: 'Jumlah Pemilih'
            },
        },
        tooltip: {
             formatter: function() {
                 return 'Untuk koordinator  <b>' + this.x + '</b> Jumlah pemilih terdaftar <b>' + Highcharts.numberFormat(this.y,0)+ '</b>';
             }
          },

        series: [{
            name: 'Nama koordinator / Langsung dari Aplikasi ',
            data: <?php echo json_encode($valuekecamatan);?>,
            shadow : true,
            colorByPoint: true,
            
            dataLabels: {
                enabled: true,
                //color: '#045396',
                align: 'center',
                formatter: function() {
                     return Highcharts.numberFormat(this.y, 0);
                }, // one decimal
                y: 0, // 10 pixels down from the top
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        },

        ]
    });
});
        </script>
            </div>
          </div>
        </div>
        
           <div class="col-md-6">
          <div class="box box-warning">
             <div class="box-header with-border">
              <h3 class="box-title">Grafik Pemilih</h3>
  
 
              
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
             <div class="box-body">
                <?php 
                foreach($kelurahangrafiklist as $resultkelurahan){
                  $namakelurahan[]=$resultkelurahan->pemilihuser;
                  $valuekelurahan[]=(float)$resultkelurahan->jumlahkelurahan;
                   $namakelurahanx[] =$resultkelurahan->namakelurahan;
                }
              ?>
             
          
             <div id="reportkelurahan">
            
             </div>
             <script type="text/javascript">
              function getRandomColor() {
    var letters = '0123456789ABCDEF'.split(''),
        color = '#';
    for (var i = 0; i < 6; ++i) {
        color += letters[Math.round(Math.random() * 15)];
    }
    return color;
};
$(function () {
    $('#reportkelurahan').highcharts({

        chart: {

                type: 'column'
            },
        title: {
            text: 'Grafik Jumlah Pemilih Per Kelurahan',
            style: {
                    fontSize: '18px',
                    fontFamily: 'Verdana, sans-serif'
            }
        },
        subtitle: {
           text: 'Yang telah ditambahkan oleh masing koordinator atau mendaftar langsung dari Aplikasi ',
           style: {
                    fontSize: '15px',
                    fontFamily: 'Verdana, sans-serif'
            }
        },

        plotOptions: {
            column: {
                depth: 25
                
            }
        },
        credits: {
            enabled: false
        },
       xAxis: [
            {
                categories:<?php echo json_encode($namakelurahan) ;?>,
                tickmarkPlacement: 'on',
            },
            {
                linkedTo: 0,
                 categories:<?php echo json_encode($namakelurahanx) ;?>,
                 labels: {
                    //y:20,
                style: {
                    fontWeight: 'bold'
                }
             
            }
            }
        ],
        exporting: { 
            enabled: true 
        },
        yAxis: {
            title: {
                text: 'Jumlah Pemilih'
            },
        },
        tooltip: {
             formatter: function() {
                 return 'Untuk koordinator  <b>' + this.x + '</b> Jumlah pemilih terdaftar <b>' + Highcharts.numberFormat(this.y,0)+  '</b>';
             }
          },

        series: [{
            name: 'Nama koordinator / Langsung dari Aplikasi ',
            data: <?php echo json_encode($valuekelurahan);?>,
            shadow : true,
            colorByPoint: true,
            
            dataLabels: {
                enabled: true,
                //color: '#045396',
                align: 'center',
                formatter: function() {
                     return Highcharts.numberFormat(this.y, 0);
                }, // one decimal
                y: 0, // 10 pixels down from the top
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        },

        ]
    });
});
        </script>
            </div>
          </div>
        </div>
      </div>

    </section>
</div>

