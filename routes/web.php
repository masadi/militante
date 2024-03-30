<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AktaController;
use App\Http\Controllers\SaksiController;
use App\Http\Controllers\CalonController;
use App\Http\Controllers\KabupatenController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\KelurahanController;
use App\Http\Controllers\TpsController;
use App\Http\Controllers\TpsdetailController;
use App\Http\Controllers\PemilihController;
use App\Http\Controllers\KoordinatorController;
use App\Http\Controllers\RelawanController;
use App\Http\Controllers\TimController;
use App\Http\Controllers\TargetController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\SmsController;
use App\Http\Controllers\HitungController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\AnalisaController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\EvenController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\RelFamiliaController;
use App\Http\Controllers\AktMilitanteController;
use App\Http\Controllers\KargoAktualController;
use App\Http\Controllers\SectorServicoController;
use App\Http\Controllers\ProfisaunController;
use App\Http\Controllers\LiterariaController;
use App\Http\Controllers\EstatutoController;
use App\Http\Controllers\MembruController;

use App\Http\Controllers\MilitanteController;
use App\Http\Controllers\MilitanteVipController;
use App\Http\Controllers\MilitanteDiasporaController;
use App\Http\Controllers\UmakainController;

use App\Http\Controllers\CetakController;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\EscolaController;
use App\Http\Controllers\FaculdadeController;
use App\Http\Controllers\EsperianciaController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




//CETAK

Route::get('/cetak/militante/{id}',[CetakController::class,'cetakmilitante']);
Route::get('/cetak/militantediaspora/{id}',[CetakController::class,'cetakmilitantediaspora']);
Route::get('/cetak/militantevip/{id}',[CetakController::class,'cetakmilitantevip']);
Route::get('/cetak/umakain/{id}',[CetakController::class,'cetakumakain']);

//REGISTER MILITANTE

Route::get('/militante/register',[MilitanteController::class,'register']);
Route::get('/militante/ajax_list',[MilitanteController::class,'ajax_list']);
Route::post('/militante/saveregister',[MilitanteController::class,'saveregister']);
Route::get('/militante/listregister',[MilitanteController::class,'listregister']);
Route::get('/militante/register_buletin/{id}',[MilitanteController::class,'listbuletin']);
Route::get('/militante/register_edit/{id}',[MilitanteController::class,'registeredit']);
Route::post('/militante/updateregister',[MilitanteController::class,'updateregister']);
Route::get('/militante/registerdelete/{id}',[MilitanteController::class,'registerdelete']);

//MILITANTE
Route::get('/militante',[MilitanteController::class,'index']);
Route::get('/militante/list',[MilitanteController::class,'list']);
Route::get('/militante/edit/{id}',[MilitanteController::class,'edit']);
Route::get('/militante/delete/{id}',[MilitanteController::class,'delete']);
Route::post('/militante/save',[MilitanteController::class,'save']);
Route::post('/militante/update',[MilitanteController::class,'update']);
Route::get('/militante/searchno/{id}',[MilitanteController::class,'searchno']); 
Route::get('/militante/get_kecamatan/{id}',[TimController::class,'get_kecamatan']);
Route::get('/militante/get_kelurahan/{id}',[TimController::class,'get_kelurahan']);
Route::get('/militante/get_tps/{id}',[TimController::class,'get_tps']);
Route::get('/militante/download',[MilitanteController::class,'download']);

Route::get('/militantevip',[MilitanteVipController::class,'index']);
Route::get('/militantevip/list',[MilitanteVipController::class,'list']);
Route::get('/militantevip/edit/{id}',[MilitanteVipController::class,'edit']);
Route::get('/militantevip/delete/{id}',[MilitanteVipController::class,'delete']);
Route::post('/militantevip/save',[MilitanteVipController::class,'save']);
Route::post('/militantevip/update',[MilitanteVipController::class,'update']);
Route::get('/militantevip/get_kecamatan/{id}',[TimController::class,'get_kecamatan']);
Route::get('/militantevip/get_kelurahan/{id}',[TimController::class,'get_kelurahan']);
Route::get('/militantevip/get_tps/{id}',[TimController::class,'get_tps']);
Route::get('/militantevip/lidownloadst',[MilitanteVipController::class,'download']);
Route::get('/militantevip/searchno/{id}',[MilitanteVipController::class,'searchno']); 


