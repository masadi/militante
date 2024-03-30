<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RelFamilia;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class RelFamiliaController extends Controller
{
    public function index() {
        if(!Session::get('username')){
            redirect('/');
        } else {
            $judulhalaman = 'Relasaun Familia ho Chefi Familia / Responsavel';
            $judulmodul = 'Relasaun Familia ho Chefi Familia / Responsavel';

            $urltambah='relfamilia/save';
            $urlupdate='relfamilia/updateaction';
            $urldelete='relfamilia/delete';
            $urledit='relfamilia/update';

            $data =  DB::table('relfamilia')->orderBy('id','DESC')->get();
            return view('relfamilia/relfamilia_index',compact('judulmodul','judulhalaman','data','urltambah','urledit','urlupdate','urldelete'));
        }
    }

	public function save(Request $request)
	{
        $name = $request->name;
        $value = $request->value;

        $data = new RelFamilia();
        $data->name = $name;
        $data->value = $value;
        $data->save();

		echo json_encode(array("status"=>TRUE));
	}
	public function update($id)
	{
        $dataku = new RelFamilia();
		$data=DB::table('relfamilia')->find($id);
		echo json_encode($data);
	}
	public function updateaction(Request $request)
	{
        $name = $request->name;
        $value = $request->value;

        $dataku = new RelFamilia();
        $data=$dataku->find($request->id);
        $data->name = $name;
        $data->value = $value;
        $data->save();
        echo json_encode(array("status"=>TRUE));
	}
	public function delete($id)
	{
        $dataku = new RelFamilia();
        $data = $dataku->find($id);
        $data->delete();
		echo json_encode(array("status"=>TRUE));
	}

//end of class
}
