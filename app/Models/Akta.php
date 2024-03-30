<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Akta extends Model
{
    use HasFactory;
    protected $table = 'dpt';
    protected $primaryKey = 'iddpt';


/*

    private function _get_datatables_query()
    {
        $this->db->select('*');
        $this->db->from('dpt');
        $this->db->join('kabupaten', 'kabupaten.kode_district=dpt.kabupatendpt');
        $this->db->join('kecamatan', 'kecamatan.kode_subdistrict=dpt.kecamatandpt');
        $this->db->join('kelurahan', 'kelurahan.kode_suco=dpt.kelurahandpt');
        $this->db->join('tps', 'tps.kode_aldeia=dpt.tpsdpt');
        $i = 0;

        foreach ($this->column_search as $item) // loop column
        {
            if ($_POST['search']['value']) // if datatable send POST for search
            {
                if ($i === 0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if (count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function get_by_id($iddpt)
    {
        $this->db->from($this->table);
        $this->db->join('kabupaten', 'kabupaten.kode_district=dpt.kabupatendpt');
        $this->db->join('kecamatan', 'kecamatan.kode_subdistrict=dpt.kecamatandpt');
        $this->db->join('kelurahan', 'kelurahan.kode_suco=dpt.kelurahandpt');
        $this->db->join('tps', 'tps.kode_aldeia=dpt.tpsdpt');
        $this->db->where('iddpt', $iddpt);
        $query = $this->db->get();

        return $query->row();
    }

    public function save($data)
    {
        $this->db->insert('dpt', $data);
        return $this->db->insert_id();
    }

    public function update($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    public function delete_by_id($iddpt)
    {
        $this->db->where('iddpt', $iddpt);
        $this->db->delete($this->table);
    }

    public function insert($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function getid($iddpt)
    {
        $this->db->from($this->table);
        $this->db->where('iddpt', $iddpt);
        $query = $this->db->get();
        return $query->row();
    }

    public function actionupdate($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    public function delete($iddpt)
    {
        $this->db->where('iddpt', $iddpt);
        $this->db->delete($this->table);
    }

    public function groupid($groupid)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('provinsipemilih', $groupid);

        return $this->db->get()->result_array();
    }

    public function groupidkabupaten($groupid)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('kabupatenpemilih', $groupid);

        return $this->db->get()->result_array();
    }

    public function groupidkecamatan($groupid)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('kecamatanpemilih', $groupid);
        return $this->db->get()->result_array();
    }

    public function groupidkelurahan($groupid)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('kelurahanpemilih', $groupid);
        return $this->db->get()->result_array();
    }

    public function getidbyphone($no_hp)
    {
        $this->db->from($this->table);
        $this->db->where('hp', $no_hp);
        $getid = $this->db->get();
        return $getid->row();
    }

    public  function reportprovinsi()
    {
        $this->db->select('pemilihuser,provinsipemilih,namaprovinsi, COUNT(namapemilih) as jumlah');
        $this->db->from('pemilih');
        $this->db->join('provinsi', 'provinsi.idprovinsi=pemilih.provinsipemilih');
        $this->db->group_by(array("pemilihuser", "provinsipemilih"));
        $result = $this->db->get();
        return $result->result();
    }

    public  function jumlahhasil()
    {
        $this->db->select('ditambahkanoleh, COUNT(iddpt) as jumlahhasil');
        $this->db->from('dpt');
        $this->db->group_by('ditambahkanoleh');
        $result = $this->db->get();
        return $result->result();
    }

    public  function reportkabupaten()
    {
        $this->db->select('pemilihuser,kabupatenpemilih,nama_district, COUNT(namapemilih) as jumlahkabupaten');
        $this->db->from('pemilih');
        $this->db->join('kabupaten', 'kabupaten.idkabupaten=pemilih.kabupatenpemilih');
        $this->db->group_by(array("pemilihuser", "kabupatenpemilih"));
        $result = $this->db->get();
        return $result->result();
    }

    public  function reportkecamatan()
    {
        $this->db->select('pemilihuser,kecamatanpemilih,namakecamatan, COUNT(namapemilih) as jumlahkecamatan');
        $this->db->from('pemilih');
        $this->db->join('kecamatan', 'kecamatan.idkecamatan=pemilih.kecamatanpemilih');
        $this->db->group_by(array('pemilihuser', 'kecamatanpemilih'));
        $result = $this->db->get();
        return $result->result();
    }

    public  function reportkelurahan()
    {
        $this->db->select('pemilihuser,kelurahanpemilih,namakelurahan, COUNT(namapemilih) as jumlahkelurahan');
        $this->db->from('pemilih');
        $this->db->join('kelurahan', 'kelurahan.idkelurahan=pemilih.kelurahanpemilih');
        $this->db->group_by(array('pemilihuser', 'kelurahanpemilih'));
        $result = $this->db->get();
        return $result->result();
    }

    public  function jumlahpemilih()
    {
        $this->db->select('pemilihuser,provinsipemilih,namapemilih, COUNT(namapemilih) as jumlahtotal');
        $this->db->from('pemilih');
        $this->db->group_by('pemilihuser');
        $result = $this->db->get();
        return $result->result();
    }

    public function getkabupaten()
    {
        $this->db->order_by('nama_district', 'asc');
        $result = $this->db->get('kabupaten')->result();
        return $result;
    }

    public function getkecamatan()
    {
        $this->db->order_by('namakecamatan', 'asc');
        $result = $this->db->get('kecamatan')->result();
        return $result;
    }

    public function getkelurahan()
    {
        $this->db->order_by('namakelurahan', 'asc');
        $result = $this->db->get('kelurahan')->result();
        return $result;
    }

    public  function getgrafikkabupaten($kabupaten)
    {
        $this->db->select('*');
        $this->db->select('COUNT(namapemilih) AS jumlahkabupaten');
        $this->db->from('pemilih');
        $this->db->like('kabupatenpemilih', $kabupaten);
        $this->db->join('kabupaten', 'kabupaten.idkabupaten=pemilih.kabupatenpemilih');
        $this->db->group_by("pemilihuser");
        $result = $this->db->get();
        return $result->result();
    }

    public  function getgrafikkecamatan($kecamatan)
    {
        $this->db->select('*');
        $this->db->select('COUNT(namapemilih) AS jumlahkecamatan');
        $this->db->from('pemilih');
        $this->db->like('kecamatanpemilih', $kecamatan);
        $this->db->join('kecamatan', 'kecamatan.idkecamatan=pemilih.kecamatanpemilih');
        $this->db->group_by("pemilihuser");
        $result = $this->db->get();
        return $result->result();
    }

    public  function getgrafikkelurahan($kelurahan)
    {
        $this->db->select('*');
        $this->db->select('COUNT(namapemilih) AS jumlahkelurahan');
        $this->db->from('pemilih');
        $this->db->like('kelurahanpemilih', $kelurahan);
        $this->db->join('kelurahan', 'kelurahan.idkelurahan=pemilih.kelurahanpemilih');
        $this->db->group_by("pemilihuser");
        $result = $this->db->get();
        return $result->result();
    }

    public function getnamakabupatenyangdipilih($id)
    {
        $id = $this->db->where('idkabupaten', $id);
        $query = $this->db->get('kabupaten');
        $row = $query->row();
        $query->num_rows();
        return $row;
    }

    public function getnamakecamatanyangdipilih($id)
    {
        $id = $this->db->where('idkecamatan', $id);
        $query = $this->db->get('kecamatan');
        $row = $query->row();
        $query->num_rows();
        return $row;
    }

    public function getnamakelurahanyangdipilih($id)
    {
        $id = $this->db->where('idkelurahan', $id);
        $query = $this->db->get('kelurahan');
        $row = $query->row();
        $query->num_rows();
        return $row;
    }

    public function insertimport($data)
    {
        $this->db->insert_batch('dpt', $data);
        return $this->db->insert_id();
    }

    public function caridpt($nikdpt)
    {
        $this->db->from($this->table);
        $this->db->join('kabupaten', 'kabupaten.idkabupaten=dpt.kabupatendpt');
        $this->db->join('kecamatan', 'kecamatan.idkecamatan=dpt.kecamatandpt');
        $this->db->join('kelurahan', 'kelurahan.idkelurahan=dpt.kelurahandpt');
        $this->db->join('tps', 'tps.idtps=dpt.tpsdpt');
        $this->db->where($nikdpt);
        $getid = $this->db->get();
        return $getid->row();
    }

    public function getallkabupaten()
    {
        $this->db->order_by('kode_district', 'asc');
        $result = $this->db->get('kabupaten')->result();
        return $result;
    }

    public function get_kecamatan($id = '')
    {
        $this->db->select('*');
        $this->db->where('kabupaten', $id);
        $this->db->from('kecamatan');
        $result = $this->db->get()->result();
        return $result;
    }

    public function get_kelurahan($id = '')
    {
        $this->db->select('*');
        $this->db->where('kecamatan', $id);
        $this->db->from('kelurahan');
        $result = $this->db->get()->result();
        return $result;
    }

    public function get_tps($id = '')
    {
        if (strlen($id) == 4) {
            $code = $id . '01';
        } else {
            $code = $id;
        }
        $this->db->select('*');
        $this->db->where('kelurahantps', $code);
        $this->db->from('tps');
        $result = $this->db->get()->result();
        return $result;
    }*/
}