Route::get('/militantediaspora',[MilitanteDiasporaController::class,'index']);
Route::get('/militantediaspora/list',[MilitanteDiasporaController::class,'list']);
Route::get('/militantediaspora/edit/{id}',[MilitanteDiasporaController::class,'edit']);
Route::get('/militantediaspora/delete/{id}',[MilitanteDiasporaController::class,'delete']);
Route::post('/militantediaspora/save',[MilitanteDiasporaController::class,'save']);
Route::post('/militantediaspora/update',[MilitanteDiasporaController::class,'update']);
Route::get('/militantediaspora/get_kecamatan/{id}',[TimController::class,'get_kecamatan']);
Route::get('/militantediaspora/get_kelurahan/{id}',[TimController::class,'get_kelurahan']);
Route::get('/militantediaspora/get_tps/{id}',[TimController::class,'get_tps']);
Route::get('/militantediaspora/download',[MilitanteDiasporaController::class,'download']);

//UMAKAIN
Route::get('/addumakain',[UmakainController::class,'index']);
Route::get('/umakain/list',[UmakainController::class,'list']);
Route::get('/umakain/searchid/{id}',[UmakainController::class,'searchid']);
Route::post('/umakain/save',[UmakainController::class,'save']);
Route::get('/umakain/edit/{id}',[UmakainController::class,'edit']);
Route::get('/umakain/delete/{id}',[UmakainController::class,'delete']);
Route::get('/umakain/searchnama/{id}',[UmakainController::class,'searchnama']);
Route::post('/umakain/savemilitante',[UmakainController::class,'savemilitante']);

//log
Route::get('/',[LoginController::class,'index']);
Route::post('/loginproses',[LoginController::class,'proses']);
Route::get('/login/logout',[LoginController::class,'logout']);
Route::get('/dashboard',[DashboardController::class,'index']);
Route::get('/tablekabupaten',[DashboardController::class,'tablekabupaten']);
Route::get('/tablekecamatan',[DashboardController::class,'tablekecamatan']);
Route::get('/tablekelurahan',[DashboardController::class,'tablekelurahan']);
Route::get('/tabletps',[DashboardController::class,'tabletps']);

//MASTER DATA
//AKTA
Route::get('/dpt',[AktaController::class,'index']);
Route::post('/dpt/ajax_list',[AktaController::class,'ajax_list']);
Route::get('/dpt/ajax_edit/{id}',[AktaController::class,'ajax_edit']);
Route::post('/dpt/ajax_add',[AktaController::class,'ajax_add']);
Route::post('/dpt/ajax_update',[AktaController::class,'ajax_update']);
Route::get('/dpt/ajax_delete/{id}',[AktaController::class,'ajax_delete']);
Route::get('/dpt/get_kecamatan_edit/{id}',[AktaController::class,'get_kecamatan_edit']);
Route::get('/dpt/get_kelurahan_edit/{id}',[AktaController::class,'get_kelurahan_edit']);
Route::get('/dpt/get_tps_edit/{id}',[AktaController::class,'get_tps_edit']);
Route::get('/dpt/get_kecamatan/{id}',[AktaController::class,'get_kecamatan']);
Route::get('/dpt/get_kelurahan/{id}',[AktaController::class,'get_kelurahan']);
Route::get('/dpt/get_tps/{id}',[AktaController::class,'get_tps']);
//FISCAIS
Route::get('/saksi',[SaksiController::class,'index']);
Route::get('/saksi/get_kecamatan/{id}',[SaksiController::class,'get_kecamatan']);
Route::get('/saksi/get_kelurahan/{id}',[SaksiController::class,'get_kelurahan']);
Route::get('/saksi/get_tps/{id}',[SaksiController::class,'get_tps']);
Route::post('/saksi/save',[SaksiController::class,'save']);
Route::get('/saksi/update/{id}',[SaksiController::class,'update']);
Route::post('/saksi/updateaction',[SaksiController::class,'updateaction']);
Route::get('/saksi/delete/{id}',[SaksiController::class,'delete']);
Route::get('/saksi/verify_saksi/{id}',[SaksiController::class,'verify_saksi']);


