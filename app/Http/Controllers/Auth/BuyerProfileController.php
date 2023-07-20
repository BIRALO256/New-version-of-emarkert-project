<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class BuyerProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user=User::find(Auth::id());
        return view('profile.buyer_profile.index',compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $id=Auth::user()->id;
        $user_addresses= UserAddress::with('user')->find($id);
        $user_addresses=UserAddress::where('user_id',$id)->get();
        return view('profile.buyer_profile.address_book',compact('user_addresses'));
    }

    //store the user address
    public function store(Request $request)
    {
        $address=UserAddress::create([
            'user_id'=>Auth::id(),
            'address'=>$request->get('address'),
            'add_information'=>$request->get('information'),
            'country'=>$request->get('country'),
            'region'=>$request->get('region'),
            'city_town'=>$request->get('city_town'),
            'created_by'=>Auth::user()->name,
        ]);
        return Redirect()->route('account.create')->with('success','Address added successfully');
       
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $id=Crypt::decrypt($id);
        $address=UserAddress::find($id);
        return view('profile.buyer_profile.edit_address',compact('address'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $address=UserAddress::find($id);
        $address->update([
            'address'=>$request->get('address'),
            'add_information'=>$request->get('information'),
            'country'=>$request->get('country'),
            'region'=>$request->get('region'),
            'city_town'=>$request->get('city_town'),
            'updated_by'=>Auth::user()->name,

        ]);
        return Redirect()->back()->with('success', 'Address updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $decryptid=Crypt::decrypt($id);

        DB::table("user_address")->where('id',$decryptid)->delete();
        
        return Redirect()->back()
            ->withSuccess(__('Address deleted successfully.'));
    }
}
