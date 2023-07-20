@role(['Admin','Vendor'])
<aside class="main-sidebar">
    {{-- <style>
         .sidebar{
            position:fixed;
            
            left: 0;
            
        } 
    </style> --}}

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar s">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                @if (Auth::user()->profile_photo_path)
                <img src="{{ asset('storage/images/profiles/'.Auth::user()->profile_photo_path) }} " class="img-circle" alt="User Image">
                    
                @else
                <img src="{{ asset('user-profile.png') }} " class="img-circle" alt="User Image">
                @endif            </div>
            <div class="pull-left info">
                <p>{{ \Auth::user()->name  }}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
       

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <!-- <li class="header">Functions</li> -->
               <!-- Optionally, you can add icons to the links -->    
<!--     
            <li><a href="{{ route('products.index') }}"><i class="fa fa-cubes"></i> <span>Product</span></a></li> -->
                <!-- Add the dropdown menu here -->  
                <!-- End of dropdown menu -->
            @role(['Admin','Vendor'])
                
                <li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
               <li><a href="{{ route('categories.index') }}"><i class="fa fa-list"></i> <span> Manage Categories</span></a></li> 
               <li class="treeview">
                <a href="#"><i class="fa fa-cubes"></i> <span>Products</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a  href="{{ route('products.index') }}"><i class="fa fa-plus"></i><span>Add Product</span></a></li>

                    <li><a  href="{{ route('productform') }}"><i class="fa fa-shopping"></i><span>Add products new version</span></a></li>
                    <li><a  href="{{ route('productform') }}"><i class="fa fa-shopping"></i><span>Manage products</span></a></li>
                    <li><a  href="{{ route('DiaplayProducts') }}"><i class="fas fa"></i><span>Display Products</span></a></li>
                </ul>
               </li>  
               <li><a href="{{ route('country.index') }}"><i class="fa fa-globe"></i> <span> Countries</span></a></li>
               <li><a href="{{ route('payement.index') }}"><i class="fa fa-credit-card"></i> <span>Payment Type</span></a></li>


                <li><a href="{{ route('customers.index') }}"><i class="fa fa-users"></i> <span>Customer</span></a></li>
                <!-- <li><a href="{{ route('sales.index') }}"><i class="fa fa-cart-plus"></i> <span>Penjualan</span></a></li> -->
                <li><a href="{{ route('suppliers.index') }}"><i class="fa fa-truck"></i> <span>Supplier</span></a></li>
                <li><a href="{{ route('productsOut.index') }}"><i class="fa fa-minus"></i> <span>Outgoing Products</span></a></li>
                <li><a href="{{ route('productsIn.index') }}"><i class="fa fa-cart-plus"></i> <span>Purchase Products</span></a></li>
            @endrole
           

            @role('Admin')
                 <li><a href="{{ route('user.index') }}"><i class="fa fa-user-secret"></i> <span>System Users</span></a></li>
            @endrole

            @role('Admin')
                <li><a href="{{ route('permissions.index') }}"><i class="fa fa-user-secret"></i> <span>Manage Permisions</span></a></li>
            @endrole
            
            @role('Admin')
                 <li><a href="{{ route('roles.index') }}"><i class="fa fa-user-secret"></i> <span>Manage Roles</span></a></li> 
            @endrole


        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>

@endrole