//Presiden
Route::get('/calon',[CalonController::class,'index']);
Route::get('/calon/ajax_list',[CalonController::class,'ajax_list']);
Route::get('/calon/ajax_edit/{id}',[CalonController::class,'ajax_edit']);
Route::post('/calon/ajax_add',[CalonController::class,'ajax_add']);
Route::post('/calon/ajax_update',[CalonController::class,'ajax_update']);
Route::get('/calon/ajax_delete/{id}',[CalonController::class,'ajax_delete']);


//Kabupaten
Route::get('/kabupaten',[KabupatenController::class,'index']);
Route::get('/kabupaten/ajax_list',[KabupatenController::class,'ajax_list']);
Route::get('/kabupaten/ajax_edit/{id}',[KabupatenController::class,'ajax_edit']);
Route::post('/kabupaten/ajax_add',[KabupatenController::class,'ajax_add']);
Route::post('/kabupaten/ajax_update',[KabupatenController::class,'ajax_update']);
Route::get('/kabupaten/ajax_delete/{id}',[KabupatenController::class,'ajax_delete']);
Route::get('/kabupaten/upload',[KabupatenController::class,'upload']);
Route::post('/kabupaten/excel',[KabupatenController::class,'excelmunicipio']);

//Kecamatan
Route::get('/kecamatan',[KecamatanController::class,'index']);
Route::get('/kecamatan/ajax_list',[KecamatanController::class,'ajax_list']);
Route::get('/kecamatan/ajax_edit/{id}',[KecamatanController::class,'ajax_edit']);
Route::post('/kecamatan/ajax_add',[KecamatanController::class,'ajax_add']);
Route::post('/kecamatan/ajax_update',[KecamatanController::class,'ajax_update']);
Route::get('/kecamatan/ajax_delete/{id}',[KecamatanController::class,'ajax_delete']);
Route::get('/kecamatan/upload',[KecamatanController::class,'upload']);
Route::post('/kecamatan/excel',[KecamatanController::class,'excel']);

//Kelurahan
Route::get('/kelurahan',[KelurahanController::class,'index']);
Route::get('/kelurahan/ajax_list',[KelurahanController::class,'ajax_list']);
Route::get('/kelurahan/get_kecamatan/{id}',[KelurahanController::class,'get_kecamatan']);
Route::get('/kelurahan/get_kecamatan_edit/{id}',[KelurahanController::class,'get_kecamatan_edit']);
Route::get('/kelurahan/ajax_edit/{id}',[KelurahanController::class,'ajax_edit']);
Route::post('/kelurahan/ajax_add',[KelurahanController::class,'ajax_add']);
Route::post('/kelurahan/ajax_update',[KelurahanController::class,'ajax_update']);
Route::get('/kelurahan/ajax_delete/{id}',[KelurahanController::class,'ajax_delete']);
Route::get('/kelurahan/upload',[KelurahanController::class,'upload']);
Route::post('/kelurahan/excel',[KelurahanController::class,'excel']);

//Tps
Route::get('/tps',[TpsController::class,'index']);
Route::get('/tps/ajax_list',[TpsController::class,'ajax_list']);
Route::get('/tps/ajax_edit/{id}',[TpsController::class,'ajax_edit']);
Route::post('/tps/ajax_add',[TpsController::class,'ajax_add']);
Route::post('/tps/ajax_update',[TpsController::class,'ajax_update']);
Route::get('/tps/ajax_delete/{id}',[TpsController::class,'ajax_delete']);
Route::get('/tps/get_kecamatan_edit/{id}',[TpsController::class,'get_kecamatan_edit']);
Route::get('/tps/get_kelurahan_edit/{id}',[TpsController::class,'get_kelurahan_edit']);
Route::get('/tps/get_tps_edit/{id}',[TpsController::class,'get_tps_edit']);
Route::get('/tps/get_kecamatan/{id}',[TpsController::class,'get_kecamatan']);
Route::get('/tps/get_kelurahan/{id}',[TpsController::class,'get_kelurahan']);
Route::get('/tps/get_tps/{id}',[TpsController::class,'get_tps']);
Route::get('/tps/upload',[TpsController::class,'upload']);
Route::post('/tps/excel',[TpsController::class,'excel']);

