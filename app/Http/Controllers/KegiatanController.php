<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kegiatan;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class KegiatanController extends Controller
{
    public function index() {
        if(!Session::get('username')){
            redirect('/');
        } else {
            $judulhalaman = 'Kegiatan';
            $judulmodul = 'Kegiatan';
            //$upload = new Upload();
            //$query = $upload->orderBy('idbukti','DESC')->get();
            return view('kegiatan/kegiatan_index',compact('judulmodul','judulhalaman'));
        }
    }

	public function indexx()
	{
		if (Session::get('username'))
			{
				$this->data['daerah']='';
				$this->data['koordinator']='';
				$this->data['pemilih']='';
				$this->data['notifikasi']='';
				$this->data['tim']='';
				$this->data['listpengaturan']=$this->Pengaturan_m->tampil();
				$this->data['kp']='';
				$this->data['tr']='';
				$this->data['keluarga']='';
				$this->data['pengaturan']='';
				$this->data['saksi']='';
				$this->data['hitung']='';
				$this->data['target']='';
				$this->data['calon']='';
				$this->data['pengguna']='';
				$this->data['relawan']='';
				$this->data['quick']='';
				$this->data['kegiatancalon']='active';
				$this->data['isu']='';
				$this->data['analisa']='';
				$this->data['sms']='';
				$this->data['dpt']='';
				$this->data['biaya']='';
				$this->data['event']='';
				$this->data['halaman']='vkegiatan';
				$this->load->view('_main',$this->data);
			}
		else
		{
			redirect('login','refresh');
		}
	}


	public function ajax_list()
    {

		//if (Session::get('username')){
            //$list = $this->Kegiatan_m->get_datatables();
            $kegiatanx = new Kegiatan();
            $list = $kegiatanx->orderBy('idkegiatan','DESC')->get();
            $data = array();
            $no = 0;
            foreach ($list as $kegiatan) {
                $no++;
                $row = array();
                $row[] = $kegiatan->namakegiatan;
                $row[] = $kegiatan->tanggalkegiatan;
                $row[] = $kegiatan->deskripsikegiatan;

                $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_kegiatan('."'".$kegiatan->idkegiatan."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                      <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_kegiatan('."'".$kegiatan->idkegiatan."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
                $data[] = $row;
            }
            $output = array(
                            "draw" => 1,
                            "recordsTotal" => $no,
                            "recordsFiltered" => $no,
                            "data" => $data,
                    );
            echo json_encode($output);
        //}
        //else{
        //    return redirect('/');
        //}
    }
    public function ajax_edit($idkegiatan)
    {
        $data = $this->Kegiatan_m->get_by_id($idkegiatan);
        echo json_encode($data);
    }
    public function ajax_add()
    {
    	$this->form_validation->set_rules('namakegiatan','Nama Kegiatan','required');
        if (Session::get('username')) {



				$tanggalkegiatan=$this->input->post('tanggalkegiatan');
				$ttl=date('Y-m-d' ,strtotime($tanggalkegiatan));
				$data=array(
						'namakegiatan'		=>$this->input->post('namakegiatan', TRUE),
						'deskripsikegiatan'		=>$this->input->post('deskripsikegiatan', TRUE),
						'tanggalkegiatan'			=>$ttl
					);

        $insert = $this->Kegiatan_m->save($data);

        echo json_encode(array("status" => TRUE));
        } else
    {
    	$errors = validation_errors();
            echo json_encode(['error'=>$errors]);
    }
    }
   public function ajax_update()
    {

		$tanggalkegiatan=$this->input->post('tanggalkegiatan');
		$ttl=date('Y-m-d' ,strtotime($tanggalkegiatan));
		$data=array(
				'namakegiatan'		=>$this->input->post('namakegiatan', TRUE),
				'deskripsikegiatan'		=>$this->input->post('deskripsikegiatan', TRUE),
				'tanggalkegiatan'			=>$ttl
					);
        $this->Kegiatan_m->update(array('idkegiatan' => $this->input->post('idkegiatan')), $data);
        echo json_encode(array("status" => TRUE));
    }
   public function delete($idkegiatan)
	{
		$this->Kegiatan_m->delete_by_id($idkegiatan);
		$this->session->set_flashdata("pesan","<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">Sukses!</div></div>");
		echo json_encode(array("status"=>TRUE));
	}


//end of class
}
