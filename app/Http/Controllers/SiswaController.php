<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sekolah;
use App\Models\Peserta_didik;
use App\Models\Anggota_rombel;
use App\Models\User;

class SiswaController extends Controller
{
    public function index(){
        $data_sekolah = [];
        $user = auth()->user();
        if($user->hasRole('administrator', request()->periode_aktif)){
            $data_sekolah = Sekolah::select('sekolah_id', 'nama')->get();
        }
        $data = Peserta_didik::withWhereHas('kelas', function($query) use ($user){
            $query->where('rombongan_belajar.semester_id', request()->semester_id);
            if($user->sekolah_id){
                $query->where('sekolah_id', $user->sekolah_id);
            }
        })->with([
            'sekolah' => function($query){
                $query->select('sekolah_id', 'nama', 'bentuk_pendidikan_id');
            }
        ])->orderBy(request()->sortby, request()->sortbydesc)
        ->when(request()->q, function($query) {
            $query->where('nama', 'ILIKE', '%' . request()->q . '%');
            $query->orWhere('nisn', 'ILIKE', '%' . request()->q . '%');
        })
        ->when(request()->sekolah_id, function($query) {
            $query->where('sekolah_id', request()->sekolah_id);
        })->paginate(request()->per_page);
        return response()->json(['status' => 'success', 'data' => $data, 'data_sekolah' => $data_sekolah]);
    }
    public function pindah_rombel(){
        request()->validate(
            [
                'tingkat' => 'required',
                'rombongan_belajar_id' => 'required',
            ],
            [
                'tingkat.required' => 'Tingkat Kelas tidak boleh kosong!',
                'rombongan_belajar_id.required' => 'Rombel Tujuan tidak boleh kosong!',
            ],
        );
        $update = Anggota_rombel::where('semester_id', semester_id())->where('peserta_didik_id', request()->peserta_didik_id)->update([
            'rombongan_belajar_id' => request()->rombongan_belajar_id
        ]);
        if($update){
            $data = [
                'icon' => 'success',
                'title' => 'Berhasil',
                'text' => 'Rombongan Belajar berhasil dipindah',
            ];
        } else {
            $data = [
                'icon' => 'error',
                'title' => 'Gagal',
                'text' => 'Rombongan Belajar gagal dipindah. Silahkan coba beberapa saat lagi',
            ];
        }
        return response()->json($data);
        request()->reset(['tingkat', 'rombongan_belajar_id']);
        request()->emit('close-modal');
        request()->alert('success', 'Rombongan Belajar berhasil dipindah', [
            'position' => 'center'
        ]);
    }
    public function get_siswa(){
        $data = [
            'siswa' => Peserta_didik::select('peserta_didik_id', 'nama')->withWhereHas('anggota_rombel', function($query){
                $query->select('peserta_didik_id', 'anggota_rombel_id');
                $query->where('rombongan_belajar_id', request()->rombongan_belajar_id);
            })->orderBy('nama')->get(),
            'petugas' => User::whereRoleIs(['bk'], request()->periode_aktif)->orderBy('name')->select('id', 'name')->get(),
        ];
        return response()->json($data);
    }
}
