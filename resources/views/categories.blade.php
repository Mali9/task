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
                            <h1 class="m-0 text-dark">categories</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">categories</li>
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
                                            <h3 class="card-title">All categories</h3>
                                            <a href="/create/category" class="btn btn-primary"
                                                style="margin-left: 20px">Create category</a>
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
                                                        <th>Category</th>
                                                        <th>Action</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if ($categories)
                                                    @foreach ($categories as $category)
                                                    <tr>
                                                        <td>{{$category->id}}</td>

                                                        <td>{{$category->category_name}}</td>

                                                        <td>{{$category->created_at}}</td>

                                                        <td>
                                                            <a href="/edit/category/{{$category->id}}"
                                                                class="btn btn-success">Edit</a>
                                                            <a href="/delete/category/{{$category->id}}"
                                                                class="btn btn-danger">Delete</a>
                                                        </td>



                                                    </tr>
                                                    @endforeach
                                                    @endif


                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                    {{$categories->links()}}
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