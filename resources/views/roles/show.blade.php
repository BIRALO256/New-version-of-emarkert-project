@extends('layouts.master')
@section('top')


@vite('resources/css/app.css')

{{-- linking the font awesome css to use icons --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


@stop
@section('content')

{{-- displaying assigned permissions when viewing a role --}}
<div class="box box-success text-2xl">
    <div class="box-header">
        <a href="{{ route('roles.index') }}"><i class="fas fa-arrow-left px-5 text-3xl"></i></a><h3 class="box-title">Viewing {{ $role->name }} Role</h3>
    </div>

 <div class="ml-5 py-5">
    <h3 class="pb-2 font-bold">Assigned Permissions</h3>

{{-- PERMISSIONS FOR USER MANAGEMENT --}}
<div class="py-2" >
    <hr>
    <h4 class="text-green-700 font-bold">User Management Permissions</h4>
    <hr>
    <div class="grid grid-flow-row md:grid-cols-4 p-6 pt-4">
        @if($userPermissions->isEmpty())
        <span><i class="fas fa-times p-2 text-gray-400 text-2xl"></i>No permissions assigned</span>
        @else
            @foreach($userPermissions as $permission)
                @if($role->hasPermissionTo($permission->name))
                <span><i class="fas fa-check text-gray-400 p-2"></i>{{ $permission->name }}</span>
                 @endif
                
            @endforeach
        @endif

    </div>
</div>

{{-- PERMISSIONS FOR PRODUCT MANAGEMENT --}}
<div class="py-2">
    
    <hr>
    <h4 class="text-green-700 font-bold">Product Management Permissions</h4>
    <hr>
    <div class="grid grid-flow-row md:grid-cols-4 p-6 pt-4">
        @if($productPermissions->isEmpty())
        <span><i class="fas fa-times p-2 text-gray-400"></i>No permissions assigned</span>
   @else
       @foreach($productPermissions as $permission)
           @if($role->hasPermissionTo($permission->name))
           <span><i class="fas fa-check text-gray-400 p-2"></i>{{ $permission->name }}</span>

           @endif
        
       @endforeach
   @endif

    </div>
</div>

{{-- PERMISSIONS FOR CUSTOMER MANAGEMENT --}}
<div class="py-2">
    
    <hr>
    <h4 class="text-green-700 font-bold">Customer Management Permissions</h4>
    <hr>
    <div class="grid grid-flow-row md:grid-cols-4 p-6 pt-4">
        @if($customerPermissions->isEmpty())
        <span><i class="fas fa-times p-2 text-gray-400"></i>No permissions assigned</span>
   @else
       @foreach($customerPermissions as $permission)
           @if($role->hasPermissionTo($permission->name))
           <span><i class="fas fa-check text-gray-400 p-2"></i>{{ $permission->name }}</span>

           @endif
        
       @endforeach
   @endif

    </div>
</div>

{{-- PERMISSIONS FOR CATEGORY MANAGEMENT --}}
<div class="py-2">
    
    <hr>
    <h4 class="text-green-700 font-bold">Category Management Permissions</h4>
    <hr>
    <div class="grid grid-flow-row md:grid-cols-4 p-6 pt-4">
        @if($categoryPermissions->isEmpty())
        <span><i class="fas fa-times p-2 text-gray-400"></i>No permissions assigned</span>
   @else
       @foreach($categoryPermissions as $permission)
           @if($role->hasPermissionTo($permission->name))
           <span><i class="fas fa-check text-gray-400 p-2"></i>{{ $permission->name }}</span>

           @endif
        
       @endforeach
   @endif

    </div>
</div>

{{-- PERMISSIONS FOR SALE MANAGEMENT --}}
<div class="py-2">
    
    <hr>
    <h4 class="text-green-700 font-bold">Sale Management Permissions</h4>
    <hr>
    <div class="grid grid-flow-row md:grid-cols-4 p-6 pt-4">
        @if($salePermissions->isEmpty())
        <span><i class="fas fa-times p-2 text-gray-400"></i>No permissions assigned</span>
   @else
       @foreach($salePermissions as $permission)
           @if($role->hasPermissionTo($permission->name))
           <span><i class="fas fa-check text-gray-400 p-2"></i>{{ $permission->name }}</span>

           @endif
        
       @endforeach
   @endif

    </div>
</div>

{{-- PERMISSIONS FOR SUPPLIER MANAGEMENT --}}
<div class="py-2">
    
    <hr>
    <h4 class="text-green-700 font-bold">Supplier Management Permissions</h4>
    <hr>
    <div class="grid grid-flow-row md:grid-cols-4 p-6 pt-4">
        @if($supplierPermissions->isEmpty())
        <span><i class="fas fa-times p-2 text-gray-400"></i>No permissions assigned</span>
   @else
       @foreach($supplierPermissions as $permission)
           @if($role->hasPermissionTo($permission->name))
           <span><i class="fas fa-check text-gray-400 p-2"></i>{{ $permission->name }}</span>

           @endif
        
       @endforeach
   @endif

    </div>
</div>

{{-- PERMISSIONS FOR ROLE MANAGEMENT --}}
<div class="py-2">
    
    <hr>
    <h4 class="text-green-700 font-bold">Role Management Permissions</h4>
    <hr>
    <div class="grid grid-flow-row md:grid-cols-4 p-6 pt-4">
        @if($rolePermissions->isEmpty())
             <span><i class="fas fa-times p-2 text-gray-400"></i>No permissions assigned</span>
        @else
            @foreach($rolePermissions as $permission)
                @if($role->hasPermissionTo($permission->name))
                <span><i class="fas fa-check text-gray-400 p-2"></i>{{ $permission->name }}</span>

                @endif
             
            @endforeach
        @endif

    </div>
</div>

{{-- PERMISSIONS FOR PERMISSION MANAGEMENT --}}
<div class="py-2">
    
    <hr>
    <h4 class="text-green-700 font-bold">Permission Management Permissions</h4>
    <hr>
    <div class="grid grid-flow-row md:grid-cols-4 p-6 pt-4">
        @if($Permissions->isEmpty())
             <span><i class="fas fa-times p-2 text-gray-400"></i>No permissions assigned</span>
        @else
            @foreach($Permissions as $permission)
                @if($role->hasPermissionTo($permission->name))
                <span><i class="fas fa-check text-gray-400 p-2"></i>{{ $permission->name }}</span>

                @endif
             
            @endforeach
        @endif

        </div>
    </div>
</div>


</div>


@stop
    



   







