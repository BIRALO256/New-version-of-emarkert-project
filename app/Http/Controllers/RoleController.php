<?php
    
namespace App\Http\Controllers;



use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\JsonResponse;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:roles-list|roles-create|roles-edit|roles-delete', ['only' => ['store']]);
         $this->middleware('permission:roles-create', ['only' => ['create','store']]);
         $this->middleware('permission:roles-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:roles-delete', ['only' => ['destroy']]);
    }
    
    /**
     * @OA\Get(
     *     path="/roles",
     *     tags={"roles"},
     *     summary="All roles",
     *     description="Multiple status values can be provided with comma separated string",
     *     operationId="index",
     *     @OA\Parameter(
     *         name="status",
     *         in="query",
     *         description="Status values that needed to be considered for filter",
     *         required=true,
     *         explode=true,
     *         @OA\Schema(
     *             default="available",
     *             type="string",
     *             enum={"available", "pending", "sold"},
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(),
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid status value"
     *     )
     * )
     */
    public function index(Request $request)
    {
        $roles = Role::orderBy('id','DESC')->paginate(8);
        if ($request->wantsJson()) {
            return response()->json($roles);
        } else {
            return view('roles.index', compact('roles'))
                ->with('i', ($request->input('page', 1) - 1) * 5);
        }
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product_permissions = Permission::where('name','LIKE',"%product%")->get();
        $role_permissions = Permission::where('name','LIKE',"%role%")->get();
        $p_permissions = Permission::where('name','LIKE',"%permission%")->get();
        $category_permissions = Permission::where('name','LIKE',"%categor%")->get();
        $customer_permissions = Permission::where('name','LIKE',"%customer%")->get();
        $sale_permissions = Permission::where('name','LIKE',"%sale%")->get();
        $user_permissions = Permission::where('name','LIKE',"%user%")->orWhere('name','LIKE',"%log%")->orWhere('name','LIKE',"%password%")->get();
        $supplier_permissions = Permission::where('name','LIKE',"%supplier%")->get();
        return view('roles.create',compact(
            'product_permissions','role_permissions',
            'p_permissions','category_permissions',
            'customer_permissions','sale_permissions',
            'user_permissions','supplier_permissions'
        ));
    }
    
   /**
     * @OA\Post(
     *      path="/roles",
     *      operationId="store",
     *      tags={"roles"},
     *      summary="Store roles in DB",
     *      description="Store role in DB",
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(),
     *      ),
     *     @OA\Response(
     *          response=200, description="Success",
     *          @OA\JsonContent(),
     *       )
     *  )
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'description'=>'required',
            'permission' => 'required',
            
        ]);
    
        $role = Role::create(
            [
                'name' => $request->get('name'),
                'description'=>$request->get('description'),
                'created_by'=>Auth::user()->name,
                'updated_by'=>Auth::user()->name
        ]);
        $role->syncPermissions($request->get('permission'));
    
        return redirect()->route('roles.index')
                        ->with('success','Role created successfully');
    }
    


     /**
     * @OA\Get(
     *    path="/roles/{id}",
     *    operationId="show",
     *    tags={"roles"},
     *    summary="Get role Detail",
     *    description="Get role Detail",
     *    @OA\Parameter(name="id", in="path", description="Id of Article", required=true,
     *        @OA\Schema(type="integer")
     *    ),
     *     @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(
     *          @OA\Property(property="status_code", type="integer", example="200"),
     *          @OA\Property(property="data",type="object")
     *           ),
     *        )
     *       )
     *  )
     */
    public function show($id)
    {
        $decryptid=Crypt::decrypt($id);
        $role = Role::find($decryptid);

        $productPermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$decryptid)->where('name','LIKE',"%product%")->get();

        $categoryPermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$decryptid)->where('name','LIKE',"%categor%")->get();

        $userPermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$decryptid)->where('name','LIKE',"%user%")->orWhere('name','LIKE',"%log%")->orWhere('name','LIKE',"%password%")->get();

        $Permissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$decryptid)->where('name','LIKE',"%permission%")->get();

        $customerPermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$decryptid)->where('name','LIKE',"%customer%")->get();

        $salePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$decryptid)->where('name','LIKE',"%sale%")->get();

        $supplierPermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$decryptid)->where('name','LIKE',"%supplier%")->get();

         $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$decryptid)->where('name','LIKE',"%role%")->get();
    
    
        return view('roles.show',compact(
            'role','rolePermissions','productPermissions','Permissions',
            'customerPermissions','categoryPermissions','supplierPermissions',
            'userPermissions','salePermissions'
    ));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $decrypt=Crypt::decrypt($id);
        $role=Role::find($decrypt);

        //query the permissions according to categories (groups)
        $product_permissions = Permission::where('name','LIKE',"%product%")->get();
        $role_permissions = Permission::where('name','LIKE',"%role%")->get();
        $p_permissions = Permission::where('name','LIKE',"%permission%")->get();
        $category_permissions = Permission::where('name','LIKE',"%categor%")->get();
        $customer_permissions = Permission::where('name','LIKE',"%customer%")->get();
        $sale_permissions = Permission::where('name','LIKE',"%sale%")->get();
        $user_permissions = Permission::where('name','LIKE',"%user%")->orWhere('name','LIKE',"%log%")->orWhere('name','LIKE',"%password%")->orWhere('name','LIKE',"%home%")->get();
        $supplier_permissions = Permission::where('name','LIKE',"%supplier%")->get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$role->id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
    
        return view('roles.edit',compact(
            'role','rolePermissions',
            'product_permissions','role_permissions',
            'p_permissions','category_permissions',
            'customer_permissions','user_permissions',
            'supplier_permissions','sale_permissions'

        ));
    }
    
    
    //update a specific role
    public function update(Request $request, Role $role)
    {
        $this->validate($request, [
            // 'name' => 'required',
            'description' => 'required',

        ]);

        $role->update([
            // 'name' => $request->input('name'),
            'description' => $request->input('description'),
            'updated_by' => Auth::user()->name
        ]);
       
    
        $role->syncPermissions($request->get('permission'));
    
        return redirect()->route('roles.index')
                        ->with('success','Role updated successfully');
    }
    

   //delete a specific role
    public function destroy($id)
    {
       
        $decryptid=Crypt::decrypt($id);

        DB::table("roles")->where('id',$decryptid)->delete();
        return redirect()->route('roles.index')
                        ->with('success','Role deleted successfully');
    }
}