//TpsDetail
Route::get('/tps_detail',[TpsdetailController::class,'index']);
Route::get('/tps_detail/ajax_list',[TpsdetailController::class,'ajax_list']);
Route::get('/tps_detail/ajax_edit/{id}',[TpsdetailController::class,'ajax_edit']);
Route::post('/tps_detail/ajax_add',[TpsdetailController::class,'ajax_add']);
Route::post('/tps_detail/ajax_update',[TpsdetailController::class,'ajax_update']);
Route::get('/tps_detail/ajax_delete/{id}',[TpsdetailController::class,'ajax_delete']);
Route::get('/tps_detail/get_kecamatan_edit/{id}',[TpsdetailController::class,'get_kecamatan_edit']);
Route::get('/tps_detail/get_kelurahan_edit/{id}',[TpsdetailController::class,'get_kelurahan_edit']);
Route::get('/tps_detail/get_tps_edit/{id}',[TpsdetailController::class,'get_tps_edit']);
Route::get('/tps_detail/get_kecamatan/{id}',[TpsdetailController::class,'get_kecamatan']);
Route::get('/tps_detail/get_kelurahan/{id}',[TpsdetailController::class,'get_kelurahan']);
Route::get('/tps_detail/get_tps/{id}',[TpsdetailController::class,'get_tps']);

//Pemilih
Route::get('/pemilih',[PemilihController::class,'index']);
Route::get('/pemilih/ajax_list',[PemilihController::class,'ajax_list']);
Route::get('/pemilih/ajax_edit/{id}',[PemilihController::class,'ajax_edit']);
Route::post('/pemilih/ajax_add',[PemilihController::class,'ajax_add']);
Route::post('/pemilih/ajax_update',[PemilihController::class,'ajax_update']);
Route::get('/pemilih/ajax_delete/{id}',[PemilihController::class,'ajax_delete']);
Route::get('/pemilih/cetak',[PemilihController::class,'cetak']);

//Koordinator
Route::get('/koordinator',[KoordinatorController::class,'index']);
Route::get('/koordinator/ajax_list',[KoordinatorController::class,'ajax_list']);

//Relawan
Route::get('/relawan',[RelawanController::class,'index']);
Route::get('/relawan/ajax_list',[RelawanController::class,'ajax_list']);

//Tim
Route::get('/tim',[TimController::class,'index']);
Route::get('/tim/get_kecamatan/{id}',[TimController::class,'get_kecamatan']);
Route::get('/tim/get_kelurahan/{id}',[TimController::class,'get_kelurahan']);
Route::get('/tim/get_tps/{id}',[TimController::class,'get_tps']);
Route::post('/tim/save',[TimController::class,'save']);
Route::get('/tim/update/{id}',[TimController::class,'update']);
Route::post('/tim/updateaction',[TimController::class,'updateaction']);
Route::get('/tim/delete/{id}',[TimController::class,'delete']);
Route::get('/tim/detail/{id}',[TimController::class,'detail']);

//Tim
Route::get('/target',[TargetController::class,'index']);
Route::get('/target/get_kecamatan/{id}',[TargetController::class,'get_kecamatan']);
Route::get('/target/get_kelurahan/{id}',[TargetController::class,'get_kelurahan']);
Route::get('/target/get_tps/{id}',[TargetController::class,'get_tps']);
Route::post('/target/save',[TargetController::class,'save']);
Route::get('/target/update/{id}',[TargetController::class,'update']);
Route::post('/target/updateaction',[TargetController::class,'updateaction']);
Route::get('/target/delete/{id}',[TargetController::class,'delete']);

//Api
Route::get('/api',[ApiController::class,'index']);
Route::get('/api/cek_kredit',[ApiController::class,'kredit']);

//Sms
Route::get('/sms/semuakoordinator',[SmsController::class,'semuakoordinator']);
Route::post('/sms/aksikoordinator',[SmsController::class,'aksikoordinator']);
Route::get('/sms/groupkoordinatorkabupaten',[SmsController::class,'groupkoordinatorkabupaten']);
Route::get('/sms/groupkoordinatorkecamatan',[SmsController::class,'groupkoordinatorkecamatan']);
Route::get('/sms/groupkoordinatorkelurahan',[SmsController::class,'groupkoordinatorkelurahan']);

