<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Validator;

class DashboardController extends Controller
{
    public function index() {
        if(!Session::get('username')){
            return redirect('/');
        } else {
            $judulhalaman = 'Dashboard ';
            $judulmodul = 'Dashboard ';
            $totalrelawan = DB::table('relawan')->count();
            $totalkoordinator = DB::table('koordinator')->count();
            $totalpemilih = DB::table('pemilih')->count();
            $totaldpt = DB::table('dpt')->where('statusdpt',1)->count();
            $totaldptbelum = DB::table('dpt')->where('statusdpt',0)->count();
            $totallaki= DB::table('dpt')->where('jkdpt','L')->count();
            $totalperempuan= DB::table('dpt')->where('jkdpt','P')->count();
            $totaltarget = DB::table('target')
                            ->select('jumlahsuara')
                            ->first();

            $totalfiscais = DB::table('saksi')->count();

            $totalmilitante = DB::table('militante')->count();
            $totalmilitantevip = DB::table('militantevip')->count();
            $totalmilitantediaspora = DB::table('militantediaspora')->count();

            return view('dashboard.home',compact('judulhalaman','judulmodul','totalrelawan','totalkoordinator',
            'totalpemilih','totaldpt','totaldptbelum','totallaki','totalperempuan','totaltarget',
            'totalfiscais','totalmilitante','totalmilitantevip','totalmilitantediaspora'));
        }
    }

    public function tablekabupaten() {
        $judulhalaman = 'Dashboard ';
        return view('tablekabupaten',compact('judulhalaman'));
    }

    public function tablekecamatan() {
        $judulhalaman = 'Dashboard ';
        return view('tablekecamatan',compact('judulhalaman'));
    }

    public function tablekelurahan() {
        $judulhalaman = 'Dashboard ';
        return view('tablekelurahan',compact('judulhalaman'));
    }

    public function tabletps() {
        $judulhalaman = 'Dashboard ';
        return view('tabletps',compact('judulhalaman'));
    }

}
