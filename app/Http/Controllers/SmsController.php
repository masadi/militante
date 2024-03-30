<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sms;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class SmsController extends Controller
{
    public function index() {
        if(!Session::get('username')){
            redirect('/');
        } else {
            $judulhalaman = 'Api';
            $judulmodul = 'Api';
            $api = new Api();
            $query = $api->orderBy('id','DESC')->get();
            return view('api/api_index',compact('query','judulmodul','judulhalaman'));
        }
    }


	public function kirimsms($no_hp)
	{
		if (!is_numeric($no_hp))
		{
			redirect('phonebook');
		}
		if(!Session::get('username'))
		{
			redirect('/');
		}else
		{
			//$this->data['Settinglist']=$this->Setting_m->tampil();
			//$this->data['getid']=$this->Phonebook_m->getidbyphone($no_hp);
			//$this->data['halaman']='vkirim';
			//$this->load->view('_main',$this->data);

            echo json_encode(array("status" => TRUE));
		}
	}
	public function send()
	{

		kirim_sms($no_hp,$b);
	}
	public function semuakoordinator()
	{
		/*$this->data['daerah']='';
		$this->data['koordinator']='';
		$this->data['calon']='';
		$this->data['notifikasi']='';
		$this->data['pemilih']='';
		$this->data['analisa']='';
		$this->data['relawan']='';
		$this->data['listpengaturan']=$this->Pengaturan_m->tampil();
		$this->data['kegiatancalon']='';$this->data['pengaturan']='';
		$this->data['quick']='';
		$this->data['dpt']='';
		$this->data['hitung']='';
		$this->data['isu']='';
		$this->data['saksi']='';
		$this->data['kp']='';
		$this->data['tr']='';
		$this->data['keluarga']='';
		$this->data['pengguna']='';
		$this->data['sms']='active';
		$this->data['tim']='';
		$this->data['target']='';
		$this->data['biaya']='';
		$this->data['event']='';
		$this->data['halaman']='vsemuakoordinator';
		$this->load->view('_main',$this->data);*/

        if(!Session::get('username')){
            redirect('/');
        } else {
            $judulhalaman = 'SMS Semua Koordinator';
            $judulmodul = 'SMS Semua Koordinator';
            return view('sms/sms_semuakoordinator',compact('judulmodul','judulhalaman'));
        }
	}

	public function semuapemilih()
	{
		/*$this->data['daerah']='';
		$this->data['koordinator']='';
		$this->data['calon']='';
		$this->data['pemilih']='';
		$this->data['analisa']='';
		$this->data['dpt']='';
		$this->data['hitung']='';
		$this->data['pengguna']='';
		$this->data['relawan']='';
		$this->data['listpengaturan']=$this->Pengaturan_m->tampil();
		$this->data['kegiatancalon']='';
		$this->data['quick']='';
		$this->data['kp']='';
		$this->data['tr']='';
		$this->data['keluarga']='';
		$this->data['saksi']='';
		$this->data['sms']='active';
		$this->data['tim']='';
		$this->data['pengaturan']='';
		$this->data['target']='';
		$this->data['isu']='';
		$this->data['biaya']='';
		$this->data['event']='';
		$this->data['notifikasi']='';
		$this->data['halaman']='vsemuapemilih';
		$this->load->view('_main',$this->data);*/

        if(!Session::get('username')){
            redirect('/');
        } else {
            $judulhalaman = 'SMS Semua Pemilih';
            $judulmodul = 'SMS Semua Pemilih';
            return view('sms/sms_semuapemilih',compact('judulmodul','judulhalaman'));
        }
	}
	public function aksikoordinator(Request $request)
	{
		/*$ab=$this->Koordinator_m->getno_hp();

		$isi=$this->input->post('isi');

		foreach($ab as $nomor)
		{
			$av=str_replace('{nama}', $nomor->nama, $isi);
			kirim_sms($nomor->hp,$av);
		}
		$this->session->set_flashdata("pesan","<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">Sukses!</div></div>");
		$this->data['daerah']='';
		$this->data['koordinator']='';
		$this->data['pemilih']='';
		$this->data['analisa']='';
		$this->data['dpt']='';
		$this->data['listpengaturan']=$this->Pengaturan_m->tampil();
		$this->data['hitung']='';
		$this->data['quick']='';
		$this->data['target']='';
		$this->data['isu']='';
		$this->data['pengaturan']='';
		$this->data['kp']='';
		$this->data['tr']='';
		$this->data['keluarga']='';
		$this->data['saksi']='';
		$this->data['sms']='active';
		$this->data['tim']='';
		$this->data['relawan']='';
		$this->data['kegiatancalon']='';
		$this->data['biaya']='';
		$this->data['calon']='';
		$this->data['notifikasi']='';
		$this->data['event']='';
		$this->data['pengguna']='';
		$this->data['halaman']='vsemuakoordinator';
		$this->load->view('_main',$this->data);*/


        $data = DB::table('user')
                ->where('level','=','koordinator')
                ->orderby('hp', 'ASC')
                ->get();

        $isi=$request->isi;

        foreach($data as $nomor) {
            $av=str_replace('{nama}', $nomor->nama, $isi);
            kirim_sms($nomor->hp,$av);
        }

	}
	public function aksipemilih(Request $request)
	{
		/*$ab=$this->Pemilih_m->getno_hp();

		$isi	=$this->input->post('isi');
		foreach($ab as $nomor)
		{
			$av=str_replace('{nama}', $nomor->namapemilih, $isi);
			kirim_sms($nomor->hp,$av);
		}
		$this->session->set_flashdata("pesan","<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">Sukses!</div></div>");
		$this->data['daerah']='';
		$this->data['koordinator']='';
		$this->data['pemilih']='';
		$this->data['relawan']='';
		$this->data['kegiatancalon']='';
		$this->data['analisa']='';
		$this->data['saksi']='';
		$this->data['hitung']='';
		$this->data['listpengaturan']=$this->Pengaturan_m->tampil();
		$this->data['dpt']='';
		$this->data['pengaturan']='';
		$this->data['quick']='';
		$this->data['sms']='active';
		$this->data['target']='';
		$this->data['isu']='';
		$this->data['tim']='';
		$this->data['biaya']='';
		$this->data['kp']='';
		$this->data['tr']='';
		$this->data['keluarga']='';
		$this->data['notifikasi']='';
		$this->data['event']='';
		$this->data['pengguna']='';
		$this->data['calon']='';
		$this->data['halaman']='vsemuapemilih';
		$this->load->view('_main',$this->data);*/


        $data = DB::table('pemilih')
                ->orderby('hp', 'ASC')
                ->get();

        $isi=$request->isi;

        foreach($data as $nomor) {
            $av=str_replace('{nama}', $nomor->namapemilih, $isi);
            kirim_sms($nomor->hp,$av);
        }



	}
	public function groupkoordinator()
	{

		/*$this->data['listprovinsi']=$this->Provinsi_m->getallkecamatan();
		$this->data['daerah']='';
		$this->data['koordinator']='';
		$this->data['pemilih']='';
		$this->data['analisa']='';
		$this->data['listpengaturan']=$this->Pengaturan_m->tampil();
		$this->data['hitung']='';
		$this->data['saksi']='';
		$this->data['relawan']='';
		$this->data['sms']='active';
		$this->data['kegiatancalon']='';
		$this->data['kp']='';
		$this->data['tr']='';
		$this->data['keluarga']='';
		$this->data['tim']='';
		$this->data['dpt']='';
		$this->data['quick']='';
		$this->data['biaya']='';
		$this->data['target']='';
		$this->data['isu']='';
		$this->data['calon']='';
		$this->data['pengguna']='';
		$this->data['notifikasi']='';
		$this->data['event']='';
		$this->data['halaman']='vgroupkoordinator';
		$this->load->view('_main',$this->data);*/

        if(!Session::get('username')){
            redirect('/');
        } else {
            $judulhalaman = 'SMS Semua Koordinator';
            $judulmodul = 'SMS Semua Koordinator';
            return view('sms/sms_groupkoordinator',compact('judulmodul','judulhalaman'));
        }
	}
	public function groupkoordinatorkabupaten()
	{

		/*$this->data['listkabupaten']=$this->Kabupaten_m->getallkabupaten();
		$this->data['daerah']='';
		$this->data['koordinator']='';
		$this->data['pemilih']='';
		$this->data['listpengaturan']=$this->Pengaturan_m->tampil();
		$this->data['analisa']='';
		$this->data['pengguna']='';
		$this->data['hitung']='';
		$this->data['pengaturan']='';
		$this->data['notifikasi']='';
		$this->data['target']='';
		$this->data['isu']='';
		$this->data['quick']='';
		$this->data['kp']='';
		$this->data['tr']='';
		$this->data['keluarga']='';
		$this->data['dpt']='';
		$this->data['saksi']='';
		$this->data['relawan']='';
		$this->data['kegiatancalon']='';
		$this->data['sms']='active';
		$this->data['tim']='';
		$this->data['biaya']='';
		$this->data['calon']='';
		$this->data['event']='';
		$this->data['halaman']='vgroupkoordinatorkabupaten';
		$this->load->view('_main',$this->data);*/

        if(!Session::get('username')){
            redirect('/');
        } else {
            $judulhalaman = 'SMS Semua Koordinator';
            $judulmodul = 'SMS Semua Koordinator';
            return view('sms/sms_groupkoordinatorkabupaten',compact('judulmodul','judulhalaman'));
        }

	}
	public function groupkoordinatorkecamatan()
	{

		/*$this->data['listkecamatan']=$this->Kecamatan_m->getallkecamatan();
		$this->data['daerah']='';
		$this->data['koordinator']='';
		$this->data['pemilih']='';
		$this->data['listpengaturan']=$this->Pengaturan_m->tampil();
		$this->data['analisa']='';
		$this->data['relawan']='';
		$this->data['isu']='';
		$this->data['kegiatancalon']='';
		$this->data['hitung']='';
		$this->data['dpt']='';
		$this->data['saksi']='';
		$this->data['quick']='';
		$this->data['target']='';
		$this->data['kp']='';
		$this->data['tr']='';
		$this->data['keluarga']='';
		$this->data['calon']='';
		$this->data['pengguna']='';
		$this->data['sms']='active';
		$this->data['tim']='';
		$this->data['pengaturan']='';
		$this->data['notifikasi']='';
		$this->data['biaya']='';
		$this->data['event']='';
		$this->data['halaman']='vgroupkoordinatorkecamatan';
		$this->load->view('_main',$this->data);*/

        if(!Session::get('username')){
            redirect('/');
        } else {
            $judulhalaman = 'SMS Semua Koordinator';
            $judulmodul = 'SMS Semua Koordinator';
            return view('sms/sms_groupkoordinatorkecamatan',compact('judulmodul','judulhalaman'));
        }
	}
	public function groupkoordinatorkelurahan()
	{

		/*$this->data['listkelurahan']=$this->Kelurahan_m->getallkelurahan();
		$this->data['daerah']='';
		$this->data['koordinator']='';
		$this->data['pemilih']='';
		$this->data['analisa']='';
		$this->data['relawan']='';
		$this->data['listpengaturan']=$this->Pengaturan_m->tampil();
		$this->data['isu']='';
		$this->data['kegiatancalon']='';
		$this->data['hitung']='';
		$this->data['saksi']='';
		$this->data['target']='';
		$this->data['dpt']='';
		$this->data['calon']='';
		$this->data['sms']='active';
		$this->data['notifikasi']='';
		$this->data['kp']='';
		$this->data['tr']='';
		$this->data['keluarga']='';
		$this->data['quick']='';
		$this->data['pengguna']='';
		$this->data['tim']='';
		$this->data['pengaturan']='';
		$this->data['biaya']='';
		$this->data['event']='';
		$this->data['halaman']='vgroupkoordinatorkelurahan';
		$this->load->view('_main',$this->data);*/

        if(!Session::get('username')){
            redirect('/');
        } else {
            $judulhalaman = 'SMS Semua Koordinator';
            $judulmodul = 'SMS Semua Koordinator';
            return view('sms/sms_groupkoordinatorkelurahan',compact('judulmodul','judulhalaman'));
        }
	}
	public function grouppemilih()
	{
		/*$this->data['listprovinsi']=$this->Provinsi_m->getallprovinsi();
		$this->data['daerah']='';
		$this->data['koordinator']='';
		$this->data['hitung']='';
		$this->data['kp']='';
		$this->data['tr']='';
		$this->data['listpengaturan']=$this->Pengaturan_m->tampil();
		$this->data['keluarga']='';
		$this->data['notifikasi']='';
		$this->data['dpt']='';
		$this->data['saksi']='';
		$this->data['pemilih']='';
		$this->data['analisa']='';
		$this->data['sms']='active';
		$this->data['relawan']='';
		$this->data['isu']='';
		$this->data['kegiatancalon']='';
		$this->data['pengaturan']='';
		$this->data['tim']='';
		$this->data['quick']='';
		$this->data['target']='';
		$this->data['biaya']='';
		$this->data['event']='';
		$this->data['calon']='';
		$this->data['pengguna']='';
		$this->data['halaman']='vgrouppemilih';
		$this->load->view('_main',$this->data);*/

        if(!Session::get('username')){
            redirect('/');
        } else {
            $judulhalaman = 'SMS Semua Koordinator';
            $judulmodul = 'SMS Semua Koordinator';
            return view('sms/sms_grouppemilih',compact('judulmodul','judulhalaman'));
        }
	}
	public function grouppemilihkabupaten()
	{

		/*$this->data['listkabupaten']=$this->Kabupaten_m->getallkabupaten();
		$this->data['daerah']='';
		$this->data['koordinator']='';
		$this->data['hitung']='';
		$this->data['kp']='';
		$this->data['tr']='';
		$this->data['listpengaturan']=$this->Pengaturan_m->tampil();
		$this->data['keluarga']='';
		$this->data['saksi']='';
		$this->data['calon']='';
		$this->data['relawan']='';
		$this->data['isu']='';
		$this->data['kegiatancalon']='';
		$this->data['dpt']='';
		$this->data['pemilih']='';
		$this->data['analisa']='';
		$this->data['quick']='';
		$this->data['sms']='active';
		$this->data['notifikasi']='';
		$this->data['target']='';
		$this->data['tim']='';
		$this->data['pengaturan']='';
		$this->data['biaya']='';
		$this->data['event']='';
		$this->data['pengguna']='';
		$this->data['halaman']='vgrouppemilihkabupaten';
		$this->load->view('_main',$this->data);*/

        if(!Session::get('username')){
            redirect('/');
        } else {
            $judulhalaman = 'SMS Semua Koordinator';
            $judulmodul = 'SMS Semua Koordinator';
            return view('sms/sms_grouppemilihkabupaten',compact('judulmodul','judulhalaman'));
        }
	}
	public function grouppemilihkecamatan()
	{

		/*$this->data['listkecamatan']=$this->Kabupaten_m->getallkecamatan();
		$this->data['daerah']='';
		$this->data['koordinator']='';
		$this->data['hitung']='';
		$this->data['saksi']='';
		$this->data['pemilih']='';
		$this->data['kp']='';
		$this->data['tr']='';
		$this->data['keluarga']='';
		$this->data['listpengaturan']=$this->Pengaturan_m->tampil();
		$this->data['kegiatancalon']='';
		$this->data['calon']='';
		$this->data['relawan']='';
		$this->data['isu']='';
		$this->data['analisa']='';
		$this->data['dpt']='';
		$this->data['quick']='';
		$this->data['sms']='active';
		$this->data['target']='';
		$this->data['pengaturan']='';
		$this->data['tim']='';
		$this->data['notifikasi']='';
		$this->data['pengguna']='';
		$this->data['biaya']='';
		$this->data['event']='';
		$this->data['halaman']='vgrouppemilihkecamatan';
		$this->load->view('_main',$this->data);*/

        if(!Session::get('username')){
            redirect('/');
        } else {
            $judulhalaman = 'SMS Semua Koordinator';
            $judulmodul = 'SMS Semua Koordinator';
            return view('sms/sms_grouppemilihkecamatan',compact('judulmodul','judulhalaman'));
        }
	}
	public function grouppemilihkelurahan()
	{
		/*$this->data['listkelurahan']=$this->Kabupaten_m->getallkelurahan();
		$this->data['daerah']='';
		$this->data['koordinator']='';
		$this->data['hitung']='';
		$this->data['notifikasi']='';
		$this->data['dpt']='';
		$this->data['saksi']='';
		$this->data['kegiatancalon']='';
		$this->data['target']='';
		$this->data['isu']='';
		$this->data['kp']='';
		$this->data['tr']='';
		$this->data['listpengaturan']=$this->Pengaturan_m->tampil();
		$this->data['keluarga']='';
		$this->data['pemilih']='';
		$this->data['quick']='';
		$this->data['analisa']='';
		$this->data['pengguna']='';
		$this->data['pengaturan']='';
		$this->data['sms']='active';
		$this->data['relawan']='';
		$this->data['calon']='';
		$this->data['tim']='';
		$this->data['biaya']='';
		$this->data['event']='';
		$this->data['halaman']='vgrouppemilihkelurahan';
		$this->load->view('_main',$this->data);*/

        if(!Session::get('username')){
            redirect('/');
        } else {
            $judulhalaman = 'SMS Semua Koordinator';
            $judulmodul = 'SMS Semua Koordinator';
            return view('sms/sms_grouppemilihkelurahan',compact('judulmodul','judulhalaman'));
        }
	}
	public function sendgroupkoordinator (Request $request)
	{
		/*$isi=$this->input->post('isi');
		$k=$this->input->post('daerah');
		$a=$this->Koordinator_m->groupid($k);
		//$ab=$a->hp;
		foreach ($a as $nomor) {
			$av=str_replace('{nama}', $nomor['nama'], $isi);
			kirim_sms($nomor['hp'],$av);
		}
		$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible">
                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Sukses</h4>
                Pesan Berhasil Dikirim.
            </div>');

		redirect('sms/groupkoordinator','refresh');*/


        $isi=$request->isi;
        $daerah=$request->daerah;
        $data = DB::table('koordinator')
                ->where('provinsikoordinator', '=', $daerah)
                ->get();


        foreach($data as $nomor) {
            $av=str_replace('{nama}', $nomor->nama, $isi);
            kirim_sms($nomor->hp,$av);
        }
        redirect('sms/groupkoordinator','refresh');
	}
	public function sendgroupkoordinatorkabupaten ()
	{
		/*$isi=$this->input->post('isi');
		$k=$this->input->post('daerah');
		$a=$this->Koordinator_m->groupidkabupaten($k);
		//$ab=$a->hp;
		foreach ($a as $nomor) {
			$av=str_replace('{nama}', $nomor['nama'], $isi);
			kirim_sms($nomor['hp'],$av);
		}
		$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible">
                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Sukses</h4>
                Pesan Berhasil Dikirim.
            </div>');

		redirect('sms/groupkoordinatorkabupaten','refresh');*/

        $isi=$request->isi;
        $daerah=$request->daerah;
        $data = DB::table('koordinator')
                ->where('kabupatenkoordinator', '=', $daerah)
                ->get();


        foreach($data as $nomor) {
            $av=str_replace('{nama}', $nomor->nama, $isi);
            kirim_sms($nomor->hp,$av);
        }
		redirect('sms/groupkoordinatorkabupaten','refresh');
	}
	public function sendgroupkoordinatorkecamatan ()
	{
		/*$isi=$this->input->post('isi');
		$k=$this->input->post('daerah');
		$a=$this->Koordinator_m->groupidkecamatan($k);
		//$ab=$a->hp;
		foreach ($a as $nomor) {
			$av=str_replace('{nama}', $nomor['nama'], $isi);
			kirim_sms($nomor['hp'],$av);
		}
		$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible">
                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Sukses</h4>
                Pesan Berhasil Dikirim.
            </div>');
        */

        $isi=$request->isi;
        $daerah=$request->daerah;
        $data = DB::table('koordinator')
                ->where('kecamatankoordinator', '=', $daerah)
                ->get();


        foreach($data as $nomor) {
            $av=str_replace('{nama}', $nomor->nama, $isi);
            kirim_sms($nomor->hp,$av);
        }

		redirect('sms/groupkoordinatorkecamatan','refresh');
	}
	public function sendgroupkoordinatorkelurahan ()
	{
		/*$isi=$this->input->post('isi');
		$k=$this->input->post('daerah');
		$a=$this->Koordinator_m->groupidkelurahan($k);
		//$ab=$a->hp;
		foreach ($a as $nomor) {
			$av=str_replace('{nama}', $nomor['nama'], $isi);
			kirim_sms($nomor['hp'],$av);
		}
		$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible">
                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Sukses</h4>
                Pesan Berhasil Dikirim.
            </div>');
        */

        $isi=$request->isi;
        $daerah=$request->daerah;
        $data = DB::table('koordinator')
                ->where('kelurahankoordinator', '=', $daerah)
                ->get();


        foreach($data as $nomor) {
            $av=str_replace('{nama}', $nomor->nama, $isi);
            kirim_sms($nomor->hp,$av);
        }
		redirect('sms/groupkoordinatorkelurahan','refresh');
	}
	public function sendgrouppemilih ()
	{
		/*$isi=$this->input->post('isi');
		$k=$this->input->post('daerah');
		$a=$this->Pemilih_m->groupid($k);
		//$ab=$a->hp;
		foreach ($a as $nomor) {
			$av=str_replace('{nama}', $nomor['namapemilih'], $isi);
			kirim_sms($nomor['hp'],$av);
		}
		$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible">
                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Sukses</h4>
                Pesan Berhasil Dikirim.
            </div>');

		//$this->load->view('_main',$this->data);*/


        $isi=$request->isi;
        $daerah=$request->daerah;
        $data = DB::table('pemilih')
                ->where('provinsipemilih', '=', $daerah)
                ->get();


        foreach($data as $nomor) {
            $av=str_replace('{nama}', $nomor->nama, $isi);
            kirim_sms($nomor->hp,$av);
        }

		redirect('sms/grouppemilih','refresh');
	}
	public function sendgrouppemilihkabupaten ()
	{
		/*$isi=$this->input->post('isi');
		$k=$this->input->post('daerah');
		$a=$this->Pemilih_m->groupidkabupaten($k);
		//$ab=$a->hp;
		foreach ($a as $nomor) {
			$av=str_replace('{nama}', $nomor['namapemilih'], $isi);
			kirim_sms($nomor['hp'],$av);
		}
		$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible">
                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Sukses</h4>
                Pesan Berhasil Dikirim.
            </div>');

		//$this->load->view('_main',$this->data);*/

        $isi=$request->isi;
        $daerah=$request->daerah;
        $data = DB::table('pemilih')
                ->where('kabupatenpemilih', '=', $daerah)
                ->get();


        foreach($data as $nomor) {
            $av=str_replace('{nama}', $nomor->nama, $isi);
            kirim_sms($nomor->hp,$av);
        }

		redirect('sms/grouppemilihkabupaten','refresh');
	}
	public function sendgrouppemilihkecamatan()
	{
		/*$isi=$this->input->post('isi');
		$k=$this->input->post('daerah');
		$a=$this->Pemilih_m->groupidkecamatan($k);
		//$ab=$a->hp;
		foreach ($a as $nomor) {
			$av=str_replace('{nama}', $nomor['namapemilih'], $isi);
			kirim_sms($nomor['hp'],$av);
		}
		$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible">
                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Sukses</h4>
                Pesan Berhasil Dikirim.
            </div>');

		//$this->load->view('_main',$this->data);*/


        $isi=$request->isi;
        $daerah=$request->daerah;
        $data = DB::table('pemilih')
                ->where('kecamatanpemilih', '=', $daerah)
                ->get();


        foreach($data as $nomor) {
            $av=str_replace('{nama}', $nomor->nama, $isi);
            kirim_sms($nomor->hp,$av);
        }

		redirect('sms/grouppemilihkecamatan','refresh');
	}
	public function sendgrouppemilihkelurahan()
	{
		/*$isi=$this->input->post('isi');
		$k=$this->input->post('daerah');
		$a=$this->Pemilih_m->groupidkelurahan($k);
		//$ab=$a->hp;
		foreach ($a as $nomor) {
			$av=str_replace('{nama}', $nomor['namapemilih'], $isi);
			kirim_sms($nomor['hp'],$isi);
		}
		$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible">
                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Sukses</h4>
                Pesan Berhasil Dikirim.
            </div>');

		//$this->load->view('_main',$this->data);*/

        $isi=$request->isi;
        $daerah=$request->daerah;
        $data = DB::table('pemilih')
                ->where('kelurahanpemilih', '=', $daerah)
                ->get();


        foreach($data as $nomor) {
            $av=str_replace('{nama}', $nomor->nama, $isi);
            kirim_sms($nomor->hp,$av);
        }

		redirect('sms/grouppemilihkelurahan','refresh');
	}
//end of class
}
