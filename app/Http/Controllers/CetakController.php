<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estatuto;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class CetakController extends Controller
{
    public function cetakumakain($id) {
        if(!Session::get('username')){
            redirect('/');
        } else {
            $judulhalaman = 'Cetak Uma Kain';
            $judulmodul = 'Cetak Uma Kain';

            
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


            return view('cetak/umakain_cetak',compact('judulmodul','judulhalaman','query','id','detail'));
        }
    }


    public function cetakmilitante($id) {
        if(!Session::get('username')){
            redirect('/');
        } else {
            $judulhalaman = 'Cetak Militante';
            $judulmodul = 'Cetak Militante';

            //$data =  DB::table('estatuto')->orderBy('id','DESC')->get();
            
            $data =  DB::table('militante')
            ->select(['militante.*','kabupaten.idkabupaten as kabupaten_id','kabupaten.nama_district as kabupaten_name',
            'kecamatan.idkecamatan as kecamatan_id','kecamatan.nama_subdistrict as kecamatan_name',
            'kelurahan.idkelurahan as kelurahan_id','kelurahan.nama_suco as kelurahan_name',
            'tps.idtps as desa_id','tps.nama_aldeia as desa_name',])
            ->leftJoin('kabupaten','kabupaten.idkabupaten','=','militante.kabupaten_id')
            ->leftJoin('kecamatan','kecamatan.kode_subdistrict','=','militante.kecamatan_id')
            ->leftJoin('kelurahan','kelurahan.kode_suco','=','militante.kelurahan_id')
            ->leftJoin('tps','tps.kode_aldeia','=','militante.desa_id')
            ->where('id',$id)->get();

            return view('cetak/militante_cetak',compact('judulmodul','judulhalaman','data','id'));
        }
    }


    public function cetakmilitantediaspora($id) {
        if(!Session::get('username')){
            redirect('/');
        } else {
            $judulhalaman = 'Cetak Militante';
            $judulmodul = 'Cetak Militante';

            //$data =  DB::table('estatuto')->orderBy('id','DESC')->get();
            
            $data =  DB::table('militantediaspora')
            ->select(['militantediaspora.*','kabupaten.idkabupaten as kabupaten_id','kabupaten.nama_district as kabupaten_name',
            'kecamatan.idkecamatan as kecamatan_id','kecamatan.nama_subdistrict as kecamatan_name'])
            ->leftJoin('kabupaten','kabupaten.idkabupaten','=','militantediaspora.kabupaten_id')
            ->leftJoin('kecamatan','kecamatan.kode_subdistrict','=','militantediaspora.kecamatan_id')
            ->where('id',$id)->get();

            return view('cetak/militantediaspora_cetak',compact('judulmodul','judulhalaman','data','id'));
        }
    }


    
    public function cetakmilitantevip($id) {
        if(!Session::get('username')){
            redirect('/');
        } else {
            $judulhalaman = 'Cetak Militante';
            $judulmodul = 'Cetak Militante';

            //$data =  DB::table('estatuto')->orderBy('id','DESC')->get();
            
            $data =  DB::table('militantevip')
            ->select(['militantevip.*','kabupaten.idkabupaten as kabupaten_id','kabupaten.nama_district as kabupaten_name',
            'kecamatan.idkecamatan as kecamatan_id','kecamatan.nama_subdistrict as kecamatan_name',
            'kelurahan.idkelurahan as kelurahan_id','kelurahan.nama_suco as kelurahan_name',
            'tps.idtps as desa_id','tps.nama_aldeia as desa_name',])
            ->leftJoin('kabupaten','kabupaten.idkabupaten','=','militantevip.kabupaten_id')
            ->leftJoin('kecamatan','kecamatan.kode_subdistrict','=','militantevip.kecamatan_id')
            ->leftJoin('kelurahan','kelurahan.kode_suco','=','militantevip.kelurahan_id')
            ->leftJoin('tps','tps.kode_aldeia','=','militantevip.desa_id')
            ->where('id',$id)->get();

            return view('cetak/militantevip_cetak',compact('judulmodul','judulhalaman','data','id'));
        }
    }


//end of class
}