Route::get('/sms/semuapemilih',[SmsController::class,'semuapemilih']);
Route::get('/sms/grouppemilihkabupaten',[SmsController::class,'grouppemilihkabupaten']);
Route::get('/sms/grouppemilihkecamatan',[SmsController::class,'grouppemilihkecamatan']);
Route::get('/sms/grouppemilihkelurahan',[SmsController::class,'grouppemilihkelurahan']);

//Hitung
Route::get('/hitung',[HitungController::class,'index']);
Route::get('/hitung/delete/{id}',[HitungController::class,'delete']);

//Upload
Route::get('/upload',[UploadController::class,'index']);
//Analisa
Route::get('/analisa',[AnalisaController::class,'index']);
Route::get('/analisa/get_kecamatan/{id}',[AnalisaController::class,'get_kecamatan']);
Route::get('/analisa/get_kelurahan/{id}',[AnalisaController::class,'get_kelurahan']);
Route::get('/analisa/get_tps/{id}',[AnalisaController::class,'get_tps']);
Route::post('/analisa/save',[AnalisaController::class,'save']);
Route::get('/analisa/update/{id}',[AnalisaController::class,'update']);
Route::post('/analisa/updateaction',[AnalisaController::class,'updateaction']);
Route::get('/analisa/delete/{id}',[AnalisaController::class,'delete']);

//Kegiatan
Route::get('/kegiatan',[KegiatanController::class,'index']);
Route::get('/kegiatan/ajax_list',[KegiatanController::class,'ajax_list']);

//User
Route::get('/user',[UserController::class,'index']);
Route::post('/user/save',[UserController::class,'save']);
Route::post('/user/updateaction',[UserController::class,'updateaction']);
Route::get('/user/update/{id}',[UserController::class,'update']);
Route::get('/user/delete/{id}',[UserController::class,'delete']);

//Profil
Route::get('/profil',[ProfilController::class,'index']);

//Pengaturan
Route::get('/pengaturan',[PengaturanController::class,'index']);
Route::post('/pengaturan/simpan',[PengaturanController::class,'simpan']);

//Even
Route::get('/even',[EvenController::class,'index']);
Route::post('/even/save',[EvenController::class,'save']);
Route::post('/even/updateaction',[EvenController::class,'updateaction']);
Route::get('/even/update/{id}',[EvenController::class,'update']);
Route::get('/even/delete/{id}',[EvenController::class,'delete']);

//-------------------------
//RelFamilia
Route::get('/relfamilia',[RelFamiliaController::class,'index']);
Route::post('/relfamilia/save',[RelFamiliaController::class,'save']);
Route::post('/relfamilia/updateaction',[RelFamiliaController::class,'updateaction']);
Route::get('/relfamilia/update/{id}',[RelFamiliaController::class,'update']);
Route::get('/relfamilia/delete/{id}',[RelFamiliaController::class,'delete']);

//AktMilitante
Route::get('/aktmilitante',[AktMilitanteController::class,'index']);
Route::post('/aktmilitante/save',[AktMilitanteController::class,'save']);
Route::post('/aktmilitante/updateaction',[AktMilitanteController::class,'updateaction']);
Route::get('/aktmilitante/update/{id}',[AktMilitanteController::class,'update']);
Route::get('/aktmilitante/delete/{id}',[AktMilitanteController::class,'delete']);

//KargoAktual
Route::get('/kargoaktual',[KargoAktualController::class,'index']);
Route::post('/kargoaktual/save',[KargoAktualController::class,'save']);
Route::post('/kargoaktual/updateaction',[KargoAktualController::class,'updateaction']);
Route::get('/kargoaktual/update/{id}',[KargoAktualController::class,'update']);
Route::get('/kargoaktual/delete/{id}',[KargoAktualController::class,'delete']);

//SectorServico
Route::get('/sectorservico',[SectorServicoController::class,'index']);
Route::post('/sectorservico/save',[SectorServicoController::class,'save']);
Route::post('/sectorservico/updateaction',[SectorServicoController::class,'updateaction']);
Route::get('/sectorservico/update/{id}',[SectorServicoController::class,'update']);
Route::get('/sectorservico/delete/{id}',[SectorServicoController::class,'delete']);

