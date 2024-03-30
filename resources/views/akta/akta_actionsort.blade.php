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
              <h3 class="box-title">Grafik Pemilih untuk kabupaten <?=$namakabupatenpilih->namakabupaten?></h3>
  
 
              
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
             <div class="box-body">
                <?php 
                //$namaprovinsix[]=array();
                foreach($grafikkabupaten as $resultgrafikkabupaten){
                    
                  $namakabupatenx[]=$resultgrafikkabupaten->pemilihuser;
                  //$namakabupatenx[] =$resultgrafikkabupaten->namakabupaten;
                  $valuekabupaten[]=(float)$resultgrafikkabupaten->jumlahkabupaten;
                  
                }
              ?>
             
          
             <div id="reportsortkabupaten">
            
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
    $('#reportsortkabupaten').highcharts({

        chart: {

                type: 'column'
            },
        title: {
            text: 'Grafik Jumlah Pemilih untuk Kabupaten',
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
        xAxis: 
            {
                categories:<?php echo json_encode($namakabupatenx) ;?>,
                tickmarkPlacement: 'on',
            },
        
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
                 return 'Untuk Pemilih  <b>' + this.x + '</b> Jumlah pemilih terdaftar <b>' + Highcharts.numberFormat(this.y,0)+ '</b>';
             }
          },

        series: [{
            name: 'Nama Pemilih / Langsung dari Aplikasi ',
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
        
 
        <div class="col-md-6">
          <div class="box box-warning">
             <div class="box-header with-border">
              <h3 class="box-title">Grafik Pemilih untuk Kecamatan <?=$namakecamatanpilih->namakecamatan?></h3>
  
 
              
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
             <div class="box-body">
                <?php 
                //$namaprovinsix[]=array();
                foreach($grafikkecamatan as $resultgrafikkecamatan){
                    
                  $namakecamatanx[]=$resultgrafikkecamatan->pemilihuser;
                  //$namakabupatenx[] =$resultgrafikkabupaten->namakabupaten;
                  $valuekecamatan[]=(float)$resultgrafikkecamatan->jumlahkecamatan;
                  
                }
              ?>
             
          
             <div id="reportsortkecamatan">
            
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
    $('#reportsortkecamatan').highcharts({

        chart: {

                type: 'column'
            },
        title: {
            text: 'Grafik Jumlah Pemilih untuk Kecamatan',
            style: {
                    fontSize: '18px',
                    fontFamily: 'Verdana, sans-serif'
            }
        },
        subtitle: {
           text: 'Yang telah ditambahkan oleh masing Pemilih atau mendaftar langsung dari Aplikasi ',
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
        xAxis: 
            {
                categories:<?php echo json_encode($namakecamatanx) ;?>,
                tickmarkPlacement: 'on',
            },
        
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
                 return 'Untuk Pemilih  <b>' + this.x + '</b> Jumlah pemilih terdaftar <b>' + Highcharts.numberFormat(this.y,0)+ '</b>';
             }
          },

        series: [{
            name: 'Nama Pemilih / Langsung dari Aplikasi ',
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
        
      </div>
    <div class="row">
         <div class="col-md-12">
 
        
 
        <div class="col-md-12">
          <div class="box box-warning">
             <div class="box-header with-border">
              <h3 class="box-title">Grafik Pemilih untuk Kelurahan <?=$namakelurahanpilih->namakelurahan?></h3>
  
 
              
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
             <div class="box-body">
                <?php 
                //$namaprovinsix[]=array();
                foreach($grafikkelurahan as $resultgrafikkelurahan){
                    
                  $namakelurahanx[]=$resultgrafikkelurahan->pemilihuser;
                  //$namakabupatenx[] =$resultgrafikkabupaten->namakabupaten;
                  $valuekelurahan[]=(float)$resultgrafikkelurahan->jumlahkelurahan;
                  
                }
              ?>
             
          
             <div id="reportsortkelurahan">
            
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
    $('#reportsortkelurahan').highcharts({

        chart: {

                type: 'column'
            },
        title: {
            text: 'Grafik Jumlah Pemilih untuk Kelurahan',
            style: {
                    fontSize: '18px',
                    fontFamily: 'Verdana, sans-serif'
            }
        },
        subtitle: {
           text: 'Yang telah ditambahkan oleh masing Pemilih atau mendaftar langsung dari Aplikasi ',
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
        xAxis: 
            {
                categories:<?php echo json_encode($namakelurahanx) ;?>,
                tickmarkPlacement: 'on',
            },
        
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
                 return 'Untuk Pemilih  <b>' + this.x + '</b> Jumlah pemilih terdaftar <b>' + Highcharts.numberFormat(this.y,0)+ '</b>';
             }
          },

        series: [{
            name: 'Nama Pemilih / Langsung dari Aplikasi ',
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

