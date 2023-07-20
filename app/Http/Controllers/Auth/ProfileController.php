<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use App\Models\User;
use App\Models\VendorBusinessInfo;
use App\Models\VendorShopInfo;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Expr\BinaryOp\NotEqual;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user=User::find(\Auth()->user()->id);
        return view('profile.index',compact('user'));
       
    }

    // return vendor shop information page
    public function create()
    {
        $user=User::find(\Auth()->user()->id);
    
        $vendor_shop=VendorShopInfo::where('user_id',$user->id)->first();
        
    
        return view('profile.shopInfo',compact('vendor_shop'));
       
    }

    
    //RETURN THE VENDOR BUSINESS PAGE
    public function returnVendorBusiness()
    {
        $id=Auth::id();
        $vendor_business=VendorBusinessInfo::find($id);
        return view('profile.businessInfo',compact('vendor_business'));
      
    }

    public function updateshop(Request $request, User $user)
    {
        $vendor=VendorShopInfo::find(Auth::id());
        if($vendor){
            $vendor->update([
                'user_id'=>Auth::id(),
                'shop_name'=>$request->get('shop_name'),
                'contact_name'=>$request->get('contact_name'),
                'email_address'=>$request->get('email_address'),
                'contact_phone1'=>$request->get('phone1'),
                'contact_phone2'=>$request->get('phone2'),
                'address_line1'=>$request->get('address1'),
                'address_line2'=>$request->get('address2'),
                'city_town'=>$request->get('city_town'),
                'state_region'=>$request->get('state_region'),
                'country'=>$request->get('country'),
                'postal_code'=>$request->get('postal_code'),
                'updated_by'=>Auth::user()->name,


            ]);
            return Redirect()->back()->with('success','Shop information updated successfully!');
        }else{
            VendorShopInfo::create([
                'user_id'=>Auth::id(),
                'shop_name'=>$request->get('shop_name'),
                'contact_name'=>$request->get('contact_name'),
                'email_address'=>$request->get('email_address'),
                'contact_phone1'=>$request->get('phone1'),
                'contact_phone2'=>$request->get('phone2'),
                'address_line1'=>$request->get('address1'),
                'address_line2'=>$request->get('address2'),
                'city_town'=>$request->get('city_town'),
                'state_region'=>$request->get('state_region'),
                'country'=>$request->get('country'),
                'postal_code'=>$request->get('postal_code'),
                'created_by'=>Auth::user()->name,

            ]);
            return Redirect()->back()->with('success','Shop information added successfully!');


        }
    }

    // return the payment method form
    public function createPayment(){
        $user=User::find(\Auth()->user()->id);
    
        $payment_method=PaymentMethod::where('user_id',$user->id)->first();
        return view('profile.paymentInfo',compact('payment_method'));
    }


    // create or update the payment method added by users
    public function updatePayment(Request $request){
        $user_id = Auth::id();
        $payment_option = $request->get('payment_option');
    
        $data = [
            'user_id' => $user_id,
            'method_name' => $payment_option,
        ];
    
        if ($payment_option === "Bank account") {
            $data += [
                'bank_name' => $request->get('bank_name'),
                'bank_account_name' => $request->get('account_name'),
                'bank_account_type' => $request->get('account_type'),
                'bank_account_number' => $request->get('account_number'),
            ];
            $success_message = 'Bank payment details ';
        } elseif ($payment_option === "Mobile Money") {
            $data += [
                'mmoney_number' => $request->get('mobile_number'),
                'mmoney_name' => $request->get('mobile_name'),
            ];
            $success_message = 'Mobile money payment details ';
        } else {
            // Handle other payment methods here if needed
            return redirect()->back()->with('error', 'Invalid payment option selected.');
        }
    
        // Find the PaymentMethod instance based on user_id and method_name
        $user_payment = PaymentMethod::where('user_id', $user_id)
                                     ->where('method_name', $payment_option)
                                     ->first();
    
        if (!$user_payment) {
            // If the instance doesn't exist, create a new one
            $data['created_by'] = Auth::user()->name;
            PaymentMethod::create($data);
            return redirect()->back()->with('success', $success_message . 'added successfully!');
        }
    
        // Update the existing PaymentMethod instance
        $data['updated_by'] = Auth::user()->name;
        $user_payment->update($data);
        return redirect()->back()->with('success', $success_message . 'updated successfully!');
    
}


