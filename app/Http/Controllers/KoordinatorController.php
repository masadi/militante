<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Koordinator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class KoordinatorController extends Controller
{
    public function index() {
        if(!Session::get('username')){
            redirect('/');
        } else {
            $judulhalaman = 'Koordinator';
            $judulmodul = 'Koordinator';
            $koordinator = new Koordinator();
            $query = $koordinator->orderBy('idkoordinator','DESC')->get();
            return view('koordinator/koordinator_index',compact('query','judulmodul','judulhalaman'));
        }
    }


	public function ajax_list()
	{

        $list = DB::table('koordinator')
            ->leftJoin('pemilih','pemilih.idpemilih','=','koordinator.idpemilihkoordinator')
            ->leftJoin('dpt','dpt.iddpt','=','pemilih.iddptpemilih')
            ->leftJoin('kecamatan','kecamatan.kode_subdistrict','=','koordinator.kecamatandijabat')
            ->leftJoin('kelurahan','kelurahan.kode_suco','=','koordinator.kelurahandijabat')
            ->orderBy('koordinator.idkoordinator','DESC')
            ->get();


		$data = array();
		$no = 0;
		foreach ($list as $koordinator) {
			$no++;
			$row = array();
			$row[] = $koordinator->namadpt;
			if ($koordinator->kecamatandijabat == '') {
				$row[] = '<b>' . $koordinator->jabatan . '</b> di Kelurahan <b>' . $koordinator->nama_suco . '</b>';
			} else {
				$row[] = '<b>' . $koordinator->jabatan . '</b> di Kecamatan <b>' . $koordinator->nama_subdistrict . '</b>';
			}
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_koordinator(' . "'" . $koordinator->idkoordinator . "'" . ')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_koordinator(' . "'" . $koordinator->idkoordinator . "'" . ')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

			$data[] = $row;
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
	public function ajax_edit($idkoordinator)
	{
		$data = $this->Koordinator_m->get_by_id($idkoordinator);
		echo json_encode($data);
	}
	public function ajax_add()
	{

		$this->form_validation->set_rules('idpemilihkoordinator', 'NIK', 'required|max_length[16]|is_unique[koordinator.idpemilihkoordinator]');
		if ($this->form_validation->run() === true) {
			$data = array(
				'idpemilihkoordinator'		=> $this->input->post('idpemilihkoordinator', TRUE),
				'lokasijabatan'				=> $this->input->post('lokasijabatan', TRUE),
				'kecamatandijabat'			=> $this->input->post('kecamatandijabat', TRUE),
				'kelurahandijabat'			=> $this->input->post('kelurahandijabat', TRUE),
				'jabatan'					=> $this->input->post('jabatan', TRUE)
			);
			$insert = $this->Koordinator_m->save($data);
			echo json_encode(array("status" => TRUE));
		} else {
			$errors = validation_errors();
			echo json_encode(['error' => $errors]);
		}
	}
	public function ajax_update()
	{

		$data = array(
			'idpemilihkoordinator'		=> $this->input->post('idpemilihkoordinator', TRUE),
			'lokasijabatan'				=> $this->input->post('lokasijabatan', TRUE),
			'kecamatandijabat'			=> $this->input->post('kecamatandijabat', TRUE),
			'kelurahandijabat'			=> $this->input->post('kelurahandijabat', TRUE),
			'jabatan'					=> $this->input->post('jabatan', TRUE)
		);
		$this->Koordinator_m->update(array('idkoordinator' => $this->input->post('idkoordinator')), $data);
		echo json_encode(array("status" => TRUE));
	}
	public function ajax_delete($idkoordinator)
	{
		$this->Koordinator_m->delete_by_id($idkoordinator);
		echo json_encode(array("status" => TRUE));
	}
	public function cetak()
	{
		$data['judul'] = "Daftar Koordinator";
		$data['ambildata'] = $this->Koordinator_m->tampil();
		$this->load->helper('dompdf');
		$view_file = $this->load->view('koordinator_pdf', $data, true);
		pdf_create($view_file, 'Daftar Koordinator');
	}
	public function search()
	{
		// tangkap variabel keyword dari URL
		$keyword = $this->uri->segment(3);
		// cari di database
		$this->db->select('*');
		$this->db->from('pemilih');
		$this->db->join('dpt', 'dpt.iddpt=pemilih.iddptpemilih');
		//$this->db->join('provinsi','provinsi.idprovinsi=dpt.provinsidpt');
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
				'idpemilih'	=> $row->idpemilih,
				'tlppemilih'	=> $row->tlppemilih
			);
		}
		echo json_encode($arr);
	}
//end of class
}
