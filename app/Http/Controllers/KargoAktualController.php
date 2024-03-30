<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KargoAktual;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class KargoAktualController extends Controller
{
    public function index() {
        if(!Session::get('username')){
            redirect('/');
        } else {
            $judulhalaman = 'Kargo Atual iha Orgaun Estrutura';
            $judulmodul = 'Kargo Atual iha Orgaun Estrutura';


            $data =  DB::table('kargoaktual')->orderBy('id','DESC')->get();
            return view('kargoaktual/kargoaktual_index',compact('judulmodul','judulhalaman','data'));
        }
    }

	public function save(Request $request)
	{
        $name = $request->name;
        $value = $request->value;

        $data = new kargoaktual();
        $data->name = $name;
        $data->value = $value;
        $data->save();

		echo json_encode(array("status"=>TRUE));
	}
	public function update($id)
	{
        $dataku = new kargoaktual();
		$data=DB::table('kargoaktual')->find($id);
		echo json_encode($data);
	}
	public function updateaction(Request $request)
	{
        $name = $request->name;
        $value = $request->value;

        $dataku = new kargoaktual();
        $data=$dataku->find($request->id);
        $data->name = $name;
        $data->value = $value;
        $data->save();
        echo json_encode(array("status"=>TRUE));
	}
	public function delete($id)
	{
        $dataku = new kargoaktual();
        $data = $dataku->find($id);
        $data->delete();
		echo json_encode(array("status"=>TRUE));
	}

//end of class
}
