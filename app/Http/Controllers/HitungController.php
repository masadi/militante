<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hitung;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class HitungController extends Controller
{
    public function index() {
        if(!Session::get('username')){
            redirect('/');
        } else {
            $judulhalaman = 'Hitung';
            $judulmodul = 'Hitung';
            $hitung = new Hitung();
            $query = $hitung->orderBy('id_hitung','DESC')->get();
            return view('hitung/hitung_index',compact('query','judulmodul','judulhalaman'));
        }
    }

	public function indexx()
	{
		if ($this->session->userdata('logged_in')==TRUE)
			{
				$saksi=$this->session->userdata('saksikode');
				$this->data['daerah']='';
				$this->data['koordinator']='';
				$this->data['hitung']='active';
				$this->data['kegiatancalon']='';
				$this->data['kp']='';
				$this->data['listpengaturan']=$this->Pengaturan_m->tampil();
				$this->data['tr']='';
				$this->data['keluarga']='';
				$this->data['pemilih']='';
				$this->data['pengguna']='';
				$this->data['relawan']='';
				$this->data['pengaturan']='';
				$this->data['isu']='';
				$this->data['notifikasi']='';
				$this->data['calon']='';
				$this->data['analisa']='';
				$this->data['dpt']='';
				$this->data['quick']='';
				$this->data['saksi']='';
				$this->data['sms']='';
				$this->data['target']='';
				$this->data['tim']='';
				$this->data['biaya']='';
				$this->data['event']='';
				$this->data['halaman']='vhitung';
				$this->data['hitunglist']=$this->Hitung_m->tampil();
				if($this->session->userdata('level')=='admin'){
					$this->data['informasisaksiuntukadmin']=$this->Hitung_m->tampilinformasisaksiuntukadmin();
				}
				$this->data['informasisaksi']=$this->Hitung_m->tampilinformasisaksi($saksi);
				//$this->data['listprovinsi']=$this->Provinsi_m->get_categories();
				//$this->data['listrelawan']=$this->Relawan_m->getallrelawan();
				$this->load->view('_main',$this->data);
			}
		else
		{
			redirect('login','refresh');
		}
	}
	public function save()
	{
		if ($this->session->userdata('logged_in')!=TRUE)
		{
			redirect('login','refresh');
		}
		else
		{

			$this->form_validation->set_rules('jumlah','Jumlah','required|strip_tags');
			if ($this->form_validation->run()==FALSE)
			{
				$this->session->set_flashdata("pesan","<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">Gagal!</div></div>");
				$this->data['halaman']='vhitung';
				$this->load->view('_main',$this->data);
			}
			else
			{
				$saksi=$this->session->userdata('saksikode');
				$data=array(
						'jumlah'		=>$this->input->post('jumlah', TRUE),
						'saksihitung'	=>$saksi
					);
				$insert=$this->Hitung_m->insert($data);
				$this->session->set_flashdata("pesan","<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">Sukses!</div></div>");
				echo json_encode(array("status"=>TRUE));
			}
		}
	}
	public function update($id_hitung)
	{
		$data=$this->Hitung_m->getid($id_hitung);
		echo json_encode($data);
	}
	public function updateaction()
	{
			$this->form_validation->set_rules('jumlah','Jumlah','required|strip_tags');


				if ($this->form_validation->run()==FALSE)
			{
				$this->session->set_flashdata("pesan","<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">Gagal!</div></div>");
				$this->data['halaman']='vhitung';
				$this->load->view('_main',$this->data);
			}
			else
			{
			$saksi=$this->session->userdata('saksikode');
				$data=array(
						'jumlah'		=>$this->input->post('jumlah', TRUE),
						'saksihitung'	=>$saksi
					);
		$this->Hitung_m->actionupdate(array('id_hitung'=>$this->input->post('id_hitung')),$data);
		echo json_encode(array("status"=>TRUE));
	}
	}

	public function delete($id_hitung)
	{
		//$this->Hitung_m->delete($id_hitung);
		//$this->session->set_flashdata("pesan","<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">Sukses!</div></div>");
		//echo json_encode(array("status"=>TRUE));


        $hitungku = new Hitung();
        $hitung = $hitungku->find($id_hitung);
        $hitung->delete();
        return redirect('hitung')->with('pesan','Data Pesanan telah berhasil dihapus');
	}
	public function kirimsms($no_hp)
	{
		if($this->session->userdata('logged_in')!=TRUE)
		{
			redirect('login','refresh');
		}else
		{
			$this->data['daerah']='';
				$this->data['koordinator']='active';
				$this->data['pemilih']='';
				$this->data['saksi']='';
				$this->data['kegiatancalon']='';
				$this->data['relawan']='';
				$this->data['pengguna']='';
				$this->data['pengaturan']='';
				$this->data['dpt']='';
				$this->data['calon']='';
				$this->data['quick']='';
				$this->data['listpengaturan']=$this->Pengaturan_m->tampil();
				$this->data['isu']='';
				$this->data['analisa']='';
				$this->data['notifikasi']='';
				$this->data['sms']='';
				$this->data['kp']='';
				$this->data['tr']='';
				$this->data['keluarga']='';
				$this->data['target']='';
				$this->data['tim']='';
				$this->data['biaya']='';
				$this->data['event']='';
			$this->data['getid']=$this->Koordinator_m->getidbyphone($no_hp);
			$this->data['halaman']='vkirim';
			$this->load->view('_main',$this->data);
		}
	}
	public function send()
	{
		//$this->data['Settinglist']=$this->Setting_m->tampil();
		$no_hp=$this->input->post('hp');
		$namakontak=$this->input->post('nama');
		$isi=$this->input->post('pesan');
		$b= str_replace('{nama}',$namakontak, $isi);

		kirim_sms($no_hp,$b);
		$this->session->set_flashdata("pesan","<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">Pesan Berhasil Dikirim!</div></div>");
		redirect('koordinator','refresh');
	}


//end of class
}
