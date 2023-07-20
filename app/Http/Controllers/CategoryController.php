<?php

namespace App\Http\Controllers;

use App\Category;
use App\Models\product_subcategory;
use App\Models\subcategory_field;
use App\Exports\ExportCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Datatables;
use PDF;
use App\Models\categorie;

class CategoryController extends Controller
{
    public function __construct()
    {
        // $this->middleware('permission:roles.index',['only'=>['index','store']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $data1 =Categorie::paginate(5);
         return view('categories.index',compact('data1'));
       
    }

    public function addcategory(Request $request)
    {
      $data = new categorie;
      $data->name =$request->name;
      $data->save();
     return redirect()->back()->with('message','Category Added Succefully');
    }
    public function delete_category($id){
        $data2=categorie::find($id);
        $data2->delete();
        return redirect()->back()->with('message','deleted Succefully');

    }

    public function display_Subcategory($id){
        $decrypt=Crypt::decrypt($id);
            
        $data3=categorie::find($decrypt);

        $subcategories = product_subcategory::where('product_category_id',$decrypt)->paginate(5);
        // dd($data3);
        return view ('categories.subCatergory',compact('data3','subcategories'));
    }

    public function add_Subcategory($id){
        $decrypt=Crypt::decrypt($id);
         
        $data5=categorie::find($decrypt);
        // dd($data5);
        return view('categories.addSubcategory',compact('data5')); 
        
    }

    public function store_subcatergory(Request $request){
        
        $data = new product_subcategory;

        $data->product_category_id =$request->categoryID;
        $data->name =$request->subcatergory;
        $data->created_by=Auth::user()->id;
        $data->save();

        return redirect()->back()->with('message','Subcategory Added Succefully');
    }


    //SUBCATEGORYFIELD

    public function displaysubcategoryfield($id,$id2){
        $decrypt=Crypt::decrypt($id);
        $data7=product_subcategory::find($decrypt);
 
        $decrypt2=Crypt::decrypt($id2);
        $data9=categorie::find($decrypt2);
       
        $subcategoryfields = subcategory_field::where('product_subcategory_id',$decrypt)->paginate(5);

        return view ('subcategoryfield.index',compact('data7','subcategoryfields', 'data9'  ));
    }


    public function addsubcategoryfield($id,$id2){


        $decrypt=Crypt::decrypt($id);
        $data8=product_subcategory::find($decrypt);

        $decrypt2=Crypt::decrypt($id2);
        $data11=categorie::find($decrypt2);
        // dd($data5);
        return view('subcategoryfield.addsubcategoryfield',compact('data8','data11')); 
        
    }
    public function store_subcatergoryfield(Request $request){
        
        $data = new subcategory_field;

        $data->product_subcategory_id =$request->subcategoryID;
        $data->name =$request->subcatergoryfield;
        $data->created_by=Auth::user()->id;
        $data->save();

        return redirect()->back()->with('message','Subcategory Added Succefully');
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
           'name'   => 'required|string|min:2'
        ]);

        Category::create($request->all());

        return response()->json([
           'success'    => true,
           'message'    => 'Categories Created'
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
        $category = Category::find($id);
        return $category;
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
        $this->validate($request, [
            'name'   => 'required|string|min:2'
        ]);

        $category = Category::findOrFail($id);

        $category->update($request->all());

        return response()->json([
            'success'    => true,
            'message'    => 'Categories Update'
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
        Category::destroy($id);

        return response()->json([
            'success'    => true,
            'message'    => 'Categories Delete'
        ]);
    }

    public function apiCategories()
    {
        $categories = Category::all();

        return Datatables::of($categories)
            ->addColumn('action', function($categories){
                return '<a onclick="editForm('. $categories->id .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                    '<a onclick="deleteData('. $categories->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            })
            ->rawColumns(['action'])->make(true);
    }

    public function exportCategoriesAll()
    {
        $categories = Category::all();
        $pdf = PDF::loadView('categories.CategoriesAllPDF',compact('categories'));
        return $pdf->download('categories.pdf');
    }

    public function exportExcel()
    {
        return (new ExportCategories())->download('categories.xlsx');
    }
}
