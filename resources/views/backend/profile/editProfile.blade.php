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
                        <li class="breadcrumb-item"><a href="#">{{$user->name}}</a></li>
                        <li class="breadcrumb-item active"><a href="{{route('profile.view')}}">Go Back</a></li>
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
                                Edit Profile
                            </h3>
                            <div class="card-tools">
                                <ul class="nav nav-pills ml-auto">
                                    <li class="nav-item">
                                        <a class="btn btn-success btn-sm" href="{{route('profile.view')}}" ><i class="fa fa-plus-circle"></i> Go Back</a>
                                    </li>
                                </ul>
                            </div>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <form id="proForm" method="post" action="{{route('profile.update')}}" enctype="multipart/form-data">
                                {{csrf_field()}}
                                {{method_field('POST')}}
                                <div class="form-row">

                                    <div class="form-group col-md-4">
                                        <label for="usertype">Name</label>
                                        <input  type="text" name="name" value="{{$user->name}}" class="form-control">
                                        @error('name')
                                        <span class="text-warning">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="usertype">Email</label>
                                        <input value="{{$user->email}}" type="text" name="email" class="form-control">
                                        @error('email')
                                        <span class="text-warning">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="usertype">Mobile</label>
                                        <input value="{{$user->mobile}}" type="text" name="mobile" class="form-control">
                                        @error('mobile')
                                        <span class="text-warning">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="usertype">Gender</label>
                                        <select  name="gender"  class="form-control">
                                            <option value="">Select</option>
                                            <option value="male" {{($user -> gender == 'male') ?'selected':''}}>Male</option>
                                            <option value="female" {{ ($user -> gender == 'female') ?'selected':''}}>Female</option>
                                        </select>
                                        @error('gender')
                                        <span class="text-warning">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-8">
                                        <label for="usertype">Address</label>
                                        <textarea name="address" class="form-control" id="" cols="2" rows="1">{!! $user->address !!}</textarea>
                                        @error('address')
                                        <span class="text-warning">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="usertype">Image</label>
                                        <input  onchange="loadFile(event)"  type="file" name="image" class="form-control">
                                        @error('image')
                                        <span class="text-warning">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label  for="usertype"> Present Image</label>
                                                <img class="profile-user-img img-fluid img-circle"
                                                     src="{{empty($user->image)?asset('public/upload/noImage.jpg'):asset('public/upload/users_image/'.$user->image)}}"
                                                     alt="User profile picture">
                                            </div>
                                            <div class="col-md-6">
                                                <label id="newimage" for="usertype"></label>
                                                <p class="mt-2 mb-3" ><img style="height: 100px !important;" id="output"  /></p>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-md-12">
                                        <h5>Change Password <span style="margin-left: 30px !important;"><span > <input class="form-check-input checkbox" type="checkbox" value="" id="changePass"></span></span></h5>
                                        <br>
                                        <div id="showPassRow" style="display: none"  class="row showPassRow">
                                            <div class="form-group col-md-4">
                                                <label for="usertype">Current Password</label>
                                                <input readonly  onfocus="this.removeAttribute('readonly');"  type="password" name="current_pass" id="current_pass" class="form-control">
                                                @error('current_pass')
                                                <span class="text-warning">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="usertype">New Password</label>
                                                <input readonly  onfocus="this.removeAttribute('readonly');" type="password" name="new_pass" id="new_pass" class="form-control">
                                                @error('new_pass')
                                                <span class="text-warning">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="usertype">Confirm  Password</label>
                                                <input readonly  onfocus="this.removeAttribute('readonly');" type="password" name="confirm_pass" id="confirm_pass" class="form-control">
                                                @error('confirm_pass')
                                                <span class="text-warning">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-2">
                                        <br>
                                        <button class="btn btn-primary btn-block" type="submit">Update</button>
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
    <script>
        var loadFile = function(event) {
            var image = document.getElementById('output');
            image.src = URL.createObjectURL(event.target.files[0]);
            $('#output').addClass('img-fluid profile-user-img img-circle');
            $('#newimage').html('New Image');
        };
    </script>
    <!-- jquery-validation -->
    <script src="{{asset('public/backend')}}/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="{{asset('public/backend')}}/plugins/jquery-validation/additional-methods.min.js"></script>
    <script>
        $(document).ready(function(){
            // $('#showPassRow').hide();
            $('#changePass').on('click',function (){
                $('#showPassRow').toggle(1000);
            });

        });
    </script>
    <script>
        $(function () {

            $('#proForm').validate({
                rules: {
                    current_pass: {
                        required: true,
                    },
                    new_pass: {
                        required: true,
                        minlength: 6
                    },
                    confirm_pass: {
                        required: true,
                        equalTo: '#new_pass',
                    },


                },
                messages: {
                    current_pass: {
                        required: "Please enter current password",
                    },
                    new_pass: {
                        required: "Please enter new password",
                        minlength: "Password will be minimum 6 characters or number"
                    },
                    confirm_pass: {
                        required: "Please enter Confirm password",
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


