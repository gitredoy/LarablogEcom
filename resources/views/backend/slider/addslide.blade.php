@extends('backend.layouts.master')
@section('main_content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Add Slider</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Slider</a></li>
                        <li class="breadcrumb-item active">Add Slider</li>
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
                                <i class="fa fa-image mr-1"></i>
                                 Add Slider
                            </h3>
                            <div class="card-tools">
                                <ul class="nav nav-pills ml-auto">
                                    <li class="nav-item">
                                        <a class="btn btn-success btn-sm" href="{{route('sliders.view')}}" ><i class="fa fa-plus-circle"></i> View Slider</a>
                                    </li>
                                </ul>
                            </div>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <form enctype="multipart/form-data" id="mySlider" method="post" action="{{route('sliders.store')}}">
                                {{csrf_field()}}
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="shorttext">Short Description</label>
                                        <textarea name="shorttext" id="shorttext" cols="2" rows="1" class="form-control"></textarea>
                                        @error('shorttext')
                                        <span class="text-warning">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="longtext">Long Description</label>
                                        <textarea name="longtext" id="longtext" cols="2" rows="1" class="form-control"></textarea>
                                        @error('longtext')
                                        <span class="text-warning">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Select Slider</label>
                                        <input  onchange="loadFile(event)"  type="file" name="image" class="form-control-file">
                                        @error('image')
                                        <span class="text-warning">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label id="newimage" for="usertype"></label>
                                        <p class="mt-2 mb-3" ><img  id="output"  /></p>
                                    </div>

                                    <div class="col-md-12 text-center">
                                        <button style="width: 150px" class="btn btn-primary " type="submit">Submit</button>
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
            $('#output').addClass('img-fluid');
            $('#newimage').html('New Slider');
        };
    </script>
    <!-- jquery-validation -->
    <script src="{{asset('public/backend')}}/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="{{asset('public/backend')}}/plugins/jquery-validation/additional-methods.min.js"></script>
    <script>
        $(function () {

            $('#mySlider').validate({
                rules: {
                    shorttext: {
                        required: true,
                    },
                    longtext: {
                        required: true,
                    },
                    image: {
                        required: true,
                        extension: "jpg|jpeg|png|ico|bmp"
                    },
                },
                messages: {
                    shorttext: {
                        required: "Please Add Short Description",
                    },
                    longtext: {
                        required: "Please Add Long Description",
                    },
                    image: {
                        required: "Please Select A Valid Image",
                        extension: "Please upload file in these format only (jpg, jpeg, png, ico, bmp)."
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


