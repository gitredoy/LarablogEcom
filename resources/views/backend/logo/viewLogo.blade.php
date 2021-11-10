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
                    <h1 class="m-0">Manage Logo</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Logo</a></li>
                        <li class="breadcrumb-item active">View Logo</li>
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
                <section class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h3>Website Logo</h3>
                        </div>
                        <div class="card-body">
                           <table class="table table-bordered">
                               <thead>
                               <tr>
                                   <td>Id</td>
                                   <td>Logo</td>
                                   <td>Updated By</td>
                                   <td>Change</td>
                               </tr>
                               </thead>
                               <tbody>
                               @foreach($logos as $logo)
                               <tr>
                                   <td>{{$logo->id}}</td>
                                   <td><img src="{{asset('public/upload/logo/'.$logo->image)}}" class="img-fluid" alt=""></td>
                                   <td>{{optional($logo->user)->name}}</td>
                                   <td>
                                       <a data-toggle="modal" href="#exampleModal">Change Logo</a>
                                   </td>

                               </tr>
                               @endforeach
                               </tbody>
                           </table>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Change Logo</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form id="logoForm" method="post" action="{{route('logo.update')}}" enctype="multipart/form-data">
                                            @csrf
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                   <div class="form-group">
                                                      <label>Select Logo</label>
                                                      <input  onchange="loadFile(event)"  type="file" name="image" class="form-control-file">

                                                   </div>

                                                </div>
                                                <div class="col-md-6">
                                                    <label id="newimage" for="usertype"></label>
                                                    <p class="mt-2 mb-3" ><img  id="output"  /></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                       </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

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
            $('#output').addClass('img-fluid');
            $('#newimage').html('New Logo');
        };
    </script>
    <!-- jquery-validation -->
    <script src="{{asset('public/backend')}}/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="{{asset('public/backend')}}/plugins/jquery-validation/additional-methods.min.js"></script>
    <script>
        $(function () {

            $('#logoForm').validate({
                rules: {
                    image: {
                        required: true,
                        extension: "jpg|jpeg|png|ico|bmp"
                    }
                },
                messages: {
                    image: {
                        required: "Please Select A Valid Image",
                        extension: "Please upload file in these format only (jpg, jpeg, png, ico, bmp)."
                    }
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
