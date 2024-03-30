<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoginModel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index() {
        if(!Session::get('username')){
            redirect('/');
        } else {
            $judulhalaman = 'User';
            $judulmodul = 'User';
            //$upload = new Upload();
            //$query = $upload->orderBy('idbukti','DESC')->get();
            return view('user/user_index',compact('judulmodul','judulhalaman'));
        }
    }

	public function indexx()
	{
		if ($this->session->userdata('logged_in')==TRUE )
			{
				if($this->session->userdata('level')=='admin'){
				$this->data['daerah']='';
				$this->data['koordinator']='';
				$this->data['pengguna']='active';
				$this->data['pengaturan']='';
				$this->data['pemilih']='';
				$this->data['relawan']='';
				$this->data['tim']='';
				$this->data['saksi']='';
				$this->data['listpengaturan']=$this->Pengaturan_m->tampil();
				$this->data['kp']='';
				$this->data['tr']='';
				$this->data['keluarga']='';
				$this->data['kegiatancalon']='';
				$this->data['calon']='';
				$this->data['notifikasi']='';
				$this->data['target']='';
				$this->data['isu']='';
				$this->data['event']='';
				$this->data['quick']='';
				$this->data['hitung']='';
				$this->data['dpt']='';
				$this->data['sms']='';
				$this->data['biaya']='';
				$this->data['analisa']='';
				$this->data['halaman']='vuser';
				$this->data['userlist']=$this->User_m->tampil();
				$this->load->view('_main',$this->data);
				}else
				{
					redirect('login','refresh');
				}
			}
		else
		{
			redirect('login','refresh');
		}
	}
	public function save(Request $request)
	{
		if(!Session::get('username')){
			redirect('/');
		} else {
			/*$this->form_validation->set_rules('username','Username','required|strip_tags');
			$this->form_validation->set_rules('password','Password','required|strip_tags');
			$this->form_validation->set_rules('nama','Nama','required|strip_tags');
			$this->form_validation->set_rules('level','Level','required|strip_tags');
			if ($this->form_validation->run()==FALSE)
			{
				$this->session->set_flashdata("pesan","<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">Gagal!</div></div>");
				$this->data['halaman']='vuser';
				$this->load->view('_main',$this->data);
			}
			else
			{
				$ipass=$this->input->post('password',TRUE);
				$password=hash('sha512',$ipass. config_item('encryption_key'));
				$data=array(
						'username'		=>$this->input->post('username'),
						'password'			=>$password,
						'nama'			=>$this->input->post('nama'),
						'level'			=>$this->input->post('level')
					);
				$insert=$this->User_m->insert($data);
				$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible">
                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Sukses</h4>
               Data berhasil Disimpan
            </div>');
				echo json_encode(array("status"=>TRUE));
			}*/

            $key =  DB::table('keys')->first();
            $username = $request->username;
            $ipassword = $request->password;
            $nama = $request->nama;
            $level = $request->level;
            $password=hash('sha512',$ipassword.$key->key);

            $user = new LoginModel();
            $user->username = $username;
            $user->nama = $nama;
            $user->level = $level;
            $user->password = $password;
            $user->save();


            echo json_encode(array("status" => TRUE));
		}
	}
	public function update($id)
	{
		//$data=$this->User_m->getid($id);
		//echo json_encode($data);
        $user = new LoginModel();
        $data = $user->find($id);

        echo json_encode($data);
	}
	public function updateaction(Request $request)
	{
		/*$this->form_validation->set_rules('username','Username','required|strip_tags');
			$this->form_validation->set_rules('password','Password','required|strip_tags');
			$this->form_validation->set_rules('nama','Nama','required|strip_tags');
			$this->form_validation->set_rules('level','Level','required|strip_tags');
            if ($this->form_validation->run()==FALSE)
			{
				$this->session->set_flashdata("pesan","<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">Gagal!</div></div>");
				$this->data['halaman']='vuser';
				$this->load->view('_main',$this->data);
			}
			else{
				$ipass=$this->input->post('password',TRUE);
				$password=hash('sha512',$ipass. config_item('encryption_key'));
                $data=array(
                        'username'		=>$this->input->post('username'),
						'password'			=>$password,
						'nama'			=>$this->input->post('nama'),
						'level'			=>$this->input->post('level')
                );
                $this->User_m->actionupdate(array('id'=>$this->input->post('id')),$data);
                echo json_encode(array("status"=>TRUE));
            }*/


            $key =  DB::table('keys')->first();
            $username = $request->username;
            $ipassword = $request->password;
            $nama = $request->nama;
            $level = $request->level;
            $password=hash('sha512',$ipassword.$key->key);

            $userku = new LoginModel();
            $user=$userku->find($request->id);
            $user->username = $username;
            $user->nama = $nama;
            $user->level = $level;
            $user->password = $password;
            $tps->save();

            echo json_encode(array("status" => TRUE));
	}
	public function delete($id)
	{
		//$this->User_m->delete($id);
		//$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible">
        //         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        //        <h4><i class="icon fa fa-check"></i> Sukses</h4>
        //        Data berhasil Dihapaus
        //    </div>');
		//echo json_encode(array("status"=>TRUE));

        $user = new LoginModel();
        $data = $user->find($id);
        $data->delete();
        echo json_encode(array("status" => TRUE));
	}
//end of class
}
