@extends('layouts.master')


@section('top')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    @vite('resources/app/app.css')
@endsection

@section('content')
    <div class="box box-success">

        <div class="box-header">
            <h3 class="box-title">List of System Users</h3>
        </div>

        <div class="box-header">
            @can('user-create')
            <a href="{{ route('user.create') }}" class="btn btn-success pull-right" ><i class="fa fa-plus"></i> Add User</a> 
            @endcan
        </div>

        <!-- /.box-header -->
        <div class="box-body">
             {{-- printing the success message --}}
             @if (session('success'))
             <div id="success-message" class="alert alert-success bg-green-500">
                 {{ session('success') }}
             </div>
         @endif
            <table id="user-table" class="table table-bordered table-hover table-striped">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Role</th>
                    <th>Created By</th>
                    <th>Updated By</th>
                    <th scope="col" colspan="3" width="1%">Action</th> 
                </tr>
                </thead>

                <tbody>

                    {{-- LISTING SYSTEM USERS --}}
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone_number }}</td>
                            <td>{{ $user->role }}</td>
                            <td>{{ $user->created_by }}</td>
                            <td>{{ $user->updated_by }}</td>


                            <td><a href="{{ route('user.edit',Crypt::encrypt($user->id)) }}" class="btn btn-info btn-sm">Edit</a></td>
                            <td>
                                {!! Form::open(['method' => 'DELETE','route' => ['user.destroy', $user->id],'style'=>'display:inline']) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach

                   
                </tbody>
            </table>
            {{-- Pagination --}}
        <div class="d-flex justify-content-center align-middle">
            {{  $users->links('pagination::bootstrap-4')  }}
        </div>
        </div>
        <!-- /.box-body -->
    </div>

    @include('suppliers.form')
@endsection

@section('bot')

    <!-- DataTables -->
    <script src=" {{ asset('assets/bower_components/datatables.net/js/jquery.dataTables.min.js') }} "></script>
    <script src="{{ asset('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }} "></script>

    {{-- Validator --}}
    <script src="{{ asset('assets/validator/validator.min.js') }}"></script>

    {{--<script>--}}
    {{--$(function () {--}}
    {{--$('#items-table').DataTable()--}}
    {{--$('#example2').DataTable({--}}
    {{--'paging'      : true,--}}
    {{--'lengthChange': false,--}}
    {{--'searching'   : false,--}}
    {{--'ordering'    : true,--}}
    {{--'info'        : true,--}}
    {{--'autoWidth'   : false--}}
    {{--})--}}
    {{--})--}}
    {{--</script>--}}

    <script type="text/javascript">

        setTimeout(function() {
                document.getElementById('success-message').remove();
            }, 5000); // Remove the success message after 5 seconds (5000 milliseconds)




        var table = $('#user-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('api.users') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'role', name: 'role'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
        function editForm(id) {
            save_method = 'edit';
            $('input[name=_method]').val('PATCH');
            $('#modal-form form')[0].reset();
            $.ajax({
                url: "{{ url('users') }}" + '/' + id + "/edit",
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('#modal-form').modal('show');
                    $('.modal-title').text('Edit Suppliers');

                    $('#id').val(data.id);
                    $('#name').val(data.name);
                    $('#email').val(data.email);
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
                    url : "{{ url('users') }}" + '/' + id,
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
                    if (save_method == 'add') url = "{{ url('suppliers') }}";
                    else url = "{{ url('suppliers') . '/' }}" + id;

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
