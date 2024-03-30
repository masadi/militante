<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Koordinator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class RegisterMilitanteController extends Controller
{
    public function index() {
        if(!Session::get('username')){
            redirect('/');
        } else {
            $judulhalaman = 'Koordinator';
            $judulmodul = 'Koordinator';
            $koordinator = new Koordinator();
            $query = $koordinator->orderBy('idkoordinator','DESC')->get();
            return view('registermilitante/registermilitante_index',compact('query','judulmodul','judulhalaman'));
        }
    }


//end of class
}
