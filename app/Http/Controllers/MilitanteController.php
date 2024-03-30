<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Literaria;
use App\Models\Militante;
use App\Models\Buletin;
use App\Models\RegisterMilitante;
use App\Models\Tim;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class MilitanteController extends Controller
{
    public function index() {
        if(!Session::get('username')){
            redirect('/');
        } else {
            $judulhalaman = 'Militante';
            $judulmodul = 'Militante';


            $query =  DB::table('militante')
            ->select(['militante.*','kabupaten.idkabupaten as kabupaten_id','kabupaten.nama_district as kabupaten_name',
            'kecamatan.idkecamatan as kecamatan_id','kecamatan.nama_subdistrict as kecamatan_name',
            'kelurahan.idkelurahan as kelurahan_id','kelurahan.nama_suco as kelurahan_name',
            'tps.idtps as desa_id','tps.nama_aldeia as desa_name',])
            ->leftJoin('kabupaten','kabupaten.idkabupaten','=','militante.kabupaten_id')
            ->leftJoin('kecamatan','kecamatan.kode_subdistrict','=','militante.kecamatan_id')
            ->leftJoin('kelurahan','kelurahan.kode_suco','=','militante.kelurahan_id')
            ->leftJoin('tps','tps.kode_aldeia','=','militante.desa_id')
            ->orderBy('id','DESC')->get();
            return view('militante/militante_index',compact('judulmodul','judulhalaman'));
        }
    }

    public function list() {
        if(!Session::get('username')){
            redirect('/');
        } else {
            $judulhalaman = 'Militante';
            $judulmodul = 'Militante';


            $query =  DB::table('militante')
            ->select(['militante.*','kabupaten.idkabupaten as kabupaten_id','kabupaten.nama_district as kabupaten_name',
            'kecamatan.idkecamatan as kecamatan_id','kecamatan.nama_subdistrict as kecamatan_name',
            'kelurahan.idkelurahan as kelurahan_id','kelurahan.nama_suco as kelurahan_name',
            'tps.idtps as desa_id','tps.nama_aldeia as desa_name',])
            ->leftJoin('kabupaten','kabupaten.kode_district','=','militante.kabupaten_id')
            ->leftJoin('kecamatan','kecamatan.kode_subdistrict','=','militante.kecamatan_id')
            ->leftJoin('kelurahan','kelurahan.kode_suco','=','militante.kelurahan_id')
            ->leftJoin('tps','tps.kode_aldeia','=','militante.desa_id')
            ->orderBy('nama','ASC')->get();
            return view('militante/militante_list',compact('judulmodul','judulhalaman','query'));
        }
    }

    public function download() {
        if(!Session::get('username')){
            redirect('/');
        } else {
            $judulhalaman = 'Militante';
            $judulmodul = 'Militante';


            $query =  DB::table('militante')
            ->select(['militante.*','kabupaten.idkabupaten as kabupaten_id','kabupaten.nama_district as kabupaten_name',
            'kecamatan.idkecamatan as kecamatan_id','kecamatan.nama_subdistrict as kecamatan_name',
            'kelurahan.idkelurahan as kelurahan_id','kelurahan.nama_suco as kelurahan_name',
            'tps.idtps as desa_id','tps.nama_aldeia as desa_name',])
            ->leftJoin('kabupaten','kabupaten.kode_district','=','militante.kabupaten_id')
            ->leftJoin('kecamatan','kecamatan.kode_subdistrict','=','militante.kecamatan_id')
            ->leftJoin('kelurahan','kelurahan.kode_suco','=','militante.kelurahan_id')
            ->leftJoin('tps','tps.kode_aldeia','=','militante.desa_id')
            ->orderBy('id','DESC')->get();
            return view('militante/militante_download',compact('judulmodul','judulhalaman','query'));
        }
    }

	public function save(Request $request)
	{
        $kabupatentim = $request->kabupatentim;
        $kecamatantim = $request->kecamatantim;
        $kelurahantim = $request->kelurahantim;
        $desatim = $request->tpstim;
        $nomilitante = $request->nomilitante;
        $tanggal = $request->tanggal;
        $noelektor = $request->noelektor;
        $status = $request->statusmilitante;
        $tanggalterbit = $request->tanggalterbit;
        $validuntil = $request->validuntil;

        $validuntil = $request->validuntil;
        $nama = $request->nama;
        $tempatlahir = $request->tempatlahir;
        //$tgllahir = $request->tgllahir;
        $tgllahir = $request->thn.'-'.$request->bln.'-'.$request->tgl;

        $usia = $request->usia;
        
        $jeniskelamin = $request->jeniskelamin;
        
        $agama = $request->agama;
        $namaayah = $request->namaayah;
        $namaibu = $request->namaibu;
        $alamat = $request->alamat;
        $telepon = $request->telepon;
        $email = $request->email;
        $keterangan = $request->keterangan;

        $periode = $request->periode;
        $jabatan = $request->jabatan;
        $pendidikan = $request->pendidikan;
        $jurusan = $request->jurusan;
        $universitas = $request->universitas;
        $tahunlulus = $request->tahunlulus;
        $profesi = $request->profesi;
        $tglinput = $request->tglinput;
        
        $tgledit = $request->tgledit;
        $oprinput = $request->oprinput;
        $opredit = $request->opredit;
        $distrikinput = $request->distrikinput;
        $cetakkartu = $request->cetakkartu;
        
        $data = new Militante();
        $data->kabupaten_id = $request->kabupatentim;
        $data->kecamatan_id = $request->kecamatantim;
        $data->kelurahan_id = $request->kelurahantim;
        $data->desa_id = $request->tpstim;
        $data->no_militante = $request->nomilitante;
        $data->tanggal = $request->tanggal;
        $data->no_elektor = $request->noelektor;
        $data->status = $request->statusmilitante;
        $data->tgl_terbit = $request->tanggalterbit;
        $data->valid_until = $request->validuntil;

        $data->nama = $request->nama;
        $data->tempat_lahir = $request->tempatlahir;
        $data->tgl_lahir = $request->thn.'-'.$request->bln.'-'.$request->tgl;
        
        $data->usia = $request->usia;
        
        $data->jenis_kelamin = $request->jeniskelamin;
        
        $data->agama = $request->agama;
        $data->nama_ayah = $request->namaayah;
        $data->nama_ibu = $request->namaibu;
        $data->alamat = $request->alamat;
        $data->telepon = $request->telepon;
        $data->email = $request->email;
        $data->keterangan = $request->keterangan;

        $data->periode = $request->periode;
        $data->jabatan_id = $request->jabatan;
        $data->pendidikan_id = $request->pendidikan;
        $data->jurusan = $request->jurusan;
        $data->universitas = $request->universitas;
        $data->tahunlulus = $request->tahunlulus;
        $data->profesi_id = $request->profesi;
        $data->tgl_input = $request->tglinput;
        
        $data->tgl_edit = $request->tgledit;
        $data->opr_input = $request->oprinput;
        $data->opr_edit = $request->opredit;
        $data->distrik_input = $request->distrikinput;
        $data->cetak_kartu = $request->cetakkartu;

        $data->observasaun = $request->observasaun;
        $data->esperiancia = $request->esperiancia;
        $data->biografia = $request->biografia;

        $dttime=date('ymdHis');

        //upload photo to drive
        $photo = $request->image;
        if(!empty($photo)){
            //$img = $_POST['image'];
            $folderPath = "filephoto/";
            
            $image_parts = explode(";base64,", $photo);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            
            $image_base64 = base64_decode($image_parts[1]);
            $fileName = uniqid() . '.png';
            
            $file = $folderPath . $fileName;
            file_put_contents($file, $image_base64);

            
            /*//print_r($fileName);
            

*/

            //$new_name = $no_militante.'_'.$dttime.'.'.$photo->extension();
            //$photo->move('filephoto/',$new_name);
                    
            $data->photo = $fileName;
        }

        //upload photo to drive
        $finger = $request->file('filefinger');
        if(!empty($finger)){
            $new_name_finger = $no_militante.'_'.$dttime.'.'.$finger->extension();
            $finger->move('filefinger/',$new_name_finger);
                    
            $data->finger = $new_name_finger;
        }

        //upload photo to drive
        $signature = $request->filesignature;
        if(!empty($signature)){
            $new_name_signature = $no_militante.'_'.$dttime.'.'.$signature->extension();
            $signature->move('filesignature/',$new_name_signature);
                    
            $data->signature = $new_name_signature;
        }


        $data->save();

        //REGISTER MILITANTE
        $characters_on_image = 8;
        $possible_letters = '234567890ABCDEFGHIJKLMNPQRSTUVWXYZ';

        $code = '';
        $i = 0;
        while ($i < $characters_on_image) { 
          $code .= substr($possible_letters, mt_rand(0, strlen($possible_letters)-1), 1);
          $i++;
        }

        $data1=DB::table('register_militante')
        ->where('kabupaten_id',$request->kabupatentim)
        ->where('kecamatan_id',$request->kecamatantim)
        ->first();

        if(!empty($data1->id)){
            $data2 = new Buletin();
            $data2->register_id = $data1->id;
            $data2->vip = 1;
            $data2->kode_militante = $request->nomilitante;
            $data2->no_segel=$code;
            $data2->save();
        }



		echo json_encode(array("status"=>TRUE));
	}



	public function update(Request $request)
	{
        $id = $request->id;
        $kabupatentim = $request->kabupatentim;
        $kecamatantim = $request->kecamatantim;
        $kelurahantim = $request->kelurahantim;
        $desatim = $request->tpstim;
        $nomilitante = $request->nomilitante;
        $tanggal = $request->tanggal;
        $noelektor = $request->noelektor;
        $status = $request->statusmilitante;
        $tanggalterbit = $request->tanggalterbit;
        $validuntil = $request->validuntil;

        $validuntil = $request->validuntil;
        $nama = $request->nama;
        $tempatlahir = $request->tempatlahir;
        //$tgllahir = $request->tgllahir;
        $tgllahir = $request->thn.'-'.$request->bln.'-'.$request->tgl;
        
        $usia = $request->usia;
        
        $jeniskelamin = $request->jeniskelamin;
        
        $agama = $request->agama;
        $namaayah = $request->namaayah;
        $namaibu = $request->namaibu;
        $alamat = $request->alamat;
        $telepon = $request->telepon;
        $email = $request->email;
        $keterangan = $request->keterangan;

        $periode = $request->periode;
        $jabatan = $request->jabatan;
        $pendidikan = $request->pendidikan;
        $jurusan = $request->jurusan;
        $universitas = $request->universitas;
        $profesi = $request->profesi;
        $tglinput = $request->tglinput;
        
        $tgledit = $request->tgledit;
        $oprinput = $request->oprinput;
        $opredit = $request->opredit;
        $distrikinput = $request->distrikinput;
        $cetakkartu = $request->cetakkartu;
        
        $dataku = new Militante();
        $data=$dataku->find($id);
        $data->kabupaten_id = $request->kabupatentim;
        $data->kecamatan_id = $request->kecamatantim;
        $data->kelurahan_id = $request->kelurahantim;
        $data->desa_id = $request->tpstim;
        $data->no_militante = $request->nomilitante;
        $data->tanggal = $request->tanggal;
        $data->no_elektor = $request->noelektor;
        $data->status = $request->statusmilitante;
        $data->tgl_terbit = $request->tanggalterbit;
        $data->valid_until = $request->validuntil;

        $data->nama = $request->nama;
        $data->tempat_lahir = $request->tempatlahir;
        $data->tgl_lahir = $request->thn.'-'.$request->bln.'-'.$request->tgl;
        
        $data->usia = $request->usia;
        
        $data->jenis_kelamin = $request->jeniskelamin;
        
        $data->agama = $request->agama;
        $data->nama_ayah = $request->namaayah;
        $data->nama_ibu = $request->namaibu;
        $data->alamat = $request->alamat;
        $data->telepon = $request->telepon;
        $data->email = $request->email;
        $data->keterangan = $request->keterangan;

        $data->periode = $request->periode;
        $data->jabatan_id = $request->jabatan;
        $data->pendidikan_id = $request->pendidikan;
        $data->jurusan = $request->jurusan;
        $data->universitas = $request->universitas;
        $data->tahunlulus = $request->tahunlulus;
        $data->profesi_id = $request->profesi;
        $data->tgl_input = $request->tglinput;
        
        $data->tgl_edit = $request->tgledit;
        $data->opr_input = $request->oprinput;
        $data->opr_edit = $request->opredit;
        $data->distrik_input = $request->distrikinput;
        $data->cetak_kartu = $request->cetakkartu;

        $data->observasaun = $request->observasaun;
        $data->esperiancia = $request->esperiancia;
        $data->biografia = $request->biografia;


        //upload photo to drive
        $photo = $request->image;
        if(!empty($photo)){
            //$img = $_POST['image'];
            $folderPath = "filephoto/";
            
            $image_parts = explode(";base64,", $photo);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            
            $image_base64 = base64_decode($image_parts[1]);
            $fileName = uniqid() . '.png';
            
            $file = $folderPath . $fileName;
            file_put_contents($file, $image_base64);

            
            /*//print_r($fileName);
            

*/

            //$new_name = $no_militante.'_'.$dttime.'.'.$photo->extension();
            //$photo->move('filephoto/',$new_name);
                    
            $data->photo = $fileName;
        }

        $data->save();

		echo json_encode(array("status"=>TRUE));
	}



	public function updateaction(Request $request)
	{
        $name = $request->name;
        $value = $request->value;

        $dataku = new Militante();
        $data=$dataku->find($request->id);
        $data->name = $name;
        $data->value = $value;
        $data->save();
        echo json_encode(array("status"=>TRUE));
	}
	public function delete($id)
	{
        $dataku = new Militante();
        $data = $dataku->find($id);
        $data->delete();
		echo json_encode(array("status"=>TRUE));
	}

    
    
	public function edit($id)
	{ 
            $judulhalaman = 'Militante';
            $judulmodul = 'Militante';


            $query =  DB::table('militante')
            ->select(['militante.*','kabupaten.idkabupaten as kabupaten_id','kabupaten.nama_district as kabupaten_name',
            'kecamatan.idkecamatan as kecamatan_id','kecamatan.nama_subdistrict as kecamatan_name',
            'kelurahan.idkelurahan as kelurahan_id','kelurahan.nama_suco as kelurahan_name',
            'tps.idtps as desa_id','tps.nama_aldeia as desa_name',])
            ->leftJoin('kabupaten','kabupaten.idkabupaten','=','militante.kabupaten_id')
            ->leftJoin('kecamatan','kecamatan.kode_subdistrict','=','militante.kecamatan_id')
            ->leftJoin('kelurahan','kelurahan.kode_suco','=','militante.kelurahan_id')
            ->leftJoin('tps','tps.kode_aldeia','=','militante.desa_id')
            ->where('id',$id)->get();
            return view('militante/militante_edit',compact('judulmodul','judulhalaman','query','id'));
	}

    

//--------------- REGISTER --------------------------------------------------------------
    public function register() {
        if(!Session::get('username')){
            redirect('/');
        } else {
            $judulhalaman = 'Register No Militante';
            $judulmodul = 'Register No Militante';


            $query =  DB::table('militante')
            ->select(['militante.*','kabupaten.idkabupaten as kabupaten_id','kabupaten.nama_district as kabupaten_name',
            'kecamatan.idkecamatan as kecamatan_id','kecamatan.nama_subdistrict as kecamatan_name',
            'kelurahan.idkelurahan as kelurahan_id','kelurahan.nama_suco as kelurahan_name',
            'tps.idtps as desa_id','tps.nama_aldeia as desa_name',])
            ->leftJoin('kabupaten','kabupaten.idkabupaten','=','militante.kabupaten_id')
            ->leftJoin('kecamatan','kecamatan.kode_subdistrict','=','militante.kecamatan_id')
            ->leftJoin('kelurahan','kelurahan.kode_suco','=','militante.kelurahan_id')
            ->leftJoin('tps','tps.kode_aldeia','=','militante.desa_id')
            ->orderBy('id','DESC')->get();
            return view('militante/militante_register',compact('judulmodul','judulhalaman'));
        }
    }
    
	public function registeredit($id)
	{ 
            $judulhalaman = 'Edit Register No.Militante';
            $judulmodul = 'Edit Register No.Militante';



            $register =  DB::table('register_militante')
            ->select(['register_militante.*','kabupaten.idkabupaten as kabupaten_id','kabupaten.nama_district as kabupaten_name',
            'kecamatan.idkecamatan as kecamatan_id','kecamatan.nama_subdistrict as kecamatan_name'])
            ->leftJoin('kabupaten','kabupaten.kode_district','=','register_militante.kabupaten_id')
            ->leftJoin('kecamatan','kecamatan.kode_subdistrict','=','register_militante.kecamatan_id')
            ->where('id','=',$id)->first();
            return view('militante/militante_register_edit',compact('judulmodul','judulhalaman','register','id'));
	}

    public function ajax_list()
    {
        $query = DB::table('kabupaten')->orderBy('urut_no_distrik','ASC')->get();
        $data = array();
        $no = 0;
        foreach ($query as $kabupaten) {
            $no++;
            $row = array();
            $row[] = $kabupaten->urut_district;
            $row[] = $kabupaten->nama_district;
            $row[] = $kabupaten->urut_no_distrik;
            $data[] = $row;
        }

        $output = array(
            "draw" => 1,
            "recordsTotal" => $no,
            "recordsFiltered" => $no,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
    
   
	public function saveregister(Request $request)
	{
        
        $data = new RegisterMilitante();
        $data->kabupaten_id = $request->kabupatentim;
        $data->kecamatan_id = $request->kecamatantim;

        $data->no_bukti = $request->nobukti;
        $data->tanggal = $request->tanggal;
        $data->vip = $request->vip;
        $data->no_buletin1 = $request->buletin1;
        $data->no_buletin2 = $request->buletin2;
        $data->keterangan = $request->keterangan;
                    
        $data->save();
       
		echo json_encode(array("status"=>TRUE));
    }

    
	public function updateregister(Request $request)
	{
        
        $data = DB::table('register_militante')
        ->where('id','=',$request->id)
        ->update(['no_buletin1' => $request->buletin1,
                'no_buletin2' => $request->buletin2,
                'keterangan' => $request->keterangan]);     
               
		echo json_encode(array("status"=>TRUE));
       
    }

    
	public function searchno($id)
	{
        //$kabupaten=$request->kabupaten;
        $kecamatan=substr($id,0,4);
        $kabupaten=substr($id,0,2);
        //$vip=$request->vip;
        
        //$kabupaten="13";
        //$kecamatan="1301";
        $vip=1;

        $data = DB::table('register_militante')
        ->select(['register_militante.*','register_buletin.kode_militante'])
        ->leftJoin('register_buletin','register_buletin.register_id','=','register_militante.id')
        ->where('register_militante.kabupaten_id','=',$kabupaten)
        ->where('register_militante.kecamatan_id','=',$kecamatan)
        ->where('register_militante.vip','=',$vip)
        ->orderBy('register_buletin.kode_militante','DESC')
        ->limit(1)
        ->get(); 

        $datakab = DB::table('kabupaten')
        ->select(['urut_no_distrik'])
        ->where('kode_district',$kabupaten)
        ->get();


        $str_kodemilitante='';
        $urut=0;
        foreach ($datakab as $querykab) {
            if($querykab->urut_no_distrik>0) {
                $urut=$querykab->urut_no_distrik;
                if($urut<10) $urut='0'.$urut;
            }
        }
        foreach ($data as $query) {
            //$urut=$query->urut_no_district;

            $no1=$query->no_buletin1;
            $no2=$query->no_buletin2;
           
            $kodemilitante=substr($query->kode_militante,3,6);
            if(!empty($kodemilitante)) $kodemilitante=$kodemilitante+1;
            if(empty($kodemilitante)) $kodemilitante=$no1;

            if($kodemilitante>$no2) $kodemilitante='';
            else {
                if($kodemilitante<10) $str_kodemilitante=$urut."00000".$kodemilitante;
                else if($kodemilitante<100) $str_kodemilitante=$urut."0000".$kodemilitante;
                else if($kodemilitante<1000) $str_kodemilitante=$urut."000".$kodemilitante;
                else if($kodemilitante<10000) $str_kodemilitante=$urut."00".$kodemilitante;
                else if($kodemilitante<100000) $str_kodemilitante=$urut."0".$kodemilitante;
                else $str_kodemilitante=$urut.$kodemilitante;
            }
        }




        echo $str_kodemilitante;

    }

	public function registerdelete($id)
	{
        $dataku = new RegisterMilitante();
        $data = $dataku->find($id);
        $data->delete();
		echo json_encode(array("status"=>TRUE));
	}
    
    public function listregister() {
        if(!Session::get('username')){
            redirect('/');
        } else {
            $judulhalaman = 'List of Register Militante';
            $judulmodul = 'List of Register Militante';


            $query =  DB::table('register_militante')
            ->select(['register_militante.*','kabupaten.idkabupaten as kabupaten_id','kabupaten.nama_district as kabupaten_name',
            'kecamatan.idkecamatan as kecamatan_id','kecamatan.nama_subdistrict as kecamatan_name'])
            ->leftJoin('kabupaten','kabupaten.kode_district','=','register_militante.kabupaten_id')
            ->leftJoin('kecamatan','kecamatan.kode_subdistrict','=','register_militante.kecamatan_id')
            ->orderBy('id','DESC')->get();
            return view('militante/militante_register_list',compact('judulmodul','judulhalaman','query'));
        }
    }

    public function listbuletin($id) {
        if(!Session::get('username')){
            redirect('/');
        } else {
            $judulhalaman = 'List of Buletin';
            $judulmodul = 'List of Buletin';

            $query =  DB::table('register_buletin')
            ->select(['register_buletin.*','militante.nama as nama1','militantediaspora.nama as nama2','militantevip.nama as nama3','militante.no_elektor as elektor1','militantediaspora.no_elektor as elektor2','militantevip.no_elektor as elektor3'])
            ->leftJoin('militante','militante.no_militante','=','kode_militante')
            ->leftJoin('militantediaspora','militantediaspora.no_militante','=','kode_militante')
            ->leftJoin('militantevip','militantevip.no_militante','=','kode_militante')
            ->where('register_id','=',$id)
            ->groupBy('kode_militante')
            ->orderBy('id','ASC')->get();
            return view('militante/militante_buletin_list',compact('judulmodul','judulhalaman','query'));
        }
    }

//end of class
}
