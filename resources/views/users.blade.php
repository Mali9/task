@extends('layouts.app')
@section('content')



<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">




        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">users</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">users</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <section class="content">
                        <div class="container-fluid">
                            @include('layouts.message')
                            <div class="row">
                                <div class="col-12">
                                    <div class="card" style="height: 762px;">
                                        <div class="card-header">
                                            <h3 class="card-title">All users</h3>
                                            <button class="btn btn-primary" style="margin-left: 20px">Add user</button>
                                            <div class="card-tools">
                                                <div class="input-group input-group-sm" style="width: 150px;">
                                                    <input type="text" name="table_search"
                                                        class="form-control float-right" placeholder="Search">

                                                    <div class="input-group-append">
                                                        <button type="submit" class="btn btn-default"><i
                                                                class="fas fa-search"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body table-responsive p-0" style="height: 300px;">
                                            <table class="table table-head-fixed text-nowrap">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>

                                                        <th>User</th>

                                                        <th>Action</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if ($users)
                                                    @foreach ($users as $user)
                                                    <tr>
                                                        <td>{{$user->id}}</td>

                                                        <td>{{$user->name}}</td>


                                                        <td>
                                                            <button class="btn btn-success">Edit</button>
                                                            <button class="btn btn-danger">Delete</button>
                                                        </td>



                                                    </tr>
                                                    @endforeach
                                                    @endif


                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                    {{$users->links()}}
                                    <!-- /.card -->
                                </div>
                            </div>
                            <!-- /.row -->
                        </div><!-- /.container-fluid -->
                    </section>
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        @endsection