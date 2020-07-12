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
                            <h1 class="m-0 text-dark">{{trans('site.Employees')}}</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">{{trans('site.Home')}}</a></li>
                                <li class="breadcrumb-item active">{{trans('site.Employees')}}</li>
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
                                            <h3 class="card-first_name">{{trans('site.Add/Edit_Employees')}}</h3>
                                        </div>
                                        <!-- /.card-header -->
                                        <!-- form start -->
                                        @if (isset($employee))
                                        <form role="form" action="{{url('/update/employee',$employee->id)}}"
                                            method="post">
                                            @else

                                            <form role="form" action="{{url('/store/employee')}}" method="post">
                                                @endif
                                                @csrf
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">first name</label>
                                                        <input required @if (isset($employee))
                                                            value="{{$employee->first_name}}" @endif name="first_name"
                                                            type="text" class="form-control" id="exampleInputEmail1"
                                                            placeholder="Enter first name">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">last name</label>
                                                        <input required @if (isset($employee))
                                                            value="{{$employee->last_name}}" @endif name="last_name"
                                                            type="text" class="form-control" id="exampleInputEmail1"
                                                            placeholder="Enter last name">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">phone</label>
                                                        <input required @if (isset($employee))
                                                            value="{{$employee->phone}}" @endif name="phone" type="text"
                                                            class="form-control" id="exampleInputEmail1"
                                                            placeholder="Enter phone">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">email</label>
                                                        <input required @if (isset($employee))
                                                            value="{{$employee->phone}}" @endif name="email"
                                                            type="email" class="form-control" id="exampleInputEmail1"
                                                            placeholder="Enter email">
                                                    </div>




                                                    <div class="form-group">
                                                        <label>Select company</label>
                                                        <select required class="form-control" name="company_id">
                                                            @if ($companies)
                                                            @foreach ($companies as $company)
                                                            <option value="{{$company->id}}" @if (isset($employee))
                                                                {{$employee->company_id == $company->id ? 'selected' : ''}}
                                                                @endif>
                                                                {{$company->name}}</option>
                                                            @endforeach

                                                            @endif

                                                        </select>
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