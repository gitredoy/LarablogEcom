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
                        <li class="breadcrumb-item active">View All Product</li>
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
                                Product List
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
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Category</th>
                                    <th>Brand</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Image</th>
                                    <th>Gallery</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                               <tbody>
                              @foreach($products  as $key => $pro)
                                  <tr>
                                      <td>{{$key+1}}</td>
                                      <td>{{optional($pro->category)->name}}</td>
                                      <td>{{optional($pro->brand)->name}}</td>
                                      <td>{{$pro->name}}</td>
                                      <td>{{$pro->price}}</td>
                                      <td><img height="65px" width="110px" src="{{asset('public/upload/products/'.$pro->image)}}" alt="product image"></td>
                                      <td>
                                          @foreach($pro -> productimage as $gallery)
                                              <img style="padding-bottom: 3px" height="50px" width="50px" src="{{asset('public/upload/products/'.$gallery->sub_image)}}" alt="product image">
                                          @endforeach

                                      </td>
                                      <td>
                                          <a href="{{route('products.single.view',['slug_name'=>$pro->slug_name])}}" class="btn btn-sm btn-secondary " title="Edit"><i class="fa fa-eye"></i></a>
                                          <a href="{{route('products.edit',['slug_name'=>$pro->slug_name])}}" class="btn btn-sm btn-primary " title="Edit"><i class="fa fa-edit"></i></a>
                                          <a id="deleteData" href="{{route('products.delete',['id'=>$pro->id])}}" class="btn btn-sm btn-danger " title="Edit"><i class="fa fa-trash"></i></a>
                                      </td>
                                  </tr>
                              @endforeach
                               </tbody>
                                <tfoot>
                                <tr>
                                    <th>Sl</th>
                                    <th>Category</th>
                                    <th>Brand</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                                </tfoot>
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
