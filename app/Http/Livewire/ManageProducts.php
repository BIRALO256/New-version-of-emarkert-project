<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\categorie;
use App\Models\fielddoption;
use App\Models\product_subcategory;
use App\Models\subcategory_field;

class ManageProducts extends Component
{

    public $product;
    public $categories;
    public $subcategories;
    public $subcategoryFields;
    public $selectedCategory ;
    public $selectedSubcategoryField ;
    public $selectedSubcategory;
    public $fieldOptions;
    public $variations = [];


    public function mount()
    {
        $this->product = new Product();
        $this->categories = categorie::all();
        $this->selectedCategory = null;
        $this->subcategories = collect(); // the collect methode creates an empty Collection instance and assigns it to the $subcategories property
        $this->selectedSubcategory = null;
        $this->subcategoryFields = collect();
        $this->selectedSubcategoryField = null;
        $this->fieldOptions = collect();
        $this->variations[] = [
            'variation' => '',
            'seller_sku' => '',
            'barcode_ean' => '',
            'quantity' => 0,
            'global_price' => 0,
            'sale_price' => 0,
            'sale_period' => '',
        ];

    }

    public function addVariation()
{
    $this->variations[] = [
        'variation' => '',
        'seller_sku' => '',
        'barcode_ean' => '',
        'quantity' => 0,
        'global_price' => 0,
        'sale_price' => 0,
        'sale_period' => '',
    ];
}

public function removeVariation($index){

  unset($this->variations[$index]);
  array_values($this->variations);

}
 

    protected $rules = [

        'product.name' => 'required|string',

        'product.description' => 'required|string',

        'product.reward_pionts_credit' => 'required',

    ];

    public function save(){
        
        $this->validate([
       
         "selectedCategory"=>"required",
         "selectedSubcategory"=>"required",
         "selectedSubcategoryField"=>"required",

        ]);

        // dd($this->product);
    }
        
   public function updatedselectedCategory($value){
    // dd($value);
    $this->subcategories=product_subcategory::where('product_category_id',$value)->get();
    $this->selectedSubcategory = null;
    $this->subcategoryFields = collect();
    $this->selectedSubcategoryField = null;
    $this->fieldOptions = collect(); 

    // dd($this->subcategories);
   }


   public function updatedselectedSubcategory($value){
    //dd($value);
    $this->subcategoryFields=subcategory_field::where('product_subcategory_id',$value)->get(); 
    $this->selectedSubcategoryField = null;
    $this->fieldOptions = collect();

    // dd($this->subcategoryFields);
   }
   public function updatedselectedSubcategoryField($value){
    //dd($value);
    $this->fieldOptions=fielddoption::where('subcategoryfieldId',$value)->get(); 
    // dd($this->fieldOption);
   }

   public function render()
    {
   

        return view('livewire.manage-products');
    }


}
