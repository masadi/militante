<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estatuto;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class EstatutoController extends Controller
{
    public function index() {
        if(!Session::get('username')){
            redirect('/');
        } else {
            $judulhalaman = 'Estatuto / Mutasaun';
            $judulmodul = 'Estatuto / Mutasaun';


            $data =  DB::table('estatuto')->orderBy('id','DESC')->get();
            return view('estatuto/estatuto_index',compact('judulmodul','judulhalaman','data'));
        }
    }

	public function save(Request $request)
	{
        $name = $request->name;
        $value = $request->value;

        $data = new estatuto();
        $data->name = $name;
        $data->value = $value;
        $data->save();

		echo json_encode(array("status"=>TRUE));
	}
	public function update($id)
	{
        $dataku = new estatuto();
		$data=DB::table('estatuto')->find($id);
		echo json_encode($data);
	}
	public function updateaction(Request $request)
	{
        $name = $request->name;
        $value = $request->value;

        $dataku = new estatuto();
        $data=$dataku->find($request->id);
        $data->name = $name;
        $data->value = $value;
        $data->save();
        echo json_encode(array("status"=>TRUE));
	}
	public function delete($id)
	{
        $dataku = new estatuto();
        $data = $dataku->find($id);
        $data->delete();
		echo json_encode(array("status"=>TRUE));
	}

//end of class
}
