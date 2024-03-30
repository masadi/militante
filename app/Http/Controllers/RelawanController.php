<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Relawan;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class RelawanController extends Controller
{
    public function index() {
        if(!Session::get('username')){
            redirect('/');
        } else {
            $judulhalaman = 'Relawan';
            $judulmodul = 'Relawan';
            $relawan = new Relawan();
            $query = $relawan->orderBy('idrelawan','DESC')->get();
            return view('relawan/relawan_index',compact('query','judulmodul','judulhalaman'));
        }
    }


	public function ajax_list()
	{
        $list = DB::table('relawan')
                    ->leftJoin('pemilih','pemilih.idpemilih','=','relawan.idpemilihrelawan')
                    ->leftJoin('dpt','dpt.iddpt','=','pemilih.iddptpemilih')
                    ->get();

		$data = array();
		$no = 0;
		foreach ($list as $relawan) {
            if(!empty($relawan->namadpt)) {
                $no++;
                $row = array();
                $row[] = $relawan->namadpt;
                $row[] = $relawan->tlppemilih;
                $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_relawan(' . "'" . $relawan->idrelawan . "'" . ')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                      <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_relawan(' . "'" . $relawan->idrelawan . "'" . ')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
                $data[] = $row;
            }
		}

		$output = array(
			"draw" => 1,
			"recordsTotal" => $no,
			"recordsFiltered" => $no,
			"data" => $data,
		);

		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit($idrelawan)
	{
		$data = $this->Relawan_m->get_by_id($idrelawan);
		echo json_encode($data);
	}
	public function ajax_add()
	{
		$this->form_validation->set_rules('idpemilihrelawan', 'NIK', 'required|max_length[16]|is_unique[relawan.idpemilihrelawan]');
		if ($this->form_validation->run() === true) {
			$data = array(
				'idpemilihrelawan'		=> $this->input->post('idpemilihrelawan', TRUE)
			);
			$insert = $this->Relawan_m->save($data);
			echo json_encode(array("status" => TRUE));
		} else {
			$errors = validation_errors();
			echo json_encode(['error' => $errors]);
		}
	}
	public function ajax_update()
	{
		$data = array(
			'idpemilihrelawan'		=> $this->input->post('idpemilihrelawan', TRUE)
		);
		$this->Relawan_m->update(array('idrelawan' => $this->input->post('idrelawan')), $data);
		echo json_encode(array("status" => TRUE));
	}
	public function ajax_delete($idrelawan)
	{
		$this->Relawan_m->delete_by_id($idrelawan);
		echo json_encode(array("status" => TRUE));
	}

	public function cetak()
	{
		$data['judul'] = "Daftar Relawan";
		$data['ambildata'] = $this->Relawan_m->tampil();
		$this->load->helper('dompdf');
		$view_file = $this->load->view('relawan_pdf', $data, true);
		pdf_create($view_file, 'Daftar Relawan');
	}
	public function search()
	{
		// tangkap variabel keyword dari URL
		$keyword = $this->uri->segment(10);
		// cari di database
		$this->db->select('*');
		$this->db->from('pemilih');
		$this->db->join('dpt', 'dpt.iddpt=pemilih.iddptpemilih');
		//    $this->db->join('provinsi','provinsi.idprovinsi=dpt.provinsidpt');
		$this->db->join('kabupaten', 'kabupaten.kode_district=dpt.kabupatendpt');
		$this->db->join('kecamatan', 'kecamatan.kode_subdistrict=dpt.kecamatandpt');
		$this->db->join('kelurahan', 'kelurahan.kode_suco=dpt.kelurahandpt');
		$this->db->join('tps', 'tps.kode_aldeia=dpt.tpsdpt');
		$this->db->like('nikdpt', $keyword);
		$query = $this->db->get();
		// format keluaran di dalam array
		foreach ($query->result() as $row) {
			$arr['query'] = $keyword;
			$arr['suggestions'][] = array(
				'value'	=> $row->nikdpt,
				'namadpt'	=> $row->namadpt,
				'tlppemilih'	=> $row->tlppemilih,
				'kode_district'	=> $row->kode_district,
				'kode_subdistrict'	=> $row->kode_subdistrict,
				'kode_suco'	=> $row->kode_suco,
				'kode_aldeia'	=> $row->kode_aldeia,
				'idpemilih'	=> $row->idpemilih
			);
		}

		// minimal PHP 5.2
		echo json_encode($arr);
	}
//end of class
}
