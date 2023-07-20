@extends('layouts.master')

@section('top')
@endsection

    @section('content')
<!-- Small boxes (Stat box) -->
<div class="row">
    
        {{-- check if user has admin role else dont show item --}}
    @role('Admin')
    <div class="col-lg-3 col-xs-6">

        <!-- small box -->
       
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>{{ \App\Models\User::count() }}</h3>

                <p>System Users</p>
            </div>
            <div class="icon">
                <i class="fa fa-user-secret"></i>
            </div>
            <a href="/user" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    @endrole
   
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3>{{ \App\Category::count() }}<sup style="font-size: 20px"></sup></h3>

                <p>Category</p>
            </div>
            <div class="icon">
                <i class="fa fa-list"></i>
            </div>
            <a href="{{ route('categories.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3>{{ \App\Product::count() }}</h3>
                <p>Product</p>
            </div>
            <div class="icon">
                <i class="fa fa-cubes"></i>
            </div>
            <a href="{{ route('DiaplayProducts') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3>{{ \App\Customer::count() }}</h3>

                <p>Customer</p>
            </div>
            <div class="icon">
                <i class="fa fa-users"></i>
            </div>
            <a href="{{ route('customers.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    
    <!-- ./col -->
</div>
<!-- Log on to codeastro.com for more projects! -->


<div class="row">
    
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-purple">
            <div class="inner">
                <h3>{{ \App\Supplier::count() }}<sup style="font-size: 20px"></sup></h3>

                <p>Supplier</p>
            </div>
            <div class="icon">
                <i class="fa fa-signal"></i>
            </div>
            <a href="{{ route('suppliers.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3>{{ \App\Models\country::count() }}<sup style="font-size: 20px"></sup></h3>

                <p>Countries</p>
            </div>
            <div class="icon">
                <i class="fa fa-globe"></i>
            </div>
            <a href="{{ route('country.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-maroon">
            <div class="inner">
                <h3>{{ \App\Product_Masuk::count() }}</h3>


                <p>Total Purchase</p>
            </div>
            <div class="icon">
                <i class="fa fa-cart-plus"></i>
            </div>
            <a href="{{ route('productsIn.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3>{{ \App\Models\payement_type::count()}}</h3>

                <p>Payement Types</p>
            </div>
            <div class="icon">
                <i class="fa fa-credit-card"></i>
            </div>
            <a href="{{ route('payement.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-primary">
            <div class="inner">
                <h3>{{ \App\Product_Keluar::count()  }}</h3>
                <p>Total Outgoing</p>
            </div>
            <div class="icon">
                <i class="fa fa-minus"></i>
            </div>
            <a href="{{ route('productsOut.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
     

    @role('Admin')
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ Spatie\Permission\Models\Role::count()  }}</h3>
                <p>Total Roles</p>
            </div>
            <div class="icon">
                <i class="fa fa-minus"></i>
            </div>
            <a href="{{ route('roles.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    @endrole
     
    <!-- ./col -->
    

    @role('Admin')
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ Spatie\Permission\Models\Permission::count()  }}</h3>
                <p>Total Permissions</p>
            </div>
            <div class="icon">
                <i class="fa fa-minus"></i>
            </div>
            <a href="{{ route('permissions.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    @endrole
    
    <!-- ./col -->
    <div id="container" class=" col-xs-6"></div>
</div><!-- Log on to codeastro.com for more projects! -->

@endsection

@section('top')
@endsection






