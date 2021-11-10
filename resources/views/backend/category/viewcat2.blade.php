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
                    <h1 class="m-0">Manage Category (by Ajax)</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Category</a></li>
                        <li class="breadcrumb-item active">View All Category</li>
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
                <section class="col-md-7">
                    <!-- Custom tabs (Charts with tabs)-->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-user mr-1"></i>
                                Category List
                            </h3>
                            <div class="card-tools">
                                <ul class="nav nav-pills ml-auto">
                                    <li class="nav-item">
                                        <a class="btn btn-success btn-sm" href="" ><i class="fa fa-plus-circle"></i> </a>
                                    </li>
                                </ul>
                            </div>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                 <!-- Value Display From Ajax Request See script file -->
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Sl</th>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                </section>
                <section class="col-md-4">
                    <!-- Custom tabs (Charts with tabs)-->
                    <div class="card">
                        <div class="card-header">
                            <h3 id="addCat" class="card-title">
                                <a class="btn btn-success btn-sm"  ><i class="fa fa-plus-circle"></i> </a>
                                Add Category
                            </h3>
                            <h3 id="updateCat" class="card-title" style="display: none">
                                <a class="btn btn-primary btn-sm"><i class="fas fa-edit "></i> </a>
                                Update Category
                            </h3>

                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="form-group">
                                <label>Category Name</label>
                                <input type="text" class="form-control" id="name" placeholder="Name">
                                <span class="text-danger" id="nameerror"></span>
                            </div>
                            <div class="form-group">
                                <button onclick="storeData()" id="addBtn" type="submit" class="btn btn-primary">Submit</button>
                                <button style="display: none"  onclick="updateFromData()"  id="updateBtn" type="submit" class="btn btn-primary">Update</button>
                            </div>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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


    <!-- Ajax Action -->

    <script>
        function updateView(){
            $('#addCat').hide();
            $('#addBtn').hide();
            $('#updateCat').show();
            $('#updateBtn').show();
        }

        function clearData(){
            $('#name').val('');
        }
        //Add-Update-Delete Alert
        function addFromAlert(){
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
                icon: 'success',
                title: 'Data Added Successfully'
            })
        }
        function updateFromAlert(){
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
                icon: 'info',
                title: ' Data Updated Successfully'
            })
        }
        function deleteFromAlert(){
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
                title: 'Data Deleted Successfully'
            })
        }

        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        //GET ALL DATA
        function getData(){
            $.ajax({
                type:"GET",
                dataType:'json',
                url:'category/view',
                success: function (result){
                    var info = "";
                    var id = 1;
                    $.each(result,function (key,value){
                        info = info + "<tr>";
                        info = info + "<td>"+ id++ +"</td>";
                        info = info + "<td>"+ value.name +"</td>";
                        info = info + "<td>"+ value.created_at +"</td>";
                        info = info + "<td>";
                        info = info + "<button  style='margin-right: 2px' class='btn btn-sm btn-primary  '>Edit</button>";
                        info = info + "<button  class='btn btn-sm btn-danger '>Delete</button>";
                        info = info + "</td>";
                        info = info + "</tr>";
                    })
                    $('tbody').html(info);
                    console.log('my success');
                }
            });
        }
        getData();

        //INSERT STORE DATA
        function storeData(){
            var name = $('#name').val();
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: 'add/category/',
                data: {name:name},
                success: function (result){
                    clearData();
                    getData();
                    addFromAlert();
                },
                error: function (error){
                    $('#nameerror').html(error.responseJSON.errors.name);
                }
            })
        }

    </script>
@endsection
