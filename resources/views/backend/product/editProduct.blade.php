@extends('backend.layouts.master')
@section('extraCss')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #0400ff;
        }

        #cross{
            background-color: white;
            padding: 0px 6px 2px 6px;
            border-radius: 57%;
            font-weight: bold;
            color: red;
            position: absolute;
            left: 62px;
            bottom: 84px;
            cursor: pointer;
        }
    </style>

@endsection
@section('main_content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Manage Product</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Product</a></li>
                        <li class="breadcrumb-item active">Edit Product</li>
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
                <section class="col-md-11">
                    <!-- Custom tabs (Charts with tabs)-->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-user mr-1"></i>
                                Edit Product
                            </h3>
                            <div class="card-tools">
                                <ul class="nav nav-pills ml-auto">
                                    <li class="nav-item">
                                        <a class="btn btn-success btn-sm" href="{{route('products.view')}}" ><i class="fa fa-plus-circle"></i> View Product</a>
                                    </li>
                                </ul>
                            </div>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <form id="myForm" method="post" action="{{route('products.update',['id'=>$product->id])}}" enctype="multipart/form-data">
                                {{csrf_field()}}
                                @method('PUT')
                                <div class="form-row">
                                    <!--Category -->
                                    <div class="form-group col-md-4">
                                        <label for="usertype">Category</label>
                                        <select name="category" id="usertype" class="form-control">
                                            <option value="">Select Category</option>
                                            @foreach($categories as $cat)
                                                <option value="{{$cat->id}}"   @if($cat->id == $product-> category_id) selected  @endif >{{$cat->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('category')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <!--Brand -->
                                    <div class="form-group col-md-4">
                                        <label for="usertype">Brand</label>
                                        <select name="brand" id="usertype" class="form-control">
                                            <option value="">Select Brand</option>
                                            @foreach($brands as $brand)
                                                <option value="{{$brand->id}}"    @if($brand->id === $product-> brand_id) selected  @endif>{{$brand->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('brand')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <!--Color -->
                                    <div class="form-group col-md-4">
                                        <label for="usertype">Color</label>
                                        <select name="color[]" id="usertype" class="form-control select2 select2-hidden-accessible" multiple="" data-placeholder="Select Multiple Color" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                            @foreach($colors as $color)
                                             <option {{(in_array(['color_id' => $color->id],$color_array))?'selected':''}}  value="{{$color->id}}">{{$color->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('color')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <!--Size -->
                                    <div class="form-group col-md-4">
                                        <label for="usertype">Size</label>
                                        <select name="size[]" id="usertype" class="form-control select2 select2-hidden-accessible" multiple="" data-placeholder="Select Multiple Size" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                            <option value="">Select Size</option>
                                            @foreach($sizes as $size)
                                                <option {{(in_array([ 'size_id' => $size->id],$size_array))?'selected':''}} value="{{$size->id}}">{{$size->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('size')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="usertype">Name</label>
                                        <input value="{{$product->name}}" type="text" name="name" class="form-control">
                                        @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Price</label>
                                        <input value="{{$product->price}}" type="number" name="price" class="form-control">
                                        @error('price')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Short Description</label>
                                        <textarea name="short_desc" id="" cols="2" rows="2" class="form-control">{{$product->short_desc}}</textarea>
                                        @error('short_desc')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Long Description</label>
                                        <textarea name="long_desc" id="" cols="2" rows="5" class="form-control">{{$product->long_desc}}</textarea>
                                        @error('long_desc')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Sub Image(Multiple)</label>
                                        <input type="file" name="subimages[]" id="image" class="form-control" multiple>
                                        @error('subimages')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <br>
                                        <input type="hidden" id="mulid" value="{{$product->id}}">
                                        <h3> Gallery Image</h3>
                                        <span id="myspan">
                                        </span>

                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Primary Image</label>
                                        <input  onchange="loadFile(event)"  type="file" name="image" class="form-control-file">
                                        @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div id="activePrimaryImage" class="form-group col-md-4">
                                        <label> Active Primary Image</label>
                                        <br>
                                        <img height="170px" width="270px" src="{{asset('public/upload/products/'.$product->image)}}" alt="product image">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label id="newimage" for="usertype"></label>
                                        <style>
                                            .fghj{
                                                text-align: center;
                                                height: 170px;
                                                width: 270px;
                                            }
                                        </style>
                                        <p class="mt-2 mb-3" ><img   id="output"  /></p>
                                    </div>

                                    <div class="col-md-4">
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                        <a href="{{route('products.view')}}" class="btn btn-secondary" type="submit">Back</a>
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
        var loadFile = function(event) {
            var image = document.getElementById('output');
            image.src = URL.createObjectURL(event.target.files[0]);
            $('#activePrimaryImage').hide();
            $('#output').addClass('fghj');
            $('#newimage').html('New Primary Image');
        };
    </script>

    <!-- select2 multiple value -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script>
        //select 2 multiple value
        $(document).ready(function() {
            $('.select2').select2({
                closeOnSelect: false
            });
        });
    </script>
    <script>
        $(function () {

            $('#myForm').validate({
                rules: {
                    category: {
                        required: true,
                    },
                    brand: {
                        required: true,
                    },
                    color: {
                        required: true,
                    },
                    size: {
                        required: true,
                    },
                    name: {
                        required: true,
                    },
                    price: {
                        required: true,
                    },
                    short_desc: {
                        required: true,
                    },
                    long_desc: {
                        required: true,
                    },

                },
                messages: {
                    category: {
                        required: "Please select category",
                    },
                    brand:{
                        required: "Please select brand",
                    },
                    color:{
                        required: "Please select color",
                    },
                    size:{
                        required: "Please select size",
                    },
                    name: {
                        required: "Please provide product name",
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

    <script>


        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })

        //EDIT DATA
        setInterval(function (){
            function getData(){
                var id = $('#mulid').val();
                $.ajax({
                    type: "GET",
                    dataType: 'json',
                    url: '{{URL::to('products/show-multiple-image')}}/'+id,
                    success: function (result){
                        var info = "";
                        $.each(result,function (key,value){
                            info = info + "<img  style='padding: 5px;' height='80px' width='80px' src='{{asset('public/upload/products')}}/"+value.sub_image+" ' alt='product image'>";
                            info = info + "<a href='javascript:void(0);' onclick='deleteMultipleImage("+value.id+")' style='cursor: pointer;color: red;background: white;padding: 1px;font-weight: bolder' >&#9747;</a>";
                        })
                        $('#myspan').html(info);
                    }
                })
            }
            getData();
        },1000);

        //deleteMultipleImage
        function deleteMultipleImage(id){
            $.ajax({
                type: "GET",
                dataType: 'json',
                url: '{{URL::to('products/delete-multiple-image')}}/' + id,
                success: function (result) {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 1200,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })
                    Toast.fire({
                        icon: 'warning',
                        title: 'Image Deleted Successfully'
                    })
                }
            })
        }
    </script>


@endsection


