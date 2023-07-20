<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\country;
use Illuminate\Support\Facades\Crypt;

class countrycontroller extends Controller
{
    public function index(){

        $data1 =country::paginate(5);
        return view('countrys.index',compact('data1'));
    }

    public function addcountry (Request $request)
    {
      $data = new country;
      $data->countryname =$request->name;
      $data->save();
      return redirect()->back()->with('message','Country Added Succefully');
    }
   

    public function deletecountry($id){

        $decrypt=Crypt::decrypt($id);
            
        $data2=country::find($decrypt);
        $data2->delete();
        return redirect()->back()->with('message','deleted Succefully');

    }
   


}