//Profisaun
Route::get('/profisaun',[ProfisaunController::class,'index']);
Route::post('/profisaun/save',[ProfisaunController::class,'save']);
Route::post('/profisaun/updateaction',[ProfisaunController::class,'updateaction']);
Route::get('/profisaun/update/{id}',[ProfisaunController::class,'update']);
Route::get('/profisaun/delete/{id}',[ProfisaunController::class,'delete']);

//Literaria
Route::get('/literaria',[LiterariaController::class,'index']);
Route::post('/literaria/save',[LiterariaController::class,'save']);
Route::post('/literaria/updateaction',[LiterariaController::class,'updateaction']);
Route::get('/literaria/update/{id}',[LiterariaController::class,'update']);
Route::get('/literaria/delete/{id}',[LiterariaController::class,'delete']);

//Estatuto
Route::get('/estatuto',[EstatutoController::class,'index']);
Route::post('/estatuto/save',[EstatutoController::class,'save']);
Route::post('/estatuto/updateaction',[EstatutoController::class,'updateaction']);
Route::get('/estatuto/update/{id}',[EstatutoController::class,'update']);
Route::get('/estatuto/delete/{id}',[EstatutoController::class,'delete']);

//Membru
Route::get('/membru',[MembruController::class,'index']);
Route::post('/membru/save',[MembruController::class,'save']);
Route::post('/membru/updateaction',[MembruController::class,'updateaction']);
Route::get('/membru/update/{id}',[MembruController::class,'update']);
Route::get('/membru/delete/{id}',[MembruController::class,'delete']);


//periode
Route::get('/periode',[PeriodeController::class,'index']);
Route::post('/periode/save',[PeriodeController::class,'save']);
Route::post('/periode/updateaction',[PeriodeController::class,'updateaction']);
Route::get('/periode/update/{id}',[PeriodeController::class,'update']);
Route::get('/periode/delete/{id}',[PeriodeController::class,'delete']);

//escola
Route::get('/escola',[EscolaController::class,'index']);
Route::post('/escola/save',[EscolaController::class,'save']);
Route::post('/escola/updateaction',[EscolaController::class,'updateaction']);
Route::get('/escola/update/{id}',[EscolaController::class,'update']);
Route::get('/escola/delete/{id}',[EscolaController::class,'delete']);

//faculdade
Route::get('/faculdade',[FaculdadeController::class,'index']);
Route::post('/faculdade/save',[FaculdadeController::class,'save']);
Route::post('/faculdade/updateaction',[FaculdadeController::class,'updateaction']);
Route::get('/faculdade/update/{id}',[FaculdadeController::class,'update']);
Route::get('/faculdade/delete/{id}',[FaculdadeController::class,'delete']);

//Esperiancia 
Route::get('/esperiancia',[EsperianciaController::class,'index']);
Route::post('/esperiancia/save',[EsperianciaController::class,'save']);
Route::post('/esperiancia/updateaction',[EsperianciaController::class,'updateaction']);
Route::get('/esperiancia/update/{id}',[EsperianciaController::class,'update']);
Route::get('/esperiancia/delete/{id}',[EsperianciaController::class,'delete']);

/*
<li class="<?php // $dpt ?>"><a class="nav-link" href="{{url('relfamilia')}}">Rel. Familia</a></li>
<li class="<?php // $dpt ?>"><a class="nav-link" href="{{url('aktmilitante')}}">Akt. Militante</a></li>
<li class="<?php // $dpt ?>"><a class="nav-link" href="{{url('kargoaktual')}}">Kargo Aktual Iha Orgaun Estrutura</a></li>
<li class="<?php // $dpt ?>"><a class="nav-link" href="{{url('serctorservico')}}">Sector Servico</a></li>
<li class="<?php // $dpt ?>"><a class="nav-link" href="{{url('profisaun')}}">Profisaun</a></li>
<li class="<?php // $dpt ?>"><a class="nav-link" href="{{url('literaria')}}">Hab. Literaria</a></li>
<li class="<?php // $dpt ?>"><a class="nav-link" href="{{url('estatutu')}}">Estatutu Mutasaun Militante</a></li>
<li class="<?php // $dpt ?>"><a class="nav-link" href="{{url('membru')}}">Membru Cooperative</a></li>
*/
