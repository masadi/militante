<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaturan;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class PengaturanController extends Controller
{
    public function index() {
        if(!Session::get('username')){
            redirect('/');
        } else {
            $judulhalaman = 'Pengaturan';
            $judulmodul = 'Pengaturan';
            //$pengaturan = new Pengaturan();
            //$listpengaturan = $pengaturan->get();
            return view('pengaturan/pengaturan_index',compact('judulmodul','judulhalaman'));
        }
    }

/*
	public function indexx()
	{
		if($this->session->userdata('logged_in')!=TRUE){
			redirect('login','refresh');
		}else {

				$this->data['koordinator']='';
				$this->data['relawan']='';
				$this->data['kegiatancalon']='';
				$this->data['kp']='';
				$this->data['tr']='';
				$this->data['keluarga']='';
				$this->data['isu']='';
				$this->data['listpengaturan']=$this->Pengaturan_m->tampil();
				$this->data['pengguna']='';
				$this->data['target']='';
				$this->data['quick']='';
				$this->data['pengaturan']='active';
				$this->data['pemilih']='';
				$this->data['calon']='';
				$this->data['analisa']='';
				$this->data['hitung']='';
				$this->data['saksi']='';
				$this->data['daerah']='';
				$this->data['sms']='';
				$this->data['dpt']='';
				$this->data['notifikasi']='';
				$this->data['tim']='';
				$this->data['biaya']='';
				$this->data['event']='';
		$this->data['listpengaturan']=$this->Pengaturan_m->tampil();
		$this->data['halaman']='vpengaturan';
		$this->load->view('_main',$this->data);
	}
	}
    */
	public function simpan(Request $request)
	{
		$username = Session::get('username');
        if(!$username){
			return redirect('/');
        }

		//$validatedData = $request->validate([
		//	'namaaplikasi' => ['required|strip_tags'],
		//	'footeraplikasi' => ['required|strip_tags'],

		//]);


        $namaaplikasi = $request->namaaplikasi;
        $footeraplikasi = $request->footeraplikasi;
        $deskripsiaplikasi = $request->deskripsiaplikasi;
        $hpaplikasi = $request->hpaplikasi;
        $alamataplikasi = $request->alamataplikasi;


        $pengaturanku = new Pengaturan();
        $pengaturan = $pengaturanku->find(0);
        $pengaturan->namaaplikasi = $namaaplikasi;
        $pengaturan->footeraplikasi = $footeraplikasi;
        $pengaturan->deskripsiaplikasi = $deskripsiaplikasi;
        $pengaturan->hpaplikasi = $hpaplikasi;
        $pengaturan->alamataplikasi = $alamataplikasi;
        $pengaturan->save();

		return redirect('pengaturan');
	}
//end of class
}
