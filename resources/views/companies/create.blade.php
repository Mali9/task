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
                            <h1 class="m-0 text-dark">{{trans('site.Companies')}}</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">{{trans('site.Home')}}</a></li>
                                <li class="breadcrumb-item active">{{trans('site.Companies')}}</li>
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
                                <!-- left column -->
                                <div class="col-md-12">
                                    <!-- general form elements -->
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h3 class="card-name">{{trans('site.Add/Edit_Company')}}</h3>
                                        </div>
                                        <!-- /.card-header -->
                                        <!-- form start -->
                                        @if (isset($company))
                                        <form role="form" action="{{url('/update/company',$company->id)}}" method="post"
                                            enctype="multipart/form-data">
                                            @else

                                            <form role="form" action="{{url('/store/company')}}" method="post"
                                                enctype="multipart/form-data">
                                                @endif
                                                @csrf
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">name</label>
                                                        <input required @if (isset($company)) value="{{$company->name}}"
                                                            @endif name="name" type="text" class="form-control"
                                                            id="exampleInputEmail1" placeholder="Enter name">
                                                    </div>


                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">url</label>
                                                        <input required @if (isset($company)) value="{{$company->url}}"
                                                            @endif name="url" type="text" class="form-control"
                                                            id="exampleInputEmail1" placeholder="Enter url">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">email</label>
                                                        <input required @if (isset($company)) value="{{$company->url}}"
                                                            @endif name="email" type="email" class="form-control"
                                                            id="exampleInputEmail1" placeholder="Enter email">
                                                    </div>


                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">logo</label>
                                                        <input name="logo" type="file" class="form-control"
                                                            id="exampleInputEmail1">
                                                        @if (isset($company))
                                                        <img src="{{$company->logo}}" width="150" height="50" alt="">
                                                        @endif
                                                    </div>



                                                </div>
                                                <!-- /.card-body -->

                                                <div class="card-footer">
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                            </form>
                                    </div>


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