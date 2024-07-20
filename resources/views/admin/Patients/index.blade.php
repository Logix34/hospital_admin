@extends('admin.layouts.app')
@section('content')
    <link rel="stylesheet" href="{{ asset("assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css")  }}">
    <link rel="stylesheet" href="{{ asset("assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css")  }}">
    <link rel="stylesheet" href="{{ asset("assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css")  }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset("assets/plugins/toastr/toastr.min.css")  }}">
    <style>
        td.details-control {
            background: url('{{ asset("assets/dist/img/details_open.png") }}') no-repeat center center;
            cursor: pointer;
            width: 18px;
        }
        tr.shown td.details-control {
            background: url('{{ asset("assets/dist/img/details_close.png") }}') no-repeat center center;
        }
    </style>
    <body class="hold-transition sidebar-mini layout-fixed">
    @if(Session::get('error_msg'))
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-ban"></i> Error!</h4>
            {{Session::get('error_msg')}}
        </div>
    @elseif(Session::get('success_msg'))
        <div class="alert alert-success alert-dismissable" style="margin-left: 259px;height: 72px;">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Success !</h4>
            {{Session::get('success_msg')}}
        </div>
    @endif
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Patient's Management</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url("admin/dashboard")}}">Home</a></li>
                            <li class="breadcrumb-item active">Patient's Management </li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <section class="content col-12">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h1 class="card-title">List</h1>
                            <div class="header-right" style="float: right">
                                @can('can-update')
                                    <a class="btn btn-dark btn-xs " href="{{ url("#") }}">Add New</a>
                                @endcan
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body col-12">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    </div>
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <form method="post" action="{{ url("#")}}">
                @csrf
                <div class="modal-content">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add patients</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </form>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <div>
    </div>
    </div><div class="modal fade" id="edit_product">
        <div class="modal-dialog">
            <form method="post" action="{{ url("#") }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add patients</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="">Name</label>
                            <div class="control">
                                <input class="form-control required" name="first_name" id="edit_product_name" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="">Status</label>
                            <div class="control">
                                <select class="form-control" name="status" id="status">

                                </select>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="id" id="edit_product_id">
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

@endsection
@section('script')
    <script src="{{ asset("assets/plugins/datatables/jquery.dataTables.min.js") }}"></script>
    <script src="{{ asset("assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js") }}"></script>
    <script src="{{ asset("assets/plugins/datatables-responsive/js/dataTables.responsive.min.js") }}"></script>
    <script src="{{ asset("assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js") }}"></script>
    <!-- SweetAlert2 -->
    <script src="{{ asset("assets/plugins/sweetalert2/sweetalert2.min.js") }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- Toastr -->
    <script src="{{ asset("assets/plugins/toastr/toastr.min.js") }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.7.6/handlebars.min.js"></script>
    <script>
        var base_url='{{ asset('/') }}';
        function format ( d) {
            var html = '';
            html += '<div class="row">';
            html += '<div class="col-6">';
            html+='<label>Profile picture:</label><img src="'+ base_url+d.profile_picture +'" width="150" alt="Profile Picture"/><br>';
            html += '<label>Name :</label>' + d.first_name+ ' ' + d.last_name+ '<br>';
            html += '<label>Phone Number:</label>' + d.phone_no+ '<br>';
            html += '<label>National Id:</label>' + d.national_id+ '<br>';
            html += '<label>Address:</label>' + d.address + '<br>';
            html += '<label>Email:</label>' + d.email + '<br>';
            html += '<label>Gender:</label>' + d.gender + '<br>';
            html += '<label>Web Address:</label>' + d.web_address + '<br>';
            html += '</div>';
            return html;
        }
        var dt = $('#example2').DataTable( {
            "processing": true,
            "serverSide": true,
            "ajax": "{{ url('')}}",
            "columns": [
                {
                    "class":          "details-control",
                    "orderable":      false,
                    "data":           null,
                    "defaultContent": ""
                },
                { "data": "name"},
                { "data": "status" },
                { "data": "action",searchable: true,orderable: false }
            ],
            "order": [[1, 'Asc']]
        } );
        var detailRows = [];
        $('#example2 tbody').on( 'click', 'tr td.details-control', function () {
            var tr = $(this).closest('tr');
            var row = dt.row( tr );
            var idx = $.inArray( tr.attr('id'), detailRows );

            if ( row.child.isShown() ) {
                tr.removeClass( 'details');
                row.child.hide();

                // Remove from the 'open' array
                detailRows.splice( idx, 1 );
            }
            else {
                tr.addClass( 'details' );
                row.child( format( row.data() ) ).show();

                // Add to the 'open' array
                if ( idx === -1 ) {
                    detailRows.push( tr.attr('id') );
                }
            }
        } );
    </script>
@endsection
</body>
