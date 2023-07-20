<?php

namespace App\Http\Controllers;

// use App\Http\Middleware\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    

    // /**
    //  * @OA\Get(
    //  *     path="/permissions",
    //  *     tags={"permissions"},
    //  *     summary="All permissions",
    //  *     description="Multiple status values can be provided with comma separated string",
    //  *     operationId="index",
    //  *     @OA\Parameter(
    //  *         name="status",
    //  *         in="query",
    //  *         description="Status values that needed to be considered for filter",
    //  *         required=true,
    //  *         explode=true,
    //  *         @OA\Schema(
    //  *             default="available",
    //  *             type="string",
    //  *             enum={"available", "pending", "sold"},
    //  *         )
    //  *     ),
    //  *     @OA\Response(
    //  *         response=200,
    //  *         description="successful operation",
    //  *         @OA\JsonContent(),
    //  *     ),
    //  *     @OA\Response(
    //  *         response=400,
    //  *         description="Invalid status value"
    //  *     )
    //  * )
    //  */

    

    //return the list of permissions to the swagger api documentation and the permissions index page
    public function index(Request $request)
    {   
            $product_permissions = Permission::where('name','LIKE',"%product%")->get();
            $role_permissions = Permission::where('name','LIKE',"%role%")->get();
            $p_permissions = Permission::where('name','LIKE',"%permission%")->get();
            $category_permissions = Permission::where('name','LIKE',"%categor%")->get();
            $customer_permissions = Permission::where('name','LIKE',"%customer%")->get();
            $sale_permissions = Permission::where('name','LIKE',"%sale%")->get();
            $user_permissions = Permission::where('name','LIKE',"%user%")->orWhere('name','LIKE',"%log%")->orWhere('name','LIKE',"%password%")->orWhere('name','LIKE',"%home%")->get();
            $supplier_permissions = Permission::where('name','LIKE',"%supplier%")->get();

        

        if($request->wantsJson()){
            $permissions=Permission::all();
            return response()->json($permissions);
        }else{
            return view('permisions.index', [
            'product_permissions' => $product_permissions,
            'role_permissions' => $role_permissions,
            'p_permissions' => $p_permissions,
            'user_permissions' => $user_permissions,
            'category_permissions' => $category_permissions,
            'customer_permissions' => $customer_permissions,
            'supplier_permissions' => $supplier_permissions,
            'sale_permissions' => $sale_permissions,


        ]);

        }


        
    }

    
    //display the form for adding a new permission
    public function create() 
    {   
        return view('permisions.create');
    }

    
    //store a newly created permission
    public function store(Request $request)
    {   
        $request->validate([
            'name' => 'required|unique:users,name'
        ]);

        Permission::create([
            'name'=>$request->get('name'),
            'description'=>$request->get('description'),
            'created_by'=>Auth::user()->name,
            'updated_by'=>Auth::user()->name,

        ]);
        
        return redirect()->route('permissions.index')
            ->withSuccess(__('Permission created successfully.'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Permission  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $decrypt=Crypt::decrypt($id);
        $permission=Permission::find($decrypt);



        return view('permisions.edit',[
            'permission' => $permission
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Permission $permission)
    {
        $permission->update([
            'name'=>$request->input('name'),
            'description'=>$request->input('description'),
            'updated_by'=>Auth::user()->name,
        ]);

        return redirect()->route('permissions.index')
            ->withSuccess(__('Permission updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();

        return redirect()->route('permissions.index')
            ->withSuccess(__('Permission deleted successfully.'));
    }
}