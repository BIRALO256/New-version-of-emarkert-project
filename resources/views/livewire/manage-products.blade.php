

<div class="container">
   
<form wire:submit.prevent="save">
  
   
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label for="category">Category:</label>
        <select class="form-control" wire:model="selectedCategory" id="category">
          <option value="">Select Category</option>
          @foreach($categories as $data)
          <option value="{{$data->id}}">{{$data->name}}</option>
          @endforeach
        </select>
        @error('selectedCategory')<span  class="text-danger" class="error"> {{ $message }}</span> @enderror
      </div>
    </div>
    
    <div class="col-md-6">
      <div class="form-group">
        <label for="subcategory">Subcategory:</label>
        <select class="form-control" wire:model="selectedSubcategory" id="subcategory">
          <option value="">Select Subcategory</option>
          @foreach($subcategories as $data)
          <option value="{{$data->id}}">{{$data->name}}</option>
          @endforeach
        </select>
        @error('selectedSubcategory')<span class="text-danger" class="error"> {{ $message }}</span> @enderror
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label for="subcategory-field1">Subcategory Field:</label>
        <select class="form-control" wire:model="selectedSubcategoryField" id="subcategory-field1">
          <option value="">Select Subcategory Field</option>
          @foreach($subcategoryFields as $data)
          <option value="{{$data->id}}">{{$data->name}}</option>
          @endforeach
        </select>
        <span class="error">

       @error('selectedSubcategoryField')<span class="text-danger"  class="error"> {{ $message }}</span> @enderror

      </div>

      
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label for="field-option">Field Option:</label>
        <select class="form-control" wire:model="" id="field-option">
          <option value="">Select Field Option</option>
          @foreach($fieldOptions as $data)
          <option value="{{$data->id}}">{{$data->name}}</option>
          @endforeach
          
        </select>
       
      @error('selectedFieldOption') <span  class="text-danger" class="error"> {{ $message }}</span> @enderror

      </div>
    </div>

  </div>
 
 <!-- Start of the product name a other stuff below -->

  <div class="row">
  <div class="col-md-6">
      <div class="form-group">
        <label for="name" >Product Name:</label>
        <input type="text" class="form-control"  id="name"  wire:model="product.name" placeholder="Name of the product">
      </div>
      @error('product.name') <span  class="text-danger" class="error"> {{ $message }}</span> @enderror
    </div>
   @if ($selectedSubcategoryField)
   <div class="col-md-6">
      <div class="form-group">
        <label for="brand">Brand</label>
        <input type="text" class="form-control" id="brand" placeholder="Enter brand">
      </div>
    </div>

  </div>

  <div class="row">
      <!-- Brand column -->
      <div class="col-md-3 mb-3">
        <div class="form-group">
          <label for="brand">Brand</label>
          <input type="text" class="form-control" id="brand" placeholder="Enter brand">
        </div>
      </div>

      <!-- Color column -->
      <div class="col-md-3 mb-3">
        <div class="form-group">
          <label for="color">Color</label>
          <input type="text" class="form-control" id="color" placeholder="Enter color">
        </div>
      </div>

      <!-- Color Family column -->
      <div class="col-md-3 mb-3">
        <div class="form-group">
          <label for="colorFamily">Color Family</label>
          <select class="form-control" id="colorFamily">
            <option value="yellow">Option 1</option>
          </select>
        </div>
      </div>

      <!-- Weight column -->
      <div class="col-md-3 mb-3">
        <div class="form-group">
          <label for="weight">Weight</label>
          <input type="text" class="form-control" id="weight" placeholder="Enter weight">
        </div>
      </div>
    </div>


  <!-- Additional form fields -->

  
    <div class="col-mid">
        <div class="form-group">
            <label for="description">Product Description:</label>
            <textarea class="form-control" name="description" id="description" wire:model="product.description"></textarea>
        </div>
    </div>


    @if(count($variations) > 0)
    @foreach($variations as $index => $variation)
<div>
  <!-- Variants Heading -->
  <div class="col text">
        <h4 class="specification-heading"  style="font-weight:bold; font-style: italic; color:green;">Variants</h4>
      </div>

    <!-- First Row -->
    <div class="row">
    <!-- Variation column -->
    <div class="col-md-3 mb-3">
        <div class="form-group">
            <label for="variation">Variation</label>
            <input type="text" class="form-control" id="variation" name="variations[{{ $index }}][variation]" wire:model="variations.{{ $index }}.variation">
        </div>
    </div>
    
    <!-- Seller SKU column -->
    <div class="col-md-3 mb-3">
        <div class="form-group">
            <label for="sellerSku">Seller SKU</label>
            <input type="text" class="form-control" id="sellerSku" name="variations[{{ $index }}][seller_sku]" wire:model="variations.{{ $index }}.seller_sku">
        </div>
    </div>

    <!-- Barcode EAN column -->
    <div class="col-md-3 mb-3">
        <div class="form-group">
            <label for="barcodeEan">Barcode EAN</label>
            <input type="text" class="form-control" id="barcodeEan" name="variations[{{ $index }}][barcode_ean]" wire:model="variations.{{ $index }}.barcode_ean">
        </div>
    </div>

    <!-- Quantity column -->
    <div class="col-md-3 mb-3">
        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="number" min="0" required class="form-control" id="quantity" name="variations[{{ $index }}][quantity]" wire:model="variations.{{ $index }}.quantity">
        </div>
    </div>
