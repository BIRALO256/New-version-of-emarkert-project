@extends('layouts.master')


@section('top')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content')
    <div class="box box-success">

        <div class="box-header">
            <h3 class="box-title">List of Permisions</h3>

            <a href="{{ route('permissions.create') }}" class="btn btn-success pull-right" style="margin-top: -8px;"><i class="fa fa-plus"></i> Add Permision</a>
        </div>


        <!-- /.box-header -->
        <div class="box-body">
            @if (session('success'))
                <div id="success-message" class="alert alert-success bg-green-500">
                    {{ session('success') }}
                </div>
            @endif
            <table id="permision-table" class="table table-bordered table-hover table-striped">
                <thead>
                <tr>
                    <th>Name</th>
                    <th width="40%">Description</th>
                    <th>Created By</th>
                    <th>Updated By</th>
                    <th scope="col" colspan="3" width="1%">Action</th> 
                </tr>
                </thead>

                <tbody>

                    {{-- LISTING PERMISIONS FOR PRODUCTS --}}


                    <tr >
                        <td colspan="4" ><h4 style="color: green; font-weight:bold">Products Management Permisions</h4></td>
                    </tr>
                    @foreach($product_permissions as $permission)
                        <tr>
                            <td>{{ $permission->name }}</td>
                            <td>{{ $permission->description }}</td>
                            <td>{{ $permission->created_by }}</td>
                            <td>{{ $permission->updated_by }}</td>

                            {{-- <td><a href="{{ route('permissions.edit',Crypt::encrypt($permission->id)) }}" class="btn btn-info btn-sm">Edit</a></td> --}}
                            <td>
                                {!! Form::open(['method' => 'DELETE','route' => ['permissions.destroy', $permission->id],'style'=>'display:inline']) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach

                    {{-- LISTING PERMISIONS FOR PRODUCT CATEGORIES --}}

                    <tr >
                        <td colspan="4"><h4 style="color: green; font-weight:bold">Category Management Permisions</h4></td>
                    </tr>
                    @foreach($category_permissions as $permission)
                        <tr>
                            <td>{{ $permission->name }}</td>
                            <td>{{ $permission->description }}</td>
                            <td>{{ $permission->create_by }}</td>
                            <td>{{ $permission->updated_by }}</td>
                            {{-- <td><a href="{{ route('permissions.edit',Crypt::encrypt($permission->id)) }}" class="btn btn-info btn-sm">Edit</a></td> --}}
                            <td>
                                {!! Form::open(['method' => 'DELETE','route' => ['permissions.destroy', $permission->id],'style'=>'display:inline']) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach


                    {{-- LISTING PERMISIONS FOR SALES MANAGEMENT --}}

                    <tr >
                        <td colspan="4"><h4 style="color: green; font-weight:bold">Sale Management Permisions</h4></td>
                    </tr>
                    @foreach($sale_permissions as $permission)
                        <tr>
                            <td>{{ $permission->name }}</td>
                            <td>{{ $permission->description }}</td>
                            <td>{{ $permission->create_by }}</td>
                            <td>{{ $permission->updated_by }}</td>
                            {{-- <td><a href="{{ route('permissions.edit',Crypt::encrypt($permission->id)) }}" class="btn btn-info btn-sm">Edit</a></td> --}}
                            <td>
                                {!! Form::open(['method' => 'DELETE','route' => ['permissions.destroy', $permission->id],'style'=>'display:inline']) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach


                    {{-- LISTING PERMISIONS FOR USERS --}}

                    <tr >
                        <td colspan="4"><h4 style="color: green; font-weight:bold">User Management Permisions</h4></td>
                    </tr>
                    @foreach($user_permissions as $permission)
                        <tr>
                            <td>{{ $permission->name }}</td>
                            <td>{{ $permission->description }}</td>
                            <td>{{ $permission->create_by }}</td>
                            <td>{{ $permission->updated_by }}</td>
                            {{-- <td><a href="{{ route('permissions.edit',Crypt::encrypt($permission->id)) }}" class="btn btn-info btn-sm">Edit</a></td> --}}
                            <td>
                                {!! Form::open(['method' => 'DELETE','route' => ['permissions.destroy', $permission->id],'style'=>'display:inline']) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach


                    {{-- LISTING PERMISIONS FOR SUPPLIERS --}}

                    <tr >
                        <td colspan="4"><h4 style="color: green; font-weight:bold">Supplier Management Permisions</h4></td>
                    </tr>
                    @foreach($supplier_permissions as $permission)
                        <tr>
                            <td>{{ $permission->name }}</td>
                            <td>{{ $permission->description }}</td>
                            <td>{{ $permission->create_by }}</td>
                            <td>{{ $permission->updated_by }}</td>
                            {{-- <td><a href="{{ route('permissions.edit',Crypt::encrypt($permission->id)) }}" class="btn btn-info btn-sm">Edit</a></td> --}}
                            <td>
                                {!! Form::open(['method' => 'DELETE','route' => ['permissions.destroy', $permission->id],'style'=>'display:inline']) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach


                    {{-- LISTING PERMISIONS FOR CUSTOMERS--}}

                    <tr >
                        <td colspan="4"><h4 style="color: green; font-weight:bold">Customer Management Permisions</h4></td>
                    </tr>
                    @foreach($customer_permissions as $permission)
                        <tr>
                            <td>{{ $permission->name }}</td>
                            <td>{{ $permission->description }}</td>
                            <td>{{ $permission->create_by }}</td>
                            <td>{{ $permission->updated_by }}</td>
                            {{-- <td><a href="{{ route('permissions.edit',Crypt::encrypt($permission->id)) }}" class="btn btn-info btn-sm">Edit</a></td> --}}
                            <td>
                                {!! Form::open(['method' => 'DELETE','route' => ['permissions.destroy', $permission->id],'style'=>'display:inline']) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach

                    {{-- LISTING PERMISIONS FOR ASSIGNING PERMISSION MANAGEMENT --}}

                    <tr >
                        <td colspan="4"><h4 style="color: green; font-weight:bold">Permision Management Permisions</h4></td>
                    </tr>
                    @foreach($p_permissions as $permission)
                        <tr>
                            <td>{{ $permission->name }}</td>
                            <td>{{ $permission->description }}</td>
                            <td>{{ $permission->create_by }}</td>
                            <td>{{ $permission->updated_by }}</td>
                            {{-- <td><a href="{{ route('permissions.edit',Crypt::encrypt($permission->id)) }}" class="btn btn-info btn-sm">Edit</a></td> --}}
                            <td>
                                {!! Form::open(['method' => 'DELETE','route' => ['permissions.destroy', $permission->id],'style'=>'display:inline']) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach

                    {{-- LISTING PERMISIONS FOR ROLE MANAGEMENT --}}

                    <tr >
                        <td colspan="4"><h4 style="color: green; font-weight:bold">Role Management Permisions</h4></td>
                    </tr>
                    @foreach($role_permissions as $permission)
                        <tr>
                            <td>{{ $permission->name }}</td>
                            <td class="w-1/2">{{ $permission->description }}</td>
                            <td>{{ $permission->create_by }}</td>
                            <td>{{ $permission->updated_by }}</td>
                            {{-- <td><a href="{{ route('permissions.edit',Crypt::encrypt($permission->id)) }}" class="btn btn-info btn-sm">Edit</a></td> --}}
                            <td>
                                {!! Form::open(['method' => 'DELETE','route' => ['permissions.destroy', $permission->id],'style'=>'display:inline']) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
    
@endsection

@section('bot')

    <!-- DataTables -->
    <script src=" {{ asset('assets/bower_components/datatables.net/js/jquery.dataTables.min.js') }} "></script>
    <script src="{{ asset('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }} "></script>

    {{-- Validator --}}
    <script src="{{ asset('assets/validator/validator.min.js') }}"></script>


    <script type="text/javascript">

    // js function to remove success message
    setTimeout(function() {
        document.getElementById('success-message').remove();
    }, 5000); // Remove the success message after 5 seconds (5000 milliseconds)

        var table = $('#permision-table').DataTable({
            processing: false,
            serverSide: true,
            ajax: "{{ route('permissions.index') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'nama', name: 'nama'},
                {data: 'harga', name: 'harga'},
                {data: 'qty', name: 'qty'},
                {data: 'show_photo', name: 'show_photo'},
                {data: 'category_name', name: 'category_name'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });

        function addForm() {
            save_method = "add";
            $('input[name=_method]').val('POST');
            $('#modal-form').modal('show');
            $('#modal-form form')[0].reset();
            $('.modal-title').text('Add Permision');
        }

        function editForm(id) {
            save_method = 'edit';
            $('input[name=_method]').val('PATCH');
            $('#modal-form form')[0].reset();
            $.ajax({
                url: "{{ url('products') }}" + '/' + id + "/edit",
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('#modal-form').modal('show');
                    $('.modal-title').text('Edit Products');

                    $('#id').val(data.id);
                    $('#nama').val(data.nama);
                    $('#harga').val(data.harga);
                    $('#qty').val(data.qty);
                    $('#category_id').val(data.category_id);
                },
                error : function() {
                    alert("Nothing Data");
                }
            });
        }

        function deleteData(id){
            var csrf_token = $('meta[name="csrf-token"]').attr('content');
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                cancelButtonColor: '#d33',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then(function () {
                $.ajax({
                    url : "{{ url('products') }}" + '/' + id,
                    type : "POST",
                    data : {'_method' : 'DELETE', '_token' : csrf_token},
                    success : function(data) {
                        table.ajax.reload();
                        swal({
                            title: 'Success!',
                            text: data.message,
                            type: 'success',
                            timer: '1500'
                        })
                    },
                    error : function () {
                        swal({
                            title: 'Oops...',
                            text: data.message,
                            type: 'error',
                            timer: '1500'
                        })
                    }
                });
            });
        }

        $(function(){
            $('#modal-form form').validator().on('submit', function (e) {
                if (!e.isDefaultPrevented()){
                    var id = $('#id').val();
                    if (save_method == 'add') url = "{{ url('products') }}";
                    else url = "{{ url('products') . '/' }}" + id;

                    $.ajax({
                        url : url,
                        type : "POST",
                        //hanya untuk input data tanpa dokumen
//                      data : $('#modal-form form').serialize(),
                        data: new FormData($("#modal-form form")[0]),
                        contentType: false,
                        processData: false,
                        success : function(data) {
                            $('#modal-form').modal('hide');
                            table.ajax.reload();
                            swal({
                                title: 'Success!',
                                text: data.message,
                                type: 'success',
                                timer: '1500'
                            })
                        },
                        error : function(data){
                            swal({
                                title: 'Oops...',
                                text: data.message,
                                type: 'error',
                                timer: '1500'
                            })
                        }
                    });
                    return false;
                }
            });
        });
    </script>

@endsection
