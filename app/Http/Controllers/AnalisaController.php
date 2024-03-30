<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Analisa;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class AnalisaController extends Controller
{
    public function index() {
        if(!Session::get('username')){
            redirect('/');
        } else {
            $judulhalaman = 'Analisa';
            $judulmodul = 'Analisa';
            //$upload = new Upload();
            //$query = $upload->orderBy('idbukti','DESC')->get();
            return view('analisa/analisa_index',compact('judulmodul','judulhalaman'));
        }
    }

	public function indexx()
	{
		if (Session::get('username'))
			{
				$this->data['daerah']='';
				$this->data['kp']='';
				$this->data['pengaturan']='';
				$this->data['tr']='';
				$this->data['keluarga']='';
				$this->data['pengguna']='';
				$this->data['notifikasi']='';
				$this->data['calon']='';
				$this->data['koordinator']='';
				$this->data['isu']='';
				$this->data['target']='';
				$this->data['relawan']='';
				$this->data['dpt']='';
				$this->data['quick']='';
				$this->data['pemilih']='';
				$this->data['hitung']='';
				$this->data['saksi']='';
				$this->data['tim']='';
				$this->data['kegiatancalon']='';
				$this->data['listpengaturan']=$this->Pengaturan_m->tampil();
				$this->data['sms']='';
				$this->data['event']='';
				$this->data['biaya']='';
				$this->data['analisa']='active';
				$this->data['halaman']='vanalisa';
				$this->data['listprovinsi']=$this->Provinsi_m->getallkecamatan();
				$this->data['analisalist']=$this->Analisa_m->tampil();
				$this->load->view('_main',$this->data);
			}
		else
		{
			redirect('login','refresh');
		}
	}
	public function save(Request $request)
	{
		if (!Session::get('username'))
		{
			redirect('/');
		}
		else
		{
			/*$this->form_validation->set_rules('provinsianalisa','Provinsi ','required|strip_tags');
			$this->form_validation->set_rules('kabupatenanalisa','Kabupaten ','required|strip_tags');
			$this->form_validation->set_rules('kecamatananalisa','Kecamatan ','required|strip_tags');
			$this->form_validation->set_rules('kelurahananalisa','Kelurahan ','required|strip_tags');
			$this->form_validation->set_rules('jenis','jenis','required|strip_tags');
			$this->form_validation->set_rules('deskripsi_analisa','deskripsi analisa','required|strip_tags');
			if ($this->form_validation->run()==FALSE)
			{
				$this->session->set_flashdata("pesan","<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">Gagal!</div></div>");
				$this->data['halaman']='vanalisa';
				$this->load->view('_main',$this->data);
			}
			else
			{
				$data=array(
						'provinsianalisa'		=>$this->input->post('provinsianalisa'),
						'kabupatenanalisa'		=>$this->input->post('kabupatenanalisa'),
						'kecamatananalisa'		=>$this->input->post('kecamatananalisa'),
						'kelurahananalisa'		=>$this->input->post('kelurahananalisa'),
						'jenis'			=>$this->input->post('jenis'),
						'deskripsi_analisa'			=>$this->input->post('deskripsi_analisa')
					);
				$insert=$this->Analisa_m->insert($data);
				$this->session->set_flashdata("pesan","<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">Sukses!</div></div>");
				echo json_encode(array("status"=>TRUE));
			}*/


            $provinsianalisa = $request->provinsianalisa;
            $kabupatenanalisa = $request->kabupatenanalisa;
            $kecamatananalisa = $request->kecamatananalisa;
            $kelurahananalisa = $request->kelurahananalisa;
            $jenis = $request->jenis;
            $deskripsi_analisa = $request->deskripsi_analisa;


            $analisa = new Analisa();
            $analisa->provinsianalisa = $provinsianalisa;
            $analisa->kabupatenanalisa = $kabupatenanalisa;
            $analisa->kecamatananalisa = $kecamatananalisa;
            $analisa->kelurahananalisa = $kelurahananalisa;
            $analisa->jenis = $jenis;
            $analisa->deskripsi_analisa = $deskripsi_analisa;
            $analisa->save();

            echo json_encode(array("status" => TRUE));
		}
	}
	public function update($idanalisa)
	{
		//$data=$this->Analisa_m->getid($idanalisa);
		//echo json_encode($data);
        $analisa = new Analisa();
		$data=$analisa->find($idanalisa);
		echo json_encode($data);
	}
	public function updateaction(Request $request)
	{
        /*
		$this->form_validation->set_rules('provinsianalisa','Provinsi ','required|strip_tags');
			$this->form_validation->set_rules('kabupatenanalisa','Kabupaten ','required|strip_tags');
			$this->form_validation->set_rules('kecamatananalisa','Kecamatan ','required|strip_tags');
			$this->form_validation->set_rules('kelurahananalisa','Kelurahan ','required|strip_tags');
			$this->form_validation->set_rules('jenis','jenis','required|strip_tags');
			$this->form_validation->set_rules('deskripsi_analisa','deskripsi analisa','required|strip_tags');
			if ($this->form_validation->run()==FALSE)
			{
				$this->session->set_flashdata("pesan","<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">Gagal!</div></div>");
				$this->data['halaman']='vanalisa';
				$this->load->view('_main',$this->data);
			}
			else
			{
		$data=array(
						'provinsianalisa'		=>$this->input->post('provinsianalisa'),
						'kabupatenanalisa'		=>$this->input->post('kabupatenanalisa'),
						'kecamatananalisa'		=>$this->input->post('kecamatananalisa'),
						'kelurahananalisa'		=>$this->input->post('kelurahananalisa'),
						'jenis'			=>$this->input->post('jenis'),
						'deskripsi_analisa'			=>$this->input->post('deskripsi_analisa')
			);
		$this->Analisa_m->actionupdate(array('idanalisa'=>$this->input->post('idanalisa')),$data);
		echo json_encode(array("status"=>TRUE));
        }*/


            $provinsianalisa = $request->provinsianalisa;
            $kabupatenanalisa = $request->kabupatenanalisa;
            $kecamatananalisa = $request->kecamatananalisa;
            $kelurahananalisa = $request->kelurahananalisa;
            $jenis = $request->jenis;
            $deskripsi_analisa = $request->deskripsi_analisa;


            $analisaku = new Analisa();
            $analisa=$analisaku->find($request->idanalisa);
            $analisa->provinsianalisa = $provinsianalisa;
            $analisa->kabupatenanalisa = $kabupatenanalisa;
            $analisa->kecamatananalisa = $kecamatananalisa;
            $analisa->kelurahananalisa = $kelurahananalisa;
            $analisa->jenis = $jenis;
            $analisa->deskripsi_analisa = $deskripsi_analisa;
            $analisa->save();

            echo json_encode(array("status" => TRUE));
	}
	public function delete($idanalisa)
	{
		/*$this->Analisa_m->delete($idanalisa);
		$this->session->set_flashdata("pesan","<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">Sukses!</div></div>");
		echo json_encode(array("status"=>TRUE));*/


        $analisaku = new Analisa();
        $analisa = $analisaku->find($idanalisa);
        $analisa->delete();
		echo json_encode(array("status" => TRUE));
	}



	public function get_kecamatan($id)
	{

        $sub_cat = DB::table('kecamatan')
        ->where('kabupaten',$id)
        ->get();

		$str = '';
		// $str .= '<option value="#">#</option>';
		foreach ($sub_cat as $value) {
			$str .= '<option value="' . $value->kode_subdistrict . '">' . $value->kode_subdistrict . ' | ' . $value->nama_subdistrict . '</option>';
		}
		echo $str;
	}

	public function get_kelurahan($id)
	{
        $sub_cat = DB::table('kelurahan')
        ->where('kecamatan',$id)
        ->get();

		$str = '';
		foreach ($sub_cat as $value) {
			$str .= '<option value="' . $value->kode_suco . '">' . $value->kode_suco . ' | ' . $value->nama_suco . '</option>';
		}
		echo $str;
	}

	public function get_tps($id)
	{
        $sub_cat = DB::table('tps')
        ->where('kelurahantps',$id)
        ->get();
		$str = '';
		foreach ($sub_cat as $value) {
			$str .= '<option value="' . $value->kode_aldeia . '">' . $value->kode_aldeia . ' | ' . $value->nama_aldeia . '</option>';
		}
		echo $str;
	}

	public function get_kecamatan_edit($id)
	{
        $sub_cat = DB::table('kecamatan')
        ->where('kode_subdistrict',$id)
        ->get();

		//$sub_cat = $this->db->get_where('kecamatan', ['kode_subdistrict' => $id])->result();
		$str = '';
		// $str .= '<option value="#">#</option>';
		foreach ($sub_cat as $value) {
			$str .= '<option value="' . $value->kode_subdistrict . '">' . $value->kode_subdistrict . ' | ' . $value->nama_subdistrict . '</option>';
		}
		echo $str;
	}

	public function get_kelurahan_edit($id)
	{
        $sub_cat = DB::table('kelurahan')
        ->where('kode_suco',$id)
        ->get();

		//$sub_cat = $this->db->get_where('kelurahan', ['kode_suco' => $id])->result();
		$str = '';
		foreach ($sub_cat as $value) {
			$str .= '<option value="' . $value->kode_suco . '">' . $value->kode_suco . ' | ' . $value->nama_suco . '</option>';
		}
		echo $str;
	}

	public function get_tps_edit($id)
	{
        $sub_cat = DB::table('tps')
        ->where('kode_aldeia',$id)
        ->get();
		//$sub_cat = $this->db->get_where('tps', ['kode_aldeia' => $id])->result();
		$str = '';
		foreach ($sub_cat as $value) {
			$str .= '<option value="' . $value->kode_aldeia . '">' . $value->kode_aldeia . ' | ' . $value->nama_aldeia . '</option>';
		}
		echo $str;
	}

//end of class
}
