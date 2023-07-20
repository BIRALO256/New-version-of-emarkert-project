@extends('layouts.master')

@section('top')

@vite('resources/css/app.css')

{{-- linking the font awesome css to use icons --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


@stop
@section('content')


<div class="box box-success text-2xl">
  <div class="box-header">
    <a href="{{ route('roles.index') }}"><i class="fas fa-arrow-left px-5 text-3xl"></i></a><h3 class="box-title">Add New Role</h3>
  </div>
  {!! Form::open(array('route' => 'roles.store', 'method' => 'POST','class'=>'bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4')) !!}
  @csrf
      <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="role_name">
          Name
        </label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline h-16 text-2xl"
         id="role_name" name="name" type="text" placeholder="Please enter the role name" required>
      </div>

      <div class="mb-4">
          <label class="block text-gray-700  font-bold mb-2" for="role_description">
            Role Description
          </label>
          <textarea rows="7" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline text-2xl"
           name="description" placeholder="Please enter a description for the role" required></textarea>
      </div>
      <h4>Assign permisions to role</h4>

      <div class="py-5">
          <span><input type="checkbox" name="all_permissions" id="all_permissions">Grant all permissions</span>
      </div>

      {{-- PERMISSIONS FOR USER MANAGEMENT --}}
      <div class="py-2">
        <hr>
        <h4 class="text-green-700 font-bold">User Management Permissions</h4>
        <hr>
        <div class="grid grid-flow-row md:grid-cols-4 p-6 pt-4">
            @foreach($user_permissions as $permission)
            <span>{{ Form::checkbox('permission[]', $permission->id, false, array('class' => 'permission')) }}
              {{ $permission->name }}</span>
                 
          @endforeach

        </div>

       </div>

        {{-- PERMISSIONS FOR PERMISSION MANAGEMENT --}}
        <div class="py-2">
            <hr>
            <h4 class="text-green-700 font-bold">Permision Management Permissions</h4>
            <hr>
            <div class="grid grid-flow-row md:grid-cols-4 p-6 pt-4">
                @foreach($p_permissions as $permission)
                <span>{{ Form::checkbox('permission[]', $permission->id, false, array('class' => 'permission')) }}
                  {{ $permission->name }}</span>
                     
              @endforeach

            </div>

          </div>

        {{-- PERMISSIONS FOR PRODUCT MANAGEMENT --}}
        <div class="py-2">
            <hr>
            <h4 class="text-green-700 font-bold">Product Management Permissions</h4>
            <hr>
            <div class="grid grid-flow-row md:grid-cols-4 p-6 pt-4">
                @foreach($product_permissions as $permission)
                <span>{{ Form::checkbox('permission[]', $permission->id, false, array('class' => 'permission')) }}
                  {{ $permission->name }}</span>
                     
              @endforeach

            </div>

          </div>

        {{-- PERMISSIONS FOR CATEGORY MANAGEMENT --}}
        <div class="py-2">
            <hr>
            <h4 class="text-green-700 font-bold">Category Management Permissions</h4>
            <hr>
            <div class="grid grid-flow-row md:grid-cols-4 p-6 pt-4">
                @foreach($category_permissions as $permission)
                <span>{{ Form::checkbox('permission[]', $permission->id, false, array('class' => 'permission')) }}
                  {{ $permission->name }}</span>
                     
              @endforeach

            </div>

          </div>

        {{-- PERMISSIONS FOR ROLE MANAGEMENT --}}
        <div class="py-2">
            <hr>
            <h4 class="text-green-700 font-bold">Role Management Permissions</h4>
            <hr>
            <div class="grid grid-flow-row md:grid-cols-4 p-6 pt-4">
                @foreach($role_permissions as $permission)
                <span>{{ Form::checkbox('permission[]', $permission->id, false, array('class' => 'permission')) }}
                  {{ $permission->name }}</span>
                     
              @endforeach

            </div>

          </div>

        {{-- PERMISSIONS FOR CUSTOMER MANAGEMENT --}}
        <div class="py-2">
            <hr>
            <h4 class="text-green-700 font-bold">Customer Management Permissions</h4>
            <hr>
            <div class="grid grid-flow-row md:grid-cols-4 p-6 pt-4">
                @foreach($customer_permissions as $permission)
                <span>{{ Form::checkbox('permission[]', $permission->id, false, array('class' => 'permission')) }}
                  {{ $permission->name }}</span>
                     
              @endforeach

            </div>

          </div>

        {{-- PERMISSIONS FOR SUPPLIER MANAGEMENT --}}
        <div class="py-2">
            <hr>
            <h4 class="text-green-700 font-bold">Supplier Management Permissions</h4>
            <hr>
            <div class="grid grid-flow-row md:grid-cols-4 p-6 pt-4">
                @foreach($supplier_permissions as $permission)
                <span>{{ Form::checkbox('permission[]', $permission->id, false, array('class' => 'permission')) }}
                  {{ $permission->name }}</span>
                     
              @endforeach

            </div>

          </div>

        {{-- PERMISSIONS FOR SALE MANAGEMENT --}}
        <div class="py-2">
          <hr>
          <h4 class="text-green-700 font-bold">Sale Management Permissions</h4>
          <hr>
          <div class="grid grid-flow-row md:grid-cols-4 p-6 pt-4">
              @foreach($sale_permissions as $permission)
              <span>{{ Form::checkbox('permission[]', $permission->id, false, array('class' => 'permission')) }}
                {{ $permission->name }}</span>
                   
            @endforeach

          </div>

        </div>

      <button class="bg-green-700 hover:bg-green-600 w-full md:w-1/5 text-white font-bold py-2 px-4 border-b-4 border-green-700 hover:border-green-500 rounded float-right my-10">
        Save Role
      </button>
    </div>
    {!! Form::close() !!}

      
</div>


<script type="text/javascript">
const grantAllPermissions=document.getElementById('all_permissions');
const checkboxes=document.getElementsByClassName('permission');
grantAllPermissions.addEventListener('change',function(){
  const isChecked=grantAllPermissions.checked;
  for (let i = 0; i < checkboxes.length; i++) {
  checkboxes[i].checked = isChecked;
}
})
</script>

@stop
    