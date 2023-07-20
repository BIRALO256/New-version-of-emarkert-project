<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\payement_type;
use Illuminate\Support\Facades\Crypt;

class payementController extends Controller
{
    public function index(){
        $data1 =payement_type::paginate(7);
        return view('payement.index',compact('data1'));
    }

    public function create(Request $request){
       
      $data = new payement_type;
      $data->payementType =$request->name;
      $data->save();
      return redirect()->back()->with('message','payement type Added Succefully');
    }

    public function deletepayement($id){
        $decrypt=Crypt::decrypt($id);
            
        $data2=payement_type::find($decrypt);
        $data2->delete();

        return redirect()->back()->with('message','payement type Added Succefully');
      }
}