</div>


    <!-- Second Row -->
    <div class="row">
        <!-- Global Price column -->
        <div class="col-md-4 mb-3">
            <div class="form-group">
                <label for="globalPrice">Global Price</label>
                <input type="number"  min="0" required class="form-control" id="globalPrice" name="variations[{{ $index }}][global_price]" wire:model="variations.{{ $index }}.global_price">
            </div>
        </div>

        <!-- Sale Price column -->
        <div class="col-md-4 mb-3">
            <div class="form-group">
                <label for="salePrice">Sale Price</label>
                <input type="number"  min="0" required class="form-control" id="salePrice" name="variations[{{ $index }}][sale_price]" wire:model="variations.{{ $index }}.sale_price">
            </div>
        </div>

        <!-- Sale Period column -->
        <div class="col-md-4 mb-3">
            <div class="form-group">
                <label for="salePeriod">Sale Period</label>
                <input type="date" class="form-control" id="salePeriod" name="variations[{{ $index }}][sale_period]" wire:model="variations.{{ $index }}.sale_period">
            </div>
        </div>
    </div>

 <div class="container">
  <div class="row">
    <div class="col-12">
      <div class="d-flex justify-content-between align-items-center">
        <!-- Delete Variation button -->
        <button type="button"   style="margin-bottom:5px;" class="btn btn-danger mr-auto" wire:click.prevent="removeVariation({{ $index}} )" @if(count($variations) <= 1) disabled @endif>
        <i class="fa fa-trash"></i>  Delete
        </button>
      </div>
    </div>
  </div>
</div>

</div>
    @endforeach
@endif
<div class="row">
  <!-- Add Variation button column -->
  <div class="col-md-4 mb-3">
    <button type="button" class="btn btn-success" wire:click.prevent="addVariation">
      <i class="fa fa-plus"></i> Add Variation
    </button>
  </div>
</div>

   

    <!-- Add more rows dynamically using Livewire-->



  
      <div class="col text">
        <h4 class="specification-heading"  style="font-weight:bold; font-style: italic; color:green;">Product Specification</h4>
      </div>
     

    <!-- First row: Certification, Main Material, Material Family -->
    <div class="row">
      <!-- Certification column -->
      <div class="col-md-4 mb-3">
        <div class="form-group">
          <label for="certification">Certifications</label>
          <select class="form-control"  id="subcategory-field">
          <option value="">Certifications</option>
        </select>
        </div>
      </div>

      <!-- Main Material column -->
      <div class="col-md-4 mb-3">
        <div class="form-group">
          <label for="mainMaterial">Main Material</label>
          <input type="text" class="form-control" id="mainMaterial" placeholder="Enter main material">
        </div>
      </div>

      <!-- Material Family column -->
      <div class="col-md-4 mb-3">
        <div class="form-group">
          <label for="materialFamily">Material Family</label>
          <select class="form-control"  id="subcategory-field">
          <option value="">Material Family of product</option>
          </select> 
        </div>
      </div>
    </div>

    <!-- Second row: Duplicate of the first row -->
    <div class="row">
      <!-- Production country column -->
      <div class="col-md-4 mb-3">
        <div class="form-group">
          <label for="productionCountry">Production country</label>
          <select class="form-control"  id="productionCountry">
          <option value="">Production country of product</option>
          </select> 
        </div>
      </div>

      <!-- Model column -->
      <div class="col-md-4 mb-3">
        <div class="form-group">
          <label for="mainMaterial2">Model </label>
          <input type="text" class="form-control" id="mainMaterial2" placeholder=" Model ID of Manufacturer part number ">
        </div>
      </div>

      <!-- Note column -->
      <div class="col-md-4 mb-3">
        <div class="form-group">
          <label for="materialFamily2">Note</label>
          <input type="text" class="form-control" id="materialFamily2" placeholder="Note/comment">
        </div>
      </div>
    </div>


    
    <!-- third row: Duplicate of the first row -->
    <div class="row">
      <!-- Certification column -->
      <div class="col-md-4 mb-3">
        <div class="form-group">
          <label for="certification2">Certification</label>
          <input type="text" class="form-control" id="certification2" placeholder="Enter certification">
        </div>
      </div>

      <!-- Main Material column -->
      <div class="col-md-4 mb-3">
        <div class="form-group">
          <label for="mainMaterial2">Main Material</label>
          <input type="text" class="form-control" id="mainMaterial2" placeholder="Enter main material">
        </div>
      </div>

      <!-- Material Family column -->
      <div class="col-md-4 mb-3">
        <div class="form-group">
          <label for="materialFamily2">Shop Type</label>
          <select class="form-control"  id="subcategory-field">
          <option value="">Shop type of product</option>
          </select> 
        </div>
      </div>
    </div>
   
       <!-- third row: Duplicate of the first row -->
       <div class="row">
      <!-- Certification column -->
      <div class="col-md-4 mb-3">
        <div class="form-group">
          <label for="certification2">Certification</label>
          <input type="text" class="form-control" id="certification2" placeholder="Enter certification">
        </div>
      </div>

      <!-- Main Material column -->
      <div class="col-md-4 mb-3">
        <div class="form-group">
          <label for="mainMaterial2">Main Material</label>
          <input type="text" class="form-control" id="mainMaterial2" placeholder="Enter main material">
        </div>
      </div>

      <!-- Material Family column -->
      <div class="col-md-4 mb-3">
        <div class="form-group">
          <label for="materialFamily2">Material Family</label>
          <input type="text" class="form-control" id="materialFamily2" placeholder="Enter material family">
        </div>
      </div>
    </div>

  
  
  <button type="submit">Submit</button>
  @endif
</form>

</div>
