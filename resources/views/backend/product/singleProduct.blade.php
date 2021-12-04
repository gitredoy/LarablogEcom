@extends('backend.layouts.master')
@section('extraCss')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('public/backend')}}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{asset('public/backend')}}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{asset('public/backend')}}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
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
                        <li class="breadcrumb-item active">View Single Product</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Main row -->
            <div class="row justify-content-md-center">
                <!-- Left col -->
                <section class="col-md-12">
                    <!-- Custom tabs (Charts with tabs)-->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-user mr-1"></i>
                                Product Details
                            </h3>
                            <div class="card-tools">
                                <ul class="nav nav-pills ml-auto">
                                    <li class="nav-item">
                                        <a class="btn btn-success btn-sm" href="{{route('products.add')}}" ><i class="fa fa-plus-circle"></i> Add Product</a>
                                    </li>
                                </ul>
                            </div>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <style>
                                table tr th {
                                    width: 20% !important;

                                }
                            </style>
                            <table id="" class="table table-bordered table-striped">

                                <tr>
                                    <th>Product Name :</th>
                                    <td>{{$product->name}}</td>
                                </tr>

                                <tr>
                                    <th>Product Category :</th>
                                    <td> {{optional($product->category)->name}}</td>
                                </tr>

                                <tr>
                                    <th>Product Brand :</th>
                                    <td> {{optional($product->brand)->name}}</td>
                                </tr>

                                <tr>
                                    <th>Product Price :</th>
                                    <td>{{$product->price}}</td>
                                </tr>
                                <tr>
                                    <th>Product Colors :</th>
                                    <td>
                                        @php $last_key =  end($colors); @endphp
                                        @foreach($colors as $color)
                                           {{optional($color->productcolor)->name}}
                                            @if ($last_key != $loop->last)
                                                 {{','}}
                                            @else
                                                {{' '}}
                                            @endif
                                        @endforeach

                                    </td>
                                </tr>
                                <tr>
                                    <th>Product Size :</th>
                                    <td>
                                        @php $last_key =  end($sizes); @endphp
                                        @foreach($sizes as $key => $size)
                                            {{optional($size->productsize)->name}}
                                            @if ($last_key != $loop->last)
                                                {{','}}
                                            @else
                                                {{' '}}
                                            @endif
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>Product Image :</th>
                                    <td><img height="110px" width="130px" src="{{asset('public/upload/products/'.$product->image)}}" alt="product image"></td>
                                </tr>

                                <tr>
                                    <th>Product Sub Image :</th>
                                    <td>
                                        @foreach($product->productimage as $subimg)
                                            <img height="110px" width="130px" src="{{asset('public/upload/products/'.$subimg->sub_image)}}" alt="product image">
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>Short Description :</th>
                                    <td class="text-justify">{{$product->short_desc}}</td>
                                </tr>
                                <tr>
                                    <th>Long Description :</th>
                                    <td class="text-justify">{{$product->long_desc}}</td>
                                </tr>
                            </table>
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
    <!-- Delete Alert -->
    <script>
        $(function (){
            $(document).on('click','#deleteData',function (e){
                e.preventDefault();
                var link = $(this).attr("href");
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = link;
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    }
                })
            })
        })

    </script>

    <!-- DataTables  & Plugins -->
    <script src="{{asset('public/backend')}}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{asset('public/backend')}}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{asset('public/backend')}}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{asset('public/backend')}}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="{{asset('public/backend')}}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{asset('public/backend')}}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="{{asset('public/backend')}}/plugins/jszip/jszip.min.js"></script>
    <script src="{{asset('public/backend')}}/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="{{asset('public/backend')}}/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="{{asset('public/backend')}}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="{{asset('public/backend')}}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="{{asset('public/backend')}}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endsection
