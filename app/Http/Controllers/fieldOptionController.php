<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Crypt;
use App\Models\subcategory_field;
use App\Models\product_subcategory;
use App\Models\fielddoption;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class fieldOptionController extends Controller
{
    public function index($id,$id2)
    {
        $decrypt1=Crypt::decrypt($id);
        $data12=subcategory_field::find($decrypt1);

        $decrypt=Crypt::decrypt($id2);
        $data14=product_subcategory::find($decrypt); 
        $data1= fielddoption::where('subcategoryfieldId',$decrypt1)->paginate(5);
        return view('fieldoption.index',compact('data12','data1','data14',));
       
    }
    public function displaypage($id)
    {
        $decrypt=Crypt::decrypt($id);
        $data13=subcategory_field::find($decrypt);

        $decrypt1=Crypt::decrypt($id);
        $data14=product_subcategory::find($decrypt1);

         return view('fieldoption.store',compact('data13','data14',));
       
    }

    public function storefieldOption(Request $request){

        $data = new fielddoption;
        $data->subcategoryfieldId =$request->subcategoryFieldID;
        $data->name =$request->fieldOption;
        $data->created_by=Auth::user()->id;
        $data->save();

        return redirect()->back()->with('message','Field option Added Succefully');

         
// // $validator = Validator::make($request->all(), [
// //     'name' => 'required|string|max:255|min:3',
// //     'email' => 'required|string|email|unique:users',
// //     'password' => 'required|string|min:8|confirmed',
// //     'phone' => 'required|string|min:8',


// // ]);

// // if ($validator->fails()) {
// //     return redirect()->back()->withErrors($validator)->withInput();
// }

    }




}
