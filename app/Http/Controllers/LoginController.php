<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoginModel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
class LoginController extends Controller
{
    public function index() {

            return view('login');

    }

    public function proses(Request $request) {
        $key =  DB::table('keys')->first();
        $admin = new LoginModel();
        $username = $request->username;
        $ipassword = $request->password;
        $password=hash('sha512',$ipassword.$key->key);
        $cek = $admin->where(['username'=>$username,'password'=>$password])->first();
        if(empty($cek)) {
            return redirect('/')->with('logingagal','Login Gagal! Silahkan periksa kembali Username dan Password anda');
        } else {
            $app =  DB::table('pengaturan')->first();

            Session::put('cryptkeys',$key->key);
            //Session::put('idadmin',$cek['id']);
            Session::put('username',$username);
            //Session::put('namauser',$cek['nama_lengkap']);
            Session::put('level',$cek['level']);
            //Session::put('kodesales',$cek['kode']);
            //Session::put('info',$cek['info']);
            Session::put('namaaplikasi',$app->namaaplikasi);
            Session::put('footeraplikasi',$app->footeraplikasi);

            Session::put('saksikode',$cek->saksikode);
            Session::put('nama',$cek->nama);

            return redirect('/dashboard');
        }
    }


    public function logout(){
        Session::flush();
        return redirect('/')->with('logingagal','Anda berhasil logout.');
    }


    public function profil()
    {
        $id = Session::get('idadmin');
        $admin = new LoginModel();
        $query = $admin->find($id);
        $judulhalaman = 'Profil - Sistem Informasi Manajemen Percetakan';
        $judulmodul = 'Update Profil Pengguna';

        return view('profil/profil_edit',compact('query','judulhalaman','judulmodul'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function profilupdate(Request $request)
    {
        $adminku = new LoginModel();

        $username = $request->username;
        $nama = $request->nama;
        $email = $request->email;
        $password = $request->password;
        $id = $request->id;

        $admin = $adminku->find($id);
        $admin->username = $username;
        $admin->nama_lengkap = $nama;
        $admin->email = $email;
        if(!empty($password)):
            $admin->password = sha1($password);
        endif;
        $save = $admin->save();
        return redirect('profil')->with('pesan','Data Pengguna berhasil diubah.');
    }

//end of class
}
