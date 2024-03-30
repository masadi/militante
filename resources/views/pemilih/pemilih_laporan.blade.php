<!DOCTYPE html>
<html lang="en" class="loading">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <link rel="stylesheet" type="text/css" href="{{url('app-assets/fonts/feather/style.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('app-assets/css/app.css')}}">
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
    <meta http-equiv="refresh" content="0; url={{url('/pemilih')}}">
    <style>
        body{
            background:#fff;

        }

        h4{
            font-size:16pt;
            margin-bottom:0px;
        }

        h5{
            font-size:10pt;
            font-weight:normal;
        }


    </style>
   </head>
   <body onload="window.print();">
    <div class="row">
        <div class="col-12">
            <h4 class="card-title"><?=$judulmodul;?>&nbsp;&nbsp;</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
                       <table class="table table-bordered" style="font-size:14px;">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Pemilih</th>
                                    <th>NIK</th>
                                    <th>Alamat</th>
                                    <th>Email</th>
                                    <th>Telepon</th>
                                    <th>TPS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($query))
                                    @foreach($query as $row)
                                    <tr>
                                        <td>{{$no}}</td>
                                        <td>{{$row->namadpt}}</td>
                                        <td>{{$row->nikdpt}}</td>
                                        <td>{{$row->alamatdpt}}</td>
                                        <td>{{$row->emailpemilih}}</td>
                                        <td>{{$row->tlppemilih}}</td>
                                        <td>{{$row->tpsdpt}}</td>
                                    </tr>
                                    <?php $no++; ?>
                                    @endforeach
                                @endif

                            </tbody>

                        </table>
        </div>
    </div>
</body>
</html>
