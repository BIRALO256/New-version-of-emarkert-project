@extends('layouts.master')


@section('top')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content')
    <div class="box box-success">

        <div class="box-header">
            <h3 class="box-title">List of Roles</h3>

            <a href="{{ route('roles.create') }}" class="btn btn-success pull-right" style="margin-top: -8px;"><i class="fa fa-plus"></i> Add Role</a>
        </div>


        <!-- /.box-header -->
        <div class="box-body">
            {{-- printing the success message --}}
            @if (session('success'))
                <div id="success-message" class="alert alert-success bg-green-500">
            {{ session('success') }}
        </div>
                
            @endif
            <table id="roles-table" class="table table-bordered table-hover table-striped">
                <thead>
                <tr>
                    <th>Name</th>
                    <th width="40%">Description</th>
                    <th>Created By</th>
                    <th>Updated By</th>
                    <th colspan="3" width="3%">Action</th> 
                </tr>
                </thead>
                <tbody>
                    <tbody>
                        @foreach($roles as $key=>$role)
                            <tr>
                                <td>{{ $role->name }}</td>
                                <td>{{ $role->description }}</td>
                                <td>{{ $role->created_by }}</td>
                                <td>{{ $role->updated_by }}</td>

                                <td>
                                    <a class="btn btn-info btn-sm" href="{{ route('roles.show',Crypt::encrypt($role->id)) }}">View</a>
                                </td>
                                <td>
                                    <a class="btn btn-primary btn-sm" href="{{ route('roles.edit',Crypt::encrypt($role->id)) }}">Edit</a>
                                </td>
                                <td>
                                    {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy',Crypt::encrypt($role->id)],'style'=>'display:inline']) !!}
                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </tbody>
            </table>
            <div class="d-flex justify-content-center align-middle">
                {{  $roles->links('pagination::bootstrap-4')  }}
            </div>
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
    // js function to remove success message
    setTimeout(function() {
        document.getElementById('success-message').remove();
    }, 5000); // Remove the success message after 5 seconds (5000 milliseconds)

        var table = $('#roles-table').DataTable({
            processing: false,
            serverSide: true,
            ajax: "{{ route('roles.index') }}",
            columns: [
                {data: 'nama', name: 'nama'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });

        function addForm() {
            save_method = "add";
            $('input[name=_method]').val('POST');
            $('#modal-form').modal('show');
            $('#modal-form form')[0].reset();
            $('.modal-title').text('Add Products');
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
