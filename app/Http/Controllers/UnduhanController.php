<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Exports\PelanggaranExport;
use App\Exports\RekapTingkat;
use App\Exports\RekapRombel;
use App\Exports\RekapPd;
use App\Models\Peserta_didik;
use App\Models\Rombongan_belajar;
use Carbon\Carbon;

class UnduhanController extends Controller
{
    public function __construct()
    {
        $this->sekolah_id = Route::current()->parameters['sekolah_id'] ?? NULL;
        $this->semester_id = Route::current()->parameters['semester_id'] ?? NULL;
        $this->start = Route::current()->parameters['start'] ?? NULL;
        $this->end = Route::current()->parameters['end'] ?? NULL;
        $this->tingkat = Route::current()->parameters['tingkat'] ?? NULL;
        $this->rombongan_belajar_id = Route::current()->parameters['rombongan_belajar_id'] ?? NULL;
        $this->peserta_didik_id = Route::current()->parameters['peserta_didik_id'] ?? NULL;
    }
    public function pelanggaran(){
        return (new PelanggaranExport)
        ->query(['start' => $this->start, 'end' => $this->end, 'sekolah_id' => $this->sekolah_id, 'semester_id' => $this->semester_id])
        ->download('laporan-pelanggaran-'.Carbon::now()
        ->translatedFormat('d-F-Y').'.xlsx');
    }
    public function rekap_tingkat(){
        return (new RekapTingkat)
            ->query(['tingkat' => $this->tingkat, 'start' => $this->start, 'end' => $this->end, 'sekolah_id' => $this->sekolah_id, 'semester_id' => $this->semester_id])
            ->download('rekap-pelanggaran-tingkat-'.$this->tingkat.'-'.Carbon::now()
            ->translatedFormat('d-F-Y').'.xlsx');
    }
    public function rekap_rombel(){
        $rombel = Rombongan_belajar::find($this->rombongan_belajar_id);
            return (new RekapRombel)
            ->query([
                'rombongan_belajar_id' => $this->rombongan_belajar_id, 
                'rombel' => $rombel, 
                'start' => $this->start, 
                'end' => $this->end, 
                'sekolah_id' => $this->sekolah_id,
                'semester_id' => $this->semester_id,
            ])
            ->download('rekap-pelanggaran-kelas'.$rombel->nama.'-'.Carbon::now()
            ->translatedFormat('d-F-Y').'.xlsx');
    }
    public function rekap_pd(){
        $pd = Peserta_didik::with([
            'pelanggaran' => function($query){
                if($this->end){
                    $query->whereDate('tanggal', '>=', $this->start);
                    $query->whereDate('tanggal', '<=', $this->end);
                }
                $query->orderBy('waktu');
            },
            'kelas' => function($query){
                $query->where('sekolah_id', $this->sekolah_id);
                $query->where('rombongan_belajar.semester_id', $this->semester_id);
            }
        ])->find($this->peserta_didik_id);
            return (new RekapPd)
            ->query(['pd' => $pd, 'start' => $this->start, 'end' => $this->end, 'sekolah_id' => $this->sekolah_id, 'semester_id' => $this->semester_id])
            ->download('rekap-pelanggaran-'.$pd->nama.'-'.Carbon::now()
            ->translatedFormat('d-F-Y').'.xlsx');
    }
}
