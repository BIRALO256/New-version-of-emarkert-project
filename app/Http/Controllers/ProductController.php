<?php

namespace App\Http\Controllers;

use App\Category;
use App\Models\product_image;
use App\Models\categorie;
use App\Http\Middleware\Role;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use App\product_categorie;

class ProductController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('role:admin,staff');
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     $category = Category::orderBy('name','ASC')
    //         ->get()
    //         ->pluck('name','id');

    //     $producs = Product::all();
    //     return view('products.index', compact('category'));
    // }
    public function index()
    {
        $data1 = Categorie::all();
        return view('products.AddProducts',compact('data1'));
    }
    public function store_product(Request $request)
    {
        $data = new Product;
        $data->name =$request->ProductName;
        $data->description =$request->description;
        $data->reward_pionts_credit =$request->rewardPoints;
        $data->product_category_id =$request->category;
        $data->created_by=Auth::user()->id;

        $data->save();

        // dd($data);

        $imageData = $request->image;
        $imageName = time().'.'.$imageData->getClientOriginalExtension();
        $request->image->move('productImages',$imageName);

        $table2Data = new product_image();
       
        $table2Data->image = "productImage/".$imageName;
        $table2Data->productID = $data->id;// this is possible because the $data variable holds the product table data which include the id itself
        $table2Data->created_by =Auth::user()->id;

        $table2Data->save();

        
       
       return redirect()->back()->with('message','Product Added Succefully');
    }
    public function Display_product(){
        $data2 = Product::all();

        return view ('products.DisplayProducts',compact('data2'));
      
    } 
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('products.form',compact('roles'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = Category::orderBy('name','ASC')
            ->get()
            ->pluck('name','id');

        $this->validate($request , [
            'nama'          => 'required|string',
            'harga'         => 'required',
            'qty'           => 'required',
            'image'         => 'required',
            'category_id'   => 'required',
            'roles' => 'required'
        ]);

        $input = $request->all();
        $input['image'] = null;

        if ($request->hasFile('image')){
            $input['image'] = '/upload/products/'.str_slug($input['nama'], '-').'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('/upload/products/'), $input['image']);
        }

        Product::create($input);

        return response()->json([
            'success' => true,
            'message' => 'Products Created'
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::orderBy('name','ASC')
            ->get()
            ->pluck('name','id');
        $product = Product::find($id);
        return $product;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::orderBy('name','ASC')
            ->get()
            ->pluck('name','id');

        $this->validate($request , [
            'nama'          => 'required|string',
            'harga'         => 'required',
            'qty'           => 'required',
//            'image'         => 'required',
            'category_id'   => 'required',
        ]);

        $input = $request->all();
        $produk = Product::findOrFail($id);

        $input['image'] = $produk->image;

        if ($request->hasFile('image')){
            if (!$produk->image == NULL){
                unlink(public_path($produk->image));
            }
            $input['image'] = '/upload/products/'.str_slug($input['nama'], '-').'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('/upload/products/'), $input['image']);
        }

        $produk->update($input);

        return response()->json([
            'success' => true,
            'message' => 'Products Update'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if (!$product->image == NULL){
            unlink(public_path($product->image));
        }

        Product::destroy($id);

        return response()->json([
            'success' => true,
            'message' => 'Products Deleted'
        ]);
    }

    public function apiProducts(){
        $product = Product::all();

        return Datatables::of($product)
            ->addColumn('category_name', function ($product){
                return $product->category->name;
            })
            ->addColumn('show_photo', function($product){
                if ($product->image == NULL){
                    return 'No Image';
                }
                return '<img class="rounded-square" width="50" height="50" src="'. url($product->image) .'" alt="">';
            })
            ->addColumn('action', function($product){
                return'<a onclick="editForm('. $product->id .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                    '<a onclick="deleteData('. $product->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            })
            ->rawColumns(['category_name','show_photo','action'])->make(true);

    }
}
