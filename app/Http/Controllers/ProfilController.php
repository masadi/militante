<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profil;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class ProfilController extends Controller
{
    public function index() {
        if(!Session::get('username')){
            redirect('/');
        } else {
            $judulhalaman = 'Profil';
            $judulmodul = 'Profil';
            $profil = new Profil();
            $profillist = $profil->where('username','=',Session::get('username'))->first();
            return view('profil/profil_index',compact('profillist','judulmodul','judulhalaman'));
        }
    }

	public function edit($id='')
	{
	    	if ($this->session->userdata('logged_in')==TRUE)
			{
		if(!is_numeric($id)){show_404();}
	if (isset($id) ){
	    if($this->session->userdata('akses') == $id){
				$this->data['relawan']='';
	        	$this->data['daerah']='';
				$this->data['koordinator']='';
				$this->data['pengaturan']='';
				$this->data['listpengaturan']=$this->Pengaturan_m->tampil();
				$this->data['pemilih']='';
				$this->data['kegiatancalon']='';
				$this->data['notifikasi']='';
				$this->data['hitung']='';
				$this->data['kp']='';
				$this->data['tr']='';
				$this->data['keluarga']='';
				$this->data['dpt']='';
				$this->data['saksi']='';
				$this->data['tim']='';
				$this->data['pengguna']='';
				$this->data['target']='';
				$this->data['isu']='';
				$this->data['quick']='';
				$this->data['event']='';
				$this->data['sms']='';
				$this->data['biaya']='';
				$this->data['calon']='';
				$this->data['profl']='active';
				$this->data['analisa']='';
				//$this->data['pesan']=$pesan;
				$this->data['profillist']=$this->Profil_m->get_profil_detail($id);
				$this->data['halaman']="vprofil";
				$this->load->view('_main',$this->data);
	    }else {
	        redirect('dashboard');
	    }

	}else{show_404();}
			}	else
		{
			redirect('login','refresh');
		}
	}
	public function save()
	{

	    	if ($this->session->userdata('logged_in')==TRUE)
			{
		 $level=$this->session->userdata('level');
		 $id =$this->session->userdata('akses');
		 $ipass=$this->input->post('password',TRUE);
		 $password=hash('sha512',$ipass. config_item('encryption_key'));

		 if ($this->session->userdata('logged_in')!=TRUE)
		{
		redirect('login','refresh');
		}
		else
		{
			$data=array(
						'username'		=>$this->input->post('username', TRUE),
						'nama' =>$this->input->post('nama', TRUE),
						'level' =>$level,
						'password' =>$password,
						//'id'=>$id

			);
			//print_r($data);
		$this->Profil_m->simpan(array('id'=>$id),$data);
		redirect('profil/edit/'.$id,'refresh');
	}
			}	else
		{
			redirect('login','refresh');
		}

	}
//end of class
}