//create or update a vendor business information based on existence state
public function createOrUpdate(Request $request){
    $user_id = Auth::id();
    $business_info = VendorBusinessInfo::find($user_id);
    $selected=$request->get('identification');
    
        $data = [
            'user_id' => $user_id,
            'id_type'=>$selected,
            'owner_name'=>$request->get('owner_name'),
            'address1'=>$request->get('address1'),
            'address2'=>$request->get('address2'),
            'city_town'=>$request->get('city_town'),
            'state_region'=>$request->get('state_region'),
            'country'=>$request->get('country'),
            'postal_code'=>$request->get('postal_code'),
        ];

    if ($business_info) {
        if($selected=="National ID"){
            $data+=[
                'id_number'=>$request->get('nin_number'),
                'id_attach_url'=>$request->get('national_id_file')
            ];
        }
        if($selected=="Driving Lisence"){
            $data+=[
                'id_number'=>$request->get('lisence_number'),
                'id_attach_url'=>$request->get('lisence_file')
            ];
        }
        if($selected=="Passport"){
            $data+=[
                'id_number'=>$request->get('passport_number'),
                'id_attach_url'=>$request->get('passport_file')
            ];
        }

        $data += [
            'updated_by'=>Auth::user()->name,
        ];

        $business_info->update($data);
        return Redirect()->back()->with('success', 'Shop business information updated successfully!');

    } else {
        if($selected=="National ID"){
            $data+=[
                'id_number'=>$request->get('nin_number'),
                'id_attach_url'=>$request->get('national_id_file')
            ];
        }
        if($selected=="Driving Lisence"){
            $data+=[
                'id_number'=>$request->get('lisence_number'),
                'id_attach_url'=>$request->get('lisence_file')
            ];
        }
        if($selected=="Passport"){
            $data+=[
                'id_number'=>$request->get('passport_number'),
                'id_attach_url'=>$request->get('passport_file')
            ];
        }
        $data += [
            'created_by'=>Auth::user()->name,
        ];
        VendorBusinessInfo::create($data);
        return Redirect()->back()->with('success', 'Shop business information added successfully!');
    }

}



    public function show(string $id)
    {
        //
    }

    //send update request for a user profile
    public function edit($id)
    {
        $decryptid=Crypt::decrypt($id);
        $user = User::find($decryptid);
        return view('profile.edit',compact('user'));
    }

    //update a user profile
    public function update(Request $request,$id)
    {
        $user=User::find($id);

        
        if ($request->hasFile('profile_pic')) {
            $request->validate([
                'profile_pic' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);
            $fileName = time() . '.' . $request->file('profile_pic')->extension();
            $request->file('profile_pic')->storeAs('public/images/profiles', $fileName);
            $user->update([ 'profile_photo_path'=>$fileName]);
        }

        if($request->input('password')==null){
            $user->update([
                'name'=>$request->input('name'),
                'email'=>$request->input('email'),
                'phone_number'=>$request->input('phone'),
                'updated_by'=>Auth()->user()->name,
            ]);
            }
            if(!($request->input('password')==null)){
                if (Hash::check($request->input('password'), $user->password)) {
                    return Redirect()->back()
                        ->with('error', 'Your new password cannot be the same as the current password!');
                }else{
                    $user->update([
                        'name'=>$request->input('name'),
                        'email'=>$request->input('email'),
                        'phone_number'=>$request->input('phone'),
                        'password'=>$request->input('password'),
                        'updated_by'=>Auth()->user()->name,

                    ]);
                    return Redirect()->back()
                     ->withSuccess(__('Profile updated successfully.'));
        
            }

        }
        return Redirect()->back()
                    ->withSuccess(__('Profile updated successfully.'));
        
        

        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
