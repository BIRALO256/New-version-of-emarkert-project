
<aside class="main-sidebar" style="background: whitesmoke">
    <style>
         .sidebar ul li a:hover{
        background-color: purple;
        color: white;
    }
    </style>

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <!-- <li class="header">Functions</li> -->
            <!-- Optionally, you can add icons to the links -->
            <h3 class="font-bold mx-5 uppercase my-2">My Account</h3>
           
                <li><a href="{{ route('account.index') }}"><i class="fa fa-user"></i></i> <span>My profile</span></a></li>
                <li><a href=""><i class="fa fa-commenting" aria-hidden="true"></i><span>My chats</span></a></li>     
                <li><a href="{{ route('account.create') }}"><i class="fa fa-address-card" aria-hidden="true"></i> <span>Address Book</span></a></li>
                {{-- <li><a href=""><i class="fa fa-money"></i> <span>Payment Methods</span></a></li> --}}
                <li><a href=""><i class="fa fa-handshake-o" aria-hidden="true"></i><span>My Orders</span></a></li>
                <hr class="py-5">
                <li><a href=""><span>Give us feedback</span></a></li>

                {!! Form::open(['method' => 'DELETE','route' => ['user.destroy', Auth::user()->id],'style'=>'display:inline']) !!}
                {!! Form::submit('Delete Account', ['class' => 'bg-red-400 w-1/2 m-auto mx-5 h-16 rounded-lg my-10 text-white']) !!}
                {!! Form::close() !!}

                <hr class="py-5">


                {!! Form::open(['method' => 'POST','route' => 'logout']) !!}
                {!! Form::submit('Log out', ['class' => 'bg-transparent w-1/2 m-auto mx-5 text-purple-900 uppercase font-bold text-2xl']) !!}
                {!! Form::close() !!}

                
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                    <button class="uppercase text-purple-500 font-bold">Log out</button>
                </form>
              

        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>

