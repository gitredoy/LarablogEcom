
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
                    <h1 class="m-0">Manage Size (by Ajax)</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Size</a></li>
                        <li class="breadcrumb-item active">View All Size</li>
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
                                Size List
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
                                <a class="btn btn-primary btn-sm"  ><i class="fa fa-plus-circle"></i> </a>
                                Add Size
                            </h3>
                            <h3 id="updateCat" class="card-title" style="display: none">
                                <a class="btn btn-success btn-sm"><i class="fas fa-edit "></i> </a>
                                 Update Size
                            </h3>

                        </div><!-- /.card-header -->
                        <div id="testParent" class="card-body">
                            <div class="form-group">
                                <label>Size Name</label>
                                <input type="text" class="form-control " id="name" placeholder="Name">
                                <span class="text-danger" id="nameerror"></span>
                                <input type="hidden" id="catid">
                            </div>
                            <div class="form-group">
                                <button onclick="storeData()" id="addBtn" type="submit" class="btn btn-primary">Submit</button>
                                <button style="display: none"  onclick="updateFromData()"  id="updateBtn" type="submit" class="btn btn-success">Update</button>
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
    <!-- Ajax Action -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script>
        function defaultview(){
            $('#updateCat').hide();
            $('#updateBtn').hide();
            $('#addCat').show();
            $('#addBtn').show();
        }
        function updateView(){
            $('#addCat').hide();
            $('#addBtn').hide();
            $('#updateCat').show();
            $('#updateBtn').show();
        }

        function clearData(){
            $('#name').val('');
            $('#catid').val('');
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
                url:'size/view',
                success: function (result){
                    var info = "";
                    var id = 1;
                    $.each(result,function (key,value){
                        info = info + "<tr>";
                        info = info + "<td>"+ id++ +"</td>";
                        info = info + "<td>"+ value.name +"</td>";
                        info = info + "<td>"+ value.created_at+"</td>";
                        info = info + "<td>";
                        info = info + "<button onclick='editFromData("+value.id+")' style='margin-right: 2px' class='btn btn-sm btn-primary  '>Edit</button>";
                        info = info + "<button onclick='deleteFromData("+value.id+")' class='btn btn-sm btn-danger '>Delete</button>";
                        info = info + "</td>";
                        info = info + "</tr>";
                    })
                    $('tbody').html(info);

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
                url: 'size/store',
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

        //EDIT DATA
        function editFromData(id){
            $.ajax({
                type: "GET",
                dataType: 'json',
                url: 'size/edit/'+id,
                success:function (value){
                    $('#name').val(value.name);
                    $('#catid').val(value.id);
                    updateView();
                }

            })
        }

        //UPDATE DATA
        function updateFromData(){
            var name = $('#name').val();
            var id = $('#catid').val();
            $.ajax({
                type: "POST",
                dataType: 'json',
                data: {name:name},
                url:'size/update/'+id,
                success:function (result){
                    clearData();
                    getData();
                    defaultview();
                    updateFromAlert();
                },
                error:function (error){
                    $('#nameerror').html(error.responseJSON.errors.name);
                }
            })
        }

        //DELETE DATA
        function deleteFromData(id){
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                buttons:true,
                dangerMode:true,
            })
                .then((willDelete) => {
                    if (willDelete){
                        //Ajax Code
                        $.ajax({
                            type: 'GET',
                            dataType: 'json',
                            url:'size/delete/'+id,
                            success:function (){
                                getData();
                                defaultview();
                               deleteFromAlert();
                            }

                        })

                    }else {
                        swal("Canceled");
                    }
                });

        }

    </script>


@endsection
