<?php

namespace App\Http\Controllers;

use App\Exports\ExportSuppliers;
use App\Http\Requests\UpdateUserRequest;
use App\Imports\SuppliersImport;
use App\Models\EmailVerification;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use PDF;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class UserController extends Controller
 {
	public function __construct() {
		// $this->middleware('role:Admin,Buyer');
	}
	
	//display a list of available users
	public function index() {
		$users = User::latest()->paginate(8);
		return view('user.index',compact('users'));
	}

    
	//return form when create user requested by normal user
	public function createUser(){
        return view('auth.register');
    }


	//store user created by normal user
	public function storeUser(Request $request){
		//validate the request
		$validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|min:3',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'required|string|min:8',


        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

		$role=Role::where('name','Buyer')->first();
		//check user existence with email
		$checkUserEmailExistence=User::where('email',$request['email'])->first();
		//check user existence with phone number
		$checkUserPhoneExistence=User::where('phone_number',$request['phone'])->first();

		if(!$checkUserEmailExistence){
			if(!$checkUserPhoneExistence){
				$user= User::create([
					'name' => $request['name'],
					'email' => $request['email'],
					'phone_number'=>$request['phone'],
					'password' => $request['password'],
					'created_by'=>$request['name'],
					'role'=>$role->name,
				]);
				// assigining role buyer to new user
				$user->assignRole([$role->id]);
				//trigger event when user email is not verified
				event(new Registered($user));
				// auth()->login($user);
		
				 return redirect()->route('login')->with('success','User account has been created successifully! Please check your mail inbox to confirm your email');	

			}else{
				return redirect()->route('create-account')->with('success','A user with the provided Phone number already exists!');

			}
			
		}else{
			return redirect()->route('create-account')->with('success','A user with the provided email already exists!');
		}
		
	}

	

	//return user form when creating user by admin
	public function create() {
		$roles = Role::all();
        return view('user.form',compact('roles'));
	}

	

	//store a user created by an admin
	public function addUser(Request $request){
		//validate the request
		$validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|min:3',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'required|string|min:8',
			'role'=>'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }



		//check user existence with email
		$checkUserEmailExistence=User::where('email',$request['email'])->first();
		//check user existence with phone number
		$checkUserPhoneExistence=User::where('phone_number',$request['phone'])->first();

		if(!$checkUserEmailExistence){
			if(!$checkUserPhoneExistence){
				$user= User::create([
					'name' => $request['name'],
					'email' => $request['email'],
					'phone_number'=>$request['phone'],
					'password' => $request['password'],
					'created_by'=>Auth::user()->name,
					'role'=>$request['role'],
		
				]);
				
				//assigning role to new created user
				$user->assignRole([$request['role']]);
				
				//rediecting back to the user creation page
				return Redirect::back()->with('success','User has been successfully added! Ask user to try login and verify their email');
		
			}else{
				return Redirect()->back()->with('success','A user with the provided Phone number already exists!');

			}
		}else{
			return Redirect()->back()->with('success','A user with the provided email already exists!');
		}
	}


	public function store(Request $request) {
		$this->validate($request, [
			'email' => 'required|unique:suppliers',
			
		]);

		User::create($request->all());

		return response()->json([
			'success' => true,
			'message' => 'Suppliers Created',
		]);

	}

	
	//show the details of a particular user
	public function show(User $user) 
    {
        return view('user.show', [
            'user' => $user
        ]);
    }

	
	//edit request that displays the user update form
	public function edit($id) 
    {	
		$decryptid=Crypt::decrypt($id);
		$user=User::find($decryptid);
			
        return view('user.edit', [
            'user' => $user,
            'userRole' => $user->role,
            'roles' => Role::latest()->get()
        ]);
    }

	
	//update aparticular user
	public function update(User $user, Request $request) 
    {
		$user->update([
			'name'=>$request->input('name'),
			'email'=>$request->input('email'),
			'phone_number'=>$request->input('phone'),
            'role' => $request->input('role'),
            'updated_by' => Auth::user()->name,
        ]);
        $user->syncRoles($request->input('role'));

        return redirect()->route('user.index')
            ->withSuccess(__('User updated successfully.'));
    }

	
	//delete a particular user
	public function destroy(User $user) 
    {
        $user->delete();

        return redirect()->route('user.index')
            ->with('success','User deleted successfully.');
    }

	public function apiUsers() {
		$users = User::all();

		return Datatables::of($users)
			->addColumn('action', function ($users) {
				return '<a onclick="editForm(' . $users->id . ')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
				'<a onclick="deleteData(' . $users->id . ')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
			})
			->rawColumns(['action'])->make(true);
	}

	public function ImportExcel(Request $request) {
		//Validasi
		$this->validate($request, [
			'file' => 'required|mimes:xls,xlsx',
		]);

		if ($request->hasFile('file')) {
			//UPLOAD FILE
			$file = $request->file('file'); //GET FILE
			Excel::import(new SuppliersImport, $file); //IMPORT FILE
			return redirect()->back()->with(['success' => 'Upload file data suppliers !']);
		}

		return redirect()->back()->with(['error' => 'Please choose file before!']);
	}

	public function exportSuppliersAll() {
		$suppliers = Supplier::all();
		$pdf = PDF::loadView('suppliers.SuppliersAllPDF', compact('suppliers'));
		return $pdf->download('suppliers.pdf');
	}

	public function exportExcel() {
		return (new ExportSuppliers)->download('suppliers.xlsx');
	}
}
