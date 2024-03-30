<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UmaKain;
use App\Models\UmaKainDetail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class UmakainController extends Controller
{
    public function index() {
        if(!Session::get('username')){
            redirect('/');
        } else {
            $judulhalaman = 'Uma Kain';
            $judulmodul = 'Uma Kain';


            //$data =  DB::table('literaria')->orderBy('id','DESC')->get();
            return view('umakain/umakain_index',compact('judulmodul','judulhalaman'));
        }
    }

    public function edit($id) {
        if(!Session::get('username')){
            redirect('/');
        } else {
            $judulhalaman = 'Uma Kain';
            $judulmodul = 'Uma Kain';


            $query =  DB::table('umakain')
            ->select(['umakain.*','kabupaten.nama_district','kecamatan.nama_subdistrict','kelurahan.nama_suco','tps.nama_aldeia'])
            ->leftJoin('kabupaten','kabupaten.kode_district','=','umakain.municipio_id')
            ->leftJoin('kecamatan','kecamatan.kode_subdistrict','=','umakain.posto_id')
            ->leftJoin('kelurahan','kelurahan.kode_suco','=','umakain.suco_id')
            ->leftJoin('tps','tps.kode_aldeia','=','umakain.aldeia_id')
            ->where('id',$id)->get();

            foreach ($query as $umakain) {
                $numeru=$umakain->numeru_database;
            }
            $detail =  DB::table('umakain_detail')
            ->where('numeru_database',$numeru)->get();

            return view('umakain/umakain_edit',compact('judulmodul','judulhalaman','query','detail'));
        }
    }

    public function list() {
        if(!Session::get('username')){
            redirect('/');
        } else {
            $judulhalaman = 'Uma Kain';
            $judulmodul = 'Uma Kain';


            $query =  DB::table('umakain')->orderBy('id','DESC')->get();
            return view('umakain/umakain_list',compact('judulmodul','judulhalaman','query'));
        }
    }

	public function save(Request $request)
	{
        $judulhalaman = 'Uma Kain';
        $judulmodul = 'Uma Kain';


        if(!empty($request->nudatabase1)) {    
            $data = new UmaKain();
            $data->municipio_id = $request->kabupatentim;
            $data->posto_id = $request->kecamatantim;
            $data->suco_id = $request->kelurahantim;
            $data->aldeia_id = $request->tpstim;

            $data->altitude = $request->altitude;
            $data->long_altitude = $request->longitude;

            $data->numeru_database = $request->nudatabase1;
            $data->numeru_registru = $request->numerusensus;
            $data->numeru_database = $data->numeru_database.$request->nudatabase2;
            $data->numeru_registru = $data->numeru_registru.$request->numerusensu2;

            $data->data_assinatura = $request->dataz;
            $data->celula = $request->celula;

            $data->hela = $request->hela;
            $data->chefe_familia = $request->chefe;
            $data->militante_responsavel = $request->respon;
            
            $data->naran = $request->naran;
            $data->kontaknaran = $request->kontaknaran;
            $data->tgl_cetak = $request->tanggalcetak;
            
            $data->tgl_cetak = $request->tanggalcetak;
            $data->coordenador = $request->coor;
            $data->no_kontaktu_coordenador = $request->kontakcoor;

            $data->ajente = $request->ajente;
            $data->no_kontaktu_ajente = $request->kontakajente;

            $data->save();
            $id=$data->id;

            echo json_encode(array("status"=>TRUE,"id"=>$id));
        } else {
            echo json_encode(array("status"=>FALSE));
        }
        
       // $query =  DB::table('umakain')->where('id',$id)->orderBy('id','DESC')->get();
       // return view('umakain/umakain_edit',compact('judulmodul','judulhalaman','query','id'));
	}
    public function savemilitante(Request $request)
	{
        $judulhalaman = 'Uma Kain';
        $judulmodul = 'Uma Kain';


        if(!empty($request->idno)) {    

            $cari=DB::table('militante')->where('no_militante',$request->nomilitante)->first();
            if(empty($cari->nama)) {
                $cari=DB::table('militantevip')->where('no_militante',$request->nomilitante)->first();
                if(empty($cari->nama)) {
                    $cari=DB::table('militantediaspora')->where('no_militante',$request->nomilitante)->first();
                }
            }
            $jenis_kelamin=$cari->jenis_kelamin;
            if($jenis_kelamin=='L') $jenis_kelamin=1;
            else $jenis_kelamin=2;
            $tgl_lahir=$cari->tgl_lahir;
            $no_elektor=$cari->no_elektor;
            $tempat_lahir=$cari->tempat_lahir;
            $telepon=$cari->telepon;
            $periode=$cari->periode;


            $data = new UmaKainDetail();
            $data->numeru_database = $request->idno;
            $data->data_2 = $request->nama; //
            $data->data_3 = $request->relfamilia;
            $data->data_4 = $jenis_kelamin; //
            $data->data_5 = $tgl_lahir; //
            $data->data_6 = $no_elektor; //
            $data->data_7 = $tempat_lahir; //
            $data->data_8 = $telepon; //
            $data->data_9 = $request->nomilitante;
            $data->data_10 = $request->tinan; //
            $data->data_11 = $request->aktnilitante;
            $data->data_12 = $request->kargoaktual;
            $data->data_13 = $request->sectorservico;
            $data->data_14 = $request->profisaun;
            $data->data_15 = $request->literaria;
            $data->data_16 = $request->estatuto;
            $data->data_17 = $request->membru;

            $data->save();
            $id=$data->id;

            echo json_encode(array("status"=>TRUE,"id"=>$id));
        } else {
            echo json_encode(array("status"=>FALSE));
        }
        
       // $query =  DB::table('umakain')->where('id',$id)->orderBy('id','DESC')->get();
       // return view('umakain/umakain_edit',compact('judulmodul','judulhalaman','query','id'));
	}


	public function update($id)
	{
        $dataku = new literaria();
		$data=DB::table('literaria')->find($id);
		echo json_encode($data);
	}

	public function searchid($id)
	{
		$data=DB::table('kabupaten')->where('kode_district',$id)->first();
        $str=$data->kode_umakain;

        $data=DB::table('umakain')->where('municipio_id',$id)->where('numeru_database',$str)->first();

        if(!empty($data->numeru_registru)) {
            $no=$data->numeru_registru;
            if(empty($no)) $no=1;
            else $no++;
        } else {
            $no=1;
        }

        if($no<10) $strno="0000".$no;
        else if($no<100) $strno="000".$no;
        else if($no<1000) $strno="00".$no;
        else if($no<10000) $strno="0".$no;
        else $strno=$no;
		echo $str."-".$strno;
	}
    
	public function searchnama($id)
	{
		$data=DB::table('militante')->where('no_militante',$id)->first();
		echo $data->nama;
	}

    
	public function updateaction(Request $request)
	{
        $name = $request->name;
        $value = $request->value;

        $dataku = new literaria();
        $data=$dataku->find($request->id);
        $data->name = $name;
        $data->value = $value;
        $data->save();
        echo json_encode(array("status"=>TRUE));
	}
	public function delete($id)
	{
        $dataku = new UmaKain();
        $data = $dataku->find($id);
        $data->delete();
		echo json_encode(array("status"=>TRUE));
	}

//end of class
}
