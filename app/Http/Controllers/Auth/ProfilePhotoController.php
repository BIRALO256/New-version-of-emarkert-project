<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class ProfilePhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        $decrptid=Crypt::decrypt($id);
        $user=User::find($decrptid);
        return view('profile.updatePhoto',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user=User::find($id);
        
        //validate the request
		$validator = Validator::make($request->all(), [
            'profile_image' => 'required|image',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $photo=$request->file('profile_image');
  
        $filename = time().'.'.$request->get('profile_image')->getClientOriginalExtension();
        $request->get('profile_image')->move(public_path('profile_pictures'), $filename);
  
        $user()->update(['profile_photo_path'=>$filename]);
  
        return back()->with('success', 'Photo updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
