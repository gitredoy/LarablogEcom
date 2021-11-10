@extends('backend.layouts.master')
@section('main_content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Manage User</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">User</a></li>
                        <li class="breadcrumb-item active">Add User</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
        <hr>
    </div>

    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Main row -->
            <div class="row justify-content-md-center">
                <!-- Left col -->
                <section class="col-md-9">
                    <!-- Custom tabs (Charts with tabs)-->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-user mr-1"></i>
                                Add User
                            </h3>
                            <div class="card-tools">
                                <ul class="nav nav-pills ml-auto">
                                    <li class="nav-item">
                                        <a class="btn btn-success btn-sm" href="{{route('users.view')}}" ><i class="fa fa-plus-circle"></i> View User</a>
                                    </li>
                                </ul>
                            </div>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <form id="myForm" method="post" action="{{route('users.store')}}">
                                {{csrf_field()}}
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="usertype">User Role</label>
                                        <select name="usertype" id="usertype" class="form-control">
                                            <option value="">Select Role</option>
                                            <option value="admin">Admin</option>
                                            <option value="user">User</option>
                                        </select>
                                        @error('usertype')
                                        <span class="text-warning">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="usertype">Name</label>
                                        <input value="{{old('name')}}" type="text" name="name" class="form-control">
                                        @error('name')
                                        <span class="text-warning">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="usertype">Email</label>
                                        <input value="{{old('email')}}" type="text" name="email" class="form-control">
                                        @error('email')
                                        <span class="text-warning">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="usertype">Password</label>
                                        <input type="password" name="password" id="password" class="form-control">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="usertype">Confirm Password</label>
                                        <input type="password" name="password2" class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <br>
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                </section>
                <!-- /.Left col -->
                <!-- right col (We are only adding the ID to make the widgets sortable)-->

                <!-- right col -->
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
@section('extraJs')
    <!-- jquery-validation -->
    <script src="{{asset('public/backend')}}/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="{{asset('public/backend')}}/plugins/jquery-validation/additional-methods.min.js"></script>
    <script>
        $(function () {

            $('#myForm').validate({
                rules: {
                    usertype: {
                        required: true,
                    },
                    name: {
                        required: true,
                    },
                    email: {
                        required: true,
                        email: true,
                    },
                    password: {
                        required: true,
                        minlength: 6
                    },
                    password2: {
                        required: true,
                        equalTo: '#password'
                    },
                },
                messages: {
                    usertype: {
                        required: "Please select user role",
                    },
                    name: {
                        required: "Please provide your name",
                    },
                    email: {
                        required: "Please enter a email address",
                        email: "Please enter a <mark>vaild</mark> email address"
                    },
                    password: {
                        required: "Please enter a strong password",
                        minlength: "Your password must be at least 6 characters long"
                    },
                    password2: {
                        required: "Please enter confirm password",
                        equalTo: "Confirm password does not match"
                    },
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
@endsection


