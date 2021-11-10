@extends('backend.layouts.master')
@section('extraCss')
    <style>

    </style>
@endsection
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
                        <li class="breadcrumb-item active">View All User</li>
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
                <section class="col-md-6">
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                     src="{{empty($user->image)?asset('public/upload/noImage.jpg'):asset('public/upload/users_image/'.$user->image)}}"
                                     alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center">{{$user->name}}</h3>

                            <p class="text-muted text-center">Role: Software Engineer</p>

                           <table class="table table-bordered">
                               <tbody>
                               <tr>
                                   <td>Email:</td>
                                   <td>{{$user->email}}</td>
                               </tr>
                               <tr>
                                   <td>Mobile:</td>
                                   <td>{{$user->mobile}}</td>
                               </tr>
                               <tr>
                                   <td>Gender:</td>
                                   <td class="text-capitalize">{{$user->gender}}</td>
                               </tr>
                               <tr>
                                   <td>Address:</td>
                                   <td>{{$user->address}}</td>
                               </tr>
                               <tr >
                                   <td colspan="2">
                                       <a href="{{route('profile.edit')}}" class="btn btn-primary btn-block"><b>Update Profile</b></a>
                                   </td>
                               </tr>
                               </tbody>
                           </table>


                        </div>
                        <!-- /.card-body -->
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

