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
    <body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <div class="content-wrapper">
            <div class="content-header col-sm-12">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">{{ isset($detail)?"Edit Doctor":"Add Doctor" }}</h1>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ url("/admin/dashboard") }}">Home</a></li>
                                <li class="breadcrumb-item active">{{ isset($detail)?"Edit Doctor":"Add Doctor" }}</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <div class="col-md-12 border-right">
                <div class="p-3 py-5">
                    <div class="row">
                        <div class="col-sm-12">
                            <se class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Info</h3>
                                </div>
                            </se>
                        </div>
                    </div>
                    <form role="form" action="{{url("submit-doctors/form")}}" method="post" id="quickForm"
                          enctype="multipart/form-data">
                        @csrf
                        <input  type="hidden" name="id"  value="{{ isset($detail->id)?$detail->id:"" }}">
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label for="first_name" class="labels">First Name</label>
                                <input type="text" id="first_name" name="first_name" class="form-control" placeholder="first name" required=""
                                       value="{{ isset($detail->first_name)?$detail->first_name:"" }}" >
                            </div>
                            <div class="col-md-6">
                                <label for="last_name" class="labels">Surname</label>
                                <input type="text" id="last_name" name="last_name" class="form-control"  placeholder="surname" required=""
                                       value="{{ isset($detail->last_name)?$detail->last_name:"" }}"  >
                            </div>
                        </div>
                        <div class="row mt-10">
                            <div class="col-md-6">
                                <label for="phone_number" class="labels">Mobile Number</label>
                                <input type="text" id="phone_no" class="form-control" name="phone_no" placeholder="enter phone number" required=""
                                       value="{{ isset($detail->phone_no)?$detail->phone_no:"" }}" >
                            </div>
                            <div class="col-md-6">
                                 <label for="email" class="labels">Email</label>
                                <input type="email" id="email" name="email" class="form-control" placeholder="enter email" required=""
                                       value="{{ isset($detail->email)?$detail->email:"" }}" >
                            </div>

                            <div class="col-md-6">
                                <label for="password" class="labels">Password</label>
                                <input type="password" id="password" name="password" class="form-control" placeholder="enter password" required="">
                            </div>

                            <div class="col-md-6">
                                <label for="address" class="labels">Address</label>
                                <input type="text" id="address" name="address" class="form-control" placeholder="enter address" required=""
                                       value="{{ isset($detail->address)?$detail->address:"" }}" >
                            </div>
                            <div class="col-md-6">
                                <label for="web_address" class="labels">Web Address </label>
                                <input type="text" name="web_address" id="web_address" class="form-control" placeholder="enter web_address"
                                       value="{{ isset($detail->web_address)?$detail->web_address:"" }}"  >
                            </div>
                            <div class="col-md-6">
                                <label for="national_id" class="labels">National ID</label>
                                <input type="text" name="national_id" id="national_id" class="form-control" placeholder="enter National ID" required=""
                                       value="{{ isset($detail->national_id)?$detail->national_id:"" }}">
                            </div>
                            <div class="col-6">
                                    <label for="gender">Gender</label>
                                    <select   type="text" class="form-control" required=""  id="gender" name="gender" value="{{ isset($detail->gender)?$detail->gender:"" }}">
                                        <option value="Male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                            </div>
                            <div class="col-6">
                                    <label for="title">Title</label>
                                    <select   type="text" class="form-control" required=""  id="title" name="title" value="{{ isset($detail->title)?$detail->title:"" }}">
                                        <option>select Title</option>
                                        <option value="Doctor">Doctor</option>
                                    </select>
                            </div>
                            <div class=" col-12">
                                <label for="profile_">Profile Picture</label>
                                <div class="control">
                                    <input class="form-control" type="file" name="profile_picture" id="profile_picture" required="" value="{{ isset($detail->profile_picture)?$detail->profile_picture:"" }}" >
                                </div>
                                @if(isset($detail->profile_picture) && !empty($detail->profile_picture))<a href="{{asset($detail->profile_picture) }}"> Profile Image</a>@endif
                            </div>
                        </div>
                        <div class="mt-5 text-center">
                            <button class="btn btn-primary profile-button" type="submit"> Submit </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
    @section('script')
        <script src="{{ asset("assets/plugins/jquery-validation/jquery.validate.min.js") }}"></script>
        <script src="{{ asset("assets/plugins/jquery-validation/additional-methods.min.js") }}"></script>
        <script src="{{ asset("assets/plugins/sweetalert2/sweetalert2.min.js") }}"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <!-- SweetAlert2 -->
        <!-- Toastr -->
        <script src="{{ asset("assets/plugins/toastr/toastr.min.js") }}"></script>
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
            $('#quickForm').validate({
                /*rules:{
                    custom_instruction: {
                        maxlength: 100,
                    },collection_option_text: {
                        maxlength: 100,
                    },
                },*/
                submitHandler: function (form) {

                    $.ajax({
                        url:"{{ url("submit-doctors/form") }}",
                        type: 'POST',
                        data: new FormData(form),
                        mimeType: "multipart/form-data",
                        dataType:'json',
                        contentType: false,
                        cache: false,``
                        processData: false,
                        success:function (data) {
                            if(data.success){
                                Toast.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'profile add successfully',
                                    showConfirmButton: false,
                                    timer: 3000,
                                });
                                setTimeout(function () {
                                    window.location="{{ url("admin/get-users") }}"
                                },500)
                            }else{
                                Toast.fire({
                                    type: 'error',
                                    title: data.error.message
                                });
                            }
                        }
                    })
                }
            });
        </script>
        @if(Session::has('success'))
            <script>
                Toast.fire({
                    type: 'success',
                    title: '{{ Session::get("success") }}'
                })
            </script>

        @endif

@endsection
</body>
