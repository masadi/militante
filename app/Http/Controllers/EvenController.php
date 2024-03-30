<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Even;
/*use App\Models\Bahan;
use App\Models\Barang;
use App\Models\Hargagrosir;
use App\Models\Barangdetail;*/
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class EvenController extends Controller
{
    public function index() {
        if(!Session::get('username')){
            redirect('/');
        } else {
            $judulhalaman = 'Even';
            $judulmodul = 'Even';
            //$akta = new Akta();
            //$query = $akta->orderBy('iddpt','DESC')->get();
            return view('even/even_index',compact('judulmodul','judulhalaman'));
        }
    }

	public function indexx()
	{
		if ($this->session->userdata('logged_in')==TRUE)
			{
				$this->data['daerah']='';
				$this->data['koordinator']='';
				$this->data['listpengaturan']=$this->Pengaturan_m->tampil();
				$this->data['relawan']='';
				$this->data['isu']='';
				$this->data['pemilih']='';
				$this->data['biaya']='';
				$this->data['tim']='';
				$this->data['pengaturan']='';
				$this->data['calon']='';
				$this->data['notifikasi']='';
				$this->data['dpt']='';
				$this->data['target']='';
				$this->data['kp']='';
				$this->data['tr']='';
				$this->data['keluarga']='';
				$this->data['pengguna']='';
				$this->data['quick']='';
				$this->data['sms']='';
				$this->data['kegiatancalon']='';
				$this->data['saksi']='';
				$this->data['hitung']='';
				$this->data['analisa']='';
				$this->data['event']='active';
				$this->data['halaman']='veven';
				$this->data['evenlist']=$this->Even_m->tampil();

				$this->load->view('_main',$this->data);
			}
		else
		{
			redirect('login','refresh');
		}
	}
	public function save(Request $request)
	{
		/*if(!Session::get('username'))
		{
			redirect('/');
		}
		else
		{*/
			/*$this->form_validation->set_rules('penyelenggara','area','required|strip_tags');
			$this->form_validation->set_rules('lokasi','Nama Pemilih','required|strip_tags');
			$this->form_validation->set_rules('kontak','Email','required|strip_tags');
			$this->form_validation->set_rules('tanggal','hp','required|strip_tags');
			$this->form_validation->set_rules('topik','ttl','required|strip_tags');
			$this->form_validation->set_rules('deskripsi','ttl','required|strip_tags');
			$this->form_validation->set_rules('narasumber','ttl','required|strip_tags');

			if ($this->form_validation->run()==FALSE)
			{
				$this->session->set_flashdata("pesan","<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">Gagal!</div></div>");
				$this->data['halaman']='veven';
				$this->load->view('_main',$this->data);
			}
			else
			{
				$tanggal=$this->input->post('tanggal');
				$tanggal=date('Y-m-d' ,strtotime($tanggal));
				$data=array(
						'penyelenggara'		=>$this->input->post('penyelenggara', TRUE),
						'lokasi'			=>$this->input->post('lokasi', TRUE),
						'kontak'			=>$this->input->post('kontak', TRUE),
						'tanggal'			=>$tanggal,
						'topik'			=>$this->input->post('topik', TRUE),
						'deskripsi'			=>$this->input->post('deskripsi', TRUE),
						'narasumber'			=>$this->input->post('narasumber', TRUE)

					);
				$insert=$this->Even_m->insert($data);
				$this->session->set_flashdata("pesan","<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">Sukses!</div></div>");
				echo json_encode(array("status"=>TRUE));
			}*/
                    $penyelenggara = $request->penyelenggara;
                    $lokasi = $request->lokasi;
                    $kontak = $request->kontak;
                    //$tanggal=date('Y-m-d' ,strtotime($tanggal));
                    $tanggal = $request->tanggal;
                    $topik = $request->topik;
                    $deskripsi = $request->deskripsi;
                    $narasumber = $request->narasumber;


                    $even = new Even();
                    $even->penyelenggara = $penyelenggara;
                    $even->lokasi = $lokasi;
                    $even->kontak = $kontak;
                    $even->tanggal = $tanggal;
                    $even->topik = $topik;
                    $even->deskripsi = $deskripsi;
                    $even->narasumber = $narasumber;
                    $even->save();

				echo json_encode(array("status"=>TRUE));
		//}
	}
	public function update($ideven)
	{
        $even = new Even();
		$data=$even->find($ideven);
		echo json_encode($data);
	}
	public function updateaction(Request $request)
	{
            /*$this->form_validation->set_rules('penyelenggara','area','required|strip_tags');
			$this->form_validation->set_rules('lokasi','Nama Pemilih','required|strip_tags');
			$this->form_validation->set_rules('kontak','Email','required|strip_tags');
			$this->form_validation->set_rules('tanggal','hp','required|strip_tags');
			$this->form_validation->set_rules('topik','ttl','required|strip_tags');
			$this->form_validation->set_rules('deskripsi','ttl','required|strip_tags');
			$this->form_validation->set_rules('narasumber','ttl','required|strip_tags');

			if ($this->form_validation->run()==FALSE)
			{
				$this->session->set_flashdata("pesan","<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">Gagal!</div></div>");
				$this->data['halaman']='veven';
				$this->load->view('_main',$this->data);
			}
			else
			{
		$tanggal=$this->input->post('tanggal');
		$tanggal=date('Y-m-d' ,strtotime($tanggal));
		$data=array(
						'penyelenggara'		=>$this->input->post('penyelenggara', TRUE),
						'lokasi'			=>$this->input->post('lokasi', TRUE),
						'kontak'			=>$this->input->post('kontak', TRUE),
						'tanggal'			=>$tanggal,
						'topik'			=>$this->input->post('topik', TRUE),
						'deskripsi'			=>$this->input->post('deskripsi', TRUE),
						'narasumber'			=>$this->input->post('narasumber', TRUE)
			);
		$this->Even_m->actionupdate(array('ideven'=>$this->input->post('ideven')),$data);
		echo json_encode(array("status"=>TRUE));

        }*/

        $penyelenggara = $request->penyelenggara;
        $lokasi = $request->lokasi;
        $kontak = $request->kontak;
        $tanggal = $request->tanggal;
        $topik = $request->topik;
        $deskripsi = $request->deskripsi;
        $narasumber = $request->narasumber;

        $evenku = new Even();
        $even=$evenku->find($request->ideven);
        $even->penyelenggara = $penyelenggara;
        $even->lokasi = $lokasi;
        $even->kontak = $kontak;
        $even->tanggal = $tanggal;
        $even->topik = $topik;
        $even->deskripsi = $deskripsi;
        $even->narasumber = $narasumber;
        $even->save();
        echo json_encode(array("status"=>TRUE));
	}
	public function delete($ideven)
	{
		//$this->Even_m->delete($ideven);
		//$this->session->set_flashdata("pesan","<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">Sukses!</div></div>");
		//echo json_encode(array("status"=>TRUE));

        $evenku = new Even();
        $even = $evenku->find($ideven);
        $even->delete();
		echo json_encode(array("status"=>TRUE));
	}

//end of class
}
